<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {        
        $pages = new Blog();
        $search = $pages->query();
        if($request->search == 'search'){
            if($request->title) {
                  $search->where('title', 'like', '%'.$request->title.'%');
            }    
        }  

        $pages = $search->latest()->paginate(siteSettings('posts_per_page'));        
        return view('admin.blog.index',compact('pages','request'));
    }

    /** 
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('admin.blog.create');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //

        $page = new Blog();

        $slug = SlugService::createSlug(Blog::class, 'slug', $request->input('title'));
        if($request->featured_image){
          $imageName = $slug. '_'. time().'.'.$request->featured_image->extension();
          $request->featured_image->move(public_path('uploads/pages'), $imageName);
          $page->featured_image = 'uploads/pages/'.$imageName;
        }
        
        $page->title = $request->input('title');
        $page->slug = $slug;
        $page->description = $request->input('description');
        $page->order = $request->input('order'); 
        $page->save();
        return redirect()->route('blog.index')->with('success', 'Blog created successfully');


    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(String $id)
    {


        $page = Blog::find($id);
        return view('admin.blog.edit', compact('page'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, String $id)
    {
       

        $page = Blog::find($id);


          $slug = SlugService::createSlug(Blog::class, 'slug', $request->input('title'));
          if($request->featured_image){
            $imageName = $slug. '_'. time().'.'.$request->featured_image->extension();
            $request->featured_image->move(public_path('uploads/pages'), $imageName);
            $page->featured_image = 'uploads/pages/'.$imageName;
          }

          $page->title = $request->input('title');
          $page->slug = $slug;
          $page->description = $request->input('description');
          $page->order = $request->input('order');

          $page->update();
            return redirect()->route('blog.index')->with('success', 'Blog updated successfully');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //

        $page = Blog::find($id);
        $page->delete();
        return redirect()->back()->with('success', 'Delete successfully');
    }
}
