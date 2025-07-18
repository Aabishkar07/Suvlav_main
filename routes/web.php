<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\NepalController;
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
use App\Http\Controllers\ContactController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\UserManagementController;
use App\Http\Controllers\UserRoleController;
use Illuminate\Support\Facades\Artisan;

// Frontend Routing

Route::get('/', [FrontController::class, 'index'])->name("home.index");
Route::get('/product/{slug}', [ProductController::class, 'detail'])->name("productdetails");
Route::get('/contactus', [FrontController::class, 'contactus']);
Route::post('/contactmail', [FrontController::class, 'contactmail']);
Route::post('/exchnageproduct', [CartController::class, 'exchnageproduct'])->name('cart.exchnageproduct');
Route::post('/addtocart', [CartController::class, 'addToCart'])->name('cart.addtocart');
Route::post('/buynow', [CartController::class, 'buynow'])->name('cart.buynow');
Route::get('/view-cart', [CartController::class, 'index'])->name('view.cart');
Route::post('/updatecart', [CartController::class, 'updateCart'])->name('cart.update');
Route::post('/removeitem', [CartController::class, 'removeCartItem'])->name('cart.remove');
Route::get('/checkout', [FrontController::class, 'checkout'])->name('cart.checkout');
Route::get('/getdistricts', [FrontController::class, 'getDistrictsByState']);
Route::get('/getmunicipalities', [FrontController::class, 'getmunicipalitiesByDistrict']);
Route::get('/getwards', [FrontController::class, 'getWardByMunicipality']);
Route::post('/checkoutsmt', [FrontController::class, 'checkoutsmt'])->name('cart.checkoutsmt');
Route::get('/allcategory', [FrontController::class, 'allcategory'])->name('allcategory');

Route::get('/profileorder', [FrontController::class, 'profileorder'])->name('profile.ordered');

Route::get('/memberlogout', [FrontController::class, 'memberlogout'])->name('member.logout');
Route::get('/memberloginform', [FrontController::class, 'memberloginform'])->name('member.loginform');
Route::get('/memberreg', [FrontController::class, 'memberreg'])->name('member.reg');

Route::get('/forgotpwform', [FrontController::class, 'forgotpwform'])->name('member.forgetpw');
Route::post('/forgotpwform', [FrontController::class, 'forgotpwformstore'])->name('member.forgotpwformstore');
Route::get('/otp', [FrontController::class, 'otp'])->name('otp');
Route::post('/checkotp', [FrontController::class, 'checkotp'])->name('checkotp');
Route::get('/newpassword', [FrontController::class, 'newpassword'])->name('newpassword');
Route::post('/changepassword', [FrontController::class, 'changepassword'])->name('changepasswords');
Route::get('/wishlist', [FrontController::class, 'wishlist'])->name('wishlist');
// Route::get('/wishlist/add/{productId}', [FrontController::class, 'addToWishlist'])->name('wishlist.add');
Route::post('/wishlist/add', [FrontController::class, 'addToWishlist'])->name('wishlist.add');

Route::delete('wishlist/{id}', [FrontController::class, 'deletewishlist'])->name('wishlist.destroy');

Route::get('/myprofile', [FrontController::class, 'myprofile'])->name('member.myprofile');
Route::get('/profile/order/{order}', [FrontController::class, 'myprofileorder'])->name('profile.order');

Route::post('/memberchanagepw', [FrontController::class, 'memberchanagepw'])->name('member.changepw');
Route::post('/profileshippingsave', [FrontController::class, 'profileshippingsave'])->name('member.profileshipping');

Route::post('/profileupdate', [FrontController::class, 'profileupdate'])->name('member.profileupdate');
Route::post('/statusupdate/{order}', [FrontController::class, 'statusupdate'])->name('member.statusupdate');



Route::post('/memberstore', [FrontController::class, 'memberstore'])->name('memberstore');
Route::post('/memberlogin', [FrontController::class, 'memberlogin'])->name('member.login');

Route::get('/productcategory/{id}', [FrontController::class, 'productcategory'])->name('product.category');
Route::get('/termsandcondition', [FrontController::class, 'termsandcondition'])->name('termsandcondition');
Route::get('/privacypolicy', [FrontController::class, 'privacypolicy'])->name('privacypolicy');
Route::get('/faqs', [FrontController::class, 'faqs'])->name('faqs');
Route::get('/allblogs', [FrontController::class, 'allblogs'])->name('allblogs');
Route::get('/blogs/{blog:slug}', [FrontController::class, 'blogsdetails'])->name('blogsdetails');
Route::get('/search', [FrontController::class, 'search'])->name('product.search');
Route::post('/search-history/clear', [FrontController::class, 'clearSearchHistory'])->name('search.history.clear');
Route::post('/search', [FrontController::class, 'searchstore'])->name('search.history.store');

Route::get('order/trackorder', [FrontController::class, 'trackorder'])->name('trackorder');
Route::get('/featuredproduct', [FrontController::class, 'featuredproduct'])->name('featuredproduct');
Route::get('/allproducts', [FrontController::class, 'newarrivals'])->name('newarrivals');
Route::get('/exchange/allproducts', [FrontController::class, 'exchange'])->name('exchange');
Route::put('/exchange/changestatus/{item_id}', [FrontController::class, 'exchangestatus'])->name('exchangestatus');
// Route::get('/newarrivals', [FrontController::class, 'newarrivals'])->name('newarrivals');
Route::post('/review/{slug}', [FrontController::class, 'store'])->name('review');



// login with google
Route::get('auth/google', [AuthenticatedSessionController::class, 'redirectToGmail'])->name('google.redirect');;
Route::get('auth/google/call-back', [AuthenticatedSessionController::class, 'handleGmailCallback'])->name('google.callback');

// facebook
Route::get('auth/facebook', [AuthenticatedSessionController::class, 'redirect'])->name('facebook-auth');
Route::get('login/facebook/callback', [AuthenticatedSessionController::class, 'callbackFacebook']);


Route::get('/history', [FrontController::class, 'history'])->name('history');
Route::get('/details', [FrontController::class, 'details'])->name('details');
Route::get('/delivery', [FrontController::class, 'delivery'])->name('delivery');
Route::get('/updatepassword', [FrontController::class, 'updatepassword'])->name('updatepassword');
Route::get('/mypoints', [FrontController::class, 'mypoints'])->name('mypoints');


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

require __DIR__ . '/auth.php';


Route::group(array('prefix' => 'admin', 'middleware' => ['auth', 'admin']), function () {
    Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');
    Route::get('/contact', [ContactController::class, 'contact'])->name('contact');
    Route::delete('/contact/{contact:id}', [ContactController::class, 'delete'])->name('contactdelete');
    // Define the route to get contact details by id
    Route::get('/contact/{id}', [ContactController::class, 'viewcontact'])->name('viewcontact');

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

    Route::delete('deletereview//{review}', [ReviewController::class, 'frontdelete'])->name('admin.review.frontdelete');

    Route::get('order/exchange', [OrderController::class, 'exchange'])->name('admin.exchange');
    Route::get('order/cancel', [OrderController::class, 'show'])->name('admin.exchangeorreturn');
    Route::resource('order', controller: OrderController::class);
    Route::get('order/showdetails/{id}', [OrderController::class, 'showdetails'])->name('admin.order.showdetails');
    Route::resource('user', UserController::class);
    Route::put('member/change/{member}', [MemberController::class, 'sharestatus'])->name('admin.sharestatus.update');
    Route::resource('member', MemberController::class);
    Route::resource('banner', BannerController::class);
    Route::get('/settings', [SettingController::class, 'edit'])->name('admin.setting.edit');
    Route::post('/settings', [SettingController::class, 'update'])->name('admin.setting.update');

    Route::get('/searchhistory', [ReportController::class, 'searchhistory'])->name('admin.searchhistory');

    Route::resource('userRole', UserRoleController::class);
    Route::resource('userManagement', UserManagementController::class);

    Route::get('report/productwise', [ReportController::class, 'productindex'])->name('admin.report.product');
    Route::get('report/customerwise', [ReportController::class, 'customerindex'])->name('admin.report.customer');


    Route::get('province', [NepalController::class, "index"])->name('province');
    Route::post('/province/{province}', [NepalController::class, 'togleActiveProvince'])->name('togleActiveProvince');

    Route::get('province/create', [NepalController::class, "create"])->name('province.create');
    Route::get('province/edit/{province}', [NepalController::class, "edit"])->name('province.edit');
    Route::post('province', [NepalController::class, "store"])->name('province.store');
    Route::put('province/{province}', [NepalController::class, "update"])->name('province.update');
    Route::delete('province/{province}', [NepalController::class, "delete"])->name('province.delete');

    Route::get('district/{province}', [NepalController::class, "district_index"])->name('district.index');
    Route::post('/toggledistrict/{district}', [NepalController::class, 'togleActivedistrict'])->name('togleActivedistrict');
 
    Route::get('district/create/{province}', [NepalController::class, "district_create"])->name('district.create');
    Route::post('district/{province}', [NepalController::class, "district_store"])->name('district.store');
    Route::get('district/edit/{district}', [NepalController::class, "district_edit"])->name('district.edit');
    Route::put('district/{district}', [NepalController::class, "district_update"])->name('district.update');
    Route::delete('district/{district}', [NepalController::class, "district_delete"])->name('district.delete');

    Route::get('municipality/{district}', [NepalController::class, "municipality"])->name('municipality');
    Route::get('municipality/create/{district}', [NepalController::class, "municipality_create"])->name('municipality.create');
    Route::post('municipality/store/{district}', [NepalController::class, "municipality_store"])->name('municipality.store');
    Route::get('municipality/edit/{municipality}', [NepalController::class, "municipality_edit"])->name('municipality.edit');
    Route::put('municipality/{municipality}', [NepalController::class, "municipality_update"])->name('municipality.update');
    Route::delete('municipality/{municipality}', [NepalController::class, "municipality_delete"])->name('municipality.delete');
});

Route::get('/clear', function () {
    Artisan::call('optimize:clear');
    Artisan::call('cache:clear');
    Artisan::call('route:cache');
    Artisan::call('config:cache');
    Artisan::call('config:clear');
    Artisan::call('view:clear');
    return 'Application all kind of cache has been cleared';
});
