<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Mail\Order as MailOrder;
use App\Mail\otp;
use App\Mail\registerUser;
use App\Mail\welcome;
use App\Models\AffiliatePoint;
use App\Models\Blog;
use App\Models\Contact;
use App\Models\Faq;
use App\Models\Member;
use App\Models\Order;
use App\Models\OrderStatus;
use App\Models\Page;
use App\Models\Product;
use App\Models\Review;
use App\Models\SearchHistory;
use App\Models\Setting;
use App\Models\Wishlist;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
//use Session;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Nette\Utils\Random;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;




class FrontController extends Controller
{

    protected $cartdata;
    protected $categories;

    public function __construct()
    {
        $guest_id = isset($_COOKIE['guest_auth_token']) ? $_COOKIE['guest_auth_token'] : '';
        $user_id = (Session::get('memeber_id_ss') != '') ? Session::get('memeber_id_ss') : 0;


        $this->cartdata = DB::table('carts')
            ->where('user_id', $user_id)
            ->orwhere('guest_id', $guest_id)
            ->get()->toArray();
        $this->categories = DB::table('product_categories as a')
            ->leftjoin('product_categories as b', 'b.parent_id', '=', 'a.id')
            ->select('a.title', 'a.id as catid', 'a.image', 'a.slug', 'b.title as child', 'b.id as childid')
            ->where('a.parent_id', 0)
            ->where('a.status', 1)
            ->get();
    }



    public function history()
    {


        $cartItems = $this->cartdata;
        $categories = $this->categories;

        if (Session::get('memeber_id_ss') == '') {
            return redirect('/memberloginform');
        } else {
            $user_id = Session::get('memeber_id_ss');


            $userdata = DB::table('members')
                ->leftJoin('provinces', 'provinces.id', '=', 'members.state')
                ->leftJoin('districts', 'districts.id', '=', 'members.district_id')
                ->select('members.*', 'provinces.name as statename', 'provinces.id as stateid', 'districts.district')
                ->where('members.id', $user_id)
                ->get()->toArray();

            // $del_address = DB::table('members')
            //   ->where('id', $user_id)
            // ->get()->toArray();

            $orders = DB::table('orders as a')
                ->where('user_id', $user_id)
                ->orderBy('a.id', 'desc')
                ->get()->toArray();


            $states = DB::table('provinces')
                ->get();

            if (isset($userdata[0]->stateid)) {
                $districts = DB::table('districts')
                    ->where('province', $userdata[0]->stateid)
                    ->get()->toArray();
            } else {
                $districts = '';
            }



            $shippings = DB::table('shippings')
                ->leftJoin('provinces', 'provinces.id', '=', 'shippings.province')
                ->leftJoin('districts', 'districts.id', '=', 'shippings.district_id')
                ->select('shippings.*', 'provinces.name as statename', 'provinces.id as stateid', 'districts.district')
                ->where('member_id', $user_id)
                ->get()->toArray();

            if (isset($shippings[0]->province)) {
                $district_del = DB::table('districts')
                    ->where('province', $shippings[0]->province)
                    ->get()->toArray();
            } else {
                $district_del = '';
            }




            return view('front.profile.history', compact('cartItems', 'orders', 'userdata', 'states', 'shippings', 'districts', 'district_del', 'categories'));
        }
    }

    public function details()
    {

        $cartItems = $this->cartdata;
        $categories = $this->categories;

        if (Session::get('memeber_id_ss') == '') {
            return redirect('/memberloginform');
        } else {
            $user_id = Session::get('memeber_id_ss');


            $userdata = DB::table('members')
                ->leftJoin('provinces', 'provinces.id', '=', 'members.state')
                ->leftJoin('districts', 'districts.id', '=', 'members.district_id')
                ->select('members.*', 'provinces.name as statename', 'provinces.id as stateid', 'districts.district')
                ->where('members.id', $user_id)
                ->get()->toArray();

            // $del_address = DB::table('members')
            //   ->where('id', $user_id)
            // ->get()->toArray();

            $orders = DB::table('orders as a')
                ->where('user_id', $user_id)
                ->orderBy('a.id', 'desc')
                ->get()->toArray();


            $states = DB::table('provinces')
                ->get();

            if (isset($userdata[0]->stateid)) {
                $districts = DB::table('districts')
                    ->where('province', $userdata[0]->stateid)
                    ->get()->toArray();
            } else {
                $districts = '';
            }



            $shippings = DB::table('shippings')
                ->leftJoin('provinces', 'provinces.id', '=', 'shippings.province')
                ->leftJoin('districts', 'districts.id', '=', 'shippings.district_id')
                ->select('shippings.*', 'provinces.name as statename', 'provinces.id as stateid', 'districts.district')
                ->where('member_id', $user_id)
                ->get()->toArray();

            if (isset($shippings[0]->province)) {
                $district_del = DB::table('districts')
                    ->where('province', $shippings[0]->province)
                    ->get()->toArray();
            } else {
                $district_del = '';
            }




            return view('front.profile.profiledetails', compact('cartItems', 'orders', 'userdata', 'states', 'shippings', 'districts', 'district_del', 'categories'));
        }
    }

    public function mypoints()
    {
        $cartItems = $this->cartdata;
        $categories = $this->categories;

        if (Session::get('memeber_id_ss') == '') {
            return redirect('/memberloginform');
        } else {
            $user_id = Session::get('memeber_id_ss');


            $userdata = DB::table('members')
                ->leftJoin('provinces', 'provinces.id', '=', 'members.state')
                ->leftJoin('districts', 'districts.id', '=', 'members.district_id')
                ->select('members.*', 'provinces.name as statename', 'provinces.id as stateid', 'districts.district')
                ->where('members.id', $user_id)
                ->get()->toArray();

            // $del_address = DB::table('members')
            //   ->where('id', $user_id)
            // ->get()->toArray();

            $orders = DB::table('orders as a')
                ->where('user_id', $user_id)
                ->orderBy('a.id', 'desc')
                ->get()->toArray();


            $states = DB::table('provinces')
                ->get();

            if (isset($userdata[0]->stateid)) {
                $districts = DB::table('districts')
                    ->where('province', $userdata[0]->stateid)
                    ->get()->toArray();
            } else {
                $districts = '';
            }



            $shippings = DB::table('shippings')
                ->leftJoin('provinces', 'provinces.id', '=', 'shippings.province')
                ->leftJoin('districts', 'districts.id', '=', 'shippings.district_id')
                ->select('shippings.*', 'provinces.name as statename', 'provinces.id as stateid', 'districts.district')
                ->where('member_id', $user_id)
                ->get()->toArray();

            if (isset($shippings[0]->province)) {
                $district_del = DB::table('districts')
                    ->where('province', $shippings[0]->province)
                    ->get()->toArray();
            } else {
                $district_del = '';
            }




            return view('front.profile.mypoint', compact('cartItems', 'orders', 'userdata', 'states', 'shippings', 'districts', 'district_del', 'categories'));
        }
    }

    public function updatepassword()
    {
        $cartItems = $this->cartdata;
        $categories = $this->categories;

        if (Session::get('memeber_id_ss') == '') {
            return redirect('/memberloginform');
        } else {
            $user_id = Session::get('memeber_id_ss');


            $userdata = DB::table('members')
                ->leftJoin('provinces', 'provinces.id', '=', 'members.state')
                ->leftJoin('districts', 'districts.id', '=', 'members.district_id')
                ->select('members.*', 'provinces.name as statename', 'provinces.id as stateid', 'districts.district')
                ->where('members.id', $user_id)
                ->get()->toArray();

            // $del_address = DB::table('members')
            //   ->where('id', $user_id)
            // ->get()->toArray();

            $orders = DB::table('orders as a')
                ->where('user_id', $user_id)
                ->orderBy('a.id', 'desc')
                ->get()->toArray();


            $states = DB::table('provinces')
                ->get();

            if (isset($userdata[0]->stateid)) {
                $districts = DB::table('districts')
                    ->where('province', $userdata[0]->stateid)
                    ->get()->toArray();
            } else {
                $districts = '';
            }



            $shippings = DB::table('shippings')
                ->leftJoin('provinces', 'provinces.id', '=', 'shippings.province')
                ->leftJoin('districts', 'districts.id', '=', 'shippings.district_id')
                ->select('shippings.*', 'provinces.name as statename', 'provinces.id as stateid', 'districts.district')
                ->where('member_id', $user_id)
                ->get()->toArray();

            if (isset($shippings[0]->province)) {
                $district_del = DB::table('districts')
                    ->where('province', $shippings[0]->province)
                    ->get()->toArray();
            } else {
                $district_del = '';
            }




            return view('front.profile.password', compact('cartItems', 'orders', 'userdata', 'states', 'shippings', 'districts', 'district_del', 'categories'));
        }
    }

    public function delivery()
    {
        $cartItems = $this->cartdata;
        $categories = $this->categories;

        if (Session::get('memeber_id_ss') == '') {
            return redirect('/memberloginform');
        } else {
            $user_id = Session::get('memeber_id_ss');


            $userdata = DB::table('members')
                ->leftJoin('provinces', 'provinces.id', '=', 'members.state')
                ->leftJoin('districts', 'districts.id', '=', 'members.district_id')
                ->select('members.*', 'provinces.name as statename', 'provinces.id as stateid', 'districts.district')
                ->where('members.id', $user_id)
                ->get()->toArray();

            // $del_address = DB::table('members')
            //   ->where('id', $user_id)
            // ->get()->toArray();

            $orders = DB::table('orders as a')
                ->where('user_id', $user_id)
                ->orderBy('a.id', 'desc')
                ->get()->toArray();


            $states = DB::table('provinces')
                ->get();

            if (isset($userdata[0]->stateid)) {
                $districts = DB::table('districts')
                    ->where('province', $userdata[0]->stateid)
                    ->get()->toArray();
            } else {
                $districts = '';
            }



            $shippings = DB::table('shippings')
                ->leftJoin('provinces', 'provinces.id', '=', 'shippings.province')
                ->leftJoin('districts', 'districts.id', '=', 'shippings.district_id')
                ->select('shippings.*', 'provinces.name as statename', 'provinces.id as stateid', 'districts.district')
                ->where('member_id', $user_id)
                ->get()->toArray();

            if (isset($shippings[0]->province)) {
                $district_del = DB::table('districts')
                    ->where('province', $shippings[0]->province)
                    ->get()->toArray();
            } else {
                $district_del = '';
            }




            return view('front.profile.deliveryaddress', compact('cartItems', 'orders', 'userdata', 'states', 'shippings', 'districts', 'district_del', 'categories'));
        }
    }

    public function newpassword(Request $request)
    {

        $email = request('email');

        $cartItems = $this->cartdata;
        $categories = $this->categories;

        return view("front.newpassword", compact('cartItems', 'categories', 'email'));
    }



    public function changepassword(Request $request)
    {
        # Validation
        $email = request('email');


        $customer = Member::where('email', $email)->first();


        if (!$customer) {
            return redirect()->back()->with('error', 'User not found.');
        }

        $hashedpw = base64_encode($request->newpassword);
        $customer->update([


            'passwrd' => $hashedpw
        ]);

        $customer->save();

        return redirect()->route('member.loginform')->with("status", "Password changed successfully!");
    }
    public function index(Request $request)
    {

        $check_share = $request->websuvcode;
        // session()->forget('websuvcode');


        if ($check_share) {
            session(['websuvcode' => $check_share]);
        }


        // Home Banner                 
        $results['home_banners'] = DB::table('banners')
            ->where(['status' => 1])
            ->orderBy('id', 'asc')
            ->inRandomOrder()->get();

        // New Products
        $results['home_prod_new_arrivals'] = DB::table('products')
            ->where(['status' => 1])
            // ->where(['prod_new_arrival' => '1'])
            ->inRandomOrder()
            ->get();

        // Featured Products
        $results['home_prod_featured'] = DB::table('products')
            ->where(['status' => 1])
            ->where(['prod_featured' => '1'])->inRandomOrder()
            // ->limit(7)
            ->get();

        $results['categories'] = $this->categories;
        // Home => Blog
        $results['cartItems'] = $this->cartdata;

        $blogs = Blog::OrderBy('order', 'asc')->take(3)->get();


        return view('front.index', $results, compact('blogs'));
    }


    // public function wishlist()
    // {
    //     $cartItems = $this->cartdata;
    //     $categories = $this->categories;

    //     $user_id = (Session::get('memeber_id_ss'));

    //     $wishlist = Wishlist::where('user_id', $user_id)->get();
    //     $results['home_prod_new_arrivals'] = DB::table('products')
    //     ->where(['status' => 1])
    //     ->where(['prod_new_arrival' => '1'])
    //     // ->limit(8)
    //     ->get();
    //     return view('front.components.wishlist', compact('cartItems', 'categories', 'wishlist'));
    // }

    public function wishlist()
    {
        $cartItems = $this->cartdata;
        $categories = $this->categories;

        $userId = Session::get('memeber_id_ss');

        if (!$userId) {
            return redirect()->route('member.loginform')->with('error', 'Please log in to view your wishlist.');
        }

        $wishlistProducts = DB::table('wishlists')
            ->join('products', 'wishlists.product_id', '=', 'products.id')
            ->where('wishlists.user_id', $userId)
            ->select('products.*')
            ->get();

        return view('front.components.wishlist', compact('cartItems', 'categories', 'wishlistProducts'));
    }


    // public function addToWishlist($productId)
    // {
    //     $cartItems = $this->cartdata;
    //     $categories = $this->categories;


    //     if (!Session::get('memeber_id_ss')) {
    //         return view('front.memloginform', compact('cartItems', 'categories'))
    //             ->with('error', 'Please login to add items to your wishlist.');
    //     }


    //     $customerId = Session::get('memeber_id_ss');


    //     Wishlist::create([
    //         'user_id' => $customerId,
    //         'product_id' => $productId,
    //     ]);

    //     return redirect()->back()->with('success', 'Product added to your wishlist successfully!');
    // }

    public function addToWishlist(Request $request)
    {




        $cartItems = $this->cartdata;
        $categories = $this->categories;

        if (!Session::get('memeber_id_ss')) {
            return response()->json([
                'success' => false,
                'redirect' => route('member.loginform'),
                'message' => 'Please login to add items to your wishlist.'
            ]);
        }

        $customerId = Session::get('memeber_id_ss');



        Wishlist::create([
            'user_id' => $customerId,
            'product_id' => $request->input('productId'),
        ]);

        return response()->json(['success' => true, 'message' => 'Product added to your wishlist successfully!']);
    }




    // public function deleteWishlist($productId)
    // {
    //     $wishlist = Wishlist::where('product_id', $productId)->first();

    //     if (!$wishlist) {
    //         return redirect()->back()->with('error', 'Wishlist item not found!');

    //     }

    //     $wishlist->delete();


    //     return redirect()->back()->with('success', 'Wishlist item deleted successfully!');

    // }


    public function deletewishlist($id)
    {

        $userId = Session::get('memeber_id_ss');

        if (!$userId) {
            return response()->json(['success' => false, 'message' => 'User not authenticated.']);
        }

        $deleted = Wishlist::where('user_id', $userId)->where('product_id', $id)->delete();

        if ($deleted) {
            return response()->json(['success' => true, 'message' => 'Item removed from wishlist.']);
        } else {
            return response()->json(['success' => false, 'message' => 'Failed to remove item from wishlist.']);
        }
    }





    public function featuredproduct()
    {
        $cartItems = $this->cartdata;
        $categories = $this->categories;

        $results['home_prod_featured'] = DB::table('products')
            ->where(['status' => 1])
            ->where(['prod_featured' => '1'])
            ->get();


        $title = "Featured Products";

        return view('front.products.viewall', $results, compact('title', 'cartItems', 'categories'));
    }




    public function store(Request $request, $slug)
    {




        $product = Product::where('slug', $slug)->firstOrFail();



        $user_id =   (Session::get('memeber_id_ss'));



        $settings = \App\Models\Setting::all()->toArray();
        if ($settings) {
            foreach ($settings as $setting) {
                $setting_data[$setting['key']] = $setting['value'];
            }
        }

        $referral_points = $setting_data['referral_points'] ?? null;


        $points = Member::find($user_id);

        $points->update([
            'total_points' => ($points->total_points ?? 0) + $referral_points,

        ]);


        AffiliatePoint::create([
            'user_id' => $user_id,
            'points' => $referral_points,
            'status' => 'COMPLETED',
            'point_status' => 'Review',
        ]);


        Review::create([
            'product_id' => $product->id,
            'review_detail' => $request->input('feedback'),
            'rating' => $request->input('rating'),
            'user_id' => $user_id,

        ]);

        return redirect()->back()->with('success', 'Review submitted successfully!');
    }


    public function newarrivals()
    {
        $cartItems = $this->cartdata;
        $categories = $this->categories;

        $results['home_prod_featured'] = DB::table('products')
            ->where(['status' => 1])
            // ->where(['prod_new_arrival' => '1'])
            ->get();




        $title = "Products";

        return view('front.products.viewall', $results, compact('title', 'cartItems', 'categories'));
    }

    public function checkout()
    {
        //$key = "bijay@123";
        //echo $enc = base64_encode ($key);
        $cartItems = $this->cartdata;
        $categories = $this->categories;
        $cok_data = Cookie::get('suvdata');

        // Cookie::queue('suvdata', 1234, 60 * 24 * 365); // 1 year

        if (count($cartItems) == 0) {
            return redirect('/view-cart')->with('message', 'Cart is empty');
        }

        $states_del = DB::table('provinces')
            ->get();

        $user_id = (Session::get('memeber_id_ss') != '') ? Session::get('memeber_id_ss') : 0;
        $shippings = "";
        $member = "";
        $guest_id = 0;
        if ($user_id == 0) {
            if ($cok_data) {
                $shippings = DB::table('shippings')
                    ->where(['guest_id' => $cok_data])
                    ->get()->toArray();
            }
        } else {
            $member = Member::findOrFail($user_id);
            $shippings = DB::table('shippings')
                ->where(['member_id' => $user_id])
                ->get()->toArray();
        }



        if (isset($shippings[0]->province)) {
            $districts = DB::table('districts')
                ->where('province', $shippings[0]->province)
                ->get();
        } else {
            $districts = '';
        }


        return view('front.checkout', compact('cartItems', 'states_del', 'shippings', 'districts', 'categories', 'member'));
    }






    public function trackorder(Request $request)
    {

        $cartItems = $this->cartdata;
        $categories = $this->categories;

        $order_id = $request->input('tracking_code');
        $orders = [];
        $shippings = [];
        $userdata = [];

        $order = Order::where('tracking_code', $order_id)->first();





        if ($order) {
            $orderid = $order->id;

            $orders = DB::table('orders as a')
                ->join('order_details as b', 'b.order_id', '=', 'a.id')
                ->where('a.id', $orderid)
                ->get()->toArray();

            $user_id = $orders[0]->user_id;

            $userdata = DB::table('members')
                ->leftJoin('provinces', 'provinces.id', '=', 'members.state')
                ->leftJoin('districts', 'districts.id', '=', 'members.district_id')
                ->select('members.*', 'provinces.name as statename', 'provinces.id as stateid', 'districts.district')
                ->where('members.id', $user_id)
                ->get()->toArray();

            $shippings = DB::table('shippings')
                ->leftJoin('provinces', 'provinces.id', '=', 'shippings.province')
                ->leftJoin('districts', 'districts.id', '=', 'shippings.district_id')
                ->select('shippings.*', 'provinces.name as statename', 'provinces.id as stateid', 'districts.district')
                ->where('member_id', $user_id)
                ->get()->toArray();
        }




        return view('front.ordertracking.index', compact('orders', 'userdata', 'shippings', 'categories', 'cartItems', 'order_id'));
    }



    public function check($name)
    {
        $firstName = explode(' ', $name)[0];
        $randomNumber = random_int(1000, 9999);
        $mycode = strtolower($firstName) . $randomNumber;
        $checkold = Member::where("affilate_code", $mycode)->first();
        if ($checkold) {
            $this->check($name);
        }
        return $mycode;
    }

    public function memberstore(Request $request)
    {

        // $id = $request->id;
        //$member = DB::table('members')->find($id);

        $rules = [
            'fname'          => 'required|min:3|max:50',
            'email'         => 'required|email|min:6|max:50',
            'password'      => 'required|min:6|max:50',
            'gender'      => 'required',
        ];

        $exist = DB::table('members')
            ->where(['email' => $request->email])
            ->get()->toArray();



        if ($request->validate($rules)) {

            if (isset($exist[0]->email)) {
                return redirect('/memberreg')->withErrors(['msg' => "$request->email is already exist. Please put another email"]);
            }

            $hashedpw = base64_encode($request->password);

            $name = $request->fname;
            // dd($request);
            $code = $this->check($name);
            $memberData = [
                'name' => $request->fname,
                'email' =>  $request->email,
                'mobileno' => $request->mobileno,
                'passwrd' => $hashedpw,
                'gender' => $request->gender,
                'status' => 1,
                'affilate_code' => $code,
                'created_at' => @date('Y-m-d H:i')
            ];

            if (empty($member)) {
                $memberid =  DB::table('members')->insertGetId($memberData);

                $request->session()->put('memeber_name_ss', $request->fname);
                $request->session()->put('memeber_email_ss', $request->email);
                $request->session()->put('memeber_id_ss', $memberid);

                $member = Member::find($memberid);


                Mail::to($request->email)->send(new welcome('Thank You'));


                Mail::to('suvlav25@gmail.com')->send(new registerUser($member));



                $cartData = [
                    'user_id' => $memberid,
                ];
                $guest_id = isset($_COOKIE['guest_auth_token']) ? $_COOKIE['guest_auth_token'] : '';
                DB::table('carts')->where('guest_id', $guest_id)->update($cartData);

                //echo $memberid;

                return redirect($request->prev_url);
            }
        } else {

            return redirect('/memberreg')->withErrors(['msg' => "Validation Error, please fill correct data !"]);
        }
        // else {
        //     DB::table('members')->where('id', $id)->update($memberData);
        // }



    }

    public function profileupdate(Request $request)
    {
        $id = Session::get('memeber_id_ss');

        $memberData = [
            'name' => $request->fname,
            'mobileno' => $request->mobileno,
            'gender' => $request->gender,
            'state' => $request->province_id,
            'district_id' => $request->district,
            'address' => $request->address
        ];
        DB::table('members')->where('id', $id)->update($memberData);

        return redirect('/myprofile?tab=2')->with(['message' => "Profile has been updated."]);
    }
    public function statusupdate(Request $request, $order)
    {
        // dd($request, $order);
        $id = Session::get('memeber_id_ss');
        OrderStatus::create([
            'order_id' => $order,
            'user_id' => $id,
            'status' => $request->status ?? "",
            'reason' => $request->reason ?? "",
        ]);


        DB::table('orders')->where('id', $order)->update([
            'status' => $request->status ?? "",
        ]);

        return redirect()->back()->with(['message' => "Order status has been updated."]);
    }

    public function memberlogin(Request $request)
    {



        // $key = "bijay@123";
        // $enc = base64_encode ($key);
        // $dec = base64_decode ($enc);
        // echo 'Encrypted : '.$enc.'<br>';
        // echo 'Decrypted : '.$dec.'<br>';


        $reqpw = base64_encode($request->password);
        $mem = DB::table('members')
            ->where('email', $request->email)
            ->where('passwrd', $reqpw)
            ->get()->toArray();

        if (isset($mem[0])) {


            $memname = $mem[0]->name;
            $request->session()->put('memeber_name_ss', $memname);
            $request->session()->put('memeber_email_ss', $request->email);
            $request->session()->put('memeber_id_ss', $mem[0]->id);

            $cartData = [
                'user_id' => $mem[0]->id,
            ];
            $guest_id = isset($_COOKIE['guest_auth_token']) ? $_COOKIE['guest_auth_token'] : '';

            DB::table('carts')->where('guest_id', $guest_id)->update($cartData);

            $returl = $request->prev_url;

            if (str_contains($request->prev_url, 'memberloginform')) {
                $returl = '/';
            } elseif (str_contains($request->current_url, 'checkout')) {
                $returl = '/checkout';
            }

            return redirect($returl);
            // if(count($this->cartdata) > 0){
            //     return redirect()->route('cart.checkout')->with('success', 'Loggedin successfully');
            // }else{
            //     return redirect('/');
            // }

        } else {

            if (str_contains($request->current_url, 'checkout')) {
                $url = '/checkout';
            } else {
                $url = '/memberloginform';
            }

            return redirect($url)->withErrors(['msg' => 'Email or Password is not match. Please put correct data.']);;
        }
    }


    public function getDistrictsByState(Request $request)
    {

        $stateId = $request->input('state_id');

        $districts = DB::table('districts')
            ->where('province', $stateId)
            ->get();

        return view('front.ajax_load_district', compact('districts'));
    }


    public function checkoutsmt(Request $request)
    {




        // dd(vars: $request->email);

        $cartItems = $this->cartdata;
        $categories = $this->categories;


        if (count($cartItems) == 0) {
            return redirect('/view-cart')->with('message', 'Cart is empty');
        }

        $user_id = Session::get('memeber_id_ss') ?? 0;
        $guest_id = 0;
        $member = "";
        $cartItems = "";
        if ($user_id == 0) {
            $guest_id = $_COOKIE['guest_auth_token'];
            Cookie::queue('suvdata', $guest_id, 60 * 24 * 365); // 1 year
            $cartItems = DB::table('carts')
                ->where('guest_id', $guest_id)
                ->get()->toArray();
        } else {
            $cartItems = DB::table('carts')
                ->where('user_id', $user_id)
                ->get()->toArray();
            $member = Member::findOrFail($user_id);
        }

        // dd(session('suvcode'));
        $webcode = session('websuvcode');
        // dd($webcode);
        $code = session('suvcode');
        $session_product_id = session('suvproduct');
        // dd($session_product_id);




        $item_count = 0;
        $totalprice = 0;
        $totalqnty = 0;




        foreach ($cartItems as $cc) {
            $item_count++;
            $totalprice = $totalprice + $cc->price * $cc->quantity;
            $totalqnty = $totalqnty + $cc->quantity;
        }

        $value = 0;
        $status = "";
        $checkmember = "";

        $trackingid = rand(10000, 99999);

        $cart_order = [
            'user_id' => $user_id,
            'total_amt' => $totalprice,
            'total_items' => $item_count,
            'total_no_qnty' => $totalqnty,
            'fullname' => $request->name,
            'email' =>  $request->email,
            'mobile' => $request->mobileno,
            'province' => $request->province_id,
            'district_id' => $request->district,
            // 'address' => $request->address,
            // 'city' => $request->city_del,
            'tole' => $request->tole_del,
            // 'houseno' => $request->house_del,
            'tracking_code' => $trackingid,
            'created_at' => @date('Y-m-d H:i')

        ];

        if ($request->redeem_point == 1) {
            $points = $member->total_points;

            if ($totalprice <= $points) {
                $usedPoints = $totalprice;
                $remainingPoints = $points - $totalprice;
            } else {
                $usedPoints = $points;
                $remainingPoints = 0;
                $totalprice -= $points;
            }
            $cart_order["use_point"] = $usedPoints;
            $member->total_points -= $usedPoints;
            $member->save();
        }


        $orderid =  DB::table('orders')->insertGetId($cart_order);


        foreach ($cartItems as $cc) {

            if ($webcode) {
                $product = Product::where("id", $cc->product_id)->first();
                $webpoint = $product->web_points;
                $checkmember = Member::where("affilate_code", $webcode)->where("share_status", "verified")->first();
                if ($checkmember) {
                    if ($checkmember->id != $user_id) {
                        $value +=  $webpoint * $cc->quantity;
                        $status = 'WebsiteShare';
                    }
                }
            } else {
                if ($session_product_id) {

                    if ($cc->product_id == $session_product_id) {
                        $product = Product::where("id", $cc->product_id)->first();
                        if ($code) {
                            $checkmember = Member::where("affilate_code", $code)->first();
                            if ($checkmember) {
                                if ($session_product_id) {
                                    if ($checkmember->id != $user_id) {
                                        $value +=  $product->points ?? 0 * $cc->quantity;
                                    }
                                }
                            }
                        }
                    }
                }
            }
            // dd("sa",$value);
            $cart_orders = [
                'order_id' => $orderid,
                'product_id' => $cc->product_id,
                'product_name' => $cc->product_title,
                'product_image' => $cc->product_image,
                'quantity' => $cc->quantity,
                'attributes' => $cc->attributes,
                'price' => $cc->price,
                'created_at' => @date('Y-m-d H:i')
            ];

            DB::table('order_details')->insert($cart_orders);
        }

        if ($checkmember) {
            if ($value != 0) {
                $affilate = AffiliatePoint::create([
                    'user_id' => $checkmember->id,
                    'order_id' => $orderid,
                    'points' => $value,
                    'status' => "PENDING",
                    'point_status' => $status
                ]);
            }
        }
        session()->forget('suvcode');
        session()->forget('suvproduct');
        // session()->forget('websuvcode');

        $exist = DB::table('shippings')
            ->where(['member_id' => $user_id])
            ->get()->toArray();

        $memberData = [
            'member_id' => $user_id,
            'guest_id' => $guest_id,
            'fullname' => $request->name,
            'email' => $request->email,
            'mobile' => $request->mobileno,
            'province' => $request->province_id,
            'district_id' => $request->district,
            'city' => $request->city_del,
            'address' => $request->address,
            'tole' => $request->tole_del,
            'houseno' => $request->house_del,
            'gaupalika' => $request->gaupalika,
            'nagarpalika' => $request->nagarpalika,
            'wardno' => $request->wardno

        ];

        if (!isset($exist[0]->fullname)) {
            $memberData['created_at'] = date('Y-m-d H:i');
            DB::table('shippings')->insert($memberData);
        } else {
            DB::table('shippings')
                ->where('id', $exist[0]->id)
                ->update($memberData);
        }

        // mailData 
        $orders = DB::table('orders as a')
            ->join('order_details as b', 'b.order_id', '=', 'a.id')
            ->where('a.id', $orderid)
            ->get()->toArray();

        $user_id = $orders[0]->user_id;

        $userdata = DB::table('members')
            ->leftJoin('provinces', 'provinces.id', '=', 'members.state')
            ->leftJoin('districts', 'districts.id', '=', 'members.district_id')
            ->select('members.*', 'provinces.name as statename', 'provinces.id as stateid', 'districts.district')
            ->where('members.id', $user_id)
            ->get()->toArray();

        $shippings = DB::table('shippings')
            ->leftJoin('provinces', 'provinces.id', '=', 'shippings.province')
            ->leftJoin('districts', 'districts.id', '=', 'shippings.district_id')
            ->select('shippings.*', 'provinces.name as statename', 'provinces.id as stateid', 'districts.district')
            ->where('member_id', $user_id)
            ->get()->toArray();

        $myuserdata = "";
        if ($user_id != 0) {
            $myuserdata = $userdata[0];
        }
        $maildata = [$orders, $myuserdata, $shippings[0]];

        if ($user_id != 0) {
            DB::table('carts')->where('user_id', '=', $user_id)->delete();
            Mail::to("suvlav25@gmail.com")->send(new MailOrder($maildata));
            Mail::to($request->email)->send(new MailOrder($maildata));

            return redirect()->route('member.myprofile')->with('success', 'Order has been Successfully Placed.');
        } else {
            DB::table('carts')->where('guest_id', '=', $guest_id)->delete();
            Mail::to("suvlav25@gmail.com")->send(new MailOrder($maildata));
            Mail::to($request->email)->send(new MailOrder($maildata));
            return redirect()->route('home.index')->with('success', 'Order has been Successfully Placed.');
        }
    }

    public function profileorder()
    {
        return view('front.memloginform', compact('cartItems'));
    }

    public function memberloginform()
    {

        if (Session::get('memeber_id_ss') != '') {
            return redirect('/');
        }

        $cartItems = $this->cartdata;
        $categories = $this->categories;

        return view('front.memloginform', compact('cartItems', 'categories'));
    }

    public function memberreg()
    {
        if (Session::get('memeber_id_ss') != '') {
            return redirect('/');
        }


        $cartItems = $this->cartdata;
        $categories = $this->categories;




        return view('front.memregform', compact('cartItems', 'categories'));
    }

    public function forgotpwform()
    {
        $cartItems = $this->cartdata;
        $categories = $this->categories;
        return view('front.forgetpwform', compact('cartItems', 'categories'));
    }



    public function forgotpwformstore(Request $request)
    {


        $cartItems = $this->cartdata;
        $categories = $this->categories;
        $email = request('email');
        if (!$email) {
            return view('front.forgetpwform');
        } else {
            $customer = Member::where("email", $request->email)->first();


            if (!$customer) {
                return redirect()->back()->with('error', 'Email not found');
            }


            $otp = rand(100000, 999999);


            $customer->update([
                'otp' => $otp,
            ]);


            Mail::to($email)->send(new otp($otp));


            return view('front.otp', ['email' => $email],  compact('cartItems', 'categories'));
        }
    }




    public function otp(Request $request)
    {
        $cartItems = $this->cartdata;
        $categories = $this->categories;
        $email = request('email');

        if (!$email) {

            return redirect()->back();
        } else {
            $customer = Member::where("email", $request->email)->first();

            if (!$customer) {

                return redirect()->back()->with('error', 'Invalid Otp');
            }


            return view('front.otp', compact('cartItems', 'categories', 'email'));
        }
    }






    public function checkotp(Request $request)
    {


        $email = $request->email;


        $otp = $request->otp;
        $checkotp = Member::where('email', $email)->first();


        if ($otp == $checkotp->otp) {
            return redirect()->route('newpassword', ['email' => $email]);
        } else {
            return redirect()->back()->with('error', 'Invalid Otp');
        }
    }


    public function myprofile()
    {

        $cartItems = $this->cartdata;
        $categories = $this->categories;

        if (Session::get('memeber_id_ss') == '') {
            return redirect('/memberloginform');
        } else {
            $user_id = Session::get('memeber_id_ss');


            $userdata = DB::table('members')
                ->leftJoin('provinces', 'provinces.id', '=', 'members.state')
                ->leftJoin('districts', 'districts.id', '=', 'members.district_id')
                ->select('members.*', 'provinces.name as statename', 'provinces.id as stateid', 'districts.district')
                ->where('members.id', $user_id)
                ->get()->toArray();

            // $del_address = DB::table('members')
            //   ->where('id', $user_id)
            // ->get()->toArray();

            $orders = DB::table('orders as a')
                ->where('user_id', $user_id)
                ->orderBy('a.id', 'desc')
                ->get()->toArray();


            $states = DB::table('provinces')
                ->get();

            if (isset($userdata[0]->stateid)) {
                $districts = DB::table('districts')
                    ->where('province', $userdata[0]->stateid)
                    ->get()->toArray();
            } else {
                $districts = '';
            }



            $shippings = DB::table('shippings')
                ->leftJoin('provinces', 'provinces.id', '=', 'shippings.province')
                ->leftJoin('districts', 'districts.id', '=', 'shippings.district_id')
                ->select('shippings.*', 'provinces.name as statename', 'provinces.id as stateid', 'districts.district')
                ->where('member_id', $user_id)
                ->get()->toArray();

            if (isset($shippings[0]->province)) {
                $district_del = DB::table('districts')
                    ->where('province', $shippings[0]->province)
                    ->get()->toArray();
            } else {
                $district_del = '';
            }




            return view('front.myprofilelist', compact('cartItems', 'orders', 'userdata', 'states', 'shippings', 'districts', 'district_del', 'categories'));
        }
    }

    function profileshippingsave(Request $request)
    {

        $id = Session::get('memeber_id_ss');

        $exist = DB::table('shippings')
            ->where(['member_id' => $id])
            ->get()->toArray();

        $memberData = [
            'member_id' => $id,
            'fullname' => $request->fname_del,
            'mobile' => $request->mobileno_del,
            'province' => $request->province_id_Del,
            'district_id' => $request->district_del,
            'city' => $request->city_del,
            'address' => $request->address_del,
            'tole' => $request->tole_del,
            'houseno' => $request->house_del,
            'gaupalika' => $request->gaupalika,
            'nagarpalika' => $request->nagarpalika,
            'wardno' => $request->wardno

        ];

        if (isset($exist[0]->fullname)) {
            $memberData['updated_at'] = date('Y-m-d H:i');
            DB::table('shippings')->where('id', $exist[0]->id)->update($memberData);
            return redirect('/myprofile?tab=3')->with(['message' => "Shipping Address has been updated."]);
        } else {
            $memberData['created_at'] = date('Y-m-d H:i');
            DB::table('shippings')->insert($memberData);
            return redirect('/myprofile?tab=3')->with(['message' => "Shipping Address has been added."]);
        }
    }

    public function memberchanagepw(Request $request)
    {


        try {
            $request->validate([
                'old_password' => 'required',
                'new_password' => 'required',
                'confirm_password' => 'required|same:new_password',
            ]);

            $userid = Session::get('memeber_id_ss');



            $userdata = DB::table('members')
                ->where('id', $userid)
                ->get()->toArray();

            $oldpwdb = base64_decode($userdata[0]->passwrd);
            $oldpw = $request->old_password;

            if ($oldpw == $oldpwdb) {
                //$newpass = base64_encode($this->request->getVar('password'));
                $newpass =  base64_encode($request->new_password);
                $memdata = [
                    'passwrd' => $newpass,
                ];

                DB::table('members')->where('id', $userid)->update($memdata);

                // echo '<span style="color:green">Password has been changed.</span>';
                return redirect('/myprofile?tab=4')->with('message', 'Password updated successfully.');
            } else {
                return redirect('/myprofile?tab=4')->with('message', 'Old Passowrd Not Matched.');
                // echo '<span style="color:red">Old Passowrd Not Matched.</span>';
            }

            // Implement password update logic here..

        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect('/myprofile?tab=4')
                ->withErrors($e->errors())
                ->withInput(); // Preserve user inputs
        }
    }

    public function productcategory($catid)
    {

        $productbycat = '';

        $home_prod_bycat = DB::table('products')
            ->where(['status' => 1])
            ->whereJsonContains('prod_categories', $catid)
            ->limit(8)
            ->get();

        //  SELECT * FROM `products` WHERE json_contains(prod_categories, '"18"')


        $categories = $this->categories;

        $cartItems = $this->cartdata;

        return view('front.productbycat', compact('home_prod_bycat', 'cartItems', 'categories'));
    }

    public function contactus()
    {

        $categories = $this->categories;

        $cartItems = $this->cartdata;

        return view('front.contactus', compact('cartItems', 'categories'));
    }

    public function contactmail(Request $request)
    {




        $user = Contact::create([
            'name' => $request->name,
            'email' => $request->email,
            'subject' => $request->subject,
            'phone_no' => $request->phone_no,
            'message' => $request->message,
        ]);



        $to = "bijay107@gmail.com";
        $fname = $request->name;
        $subject = $request->subject;
        $femail = $request->email;
        $phone_no = $request->phone_no;
        $message = $request->message;

        $msgf = 'Name : ' . $fname . '\n Phone no.' . $phone_no . '\n Message :' . $message;

        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";


        $headers .= 'From: <' . $femail . '>' . "\r\n";


        $ok = @mail($to, $subject, $msgf, $headers);
        if ($ok) {
            return redirect('/contactus')->with(['message' => "Email has been sent."]);
        } else {
            return redirect('/contactus')->with(['message' => "Email has not been send."]);
        }
    }
    public function memberlogout()
    {

        Auth::logout();
        Session::flush();
        return redirect('/')->with("success", "Sucessfully Logout");
    }



    public function termsandcondition()
    {

        $cartItems = $this->cartdata;
        $categories = $this->categories;
        $pages = Page::where('id', 3)->first();
        return view('front.termsandprivacy.index', compact('pages', 'cartItems', 'categories'));
    }


    public function privacypolicy()
    {
        $cartItems = $this->cartdata;
        $categories = $this->categories;
        $pages = Page::where('id', 4)->first();
        return view('front.termsandprivacy.index', compact('pages', 'cartItems', 'categories'));
    }


    public function faqs()
    {

        $cartItems = $this->cartdata;
        $categories = $this->categories;
        $pages = Faq::get();
        return view('front.faqs.index', compact('pages', 'cartItems', 'categories'));
    }


    public function allblogs()
    {

        $cartItems = $this->cartdata;
        $categories = $this->categories;
        $blogs = Blog::get();
        return view('front.blog.allblogs', compact('blogs', 'cartItems', 'categories'));
    }


    public function blogsdetails(Blog $blog)
    {


        $cartItems = $this->cartdata;
        $categories = $this->categories;
        $otherblogs = Blog::where('id', "!=", $blog->id)->get();

        return view('front.blog.single', compact('blog', 'cartItems', 'categories', 'otherblogs'));
    }



    public function search(Request $request)
    {
        $cartItems = $this->cartdata;
        $categories = $this->categories;

        $id = Session::get('memeber_id_ss');

        $userdata = DB::table('members')
            ->where('members.id', $id)
            ->first();


        if ($id) {
            $cartItems = $this->cartdata;
            $categories = $this->categories;
            $query = $request->input('query');
            $name = $userdata->name;

            if ($query) {
                SearchHistory::create([
                    'email' => session('memeber_email_ss'), // Store the user's email from session
                    'search_item' => $query,
                    'user_id' => $id,
                    'name' => $name,
                    'phonenumber' => $userdata->mobileno,
                ]);
            }

            $searchHistory = json_decode(Cookie::get('search_history', '[]'), true);
            $searchHistory[] = $query;
            $searchHistory = array_unique(array_slice($searchHistory, -10));

            Cookie::queue('search_history', json_encode($searchHistory), 60 * 24 * 365 * 5); // 5 years

            $productIDs = Product::where('title', 'like', '%' . $query . '%')->pluck('id');
            $products = Product::whereIn('id', $productIDs)->get();

            return view('front.products.search', compact('cartItems', 'categories', 'products', 'query', 'searchHistory'));
        } else {




            $cartItems = $this->cartdata;
            $categories = $this->categories;
            $query = $request->input('query');


            if ($query) {
                SearchHistory::create([
                    'search_item' => $query,
                ]);
            }

            $searchHistory = json_decode(Cookie::get('search_history', '[]'), true);
            $searchHistory[] = $query;
            $searchHistory = array_unique(array_slice($searchHistory, -10));

            Cookie::queue('search_history', json_encode($searchHistory), 60 * 24 * 365 * 5); // 5 years

            $productIDs = Product::where('title', 'like', '%' . $query . '%')->pluck('id');
            $products = Product::whereIn('id', $productIDs)->get();

            return view('front.products.search', compact('cartItems', 'categories', 'products', 'query', 'searchHistory'));
        }
    }


    public function searchstore(Request $request)
    {
        $query = $request->input('query');

        SearchHistory::where('search_item', $query)->update([
            'email' => $request->email,
            'name' => $request->name,
            'phonenumber' => $request->phonenumber,
            'district' => $request->district,
        ]);

        return redirect('/')->with("message", "Search history submitted successfully!");
    }




    public function clearSearchHistory()
    {


        Cookie::queue(Cookie::forget('search_history'));


        return redirect()->back()->with('message', 'Search history cleared successfully!');
    }

    public function myprofileorder($order)
    {

        $order_id = $order;
        $cartItems = $this->cartdata;
        $categories = $this->categories;

        $order = Order::where('id', $order_id)->first();


        $orderid = $order->id;

        $orders = DB::table('orders as a')
            ->join('order_details as b', 'b.order_id', '=', 'a.id')
            ->where('a.id', $orderid)
            ->get()->toArray();

        $user_id = $orders[0]->user_id;

        $userdata = DB::table('members')
            ->leftJoin('provinces', 'provinces.id', '=', 'members.state')
            ->leftJoin('districts', 'districts.id', '=', 'members.district_id')
            ->select('members.*', 'provinces.name as statename', 'provinces.id as stateid', 'districts.district')
            ->where('members.id', $user_id)
            ->get()->toArray();

        $shippings = DB::table('shippings')
            ->leftJoin('provinces', 'provinces.id', '=', 'shippings.province')
            ->leftJoin('districts', 'districts.id', '=', 'shippings.district_id')
            ->select('shippings.*', 'provinces.name as statename', 'provinces.id as stateid', 'districts.district')
            ->where('member_id', $user_id)
            ->get()->toArray();



        return view('front.profileorder_view', compact('orders', 'userdata', 'shippings', 'categories', 'cartItems', 'order_id'));
    }
}
