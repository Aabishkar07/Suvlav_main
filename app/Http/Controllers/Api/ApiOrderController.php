<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
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


}
