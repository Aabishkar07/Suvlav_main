@extends('layouts.frontendapp')
@section('content')

@php 
$total_amount = 0;
@endphp 

	<!-- Shopping Cart -->
	<div class="shopping-cart section">
		<div class="container" id="js_cart_block">
			@if(count($cartItems) > 0 )
			<div class="row">
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
						<tbody>
							@foreach($cartItems as $cartItem)
							@php
							$prod_attrs = (!empty($cartItem->attributes))? json_decode($cartItem->attributes, true) : [];
							$total_amount += ($cartItem->quantity * $cartItem->price);
							@endphp 
							<tr>
								<td class="image" data-title="No"><img src="{{ asset('public'.$cartItem->product_image)}}" alt="#"></td>
								<td class="product-des" data-title="Description">
									<p class="product-name"><a href="/product/{{ $cartItem->product_slug }}">{{ $cartItem->product_title }}</a></p>
									
										@foreach($prod_attrs as $key => $value)
										@if(!empty($value)) <p class="product-des">{{ $key}} : {{$value}}</p> @endif
										
										@endforeach
									
								</td>
								<td class="price" data-title="Price"><span>{{ moneyFormat($cartItem->price) }} </span></td>
								<td class="qty" data-title="Qty"><!-- Input Order -->
									<div class="input-group js_quantity">
										<div class="button minus">
											<button type="button" onClick="handleCartInputQuantities('{{ csrf_token() }}', {{$cartItem->id}}, {{ $cartItem->quantity - 1 }}, '{{ route('cart.update') }}');" class="btn btn-primary btn-number"  data-type="minus" data-field="quant[{{$cartItem->id}}]">
												<i class="ti-minus"></i>
											</button>
										</div>
										<input type="hidden" class="js_qty" value="{{ $cartItem->quantity}}">
										<input type="text" name="quant[{{$cartItem->id}}]" class="input-number" disabled="disabled" data-min="1" data-max="100" value="{{ $cartItem->quantity}}">
										<div class="button plus">
											<button type="button" onClick="handleCartInputQuantities('{{ csrf_token() }}', {{$cartItem->id}}, {{ $cartItem->quantity + 1 }}, '{{ route('cart.update') }}');" class="btn btn-primary btn-number" data-type="plus" data-field="quant[{{$cartItem->id}}]">
												<i class="ti-plus"></i>
											</button>
										</div>
									</div>
									<!--/ End Input Order -->
								</td>
								<td class="total-amount" data-title="Total"><span>{{ moneyFormat($cartItem->price * $cartItem->quantity) }}</span></td>
								<td class="action" data-title="Remove"><a href="javascript:void(0)" onclick="deleteCartItem('{{ csrf_token() }}', {{$cartItem->id}}, '{{ route('cart.remove') }}')"><i class="ti-trash remove-icon"></i></a></td>
							</tr>
							@endforeach
						
						</tbody>
					</table>
					<!--/ End Shopping Summery -->
				</div>
			</div>
			<div class="row">
				<div class="col-12">
					<!-- Total Amount -->
					<div class="total-amount">
						<div class="row">
							<div class="col-lg-8 col-md-5 col-12">
								<!-- <div class="left">
									<div class="coupon">
										<form action="#" target="_blank">
											<input name="Coupon" placeholder="Enter Your Coupon">
											<button class="btn">Apply</button>
										</form>
									</div>
									<div class="checkbox">
										<label class="checkbox-inline" for="2"><input name="news" id="2" type="checkbox"> Shipping (+10$)</label>
									</div>
								</div> -->
							</div>
							<div class="col-lg-4 col-md-7 col-12">
								<div class="right">
									<ul>
										<li>Cart Subtotal<span>{{ moneyFormat($total_amount) }}</span></li>
										<li>Shipping<span>Free</span></li>
										<!-- <li>Discount<span> - </span></li> -->
										<li class="last">You Pay<span>{{ moneyFormat($total_amount) }}</span></li>
									</ul>
									<div class="button5">
										<a href="{{ url('/checkout') }}" class="btn">Checkout</a>
										<a href="{{ url('/')}}" class="btn">Continue shopping</a>
									</div>
								</div>
							</div>
						</div>
					</div>
					<!--/ End Total Amount -->
				</div>
			</div>
			@else
			<div class="row">
				<p> Cart is empty. </p>
			</div>
			@endif 
		</div>
	</div>
	<!--/ End Shopping Cart -->
@endsection
