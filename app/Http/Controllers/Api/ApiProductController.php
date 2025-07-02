<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Number;

class ApiProductController extends Controller
{
    public function allproduct()
    {
        $products = Product::latest()->get();
       

        return response()->json([
            'status' => '200',
            'data' => $products
        ], 200);
    }

    public function singlepage($product)
    {
        $products = Product::where("id", (int) $product)->first();
        return response()->json([
            'status' => '200',
            'data' => $products
        ], 200);
    }
}
