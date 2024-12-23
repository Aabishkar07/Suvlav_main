<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use Illuminate\Http\Request;
use Intervention\Image\Laravel\Facades\Image;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $banners = new Banner;
        $search = $banners->query();
        if($request->search == 'search'){
            if($request->title) {
                  $search->where('title', 'like', '%'.$request->title.'%');
            }          
          
        } 

        $banners = $search->latest()->paginate(siteSettings('posts_per_page'));        
        return view('admin.banner.index',compact('banners','request'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.banner.create');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {        
        $request->validate([
            'title' => 'required|string|max:255',
            'main_heading' => 'required|string|max:255',            
            'display_option' => 'required',
            'status' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
          ]);

          $destinationPath = '/uploads/banners/';
          $banner = new Banner();

          if($request->image){            
            $imageName = 'banner'. '_'. time().'.'.$request->image->extension(); 
            $image = Image::read($request->image);
            if($request->input('display_option') == '1'){
                $image->resize(1900, 700);
            } else {
                $image->resize(600, 370);   
            }             
            $image->save(public_path($destinationPath . $imageName));
            $banner->image = $destinationPath . $imageName;
          }

          $banner->title = $request->input('title');
          $banner->short_desc = $request->input('short_desc');
          $banner->top_heading = $request->input('top_heading');
          $banner->main_heading = $request->input('main_heading');          
          $banner->btn_name = $request->input('btn_name');
          $banner->btn_url = $request->input('btn_url');
          $banner->display_option = $request->input('display_option');
          $banner->status = $request->input('status');
          $banner->save();
          return redirect()->route('banner.index')->with('success', 'Banner created successfully');
  

    }

    /**
     * Display the specified resource.
     */
    public function show(Banner $banner)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Banner $banner)
    {
        return view('admin.banner.edit',  compact('banner'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Banner $banner)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'main_heading' => 'required|string|max:255',            
            'display_option' => 'required',
            'status' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:4096',
          ]);

          $destinationPath = '/uploads/banners/';
          if($request->image){            
            $imageName = 'banner'. '_'. time().'.'.$request->image->extension(); 
            $image = Image::read($request->image);
            if($request->input('display_option') == '1'){
                $image->resize(1900, 700);
            } else {
                $image->resize(600, 370);   
            }             
            $image->save(public_path($destinationPath . $imageName));
            $banner->image = $destinationPath . $imageName;
          } 
          $banner->title = $request->input('title');
          $banner->short_desc = $request->input('short_desc');
          $banner->top_heading = $request->input('top_heading');
          $banner->main_heading = $request->input('main_heading');          
          $banner->btn_name = $request->input('btn_name');
          $banner->btn_url = $request->input('btn_url');
          $banner->display_option = $request->input('display_option');
          $banner->status = $request->input('status');
          $banner->update();
          return redirect()->route('banner.index')->with('success', 'Banner edeited successfully');
  
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Banner $banner)
    {
        //
    }
}
