<?php

namespace App\Http\Controllers;

use App\Models\ProductSize;
use Illuminate\Http\Request;

class ProductSizeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        
        $productsizes = new ProductSize;
        $search = $productsizes->query();
        if($request->search == 'search'){
            if($request->title) {
                  $search->where('title', 'like', '%'.$request->title.'%')->orWhere('display_name', '=', $request->title);
            }          
            
          }  

        $productsizes = $search->latest()->paginate(siteSettings('posts_per_page'));        
        return view('admin.productsize.index',compact('productsizes','request'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.productsize.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'display_name' => 'required|string|max:255',
            'status' => 'required',
          ]);
  
          $productsize = new ProductSize();

          $productsize->title = $request->input('title');
          $productsize->display_name = $request->input('display_name');
          $productsize->status = $request->input('status');
          
          $productsize->save();
          return redirect()->route('productsize.index')->with('success', 'Item created successfully');
  
    }

    /**
     * Display the specified resource.
     */
    public function show(ProductSize $productsize)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ProductSize $productsize)
    {
        return view('admin.productsize.edit', compact('productsize'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ProductSize $productsize)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'display_name' => 'required|string|max:255',  
            'status' => 'required',
          ]);

          $productsize->title = $request->input('title');
          $productsize->display_name = $request->input('display_name');
          $productsize->status = $request->input('status');

          $productsize->update();
          return redirect()->route('productsize.index')->with('success', 'Product size updated successfully');
    
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProductSize $productsize)
    {
        $productsize->delete();
        return redirect()->route('productsize.index')->with('success', 'Product size deleted successfully');
    }
}
