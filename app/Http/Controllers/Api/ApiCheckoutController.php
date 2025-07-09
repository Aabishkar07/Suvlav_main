<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use function GuzzleHttp\json_decode;
use App\Mail\Order as MailOrder;

class ApiCheckoutController extends Controller
{
    public function checkitemid()
    {

        $item_id = rand(100000, 999999);
        $check = $cartItems = DB::table('order_details')
            ->where('item_id', $item_id)
            ->first();
        if ($check) {
            $this->checkitemid();
        }
        return $item_id;
    }

    public function placeorder(Request $request)
    {
        error_log("placeorder");

        $allData = $request->all();
        if (empty($allData)) {
            error_log("No data in request");
        } else {
            error_log(json_encode($allData));


            if (count($allData["cart"]) == 0) {
                return redirect('/view-cart')->with('message', 'Cart is empty');
            }

            $DatacartItems = $allData["cart"];


            $user_id = $allData["user_id"];
            $details = $allData["address"];
            $guest_id = 0;
            $member = $user_id != 0 ? Member::findOrFail($user_id) : null;

            $item_count = $totalprice = $totalqnty = 0;

            foreach ($DatacartItems as $cc) {
                $item_count++;
                $totalprice += $cc["price"] * $cc["quantity"];
                $totalqnty += $cc["quantity"];
            }

            // Apply Redeem Points
            if (isset($allData["redeem_points"]) && $member) {
                error_log("aaaaaaaabbb");
                $points = $member->total_points;
                $usedPoints = min($totalprice, $points);
                $totalprice -= $usedPoints;
                $member->total_points -= $usedPoints;
                $member->save();
                $allData["redeem_points"] = $usedPoints;
            }

            $trackingid = rand(10000, 99999);

            $cart_order = [
                'user_id' => $user_id,
                'total_amt' => $totalprice,
                'total_items' => $item_count,
                'total_no_qnty' => $totalqnty,
                'fullname' => $details["name"],
                'email' => $details["email"],
                'mobile' => $details["phone"],
                'province' => $details["state"],
                'district_id' => $details["district"],
                'tole' => $details["tole"],
                'tracking_code' => $trackingid,
                'created_at' => now()
            ];


            $orderid = DB::table('orders')->insertGetId($cart_order);

            foreach ($DatacartItems as $cc) {

                $cart_orders = [
                    'order_id' => $orderid,
                    'item_id' => $this->checkitemid(),
                    'product_id' => $cc['id'],
                    'product_name' => $cc['title'],
                    'product_image' => $cc['image'],
                    'quantity' => $cc['quantity'],
                    'attributes' => isset($cc['variant']) ? json_encode($cc['variant']) : '',
                    'price' => $cc['price'],
                    'created_at' => now()
                ];

                DB::table('order_details')->insert($cart_orders);
            }

            // Handle shipping
            $existingShipping = DB::table('shippings')->where('member_id', $user_id)->first();
            $memberData = [
                'member_id' => $user_id,
                'guest_id' => $guest_id,
                'fullname' => $details["name"],
                'email' => $details["email"],
                'mobile' => $details["phone"],
                'province' => $details["state"],
                'district_id' => $details["district"],
                'tole' => $details["tole"],
                'nagarpalika' => $details["municipality"],
                'wardno' => $details["ward"]
            ];

            if (!$existingShipping) {
                error_log("exists");
                $memberData['created_at'] = now();
                DB::table('shippings')->insert($memberData);
            } else {
                DB::table('shippings')->where('id', $existingShipping->id)->update($memberData);
            }

            // Email
            $orders = DB::table('orders as a')
                ->join('order_details as b', 'b.order_id', '=', 'a.id')
                ->where('a.id', $orderid)
                ->get();

            $userdata = DB::table('members')
                ->leftJoin('provinces', 'provinces.id', '=', 'members.state')
                ->leftJoin('districts', 'districts.id', '=', 'members.district_id')
                ->select('members.*', 'provinces.name as statename', 'provinces.id as stateid', 'districts.district')
                ->where('members.id', $user_id)
                ->first();

            $shipping = DB::table('shippings')
                ->leftJoin('provinces', 'provinces.id', '=', 'shippings.province')
                ->leftJoin('districts', 'districts.id', '=', 'shippings.district_id')
                ->select('shippings.*', 'provinces.name as statename', 'provinces.id as stateid', 'districts.district')
                ->where('member_id', $user_id)
                ->first();

            $maildata = [$orders, $userdata, $shipping];


            // Mail::to(config('mail.admin'))->send(new MailOrder($maildata));
            // Mail::to($details["email"])->send(new MailOrder($maildata));
            error_log("dddsasdd");
            return response()->json([
                'message' => 'Order successfully Placed',
                'status' => 200
            ]);

        }


    }
}
