<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Http\Request;

class ApiCategoryController extends Controller
{
    public function allcategory()
    {
        $categories = ProductCategory::latest()->get();
        return response()->json([
            'status' => '200',
            'data' => $categories
        ], 200);
    }
    public function singlecategory($category)
    {
        $categories = ProductCategory::where("id", $category)->first();
        return response()->json([
            'status' => '200',
            'data' => $categories
        ], 200);
    }

    public function categorywiseproduct($category)
    {

        error_log("aaa");
        $products = Product::all()->filter(function ($product) use ($category) {
            $categories = json_decode($product->prod_categories, true);
            return is_array($categories) && in_array($category, $categories);
        })->values(); // Reset array keys
        error_log($products);

        return response()->json([
            'status' => '200',
            'data' => $products
        ], 200);
    }


}
