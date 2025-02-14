<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Exchange;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Session;
use Cache;

class CartController extends Controller
{

    public function index(Request $request)
    {

        $cart = new Cart;
        $guest_id = $_COOKIE['guest_auth_token'];
        $user_id = (Session::get('memeber_id_ss') != '') ? Session::get('memeber_id_ss') : 0;

        $cartItems = Cart::where('user_id', $user_id)
            ->orwhere('guest_id', $guest_id)
            ->get();

        $categories = DB::table('product_categories as a')
            ->leftjoin('product_categories as b', 'b.parent_id', '=', 'a.id')
            ->select('a.title', 'a.id as catid', 'a.image', 'a.slug', 'b.title as child', 'b.id as childid')
            ->where('a.parent_id', 0)
            ->where('a.status', 1)
            ->get();

        return view('front.products.cart', compact('cartItems', 'categories'));
    }

    /* **** Remove Cart Item *********/
    public function removeCartItem(Request $request)
    {
        $response_data = [];
        $guest_id = $_COOKIE['guest_auth_token'];
        $cart = Cart::where('id', $request->cartItemId)->first();
        if ($cart) {
            $cart->delete();

            $response_data['status'] = 'success';
            $response_data['msg'] = 'The item has been removed.';
            $response_data['cart_page_content'] = $this->cartItemsBlock();
            $response_data['content'] = $this->cartDropDown();
        } else {
            $response_data['status'] = 'error';
            $response_data['msg'] = 'The item has failed to delete.';
        }
        echo json_encode($response_data);
        exit;
    }


    /* Update Cart Item */
    public function updateCart(Request $request)
    {
        $response_data = [];
        $guest_id = $_COOKIE['guest_auth_token'];
        $cart = new Cart();
        $cartItem = Cart::where('id', $request->cartItemId)->first();

        if ($cartItem) {
            $cartItem->quantity = $request->quantity;
            $cartItem->save();

            $response_data['status'] = 'success';
            $response_data['msg'] = 'The cart has been updated.';
            $response_data['cart_page_content'] = $this->cartItemsBlock();
            $response_data['content'] = $this->cartDropDown();
        } else {
            $response_data['status'] = 'error';
            $response_data['msg'] = 'The cart has failed to update.';
        }

        echo json_encode($response_data);
        exit;
    }

    /*** Add to Cart */


    public function AddToCart(Request $request)
    {

        $response_data = [];
        $cart = new Cart();
        $guest_id = $_COOKIE['guest_auth_token'];
        $user_id = (Session::get('memeber_id_ss') != '') ? Session::get('memeber_id_ss') : 0;
        $product = Product::where('id', $request->product_id)->firstOrFail();

        $prod_attr = [
            'color' => $request->cartColor,
            'size' => $request->cartSize
        ];

        $price = $product->regular_price;
        if (!empty($product->sale_price)) {
            $price = $product->sale_price;
        }

        $cartItem = Cart::where('product_id', $request->product_id)
            ->where(function ($query) use ($user_id, $guest_id) {
                $query->where('user_id', $user_id)
                    ->orWhere('guest_id', $guest_id);
            })
            ->first();

        $available_qty = $product->availablestock ?? 0;

        if ($cartItem) {
            $qty = $cartItem->quantity + $request->quantity;
            if ($available_qty < $qty) {
                return response()->json(["success" => false, "message" => "Only " . $available_qty . " quantity is available. Please Check in Cart"]);
            } else {
                $cartItem->quantity += $request->quantity;
                $cartItem->attributes = json_encode($prod_attr);
                $cartItem->save();
            }
        } else {

            $cart = new Cart();

            if ($user_id != 0) {
                $cart->user_id = $user_id;
            }
            if ($available_qty < $request->quantity) {
                return response()->json(["success" => false, "message" => "Only " . $available_qty . " quantity is available"]);
            } else {
                // dd($request->quantity);
                $cart->guest_id = $guest_id;
                $cart->product_id = $request->product_id;
                $cart->quantity = $request->quantity;
                $cart->product_title = $product->title;
                $cart->product_image = $product->image;
                $cart->product_slug = $product->slug;
                $cart->attributes = json_encode($prod_attr);
                $cart->price = $price;
                $cart->save();
            }
        }
        $cartDropDown = $this->cartDropDown();
        $response_data['status'] = 'success';
        $response_data['msg'] = 'The product has been added to cart.';
        $response_data['content'] = $cartDropDown;
        echo json_encode($response_data);
        exit;
    }

    public function buynow(Request $request)
    {
        $response_data = [];
        $cart = new Cart();
        $guest_id = $_COOKIE['guest_auth_token'];
        $user_id = (Session::get('memeber_id_ss') != '') ? Session::get('memeber_id_ss') : 0;
        $product = Product::where('id', $request->product_id)->firstOrFail();

        $prod_attr = [
            'color' => $request->cartColor,
            'size' => $request->cartSize
        ];

        $price = $product->regular_price;
        if (!empty($product->sale_price)) {
            $price = $product->sale_price;
        }

        $cartItem = Cart::where('product_id', $request->product_id)
            ->where(function ($query) use ($user_id, $guest_id) {
                $query->where('user_id', $user_id)
                    ->orWhere('guest_id', $guest_id);
            })
            ->first();

        $available_qty = $product->availablestock ?? 0;

        if ($cartItem) {
            $qty = $cartItem->quantity + $request->quantity;
            if ($available_qty < $qty) {
                return response()->json(["success" => false, "message" => "Only " . $available_qty . " quantity is available. Please Check in Cart"]);
            } else {
                $cartItem->quantity += $request->quantity;
                $cartItem->attributes = json_encode($prod_attr);
                $cartItem->save();
            }
        } else {

            $cart = new Cart();

            if ($user_id != 0) {
                $cart->user_id = $user_id;
            }
            if ($available_qty < $request->quantity) {
                return response()->json(["success" => false, "message" => "Only " . $available_qty . " quantity is available"]);
            } else {
                // dd($request->quantity);
                $cart->guest_id = $guest_id;
                $cart->product_id = $request->product_id;
                $cart->quantity = $request->quantity;
                $cart->product_title = $product->title;
                $cart->product_image = $product->image;
                $cart->product_slug = $product->slug;
                $cart->attributes = json_encode($prod_attr);
                $cart->price = $price;
                $cart->save();
            }
        }
        $cartDropDown = $this->cartDropDown();
        $response_data['status'] = 'success';
        $response_data['msg'] = 'The product has been added to cart.';
        $response_data['content'] = $cartDropDown;
        echo json_encode($response_data);
        exit;
    }

    public function exchnageproduct(Request $request)
    {
        // dd("hello world", $request);
        $response_data = [];

        $user_id = (Session::get(key: 'memeber_id_ss') != '') ? Session::get('memeber_id_ss') : 0;
        $product = Product::where('id', $request->product_id)->firstOrFail();

        $prod_attr = [
            'color' => $request->cartColor,
            'size' => $request->cartSize
        ];

        $data = [
            'new_product_id' => $product->id,
            'product_name' => $product->title,
            'price' => $product->sale_price ? $product->sale_price : $product->regular_price,
            'user_id' => $user_id,
            'item_id' =>  $request->item_id,
            'attribute' => json_encode($prod_attr),
            'status' => "pending",
        ];
        $order_details = DB::table('order_details')
            ->where("item_id", $request->item_id)
            ->update(['status' => "wanttoexchange"]);
        Exchange::create($data);
        dd($data);
    }



    public function cartDropDown()
    {
        $guest_id = $_COOKIE['guest_auth_token'];
        // Update cache  
        Cache::forget($guest_id);
        $data = Cache::remember($guest_id, 24 * 60 * 60, function () {

            $content = '';
            $total_amount = 0;
            $itemCount = 0;
            $guest_id = $_COOKIE['guest_auth_token'];
            $user_id = (Session::get('memeber_id_ss') != '') ? Session::get('memeber_id_ss') : 0;

            $cart = new Cart;
            $delete_url = "'" . route('cart.remove') .  "'";
            $csrf_token = "'" . csrf_token() . "'";

            $cartItems = Cart::where('user_id', $user_id)
                ->orwhere('guest_id', $guest_id)
                ->get();

            if (count($cartItems)) {
                $body_content = '<ul class="shopping-list">';
                foreach ($cartItems as $cartItem) {
                    //$itemCount += $cartItem->quantity;
                    $itemCount++;
                    $total_amount += ($cartItem->quantity * $cartItem->price);
                    $body_content .= '<li>
                            <a href="javascript:void(0)" class="remove"  onClick="deleteCartItem(' . $csrf_token . ', ' . $cartItem->id . ', ' . $delete_url . ');" title="Remove this item"><i class="fa fa-remove"></i></a>
                            <a class="cart-img" href="/product/' . $cartItem->product_slug . '"><img src="' . asset($cartItem->product_image) . '" alt="#"></a>
                            <h4><a href="/product/' . $cartItem->product_slug . '">' . $cartItem->product_title . '</a></h4>
                            <p class="quantity">' . $cartItem->quantity . 'x - <span class="amount">' . moneyFormat($cartItem->price) . '</span></p>
                        </li>';
                }

                $body_content .= '</ul>';

                $top_content = '<a href="' . route('view.cart')  . '" class="single-icon"><i class="ti-bag"></i> <span class="total-count">' . $itemCount  . '</span></a>';
                $top_content .= '<div class="shopping-item">
                    <div class="dropdown-cart-header">
                        <span>' . $itemCount . ' Items</span>
                        <a href="' .  route('view.cart') . '">View Cart</a>
                    </div>';

                $btm_content = '<div class="bottom">
                                <div class="total">
                                    <span>Total</span>
                                    <span class="total-amount">' . moneyFormat($total_amount) . '</span>
                                </div>
                                <a href="' . url('/checkout') . '" class="btn animate">Checkout</a>
                            </div></div>';
                $content = $top_content . $body_content . $btm_content;
            } else {
                $content = '<a href="' . route('view.cart') . '" class="single-icon"><i class="ti-bag"></i> <span class="total-count">' . $itemCount  . '</span></a>';
            }

            return $content;
        });

        return $data;
    }

    /***** Cart Items for Cart Page ***********  */

    public function cartItemsBlock()
    {
        $content = '';
        $total_amount = 0;
        $itemCount = 0;
        $guest_id = $_COOKIE['guest_auth_token'];
        $user_id = (Session::get('memeber_id_ss') != '') ? Session::get('memeber_id_ss') : 0;

        $cart = new Cart;
        $cartItems = Cart::where('user_id', $user_id)
            ->orwhere('guest_id', $guest_id)
            ->get();

        if (count($cartItems)) {
            $update_url = "'" . route('cart.update') .  "'";
            $delete_url = "'" . route('cart.remove') .  "'";
            $csrf_token = "'" . csrf_token() . "'";

            $content .= '<div class="row">
				<div class="col-12">
					<!-- Shopping Summery -->
					<table class="table shopping-summery">
						<thead>
							<tr class="main-hading">
								<th>PRODUCT</th>
								<th>NAME</th>
								<th class="text-center">UNIT PRICE</th>
								<th class="text-center">QUANTITY</th>
								<th class="text-center">TOTAL</th> 
								<th class="text-center"><i class="ti-trash remove-icon"></i></th>
							</tr>
						</thead>
						<tbody>';

            foreach ($cartItems as $cartItem) {
                $prod_attrs = (!empty($cartItem->attributes)) ? json_decode($cartItem->attributes, true) : [];
                $itemCount += $cartItem->quantity;
                $total_amount += ($cartItem->quantity * $cartItem->price);

                $content .= '<tr>
								<td class="image" data-title="No"><img src="' . asset($cartItem->product_image) . '" alt="' . $cartItem->product_title . '"></td>
								<td class="product-des" data-title="Description">
									<p class="product-name"><a href="/product/' . $cartItem->product_slug . '">' . $cartItem->product_title . '</a></p>';
                foreach ($prod_attrs as $key => $value) {
                    $content .= (!empty($value)) ? '<p class="product-des">' . $key . ': ' . $value . '</p>' : '';
                }

                $content .= '</td>
								<td class="price" data-title="Price"><span>' . moneyFormat($cartItem->price) . ' </span></td>
								<td class="qty" data-title="Qty"><!-- Input Order -->
									<div class="input-group">
										<div class="button minus">
											<button type="button" onClick="handleCartInputQuantities(' . $csrf_token . ', ' . $cartItem->id . ', ' . ($cartItem->quantity - 1) . ', ' . $update_url . ');" class="btn btn-primary btn-number" data-type="minus" data-field="quant[' . $cartItem->quantity . ']">
												<i class="ti-minus"></i>
											</button>
										</div>
										<input type="text" name="quant[' . $cartItem->quantity . ']"  disabled="disabled" class="input-number"  data-min="1" data-max="100" value="' . $cartItem->quantity . '">
										<div class="button plus">
											<button type="button" onClick="handleCartInputQuantities(' . $csrf_token . ', ' . $cartItem->id . ', ' . ($cartItem->quantity + 1) . ', ' . $update_url . ');" class="btn btn-primary btn-number" data-type="plus" data-field="quant[' . $cartItem->quantity . ']">
												<i class="ti-plus"></i>
											</button>
										</div>
									</div>
									<!--/ End Input Order -->
								</td>
								<td class="total-amount" data-title="Total"><span>' . moneyFormat(($cartItem->quantity * $cartItem->price)) . '</span></td>
								<td class="action" data-title="Remove"><a href="javascript:void(0)" onClick="deleteCartItem(' . $csrf_token . ', ' . $cartItem->id . ', ' . $delete_url . ');"><i class="ti-trash remove-icon"></i></a></td>
							</tr>';
            }
            $content .= '</tbody>
					</table>
					<!--/ End Shopping Summery -->
				</div>
			</div>';

            $content .= '<div class="row">
				<div class="col-12">
					<!-- Total Amount -->
					<div class="total-amount">
						<div class="row">
							<div class="col-lg-8 col-md-5 col-12">
								<div class="left">
									<div class="coupon">
										<form action="#" target="_blank">
											<input name="Coupon" placeholder="Enter Your Coupon">
											<button class="btn">Apply</button>
										</form>
									</div>
									<div class="checkbox">
										<label class="checkbox-inline" for="2"><input name="news" id="2" type="checkbox"> Shipping (+10$)</label>
									</div>
								</div>
							</div>
							<div class="col-lg-4 col-md-7 col-12">
								<div class="right">
									<ul>';

            $content .= '<li>Cart Subtotal<span>' . moneyFormat($total_amount) . '</span></li>';
            $content .= '<li>Shipping<span>Free</span></li>';
            $content .= '<li>Discount <span> - </span></li>';
            $content .= '<li class="last">Total<span>' . moneyFormat($total_amount) . '</span></li>';
            $content .= '</ul>
									<div class="button5">
										<a href="#" class="btn">Checkout</a>
										<a href="#" class="btn">Continue shopping</a>
									</div>
								</div>
							</div>
						</div>
					</div>
					<!--/ End Total Amount -->
				</div>
			</div>';
        } else {
            $content .= '<div class="row">
				<div class="col-12">
                <p> Cart is empty.</p>
                </div> </div>';
        }

        return $content;
    }
}
