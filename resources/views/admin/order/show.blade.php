@extends('layouts.backendapp')

@section('content')

@php
// Configure this page 
$pageName = 'Order Detail';
$showChildFormat = 'yes';
$site_currency = siteSettings('site_currency'); 

$breadcrumbs = [
    ['title' => 'Dashboard', 'link' => '#', 'isActive' => ''],
    ['title' => 'Orders & Reviews', 'link' => '#', 'isActive' => ''],
    ['title' => 'Order Detail', 'link' => '#', 'isActive' => 'active'],
];


$start = (isset($request->page) && !empty($request->page))? (($request->page -1 ) * $post_per_page )+ 1 : 1

@endphp
<div class="col-lg-12 grid-margin stretch-card px-5" id="printableArea">
      <div class="card">
        <div class="card-body">

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            {{ $message }}
        </div>     
    @endif 



      <h4 class="card-title">Customer Detail </h4>   

      
      <div id="Profile" class="tabcontent">
				
									<div class="row">
										<div class="col-lg-4 col-md-4 col-12">
											<div class="form-group">
												<span>Full Name</span> &nbsp; : &nbsp; {{ $userdata[0]->name;}}
											</div>
										</div>
										<div class="col-lg-4 col-md-4 col-12">
											<div class="form-group">
											<span>Email</span>&nbsp; : &nbsp; {{ $userdata[0]->email;}}
											</div>
										</div>

										<div class="col-lg-4 col-md-4 col-12">
											<div class="form-group">
											<span>Mobile No.</span>&nbsp; : &nbsp; {{ $userdata[0]->mobileno;}}
											</div>
										</div>
									</div>

									<div class="row">
									
									<div class="col-lg-4 col-md-4 col-12">
											<div class="form-group">
											<span>Gender</span>&nbsp; : &nbsp; {{ $userdata[0]->gender;}}
											</div>
										</div>
									
									<div class="col-lg-4 col-md-4 col-12">
											<div class="form-group">
											<span>State</span>&nbsp; : &nbsp; {{ $userdata[0]->statename;}}
											</div>
										</div>
										<div class="col-lg-4 col-md-4 col-12">
											<div class="form-group">
											<span>District</span> &nbsp; : &nbsp; {{ $userdata[0]->district;}}
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-lg-8 col-md-8 col-12">
											<div class="form-group">
											<span>Address.</span> &nbsp; : &nbsp; {{ $userdata[0]->address;}}
											</div>
										</div>
									</div>


						</div>

      <!-- Tab content -->
      <p> &nbsp; </p>
      <h4 class="card-title">Order Detail </h4> 
      <div id="order_history" class="tabcontent">
							<div class="row">
									<div class="col-12">
										<!-- Shopping Summery -->
                    <table class="table shopping-order">
                      <tr>
                      <th>Order ID : {{ $orders[0]->id;}} </th>
                      <th>Order Date : {{ $orders[0]->created_at;}}</th>
                      <th>Order Status : {{ $orders[0]->status;}}</th>
                    </tr>
                    </table>
                    <br>
										<table class="table shopping-summery">
											<thead>
												<tr class="main-hading">
												
													<th>Image</th>
													<th>Name</th>
													<th>Unit Price</th>
													<th>Quantity</th>
													<th>Total</th> 
													
												
												</tr>
											</thead>
											<tbody>	
											<?php 
												$sn =1;
												$tamunt = 0;
											 	foreach($orders as $order) {
													$cdate = explode(' ',$order->created_at);
											    ?>	
												<tr>
													
													<td class="image" data-title="No"><img src="{{ asset($order->product_image)}}"></td>
													<td class="product-des" data-title="Description">{{ $order->product_name }}</td>
													<td class="price"><span>{{ moneyFormat($order->price)}} </span></td>
													<td class="text-center qty">{{ $order->total_no_qnty }}</td>
													<td class="total-amount" data-title="Total"><span>{{ moneyFormat($order->total_amt);}}</span></td>
													
												</tr>
												<?php 
												$tamunt = $tamunt + $order->total_amt;
												$sn++; } ?>
												<tr>
													<td colspan="3">&nbsp; </td>
													<td>&nbsp;Total Amount :</td>
													<td class="total-amount"  data-title="Total"><b>{{ moneyFormat($tamunt);}}</b></td>
												</tr>
											</tbody>
										</table>
										<!--/ End Shopping Summery -->
									</div>
								</div>
							</div>

							
							
				

						<!-- Start  delivery Addresss form -->
            <p> &nbsp; </p>
            <h4 class="card-title">Delevery Address </h4> 
						<div id="deladdress" class="tabcontent">

									<div class="row">
										<div class="col-lg-4 col-md-4 col-12">
											<div class="form-group">
											<span>Full Name</span> &nbsp; : &nbsp; {{ @$shippings[0]->fullname;}}
											</div>
										</div>
										<!-- <div class="col-lg-4 col-md-4 col-12">
											<div class="form-group">
											<span>Email</span> &nbsp; : &nbsp; {{ @$shippings[0]->email;}}
											</div>
										</div> -->

										<div class="col-lg-4 col-md-4 col-12">
											<div class="form-group">
											<span>Mobile No.</span> &nbsp; : &nbsp; {{ @$shippings[0]->mobile;}}
											</div>
										</div>
										<div class="col-lg-4 col-md-4 col-12">
											<div class="form-group">
											<span>State</span>&nbsp; : &nbsp; {{ @$shippings[0]->statename;}}
											</div>
										</div>
									</div>

									<div class="row">
									
										<div class="col-lg-4 col-md-4 col-12">
											<div class="form-group">
											<span>District</span> &nbsp; : &nbsp; {{ @$shippings[0]->district;}}
											</div>
										</div>
										<div class="col-lg-4 col-md-4 col-12">
											<div class="form-group">
											<span>City</span> &nbsp; : &nbsp; {{ @$shippings[0]->city;}}
											</div>
										</div>
										<div class="col-lg-4 col-md-4 col-12">
											<div class="form-group">
											<span>Address.</span> &nbsp; : &nbsp; {{ @$shippings[0]->address;}}
											</div>
									</div>

										
									</div>
								<div class="row">
									

									<div class="col-lg-4 col-md-4 col-12">
											<div class="form-group">
											<span>Tole.</span> &nbsp; : &nbsp; {{ @$shippings[0]->tole;}}
											</div>
									</div>

									<div class="col-lg-4 col-md-4 col-12">
											<div class="form-group">
											<span>House No.</span> &nbsp; : &nbsp; {{ @$shippings[0]->houseno;}}
											</div>
									</div>
									
									
									
									<div class="col-lg-4 col-md-4 col-12">
										<div class="form-group">
										<span>Gaupalika</span> &nbsp; : &nbsp; {{ @$shippings[0]->gaupalika;}}
										</div>
								</div>

	<div class="col-lg-4 col-md-4 col-12">
									<div class="form-group">
									<span>Nagarpalika</span> &nbsp; : &nbsp; {{ @$shippings[0]->nagarpalika;}}
									</div>
							</div>
							
								<div class="col-lg-4 col-md-4 col-12">
								<div class="form-group">
								<span>Ward No.</span> &nbsp; : &nbsp; {{ @$shippings[0]->wardno;}}
								</div>
						</div>
									
								</div>

								
						</div>

      <div>
      <p> &nbsp; </p>
        <a href="{{ route('order.edit', $order->id)}}" class="btn btn-info sfw"> UPDATE </a>
        <a href="{{route('order.index')}}" class="btn btn-info sfw" ><i class="fa fa-mail-reply"></i> BACK </a>
        <button class="btn btn-dark btn-lg" onclick="printDiv('printableArea')">Print</button>
      </div>
      
      
  
      </div>
    </div>
    
</div>

<script>
        function printDiv(divId) {
            var printContents = document.getElementById(divId).innerHTML;
            var originalContents = document.body.innerHTML;

            document.body.innerHTML = printContents;

            window.print();

            document.body.innerHTML = originalContents;
       }
    </script>
@endsection