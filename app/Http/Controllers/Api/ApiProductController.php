<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductColor;
use App\Models\ProductSize;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
        $product = Product::where("id", (int) $product)->first();
        $productreviews = Review::with("user")->where("product_id", $product->id)->get();
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
            'prod_sizes' => $prod_sizes,
            'prod_colors' => $prod_colors,
            'data' => $product,
            'productreviews' => $productreviews,
        ], 200);
    }

    public function productreview($product, $user)
    {
        $productreview = Review::with("user")->where("product_id", (int) $product)->get();
        error_log($productreview);
        $hasOrdered = DB::table('order_details')->join('orders', 'orders.id', '=', 'order_details.order_id')
            ->where('orders.user_id', '=', $user)
            ->where('order_details.product_id', $product)
            ->exists();

        $hasreviewed = Review::where('user_id', '=', $user)->where('product_id', '=', $product)->exists();

        return response()->json([
            'status' => '200',
            'data' => $productreview,
            'hasOrdered' => (bool) $hasOrdered,
            'hasreviewed' => (bool) $hasreviewed
        ], 200);
    }

    public function postproductreview(Request $request, $product, $user)
    {
        Review::create([
            'rating' => $request->rating,
            'review_detail' => $request->review_detail,
            'product_id' => $product,
            'user_id' => $user,
        ]);
        return response()->json([
            'status' => '200',
            'messsgae' => "Review Successfull"

        ], 200);


    }


}
