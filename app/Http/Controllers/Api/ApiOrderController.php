<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Exchange;
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
}
