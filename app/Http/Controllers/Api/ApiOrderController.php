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
        $orders = Order::with('orderDetails')
            ->where('user_id', $userId)->where('status', 'Pending')
            ->get();

        return response()->json([
            'status' => true,
            'orders' => $orders
        ]);
    }


    public function ongoingorder($userId)
    {
        $ongoingorder = Order::with('orderDetails')
            ->where('user_id', $userId)->where('status', 'Ongoing')
            ->get();

        return response()->json([
            'status' => true,
            'order' => $ongoingorder
        ]);
    }


    public function deliveredorder($userId)
    {
        $ongoingorder = Order::with('orderDetails')
            ->where('user_id', $userId)->where('status', 'Delevered')
            ->get();

        return response()->json([
            'status' => true,
            'order' => $ongoingorder
        ]);
    }

    public function cancelledorder($userId)
    {
        $ongoingorder = Order::with('orderDetails')
            ->where('user_id', $userId)->where('status', 'Cancel')
            ->get();

        return response()->json([
            'status' => true,
            'order' => $ongoingorder
        ]);
    }



public function exchange($userId)
{
    $ongoingOrders = Order::with('orderDetails')
        ->where('user_id', $userId)
        ->get();

    return response()->json([
        'status' => true,
        'order' => $ongoingOrders
    ]);
}


    public function exchangeupdate(Request $request)
    {
        $request->validate([
            'exchanges' => 'required|array',
            'exchanges.*.item_id' => 'required|integer',
            'exchanges.*.user_id' => 'required|integer',
            'exchanges.*.product_name' => 'required|string',
            'exchanges.*.price' => 'required|numeric',
        ]);

        foreach ($request->exchanges as $exchangeData) {
            \App\Models\Exchange::create([
                'item_id' => $exchangeData['item_id'],
                // 'new_product_id' => $exchangeData['new_product_id'] ?? null,
                'product_name' => $exchangeData['product_name'],
                'price' => $exchangeData['price'],
                'user_id' => $exchangeData['user_id'],
                'attribute' => $exchangeData['attribute'] ?? '',
                'status' => $exchangeData['status'] ?? 'pending',
                // 'points' => $exchangeData['price'] ?? 0,
                'points' => ($exchangeData['quantity']) * ($exchangeData['price']),

            ]);
        }
        return response()->json([
            'status' => true,
            'message' => 'Exchange request submitted successfully.',
        ]);
    }


public function referralcode(Request $request)
{
    $request->validate([
        'webcode' => 'required|string',
    ]);

    $webcode = $request->input('webcode');

    // Check if a member exists with the given affiliate code and verified status
    $checkmember = Member::where('affilate_code', $webcode)
                        ->where('share_status', 'verified')
                        ->first();

    if (!$checkmember) {
        return response()->json([
            'success' => false,
            'message' => 'Invalid or unverified affiliate code.',
        ], 404);
    }

    return response()->json([
        'success' => true,
        'message' => 'Affiliate code is valid and verified.',
        'member_id' => $checkmember->id // optional: return member ID
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
