<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use \Cviebrock\EloquentSluggable\Services\SlugService;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $categories = new Category;
        $search = $categories->query();
        if($request->search == 'search'){
            if($request->title) {
                  $search->where('title', 'like', '%'.$request->title.'%');
            }          
            
          }  

        $categories = $search->latest()->paginate(10);        
        return view('admin.category.index',compact('categories','request'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'status' => 'required',
          ]);
  
          $category = new Category();
          $slug = SlugService::createSlug(Category::class, 'slug', $request->input('title'));

          $category->title = $request->input('title');
          $category->slug = $slug;
          $category->status = $request->input('status'); 
          $category->save();
          return redirect()->route('category.index')->with('success', 'Category created successfully');

    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return view('admin.category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'status' => 'required',
          ]);


          $slug = SlugService::createSlug(Category::class, 'slug', $request->input('title'));
          
          $category->title = $request->input('title');
          $category->slug = $slug;
          $category->status = $request->input('status');

          $category->update();
          return redirect()->route('category.index')->with('success', 'Category updated successfully');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('category.index')->with('success', 'Category deleted successfully');

    }
}
