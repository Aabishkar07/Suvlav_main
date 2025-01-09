<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Product;
use App\Models\user;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $reviews = new Review;
        $search = $reviews->query();
        if ($request->search == 'search') {
            if ($request->product_id) {
                $search->where('product_id', '=', $request->product_id);
            }
        }
        $products = Product::all();
        $reviews = $search->latest()->paginate(siteSettings('posts_per_page'));
        return view('admin.review.index', compact('reviews', 'request', 'products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $products = Product::all();
        $users = User::all();
        return view('admin.review.create', compact('products', 'users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'rating' => 'required|integer|min:0|max:5',
            'review_detail' => 'required',
            'status' => 'required',
            'product_id' => 'required',
            'user_id' => 'required',
        ]);

        $review = new Review();
        $review->review_detail = $request->input('review_detail');
        $review->rating = $request->input('rating');
        $review->user_id = $request->input('user_id');
        $review->product_id = $request->input('product_id');
        $review->status = $request->input('status');
        $review->save();
        return redirect()->route('review.index')->with('success', 'Review created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Review $review)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Review $review)
    {
        $products = Product::all();
        $users = User::all();
        return view('admin.review.edit', compact('review', 'products', 'users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Review $review)
    {
        $request->validate([
            'rating' => 'required|integer|min:0|max:5',
            'review_detail' => 'required',
            'status' => 'required',
            'product_id' => 'required',
            'user_id' => 'required',
        ]);

        $review->review_detail = $request->input('review_detail');
        $review->rating = $request->input('rating');
        $review->user_id = $request->input('user_id');
        $review->product_id = $request->input('product_id');
        $review->status = $request->input('status');
        $review->isNew = '0';
        $review->update();
        return redirect()->route('review.index')->with('success', 'Review updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Review $review)
    {
        $review->delete();
        return redirect()->route('review.index')->with('success', 'Review deleted successfully');
    }
    public function frontdelete(Review $review)
    {
        $review->delete();
        return redirect()->back()->with('success', 'Review deleted successfully');
    }
}
