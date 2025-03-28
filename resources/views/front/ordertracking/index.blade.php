@extends('layouts.frontendapp')
@section('content')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-pzjw8f+ua7Kw1TIq0p8FqHlXY2Y9Fz9mJeC5zrU9PSzYZh5Bod4XY10v5uTz8kd7" crossorigin="anonymous">

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-kQmMbDJkLh9ZcZtb2dxC9KHfuB/7Xt0y+vT1iKv1lj9rZXoS5zkLVgBfjR5w6myO" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-VPzHZcbw+rdFE9I9xHD2Dpqcb6+F9D91hbKp1k/mV0yT1xZIjxK6gGSjft3LF9yL" crossorigin="anonymous"></script>

@php
    $pageName = 'Order Detail';
    $showChildFormat = 'yes';
    $site_currency = siteSettings('site_currency');
    $breadcrumbs = [
        ['title' => 'Dashboard', 'link' => '#', 'isActive' => ''],
        ['title' => 'Orders & Reviews', 'link' => '#', 'isActive' => ''],
        ['title' => 'Order Detail', 'link' => '#', 'isActive' => 'active'],
    ];
@endphp



<div class="container my-10 sm:mt-32" id="printableArea">
    {{-- @dd($orders) --}}
    <h1 class="mb-2 text-xl">Tracking Order Details of Order Id : {{ $order_id ?? "" }}</h1>
    @if ($orders)
        
    <div class="card">
        <div class="card-body">
            @if ($message = Session::get('success'))
                <div class="alert alert-success">
                    {{ $message }}
                </div>
            @endif

            <!-- Customer Details Section -->
            <h4 class="card-title">Customer Detail</h4>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <strong>Full Name:</strong> {{ $userdata[0]->name ?? @$shippings[0]->fullname }}
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <strong>Email:</strong> {{ $userdata[0]->email ?? @$shippings[0]->email }}
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <strong>Mobile No.:</strong> {{ $userdata[0]->mobileno ?? @$shippings[0]->mobile }}
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <strong>Gender:</strong> {{ $userdata[0]->gender ?? "-" }}
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <strong>State:</strong> {{ $userdata[0]->statename ?? @$shippings[0]->statename }}
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <strong>District:</strong> {{ $userdata[0]->district ?? @$shippings[0]->district }}
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <strong>Address:</strong> {{ $userdata[0]->address ?? @$shippings[0]->address }}
                    </div>
                </div>
            </div>

            <hr>

            <!-- Order Details Section -->
            <h4 class="card-title">Order Detail</h4>
            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Order ID</th>
                            <th>Order Date</th>
                            <th>Order Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{ $orders[0]->id }}</td>
                            <td>{{ $orders[0]->created_at }}</td>
                            <td><span class="badge bg-{{ strtolower($orders[0]->status) == 'completed' ? 'success' : 'warning' }}">{{ $orders[0]->status }}</span></td>
                        </tr>
                    </tbody>
                </table>

                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Unit Price</th>
                            <th>Quantity</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $totalAmount = 0;
                        @endphp
                        @foreach($orders as $order)
                            <tr>
                                <td><img src="{{ asset($order->product_image) }}" alt="{{ $order->product_name }}" class="img-fluid" width="100"></td>
                                <td>{{ $order->product_name }}</td>
                                <td>{{ moneyFormat($order->price) }}</td>
                                <td class="text-center">{{ $order->total_no_qnty }}</td>
                                <td>{{ moneyFormat($order->total_amt) }}</td>
                            </tr>
                            @php
                                $totalAmount += $order->total_amt;
                            @endphp
                        @endforeach
                        <tr>
                            <td colspan="4" class="text-right"><strong>Total Amount:</strong></td>
                            <td><strong>{{ moneyFormat($totalAmount) }}</strong></td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <hr>

            <!-- Delivery Address Section -->
            <h4 class="card-title">Delivery Address</h4>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <strong>Full Name:</strong> {{ @$shippings[0]->fullname }}
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <strong>Mobile No.:</strong> {{ @$shippings[0]->mobile }}
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <strong>State:</strong> {{ @$shippings[0]->statename }}
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <strong>District:</strong> {{ @$shippings[0]->district }}
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <strong>City:</strong> {{ @$shippings[0]->city }}
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <strong>Address:</strong> {{ @$shippings[0]->address }}
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <strong>Tole:</strong> {{ @$shippings[0]->tole }}
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <strong>House No.:</strong> {{ @$shippings[0]->houseno }}
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <strong>Gaupalika:</strong> {{ @$shippings[0]->gaupalika }}
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <strong>Nagarpalika:</strong> {{ @$shippings[0]->nagarpalika }}
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <strong>Ward No.:</strong> {{ @$shippings[0]->wardno }}
                    </div>
                </div>
            </div>

            <hr>

            <!-- Action Buttons -->
            <div>
          
                <a href="/" class="text-white btn btn-secondary"><i class="fa fa-mail-reply"></i> Back</a>
            </div>

        </div>
    </div>
    @else
    <div class="flex items-center justify-center">
        <div class="p-6 bg-white rounded-lg shadow-lg custom-margin">
          <p class="pl-4 text-2xl font-bold text-red-600 border-l-4 border-red-600">
            No order is available for this tracking ID.
          </p>
        </div>
      </div>
<style>.custom-margin {
    margin: 0; /* Default margin for small screens */
  }
  
  @media (min-width: 1024px) {
    /* Applies margin on screens 1024px and larger */
    .custom-margin {
      margin: 200px;
    }
  }
</style>        
      
    @endif
</div>

{{-- <script>
    function printDiv(divId) {
        var printContents = document.getElementById(divId).innerHTML;
        var originalContents = document.body.innerHTML;
        document.body.innerHTML = printContents;
        window.print();
        document.body.innerHTML = originalContents;
    }
</script> --}}
@endsection
