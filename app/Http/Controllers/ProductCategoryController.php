<?php

namespace App\Http\Controllers;
use Auth;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use \Cviebrock\EloquentSluggable\Services\SlugService;
use Intervention\Image\Laravel\Facades\Image;

class ProductCategoryController extends Controller
{
    //
    public function index(Request $request) {
        $productcats = new ProductCategory;
        $search = $productcats->query();
        if($request->search == 'search'){
            if($request->title) {
                  $search->where('title', 'like', '%'.$request->title.'%');
            }          
            
          } else{
            $search->where('parent_id', 0);
          } 

        $productcats = $search->latest()->paginate(3);        
        return view('admin.productcat.index',compact('productcats','request'));
    }

    // Get Product Categories
    public function getAllCategories($parent_id = 0){
      $cat_ids = [];
      $productcats = new ProductCategory;
      $productcats = $productcats->query()->where('parent_id', $parent_id)->orderby('id', 'asc')->get();
      if(count($productcats) > 0){
        foreach ($productcats as $key => $productcat){
          $cat_ids[] = $productcat->id;
          $cat_ids[] = $this->getAllCategories($productcat->id, $cat_ids);
          
        }
      }
      return $cat_ids; 
    }

    // Nested array to single dimension
    function nestedToSingle(array $array){
    $singleDimArray = [];

    foreach ($array as $item) {
        if (is_array($item)) {
            $singleDimArray = array_merge($singleDimArray, $this->nestedToSingle($item));
        } else {
            $singleDimArray[] = $item;
        }
    }
    return $singleDimArray;
}

        
    public function create(ProductCategory $productcat)
    {
      $categories = ProductCategory::where('parent_id', 0)->orderby('title', 'asc')->get();
      return view('admin.productcat.create',  compact('categories'));
    }

    public function store(Request $request){
        
        $request->validate([
            'title' => 'required|string|max:255',
            'short_desc' => 'required|string|max:255',
            'status' => 'required',
          ]);
  
          $productcat = new ProductCategory();
          $destinationPath = '/uploads/productcats/';
          $slug = SlugService::createSlug(ProductCategory::class, 'slug', $request->input('title'));

          if($request->image){            
            $imageName = $slug. '_'. time().'.'.$request->image->extension(); 
            $image = Image::read($request->image);  
            $image->resize(180, 180); 
            $image->save(public_path($destinationPath . $imageName));
            $productcat->image = $destinationPath . $imageName;
          }


          $productcat->title = $request->input('title');
          $productcat->short_desc = $request->input('short_desc');
          $productcat->content = $request->input('content');
          $productcat->parent_id = $request->input('parent_id');
          $productcat->slug = $slug;
          $productcat->cat_featured = ($request->input('cat_featured') == '1')? '1' : '0';
          $productcat->status = $request->input('status');
          $productcat->save();
          return redirect()->route('productcat.index')->with('success', 'Product Category created successfully');
  
    }

    public function edit(ProductCategory $productcat){
       $categories = ProductCategory::where('parent_id', 0)->orderby('title', 'asc')->get();
        return view('admin.productcat.edit',  compact('productcat', 'categories'));
    }

    public function update(Request $request, ProductCategory $productcat){
        $request->validate([
            'title' => 'required|string|max:255',
            'short_desc' => 'required',
            'status' => 'required'
    
          ]);

          $destinationPath = '/uploads/productcats/';
          $slug = SlugService::createSlug(ProductCategory::class, 'slug', $request->input('title'));

          if($request->image){            
            $imageName = $slug. '_'. time().'.'.$request->image->extension(); 
            $image = Image::read($request->image);  
            $image->resize(180, 180); 
            $image->save(public_path($destinationPath . $imageName));
            $productcat->image = $destinationPath . $imageName;
          }
    
          $productcat->title = $request->input('title');
          $productcat->short_desc = $request->input('short_desc');
          $productcat->content = $request->input('content');       
          $productcat->slug = $slug;
          $productcat->cat_featured = ($request->input('cat_featured') == '1')? '1' : '0';
          $productcat->parent_id = $request->input('parent_id');
          $productcat->status = $request->input('status');
          $productcat->update();
            return redirect()->route('productcat.index')->with('success', 'Product Category edeited successfully');
    
    }

        // Delete item
        public function destroy(ProductCategory $productcat){
          $productcat->delete();
          return redirect()->route('productcat.index')->with('success', 'Product Category deleted successfully');
        }
}
