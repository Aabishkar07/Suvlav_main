<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use \Cviebrock\EloquentSluggable\Services\SlugService;
use App\Models\Category;
use Intervention\Image\Laravel\Facades\Image;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {        
        $posts = new Post;
        $search = $posts->query();
        if($request->search == 'search'){
            if($request->title) {
                  $search->where('title', 'like', '%'.$request->title.'%');
            }    
        }  

        $posts = $search->latest()->paginate(siteSettings('posts_per_page'));        
        return view('admin.post.index', compact('posts','request'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.post.create', compact('categories'));

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
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            // The user should select at least one category
            'categories_id' => ['required', 'array', 'min:1'],
            'categories_id.*' => ['required', 'integer', 'exists:categories,id'],
          ]);
  
          $post = new Post();
          $destinationPath = '/uploads/posts/';
          $slug = SlugService::createSlug(Post::class, 'slug', $request->input('title'));

          if($request->image){            
            $imageName = $slug . '_'. time().'.'.$request->image->extension(); 
            $image = Image::read($request->image);
            $image->resize(950, 570);
            $image->save(public_path($destinationPath . $imageName));
            $post->image = $destinationPath . $imageName;
          }
          
          $post->title = $request->input('title');
          $post->slug = $slug;
          $post->short_desc = $request->input('short_desc');
          $post->content = $request->input('content');
          $post->status = $request->input('status');           
          $post->save();
          $post->categories()->attach($request->categories_id);
          return redirect()->route('post.index')->with('success', 'post created successfully');

    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        $categories = Category::all();
        return view('admin.post.edit', compact('post', 'categories'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'short_desc' => 'required|string|max:255',
            'status' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',            
            // The user should select at least one category
            'categories_id' => ['required', 'array', 'min:1'],
            'categories_id.*' => ['required', 'integer', 'exists:categories,id'],
          ]);

          $destinationPath = '/uploads/posts/';
          $slug = SlugService::createSlug(Post::class, 'slug', $request->input('title'));
          
          if($request->image){            
            $imageName = $slug . '_'. time().'.'.$request->image->extension(); 
            $image = Image::read($request->image);
            $image->resize(950, 570);
            $image->save(public_path($destinationPath . $imageName));
            $post->image = $destinationPath . $imageName;
          }

          $post->title = $request->input('title');
          $post->slug = $slug;
          $post->short_desc = $request->input('short_desc');
          $post->content = $request->input('content');
          $post->status = $request->input('status');
          $post->update();

          $attachableCategory = [];
          foreach($request->categories_id as $category) {
              $attachableCategory[] = Category::where('id', $category)->pluck('id')->first();
          }
      
          $post->categories()->sync($attachableCategory);
      
         // $post->categories()->attach($request->categories_id);
          return redirect()->route('post.index')->with('success', 'Post updated successfully');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('post.index')->with('success', 'Post deleted successfully');
    }
}
