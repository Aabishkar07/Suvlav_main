<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function productindex(Request $request)
    {
        $products = DB::table('products')->get();
        $customers = DB::table('orders as a')
            ->join('order_details as b', 'b.order_id', '=', 'a.id');

        $myproduct = "";
        $fromdate = $request->input("from") ?? "";
        $todate = $request->input("to") ?? "";

        if ($request->product) {
            $myproduct = DB::table('products')->where("id", $request->product)->first();
            $customers = $customers->where('b.product_id', $request->product);
        }
        if ($fromdate) {
            $customers = $customers->whereDate('b.created_at', ">=", $fromdate);
        }
        if ($todate) {
            $customers = $customers->whereDate('b.created_at', "<=", $todate);
        }
        $customers = $customers->paginate(siteSettings('posts_per_page'));
        return view('admin.reports.productreport', compact("products", 'myproduct', 'customers'));
    }
    public function customerindex(Request $request)
    {
        $userdatas = DB::table('members')->get();
        $orders = [];
        $products = [];
        if ($request->customer) {
            $orders = DB::table('orders as a')
                ->join('order_details as b', 'b.order_id', '=', 'a.id')
                ->where('a.user_id', $request->customer)
                ->paginate(siteSettings('posts_per_page'));

            $products = DB::table('orders as a')
                ->join('order_details as b', 'b.order_id', '=', 'a.id')
                ->where('a.user_id', $request->customer)
                ->select('b.product_id', 'b.product_name')
                ->distinct('b.product_id')
                ->get();

            // dd($products);
        }
        if ($request->product) {
            $orders = DB::table('orders as a')
                ->join('order_details as b', 'b.order_id', '=', 'a.id')
                ->where('a.user_id', $request->customer)
                ->where('b.product_id', $request->product)
                ->paginate(siteSettings('posts_per_page'));
        }

        return view('admin.reports.customerreport', compact("userdatas", 'orders', 'products'));
    }

    public function searchhistory()
    {
        $searchhistorys = DB::table('search_histories')->paginate(siteSettings('posts_per_page'));


       
        $uniqueCount = DB::table('search_histories')
        ->select('search_item', DB::raw('count(*) as count'))  // Count occurrences of each search_item
        ->groupBy('search_item')  // Group by search_item to get counts
        ->get();
    

    

        return view('admin.reports.searchhistory', compact("searchhistorys" ,'uniqueCount'));
    }
}
