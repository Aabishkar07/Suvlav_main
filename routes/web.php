<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductCategoryController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductColorController;
use App\Http\Controllers\ProductSizeController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\Front\FrontController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\UserManagementController;
use App\Http\Controllers\UserRoleController;

// Frontend Routing

Route::get('/', [FrontController::class, 'index']);
Route::get('/product/{slug}', [ProductController::class, 'detail']);
Route::get('/contactus', [FrontController::class, 'contactus']);
Route::post('/contactmail', [FrontController::class, 'contactmail']);
Route::post('/addtocart', [CartController::class, 'addToCart'])->name('cart.addtocart');
Route::post('/buynow', [CartController::class, 'buynow'])->name('cart.buynow');
Route::get('/view-cart', [CartController::class, 'index'])->name('view.cart');
Route::post('/updatecart', [CartController::class, 'updateCart'])->name('cart.update');
Route::post('/removeitem', [CartController::class, 'removeCartItem'])->name('cart.remove');
Route::get('/checkout', [FrontController::class, 'checkout'])->name('cart.checkout');
Route::get('/getdistricts', [FrontController::class, 'getDistrictsByState']);
Route::post('/checkoutsmt', [FrontController::class, 'checkoutsmt'])->name('cart.checkoutsmt');

Route::get('/profileorder', [FrontController::class, 'profileorder'])->name('profile.ordered');

Route::get('/memberlogout', [FrontController::class, 'memberlogout'])->name('member.logout');
Route::get('/memberloginform', [FrontController::class, 'memberloginform'])->name('member.loginform');
Route::get('/memberreg', [FrontController::class, 'memberreg'])->name('member.reg');

Route::get('/forgotpwform', [FrontController::class, 'forgotpwform'])->name('member.forgetpw');
Route::get('/myprofile', [FrontController::class, 'myprofile'])->name('member.myprofile');
Route::post('/memberchanagepw', [FrontController::class, 'memberchanagepw'])->name('member.changepw');
Route::post('/profileshippingsave', [FrontController::class, 'profileshippingsave'])->name('member.profileshipping');

Route::post('/profileupdate', [FrontController::class, 'profileupdate'])->name('member.profileupdate');



Route::post('/memberstore', [FrontController::class, 'memberstore'])->name('memberstore');
Route::post('/memberlogin', [FrontController::class, 'memberlogin'])->name('member.login');

Route::get('/productcategory/{id}', [FrontController::class, 'productcategory'])->name('product.category');
Route::get('/termsandcondition', [FrontController::class, 'termsandcondition'])->name('termsandcondition');
Route::get('/privacypolicy', [FrontController::class, 'privacypolicy'])->name('privacypolicy');
Route::get('/faqs', [FrontController::class, 'faqs'])->name('faqs');
Route::get('/allblogs', [FrontController::class, 'allblogs'])->name('allblogs');
Route::get('/blogs/{blog:slug}', [FrontController::class, 'blogsdetails'])->name('blogsdetails');
Route::get('/search', [FrontController::class, 'search'])->name('product.search');

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';


Route::group(array('prefix' => 'admin', 'middleware'=>['auth', 'admin']), function() {
    Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');
    
    //Route::get('dashboard',[HomeController::class, 'index']);
    Route::resource('product', ProductController::class);  
    Route::post('/togleActive/{product}', [ProductController::class, 'togleActive'])->name('togleActive');

    Route::resource('brand', BrandController::class);  
    Route::resource('productcat', ProductCategoryController::class);  
    Route::resource('productcolor', ProductColorController::class);
    Route::resource('productsize', ProductSizeController::class);  
    Route::resource('page', PageController::class);  
    Route::resource('blog', BlogController::class);  

    Route::resource('faqs', FaqController::class);  
    Route::resource('category', CategoryController::class);  
    Route::resource('post', PostController::class);  
    Route::resource('review', ReviewController::class);  
    Route::resource('order', OrderController::class);
    Route::get('order/showdetails/{id}', [OrderController::class, 'showdetails'])->name('admin.order.showdetails');
    Route::resource('user', UserController::class);  
    Route::resource('member', MemberController::class);        
    Route::resource('banner', BannerController::class);  
    Route::get('/settings', [SettingController::class, 'edit'])->name('admin.setting.edit');
    Route::post('/settings', [SettingController::class, 'update'])->name('admin.setting.update');

    Route::resource('userRole', UserRoleController::class);
    Route::resource('userManagement', UserManagementController::class);

});