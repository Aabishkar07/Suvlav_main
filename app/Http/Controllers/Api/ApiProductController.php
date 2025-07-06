<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductColor;
use App\Models\ProductSize;
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

        // Product Sizes
        $prod_sizes = [];
        if ($product->prod_sizes != '') {
            $prod_sizeIds = json_decode($product->prod_sizes, true);
            $prod_sizes = ProductSize::whereIn('id', $prod_sizeIds)
                ->where('status', '1')
                ->orderBy('order', 'asc')
                ->get();
        }

        // Product Colors
        $prod_colors = [];
        if ($product->prod_colors != '') {
            $prod_colorIds = json_decode($product->prod_colors, true);
            $prod_colors = ProductColor::whereIn('id', $prod_colorIds)
                ->where('status', '1')
                ->get();
        }


        return response()->json([
            'status' => '200',
            'data' => $products,
            'prod_sizes' => $prod_sizes,
            'prod_colors' => $prod_colors,
        ], 200);
    }
}
