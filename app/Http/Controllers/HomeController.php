<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Order;

class HomeController extends Controller
{
    public function index(){
        $posts = Post::orderBy('id', 'desc')->take(2)->get();
        $orders = Order::orderBy('id', 'desc')->take(5)->get();
        return view('admin.index', compact('posts', 'orders'));
    }
}
