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
                   ->where('user_id', $userId)->where('status' , 'Pending')
                   ->get();

    return response()->json([
        'status' => true,
        'orders' => $orders
    ]);
}
}
