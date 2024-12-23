<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class BrandController extends Controller
{
    public function index(Request $request) {

        $brands = new Brand;
        $search = $brands->query();
        if($request->search == 'search'){
            if($request->name) {
                  $search->where('name', 'like', '%'.$request->name.'%');
            }
  
          }
        $brands = $search->latest()->paginate(20);
        return view('admin.brand.index',compact('brands','request'));
    }
    
    public function create()
    {
          return view('admin.brand.create');
    }


    public function store(Request $request){

        $request->validate([
            'name' => 'required|string|max:255',
            'short_desc' => 'required|string|max:255',
            'status' => 'required',
          ]);
  
          $brand = new Brand();
          $brand->title = $request->input('name');
          $brand->short_desc = $request->input('short_desc');
          $brand->content = $request->input('content');
          $brand->status = $request->input('status');

          $brand->save();
          return redirect()->route('brand.index')->with('success', 'Brand created successfully');
  
    }
    public function show($id) {}

    public function edit(Brand $brand){
        return view('admin.brand.edit',  compact('brand'));
    }
    public function update(Request $request, Brand $brand){



        $request->validate([
            'btitle' => 'required|string|max:255',
            'short_desc' => 'required',
            'status' => 'required'
    
          ]);


      $data = [
              'title' => $request->input('btitle'),
              'short_desc' => $request->input('short_desc'),
              'content' => $request->input('content'),
              'status' => $request->input('status')
          ];

         // $brand->update();
          DB::table('brands')
              ->where('id', $brand->id)
              ->update($data);

          return redirect()->route('brand.index')->with('success', 'brand updated successfully');
    
    }

    // Delete item
    public function destroy(Brand $brand){
        $brand->delete();
      return redirect()->route('brand.index')->with('success', 'Brand deleted successfully');
    }

    
}
