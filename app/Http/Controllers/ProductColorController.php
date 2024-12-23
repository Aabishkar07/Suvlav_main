<?php

namespace App\Http\Controllers;

use App\Models\ProductColor;
use Illuminate\Http\Request;

class ProductColorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $productcolors = new ProductColor;
        $search = $productcolors->query();
        if($request->search == 'search'){
            if($request->title) {
                  $search->where('title', 'like', '%'.$request->title.'%')->orWhere('color_code', '=', $request->title);
            }          
            
          }  

        $productcolors = $search->latest()->paginate(siteSettings('posts_per_page'));        
        return view('admin.productcolor.index',compact('productcolors','request'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.productcolor.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'color_code' => 'required|string|max:255',
            'status' => 'required',
          ]);
  
          $productcolor = new ProductColor();

          $productcolor->title = $request->input('title');
          $productcolor->color_code = $request->input('color_code');
          $productcolor->status = $request->input('status');
          
          $productcolor->save();
          return redirect()->route('productcolor.index')->with('success', 'Item created successfully');
  
    }

    /**
     * Display the specified resource.
     */
    public function show(ProductColor $productcolor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ProductColor $productcolor)
    {
        return view('admin.productcolor.edit', compact('productcolor'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ProductColor $productcolor)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'color_code' => 'required|string|max:255',  
            'status' => 'required',
          ]);

          $productcolor->title = $request->input('title');
          $productcolor->color_code = $request->input('color_code');
          $productcolor->status = $request->input('status');

          $productcolor->update();
          return redirect()->route('productcolor.index')->with('success', 'Product color updated successfully');
    
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProductColor $productcolor)
    {
        $productcolor->delete();
        return redirect()->route('productcolor.index')->with('success', 'Product color deleted successfully');
    }
}
