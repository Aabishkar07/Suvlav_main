<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Order;
use Illuminate\Support\Facades\DB;
use App\Models\Product;


class HomeController extends Controller
{
    public function index()
    {
        $posts = Post::orderBy('id', 'desc')->take(2)->get();

        $orders = Order::orderBy('id', 'desc')->take(5)->get();
        $totalproducts = Product::count();
        $pendingorders = Order::where('status', 'Pending')->count();
        $totalmembers = Member::count();
        $totalorder = Order::count();
        return view('admin.index', compact('posts', 'orders', 'totalorder', 'totalproducts', 'pendingorders', 'totalmembers'));
        $posts = Post::orderBy('id', 'desc')->take(2)->get();
        $orders = Order::orderBy('id', 'desc')->take(5)->get();
        return view('admin.index', compact('posts', 'orders'));
    }



    public function myprofile()
    {

        $cartItems = $this->cartdata;
        $categories = $this->categories;

        if (Session::get('memeber_id_ss') == '') {
            return redirect('/memberloginform');
        } else {
            $user_id = Session::get('memeber_id_ss');


            $userdata = DB::table('members')
                ->leftJoin('provinces', 'provinces.id', '=', 'members.state')
                ->leftJoin('districts', 'districts.id', '=', 'members.district_id')
                ->select('members.*', 'provinces.name as statename', 'provinces.id as stateid', 'districts.district')
                ->where('members.id', $user_id)
                ->get()->toArray();

            // $del_address = DB::table('members')
            //   ->where('id', $user_id)
            // ->get()->toArray();

            $orders = DB::table('orders as a')
                ->join('order_details as b', 'b.order_id', '=', 'a.id')
                ->where('user_id', $user_id)
                ->get()->toArray();

            $states = DB::table('provinces')
                ->get();

            if (isset($userdata[0]->stateid)) {
                $districts = DB::table('districts')
                    ->where('province', $userdata[0]->stateid)
                    ->get()->toArray();
            } else {
                $districts = '';
            }



            $shippings = DB::table('shippings')
                ->leftJoin('provinces', 'provinces.id', '=', 'shippings.province')
                ->leftJoin('districts', 'districts.id', '=', 'shippings.district_id')
                ->select('shippings.*', 'provinces.name as statename', 'provinces.id as stateid', 'districts.district')
                ->where('member_id', $user_id)
                ->get()->toArray();

            if (isset($shippings[0]->province)) {
                $district_del = DB::table('districts')
                    ->where('province', $shippings[0]->province)
                    ->get()->toArray();
            } else {
                $district_del = '';
            }




            return view('front.myprofilelist', compact('cartItems', 'orders', 'userdata', 'states', 'shippings', 'districts', 'district_del', 'categories'));
        }
    }

   






}

