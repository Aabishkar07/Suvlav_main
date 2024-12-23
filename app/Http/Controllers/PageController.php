<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\Http\Request;
use \Cviebrock\EloquentSluggable\Services\SlugService;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {        
        $pages = new Page;
        $search = $pages->query();
        if($request->search == 'search'){
            if($request->title) {
                  $search->where('title', 'like', '%'.$request->title.'%');
            }    
        }  

        $pages = $search->latest()->paginate(siteSettings('posts_per_page'));        
        return view('admin.page.index',compact('pages','request'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.page.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'short_desc' => 'required|string|max:255',
            'status' => 'required',
          ]);
  
          $page = new Page();

          $slug = SlugService::createSlug(Page::class, 'slug', $request->input('title'));
          if($request->image){
            $imageName = $slug. '_'. time().'.'.$request->image->extension();
            $request->image->move(public_path('uploads/pages'), $imageName);
            $page->image = 'uploads/pages/'.$imageName;
          }
          
          $page->title = $request->input('title');
          $page->slug = $slug;
          $page->short_desc = $request->input('short_desc');
          $page->content = $request->input('content');
          $page->status = $request->input('status'); 
          $page->save();
          return redirect()->route('page.index')->with('success', 'Page created successfully');

    }

    /**
     * Display the specified resource.
     */
    public function show(Page $page)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Page $page)
    {
        return view('admin.page.edit', compact('page'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Page $page)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'short_desc' => 'required|string|max:255',
            'status' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
          ]);


          $slug = SlugService::createSlug(Page::class, 'slug', $request->input('title'));
          if($request->image){
            $imageName = $slug. '_'. time().'.'.$request->image->extension();
            $request->image->move(public_path('uploads/pages'), $imageName);
            $page->image = 'uploads/pages/'.$imageName;
          }

          $page->title = $request->input('title');
          $page->slug = $slug;
          $page->short_desc = $request->input('short_desc');
          $page->content = $request->input('content');
          $page->status = $request->input('status');

          $page->update();
            return redirect()->route('page.index')->with('success', 'Page updated successfully');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Page $page)
    {
        $page->delete();
        return redirect()->route('page.index')->with('success', 'Page deleted successfully');

    }
}
