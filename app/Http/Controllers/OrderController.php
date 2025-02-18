<?php

namespace App\Http\Controllers;

use App\Models\AffiliatePoint;
use App\Models\Member;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $orders = new Order;
        $search = $orders->query();

        $fromdate = $request->input("from") ?? "";
        $todate = $request->input("to") ?? "";

        if ($request->search == 'search') {
            if ($request->tracking_code) {
                $search->where('id', '=', $request->tracking_code);
            }
        }

        if ($request->status) {
            $search->where('status', '=', $request->status);
        }

        if ($fromdate) {
            $search = $search->whereDate('created_at', ">=", $fromdate);
        }
        if ($todate) {
            $search = $search->whereDate('created_at', "<=", $todate);
        }

        $orders = $search->latest()->paginate(siteSettings('posts_per_page'));
        return view('admin.order.index', compact('orders', 'request'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }
    public function show()
    {

        $orders = DB::table('order_statuses as a')
            ->join('orders as b', 'a.order_id', '=', 'b.id')
            ->join('members as m', 'a.user_id', '=', 'm.id')
            ->select("a.*", "b.*", "m.name", "a.status as order_status")
            ->orderBy('a.id', 'desc')
            ->paginate(siteSettings('posts_per_page'));
        return view('admin.order.cancel', compact('orders'));
    }
    public function exchange()
    {

        $orders = DB::table('order_details as a')
            ->join('exchanges as b', 'a.item_id', '=', 'b.item_id')
            ->join('members as m', 'b.user_id', '=', 'm.id')
            ->where('a.status', 'wanttoexchange')
            ->orWhere('a.status', 'exchanged')
            ->select("a.*","a.order_id as myorder_id","a.product_name as old_product_name","a.price as old_price","a.quantity as old_quantity", "b.*", "m.name","m.mobileno as mobile", "a.status as order_status")
            ->orderBy('b.id', 'desc')
            ->paginate(siteSettings('posts_per_page'));
        return view('admin.order.exchange', compact('orders'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function showdetails($pid)
    {

        $orderid = $pid;

      

        $orders = DB::table('orders as a')
            ->join('order_details as b', 'b.order_id', '=', 'a.id')
            ->where('a.id', $orderid)
            ->get()->toArray();

          

        $user_id = $orders[0]->user_id;

        $userdata = DB::table('members')
            ->leftJoin('provinces', 'provinces.id', '=', 'members.state')
            ->leftJoin('districts', 'districts.id', '=', 'members.district_id')
            ->select('members.*', 'provinces.name as statename', 'provinces.id as stateid', 'districts.district')
            ->where('members.id', $user_id)
            ->get()->toArray();

        $shippings = DB::table('shippings')
            ->leftJoin('provinces', 'provinces.id', '=', 'shippings.province')
            ->leftJoin('districts', 'districts.id', '=', 'shippings.district_id')
            ->select('shippings.*', 'provinces.name as statename', 'provinces.id as stateid', 'districts.district')
            ->where('member_id', $user_id)
            ->get()->toArray();


        return view('admin.order.show', compact('orders', 'userdata', 'shippings'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        return view('admin.order.edit', compact('order'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {
        $request->validate([
            'status' => 'required',
        ]);
        if ($request->status == "Delevered") {
            $affiliate = AffiliatePoint::where("order_id", $order->id)->first();
            if ($affiliate) {
                $member = Member::where("id", $affiliate->user_id)->first();
                $member->total_points += $affiliate->points;
                $member->save();
                $affiliate->status = "COMPLETED";
                $affiliate->save();
            }
        }

        $order->status = $request->input('status');
        $order->update();
        return redirect()->route('order.index')->with('success', 'Order status updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        //
    }

    public function exchangeorreturn()
    {
        dd("aa");
        $orders = DB::table('order_statuses as a')
            ->join('orders as b', 'a.order_id', '=', 'b.id')
            ->join('members as m', 'a.user_id', '=', 'm.id')
            ->get()->toArray();
        return view('admin.order.exchange', compact('orders', 'request'));
    }
}
