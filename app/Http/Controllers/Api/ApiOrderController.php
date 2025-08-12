<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\AffiliatePoint;
use App\Models\Exchange;
use App\Models\Member;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ApiOrderController extends Controller
{
    //

    public function order($userId)
    {
        $orders = Order::with([
            'orderDetails',
            'shipping.getMunicipality',
            'shipping.getprovince',
            'shipping.getDistrict'
        ])
            ->where('user_id', $userId)
            ->where('status', 'Pending')
            ->get();

        return response()->json([
            'status' => true,
            'orders' => $orders
        ]);
    }


    public function ongoingorder($userId)
    {

        $ongoingorder = Order::with([
            'orderDetails',
            'shipping.getMunicipality',
            'shipping.getprovince',
            'shipping.getDistrict'
        ])
            ->where('user_id', $userId)
            ->where('status', 'Ongoing')
            ->get();
        // $ongoingorder = Order::with('orderDetails')
        //     ->where('user_id', $userId)->where('status', 'Ongoing')
        //     ->get();

        return response()->json([
            'status' => true,
            'order' => $ongoingorder
        ]);
    }


    public function deliveredorder($userId)
    {

        $ongoingorder = Order::with([
            'orderDetails',
            'shipping.getMunicipality',
            'shipping.getprovince',
            'shipping.getDistrict'
        ])
            ->where('user_id', $userId)
            ->where('status', 'Delevered')
            ->get();

        // $ongoingorder = Order::with('orderDetails')
        //     ->where('user_id', $userId)->where('status', 'Delevered')
        //     ->get();

        return response()->json([
            'status' => true,
            'order' => $ongoingorder
        ]);
    }

    public function cancelledorder($userId)
    {


        $ongoingorder = Order::with([
            'orderDetails',
            'shipping.getMunicipality',
            'shipping.getprovince',
            'shipping.getDistrict'
        ])
            ->where('user_id', $userId)
            ->where('status', 'Cancel')
            ->get();

        return response()->json([
            'status' => true,
            'order' => $ongoingorder
        ]);
    }



    public function exchange($userId)
    {
        $ongoingOrders = Exchange::with("orderDetails", "orderDetails.order")->where("user_id", $userId)->orderBy("id","desc")->get();
        error_log(json_encode($ongoingOrders));

        // $ongoingOrders = Order::with('orderDetails')
        //     ->where('user_id', $userId)
        //     ->get();

        return response()->json([
            'status' => true,
            'data' => $ongoingOrders
        ]);
    }


    public function exchangeupdate(Request $request)
    {
        error_log("aa");
        $exchange = $request->exchanges;

        $order_details = DB::table('order_details')
            ->where("item_id", $exchange['item_id'])
            ->update(['status' => "wanttoexchange"]);

        // error_log("aabishkar" , $order_details);
        error_log(json_encode("aabishkar" , $order_details));

        Exchange::create(attributes: [
            'item_id' => $exchange['item_id'],
            // 'new_product_id' => $exchange['new_product_id'] ?? null,
            'product_name' => $exchange['product_name'],
            'price' => $exchange['price'],
            'user_id' => $exchange['user_id'],
            'attribute' => $exchange['attribute'] ?? '',
            'status' => $exchange['status'] ?? 'pending',
            'points' => ($exchange['quantity']) * ($exchange['price']),
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Exchange request submitted successfully.',
        ]);
    }


    public function referralcode(Request $request, $userId)
    {
        error_log("Referral code called2");

        $member = Member::find($userId);
        error_log(json_encode($member));
        $request->validate([
            'webcode' => 'required|string',
        ]);

        $webcode = $request->input('webcode');
        error_log(json_encode($webcode));

        // Check if a member exists with the given affiliate code and verified status
        $checkmember = Member::where('affilate_code', $webcode)->first();
        error_log(json_encode($checkmember));

        if (!$checkmember) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid or unverified affiliate code.',
            ], 200);
        }
        if ($member->id == $checkmember->id) {
            return response()->json([
                'success' => false,
                'message' => 'You cannot refer yourself.',
            ], 200);

        }


        return response()->json([
            'success' => true,
            'message' => 'Affiliate code Successfully Applied.',
            'member_id' => $checkmember->id // optional: return member ID
        ]);
    }


    public function checkexchange($item_id)
    {

        $checkexchange = Exchange::where("item_id", $item_id)->first();

        if ($checkexchange) {
            if ($checkexchange->status == "pending") {
                return response()->json([
                    'success' => false,
                    'message' => 'Exchange on pending ',
                ], 200);
            }
            if ($checkexchange->status == "exchanged") {
                return response()->json([
                    'success' => false,
                    'message' => 'Product Exchanged ',
                ], 200);
            }
        }
        return response()->json([
            'success' => true,
            'message' => 'No product Found.',
        ]);
    }

    // public function referralcode(Request $request)
// {
//     $request->validate([
//         'webcode' => 'required|string',
//         'order_id' => 'required|numeric',
//         'points' => 'required|numeric',
//         'point_status' => 'required|string',
//     ]);

    //     $webcode = $request->input('webcode');
//     $orderId = $request->input('order_id');
//     $points = $request->input('points');
//     $pointStatus = $request->input('point_status');

    //     // Check member from affiliate code
//     $checkmember = Member::where("affilate_code", $webcode)
//                     ->where("share_status", "verified")
//                     ->first();

    //     if (!$checkmember) {
//         return response()->json([
//             'success' => false,
//             'message' => 'Invalid or unverified affiliate code.',
//         ], 404);
//     }

    //     // Create affiliate point record
//     $affiliate = AffiliatePoint::create([
//         'user_id' => $checkmember->id,
//         'order_id' => $orderId,
//         'points' => $points,
//         'status' => "PENDING",
//         'point_status' => $pointStatus,
//     ]);

    //     return response()->json([
//         'success' => true,
//         'message' => 'Affiliate points stored successfully.',
//         'data' => $affiliate
//     ]);
// }





}
