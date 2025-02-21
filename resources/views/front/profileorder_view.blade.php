@extends('layouts.frontendapp')
@section('content')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-pzjw8f+ua7Kw1TIq0p8FqHlXY2Y9Fz9mJeC5zrU9PSzYZh5Bod4XY10v5uTz8kd7" crossorigin="anonymous">

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"
        integrity="sha384-kQmMbDJkLh9ZcZtb2dxC9KHfuB/7Xt0y+vT1iKv1lj9rZXoS5zkLVgBfjR5w6myO" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
        integrity="sha384-VPzHZcbw+rdFE9I9xHD2Dpqcb6+F9D91hbKp1k/mV0yT1xZIjxK6gGSjft3LF9yL" crossorigin="anonymous">
    </script>

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

    <div class="container my-10 sm:mt-24 " id="printableArea">
        <h1 class="mb-2 text-xl text-center"> Order Details of Order Id : <span class="font-bold text-red-600">
                {{ $order_id }}</span></h1>
        <div class="card">
            <div class=" card-body">
                @if ($message = Session::get('success'))
                    <div class="alert alert-success">
                        {{ $message }}
                    </div>
                @endif

                <!-- Customer Details Section -->
                {{-- <h4 class="underline card-title" style="font-size: 20px;color:green;font-weight: bold;">Customer Detail</h4> --}}
                <div class="text-center text-white rounded card-header bg-success">
                    <h4 class="mb-0" style="font-size: 14px;font-weight: bold;">Customer Details</h4>
                </div>
                <div class="container my-3 row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <strong>Full Name:</strong> {{ $userdata[0]->name }}
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <strong>Email:</strong> {{ $userdata[0]->email }}
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <strong>Mobile No.:</strong> {{ $userdata[0]->mobileno }}
                        </div>
                    </div>
                </div>
                <div class="container row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <strong>Gender:</strong> {{ $userdata[0]->gender }}
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <strong>State:</strong> {{ $userdata[0]->statename }}
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <strong>District:</strong> {{ $userdata[0]->district }}
                        </div>
                    </div>
                </div>
                <div class="container row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <strong>Address:</strong> {{ $userdata[0]->address }}
                        </div>
                    </div>
                </div>

                <hr>

                <!-- Order Details Section -->
                {{-- <h4 class="underline card-title" style="font-size: 20px;color:green;font-weight: bold;">Order Detail</h4> --}}

                <div class="text-center text-white rounded card-header bg-success">
                    <h4 class="mb-0" style="font-size: 14px;font-weight: bold;">Order Details</h4>
                </div>
                <div class="container my-4">
                    <div class="border-0 shadow-sm card">
                        <div class="card-body">
                            <div class="text-center row">
                                <!-- Order ID -->
                                <div class="mb-3 col-lg-3 col-md-4 col-sm-6 col-12">
                                    <p class="mb-1"><strong>Order ID:</strong></p>
                                    <p>{{ $orders[0]->order_id }}</p>
                                </div>
                                <!-- Tracking ID -->
                                <div class="mb-3 col-lg-3 col-md-4 col-sm-6 col-12">
                                    <p class="mb-1"><strong>Tracking ID:</strong></p>
                                    <p>{{ $orders[0]->tracking_code }}</p>
                                </div>
                                <!-- Order Date -->
                                <div class="mb-3 col-lg-3 col-md-4 col-sm-6 col-12">
                                    <p class="mb-1"><strong>Order Date:</strong></p>
                                    <p>{{ $orders[0]->created_at }}</p>
                                </div>

                                <!-- Order Status -->
                                <div class="mb-3 col-lg-3 col-md-4 col-sm-6 col-12">
                                    <p class="mb-1"><strong>Order Status:</strong></p>
                                    <span
                                        class="badge text-lg bg-{{ strtolower($orders[0]->order_status) == 'completed' ? 'success' : 'warning' }}">
                                        {{ $orders[0]->order_status }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>



                <div class="mt-5 ">
                    <div class="table-responsive">
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
                                @foreach ($orders as $order)
                                    <tr>
                                        <td><img src="{{ asset('public/' . $order->product_image) }}"
                                                alt="{{ $order->product_name }}" class="img-fluid" width="100"></td>
                                        <td>{{ $order->product_name }}</td>
                                        <td>{{ moneyFormat($order->price) }}</td>
                                        <td class="">{{ $order->quantity }}</td>
                                        <td>{{ moneyFormat($order->price * $order->quantity) }}
                                        </td>
                                        {{-- @dd($orders) --}}
                                        
                                    </tr>
                                    <tr>

                                       <td>
                                        <div class="">
                                            @if ($order->product_status == 'exchanged')
                                                <div class="p-1 text-white bg-blue-500 rounded cursor-pointer">
                                                    Exchanged
                                                </div>
                                            @elseif ($order->product_status == 'wanttoexchange')
                                                <div class="p-1 text-white bg-yellow-600 rounded cursor-pointer">
                                                    Exchange on pending
                                                </div>
                                            @endif
                                        </div>
                                       </td>
                                       <td></td>
                                       <td></td>
                                       <td></td>
                                       <td></td>
                                    </tr>
                                    @php
                                        $totalAmount = $order->total_amt;
                                    @endphp
                                @endforeach
                                <tr>
                                    <td colspan="4" class="text-right"><strong>Total Amount:</strong></td>
                                    <td><strong>{{ moneyFormat($totalAmount) }}</strong></td>
                                </tr>
                                @if ($order->use_point)
                                    <tr>
                                        <td colspan="4" class="text-right"><strong>Point Use :</strong></td>
                                        <td><strong>{{ moneyFormat($order->use_point) }}</strong></td>
                                    </tr>
                                    <tr>
                                        <td colspan="4" class="text-right"><strong>To Be Paid :</strong></td>
                                        <td><strong>{{ moneyFormat($order->total_amt - $order->use_point) }}</strong></td>

                                    </tr>
                                @endif


                            </tbody>
                        </table>
                    </div>
                </div>


                <hr>

                <!-- Delivery Address Section -->
                <div class="my-4 text-center text-white rounded card-header bg-success">
                    <h4 class="mb-0" style="font-size: 14px;font-weight: bold;">Delivery Address </h4>
                </div>
                <div class="container row ">
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
                <div class="container row">
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

                <div class="container row">
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

                <div class="container row">
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
                <div class="mt-5">

                    <a href="{{ route('member.myprofile') }}" class="text-white btn btn-secondary"><i
                            class="fa fa-mail-reply"></i> Back</a>
                </div>

            </div>
        </div>
    </div>
@endsection
