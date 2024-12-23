<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\AffiliatePoint;
use App\Models\Blog;
use App\Models\Faq;
use App\Models\Member;
use App\Models\Page;
use App\Models\Product;
use App\Models\Setting;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
//use Session;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

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

    public function index(Request $request)
    {

        // Home Banner                 
        $results['home_banners'] = DB::table('banners')
            ->where(['status' => 1])
            ->orderBy('id', 'asc')
            ->get();

        // New Products
        $results['home_prod_new_arrivals'] = DB::table('products')
            ->where(['status' => 1])
            ->where(['prod_new_arrival' => '1'])
            // ->limit(8)
            ->get();

        // Featured Products
        $results['home_prod_featured'] = DB::table('products')
            ->where(['status' => 1])
            ->where(['prod_featured' => '1'])
            // ->limit(7)
            ->get();

        $results['categories'] = $this->categories;
        // Home => Blog
        $results['cartItems'] = $this->cartdata;

        $blogs = Blog::OrderBy('order', 'asc')->take(3)->get();


        return view('front.index', $results, compact('blogs'));
    }

    public function checkout()
    {
        //$key = "bijay@123";
        //echo $enc = base64_encode ($key);

        $cartItems = $this->cartdata;
        $categories = $this->categories;


        if (count($cartItems) == 0) {
            return redirect('/view-cart')->with('message', 'Cart is empty');
        }

        $states_del = DB::table('provinces')
            ->get();

        $user_id = (Session::get('memeber_id_ss') != '') ? Session::get('memeber_id_ss') : 0;

        $shippings = DB::table('shippings')
            ->where(['member_id' => $user_id])
            ->get()->toArray();

        if (isset($shippings[0]->province)) {
            $districts = DB::table('districts')
                ->where('province', $shippings[0]->province)
                ->get();
        } else {
            $districts = '';
        }


        return view('front.checkout', compact('cartItems', 'states_del', 'shippings', 'districts', 'categories'));
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
            $code = $this->check($name);
            $memberData = [
                'name' => $request->fname,
                'email' =>  $request->email,
                'mobileno' => $request->mobileno,
                'passwrd' => $hashedpw,
                'gender' => '',
                'status' => 1,
                'affilate_code' => $code,
                'created_at' => @date('Y-m-d H:i')
            ];

            if (empty($member)) {
                $memberid =  DB::table('members')->insertGetId($memberData);

                $request->session()->put('memeber_name_ss', $request->fname);
                $request->session()->put('memeber_email_ss', $request->email);
                $request->session()->put('memeber_id_ss', $memberid);

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




        // dd(session('suvcode'));
        $code = session('suvcode');
        $session_product_id = session('suvproduct');
        // dd($session_product_id);

        $user_id = Session::get('memeber_id_ss');




        $cartItems = DB::table('carts')
            ->where('user_id', $user_id)
            ->get()->toArray();

        $item_count = 0;
        $totalprice = 0;
        $totalqnty = 0;

        $referral_points = Setting::where('key', "referral_points")->first()->value ?? 0;



        foreach ($cartItems as $cc) {
            $item_count++;
            $totalprice = $totalprice + $cc->price * $cc->quantity;
            $totalqnty = $totalqnty + $cc->quantity;
        }

        $value = 0;
        $checkmember = "";


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
            'address' => $request->address,
            'city' => $request->city_del,
            'tole' => $request->tole_del,
            'houseno' => $request->house_del,
            'created_at' => @date('Y-m-d H:i')
        ];


        $orderid =  DB::table('orders')->insertGetId($cart_order);


        foreach ($cartItems as $cc) {

            if ($session_product_id) {
                if ($cc->product_id == $session_product_id) {
                    $product = Product::where("id", $cc->product_id)->first();
                    if ($code) {
                        $checkmember = Member::where("affilate_code", $code)->first();
                        if ($checkmember) {
                            if ($session_product_id) {
                                if ($checkmember->id != $user_id) {
                                    $value +=  $product->points ?? 0;
                                }
                            }
                        }
                    }
                }
            }

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
            $affilate = AffiliatePoint::create([
                'user_id' => $checkmember->id,
                'order_id' => $orderid,
                'points' => $value,
                'status' => "PENDING",
            ]);
        }
        session()->forget('suvcode');
        session()->forget('suvproduct');

        $exist = DB::table('shippings')
            ->where(['member_id' => $user_id])
            ->get()->toArray();

        $memberData = [
            'member_id' => $user_id,
            'fullname' => $request->name,
            'mobile' => $request->mobileno,
            'province' => $request->province_id,
            'district_id' => $request->district,
            'city' => $request->city_del,
            'address' => $request->address,
            'tole' => $request->tole_del,
            'houseno' => $request->house_del,
            // 'gaupalika' => $request->gaupalika,
            // 'nagarpalika' => $request->nagarpalika,
            // 'wardno' => $request->wardno

        ];

        if (!isset($exist[0]->fullname)) {
            $memberData['created_at'] = date('Y-m-d H:i');
            DB::table('shippings')->insert($memberData);
        }

        DB::table('carts')->where('user_id', '=', $user_id)->delete();

        return redirect()->route('member.myprofile')->with('success', 'Order has been Successfully Placed.');
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
                ->join('order_details as b', 'b.order_id', '=', 'a.id')
                ->where('user_id', $user_id)
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
               'gaupalika'=>$request->gaupalika,
            'nagarpalika'=>$request->nagarpalika,
            'wardno'=>$request->wardno

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

        $userid = Session::get('memeber_id_ss');

        if ($request->newpassword != $request->confirmpassword) {
            echo '<span style="color:red">Confirm Password is mis-matched</span>';
            die();
        }

        $userdata = DB::table('members')
            ->where('id', $userid)
            ->get()->toArray();

        $oldpwdb = base64_decode($userdata[0]->passwrd);
        $oldpw = $request->old_password;

        if ($oldpw == $oldpwdb) {
            //$newpass = base64_encode($this->request->getVar('password'));
            $newpass =  base64_encode($request->newpassword);
            $memdata = [
                'passwrd' => $newpass,
            ];

            DB::table('members')->where('id', $userid)->update($memdata);

            echo '<span style="color:green">Password has been changed.</span>';
        } else {
            echo '<span style="color:red">Old Passowrd Not Matched.</span>';
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

        $to = "bijay107@gmail.com";
        $fname = $request->name;
        $subject = $request->subject;
        $femail = $request->email;
        $phone_no = $request->phone_no;
        $message = $request->message;

        $msgf = 'Name : ' . $fname . '\n Phone no.' . $phone_no . '\n Message :' . $message;

        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

        // More headers
        $headers .= 'From: <' . $femail . '>' . "\r\n";
        // $headers .= 'Cc: myboss@example.com' . "\r\n";

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
        return redirect('/');
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
        $query = $request->input('query');

        $productIDs = Product::where('title', 'like', '%' . $query . '%')->pluck('id');

        $products = Product::whereIn('id', $productIDs)
            ->get();
        return view('front.products.search', compact('cartItems', 'categories', 'products', 'query'));
    }
}
