<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Brand;
use App\Models\Member;
use App\Models\ProductCategory;
use App\Models\ProductSize;
use App\Models\ProductColor;
use App\Models\Review;
use Illuminate\Http\Request;
use \Cviebrock\EloquentSluggable\Services\SlugService;
use Intervention\Image\Laravel\Facades\Image;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;



class ProductController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index(Request $request)
  {
    $products = new Product;
    $search = $products->query();

    if ($request->title) {
      $search->where('title', 'like', '%' . $request->title . '%')->orWhere('prod_code', '=', $request->title);
    }
    if ($request->price) {
      if ($request->price == "high-to-low") {
        $search->orderBy('sale_price', 'DESC');
      }
      if ($request->price == "low-to-high") {
        $search->orderBy('sale_price', 'ASC');
      }
    }
    if ($request->sortbystock) {
      if ($request->sortbystock == "high-to-low") {
        $search->orderBy('availablestock', 'DESC');
      }
      if ($request->sortbystock == "low-to-high") {
        $search->orderBy('availablestock', 'ASC');
      }
    }


    $products = $search->latest()->paginate(siteSettings('posts_per_page'));
    return view('admin.product.index', compact('products', 'request'));
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create()
  {
    $brands = Brand::all();
    $productsizes = ProductSize::all();
    $productcolors = ProductColor::all();
    $categories = ProductCategory::where('parent_id', 0)->orderby('title', 'asc')->get();
    return view('admin.product.create', compact('brands', 'categories', 'productsizes', 'productcolors'));
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(Request $request)
  {
    $request->validate([
      'title' => 'required|string|max:255',
      'short_desc' => 'required|string|max:255',
      'regular_price' => 'required|string',
      'status' => 'required',
      'availablestock' => 'required',
      'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    $product = new Product();
    $updated_images = [];
    $destinationPath = '/uploads/products/';

    $slug = SlugService::createSlug(Product::class, 'slug', $request->input('title'));
    $prod_code = $this->createProductCode();

    if ($request->image) {
      $imageName = $slug . '_' . time() . '.' . $request->image->extension();
      $image = Image::read($request->image);
      //   $image->resize(550, 550);
      $image->save(public_path($destinationPath . $imageName));
      $product->image = $destinationPath . $imageName;
    }

    // store product images
    if ($request->new_images) {
      foreach ($request->new_images as $key => $new_image) {
        $imageName = $slug . '_' . time() . '.' . $new_image->extension();
        $image = Image::read($new_image);
        // $image->resize(550, 550);
        $image->save(public_path($destinationPath . $imageName));
        $updated_images[] = $destinationPath . $imageName;
      }
    }

    if (implode(null, $updated_images) == null) {
      $product->images = '{}';
    } else {
      $product->images = json_encode($updated_images);
    }

    $product->title = $request->input('title');
    $product->slug = $slug;
    $product->short_desc = $request->input('short_desc');
    $product->web_points = $request->input('web_points');
    $product->content = $request->input('content');
    $product->regular_price = $request->input('regular_price');
    $product->sale_price = $request->input('sale_price');
    $product->points = $request->input('points');

    $product->prod_code = $prod_code;
    $product->brand_id = $request->input('brand_id');
    $product->availablestock = $request->input('availablestock');
    if ($request->input('prod_cats')) {
      $product->prod_categories = json_encode($request->input('prod_cats'));
    }
    if ($request->input('prod_sizes')) {
      $product->prod_sizes = json_encode($request->input('prod_sizes'));
    }
    if ($request->input('prod_colors')) {
      $product->prod_colors = json_encode($request->input('prod_colors'));
    }
    $product->stock_status = $request->input('stock_status');
    $product->prod_featured = $request->input('prod_featured');
    $product->prod_new_arrival = $request->input('prod_new_arrival');
    $product->status = $request->input('status');

    $product->save();
    return redirect()->route('product.index')->with('success', 'Item created successfully');
  }

  /**
   * Display the specified resource.
   */
  public function show(Product $product)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(Product $product)
  {
    $brands = Brand::all();
    $productsizes = ProductSize::all();
    $productcolors = ProductColor::all();
    $categories = ProductCategory::where('parent_id', 0)->orderby('title', 'asc')->get();
    return view('admin.product.edit', compact('product', 'brands', 'categories', 'productsizes', 'productcolors'));
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, Product $product)
  {
    $request->validate([
      'title' => 'required|string|max:255',
      'short_desc' => 'required|string|max:255',
      'regular_price' => 'required|string',
      'status' => 'required',
      'availablestock' => 'required',
      'image' => 'image|mimes:jpeg,png,jpg,gif|max:4096',
    ]);

    $updated_images = [];
    $data_images = [];
    $destinationPath = '/uploads/products/';
    $slug = $product->slug;

    // Product Main Image
    if ($request->image) {
      $imageName = $product->slug . '_' . time() . '.' . $request->image->extension();
      $image = Image::read($request->image);
      //   $image->resize(550, 550);
      $image->save(public_path($destinationPath . $imageName));
      $product->image = $destinationPath . $imageName;
    }

    // Multiple Images
    if (isset($product->images) && !empty($product->images)) {
      $data_images = json_decode($product->images, true);
    }
    if ($request->old_images) {
      foreach ($request->old_images as $old_image) {
        if (in_array($old_image, $data_images)) {
          $updated_images[] = $old_image;
        } else {
          if (file_exists(public_path($old_image))) {
            unlink(public_path($old_image));
          }
        }
      }
    }

    if ($request->new_images) {
      foreach ($request->new_images as $key => $new_image) {
        if (in_array($new_image->getClientOriginalName(), $request->actual_images)) {

          $imageName = $slug . '_' . time() . '.' . $new_image->extension();
          $image = Image::read($new_image);
          //   $image->resize(550, 550);
          $image->save(public_path($destinationPath . $imageName));
          $updated_images[] = $destinationPath . $imageName;
        }
      }
    }

    if (implode(null, $updated_images) == null) {
      $product->images = '{}';
    } else {
      $product->images = json_encode($updated_images);
    }


    $product->title = $request->input('title');
    $product->short_desc = $request->input('short_desc');
    $product->web_points = $request->input('web_points');

    $product->content = $request->input('content');
    $product->regular_price = $request->input('regular_price');
    $product->sale_price = $request->input('sale_price');
    $product->points = $request->input('points');
    $product->availablestock = $request->input('availablestock');

    $product->brand_id = $request->input('brand_id');
    if ($request->input('prod_cats')) {
      $product->prod_categories = json_encode($request->input('prod_cats'));
    }
    if ($request->input('prod_sizes')) {
      $product->prod_sizes = json_encode($request->input('prod_sizes'));
    }
    if ($request->input('prod_colors')) {
      $product->prod_colors = json_encode($request->input('prod_colors'));
    }
    $product->stock_status = $request->input('stock_status');
    $product->prod_featured = $request->input('prod_featured');
    $product->prod_new_arrival = $request->input('prod_new_arrival');
    $product->status = $request->input('status');

    $product->update();
    return redirect()->route('product.index')->with('success', 'Product updated successfully');
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(Product $product)
  {
    $product->delete();
    return redirect()->route('product.index')->with('success', 'Product deleted successfully');
  }

  // Generate Product Code
  public function createProductCode()
  {
    $prefix = 'ES';
    $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersNumber = strlen($characters);
    $codeLength = 6;

    $code = '';

    while (strlen($code) < 6) {
      $position = rand(0, $charactersNumber - 1);
      $character = $characters[$position];
      $code = $code . $character;
    }
    if (Product::where('prod_code', $code)->exists()) {
      $this->createProductCode();
    }
    return $prefix . $code;
  }

  // Detail page

  public function detail(Request $request, $slug)
  {
    $product = Product::where('slug', $slug)->firstOrFail();

    $code = $request->suvcode;
    if ($code) {
      $checkmember = Member::where("affilate_code", $code)->first();
      if ($checkmember) {
        session(['suvcode' => $code]);
        session(['suvproduct' => $product->id]);
      } else {
        abort("404");
      }
    }
    $prod_categories = [];

    // Product Categories
    if ($product->prod_categories != '') {
      $prod_catIds = json_decode($product->prod_categories, true);
      $prod_categories = ProductCategory::whereIn('id', $prod_catIds)
        ->where('status', '1')
        ->get();
    }

    // Product Sizes
    $prod_sizes = [];
    if ($product->prod_sizes != '') {
      $prod_sizeIds = json_decode($product->prod_sizes, true);
      $prod_sizes = ProductSize::whereIn('id', $prod_sizeIds)
        ->where('status', '1')
        ->orderBy('order', 'asc')
        ->get();
    }

    // Product Colors
    $prod_colors = [];
    if ($product->prod_colors != '') {
      $prod_colorIds = json_decode($product->prod_colors, true);
      $prod_colors = ProductColor::whereIn('id', $prod_colorIds)
        ->where('status', '1')
        ->get();
    }

    // print_r($prod_categories);
    // die();
    $guest_id = isset($_COOKIE['guest_auth_token']) ? $_COOKIE['guest_auth_token'] : '';
    // $user_id = (Auth::check()) ? Auth::id() : 0;
    $user_id = (Session::get('memeber_id_ss') != '') ? Session::get('memeber_id_ss') : 0;
    $member = "";
    if ($user_id != 0) {
      $member = Member::where("id", $user_id)->first();
    }

    // dd($user_id);


    $cartItems = DB::table('carts')
      ->where('user_id', $user_id)
      ->orwhere('guest_id', $guest_id)
      ->get()->toArray();

    $categories = DB::table('product_categories as a')
      ->leftjoin('product_categories as b', 'b.parent_id', '=', 'a.id')
      ->select('a.title', 'a.id as catid', 'a.image', 'a.slug', 'b.title as child', 'b.id as childid')
      ->where('a.parent_id', 0)
      ->where('a.status', 1)
      ->get();




    // $hasreviewed = false;

    if ($member) {

      $hasOrdered = DB::table('order_details')->join('orders', 'orders.id', '=', 'order_details.order_id')
        ->where('orders.user_id', '=', $member->id)
        ->where('order_details.product_id', $product->id)
        ->exists();

    
      $hasreviewed = Review::where('user_id', '=', $member->id)->where('product_id', '=', $product->id)->exists();
    } else {
      $hasOrdered = false;
      $hasreviewed = false;
    }



    $reviews = Review::where('product_id', $product->id)->get();
    $allfeedback = Review::where('product_id', $product->id)->get();
    $reviewcount = Review::where("product_id", $product->id)->count();

    if ($reviewcount == 0) {
      $averagerating = "";
    } else {
      $averagerating = $reviews->avg('rating');
    }

    return view('front.products.detail', compact('product', 'member', 'prod_categories', 'prod_sizes', 'prod_colors', 'cartItems', 'categories', 'averagerating', 'reviewcount', 'reviews', 'allfeedback', 'hasOrdered', 'hasreviewed'));
  }

  public function togleActive(Product $product)
  {
    if ($product->status == "1") {
      $product->status = "0";
    } else {
      $product->status = "1";
    }
    $product->save();
    return redirect()->back()->with("popsuccess", "Active Status Changed");
  }
}
