@extends('layouts.backendapp')

@section('content')
    @php
        // Configure this page
        $pageName = 'Report';
        $showChildFormat = 'yes';
        $post_per_page = siteSettings('posts_per_page');
        $site_currency = siteSettings('site_currency');

        $breadcrumbs = [
            ['title' => 'Dashboard', 'link' => '#', 'isActive' => ''],
            ['title' => 'Report', 'link' => '#', 'isActive' => ''],
            ['title' => 'Customer Report', 'link' => '#', 'isActive' => 'active'],
        ];

        $start = isset($request->page) && !empty($request->page) ? ($request->page - 1) * $post_per_page + 1 : 1;

    @endphp

    <div class="px-4">

        <div class="">
            <label>Customer Report</label>
            <div class="gap-5 py-4 d-flex">

                <div style="width:210px;" class="">

                    <form method="GET">
                        <select name="customer" onchange="this.form.submit()" class="text-black form-select"
                            aria-label="Default select example">
                            <option disabled value="" {{ request()->customer ? '' : 'selected' }}>Select the customer
                            </option>
                            @foreach ($userdatas as $user)
                                <option {{ request()->customer == $user->id ? 'selected' : '' }}
                                    value="{{ $user->id }}">
                                    {{ $user->name }}</option>
                            @endforeach
                        </select>
                    </form>
                </div>

                @if (request()->customer)
                    <div style="width:300px;" class="">
                        <form method="GET">
                            <input type="hidden" name="customer" value="{{ request()->customer }}" />
                            <select name="product" onchange="this.form.submit()" class="text-black form-select"
                                aria-label="Default select example">
                                <option disabled {{ request()->product ? '' : 'selected' }} value="">Select the products
                                </option>

                                @foreach ($products as $pdata)
                                    <option class="" {{ request('product') == $pdata->product_id ? 'selected' : '' }}
                                        value="{{ $pdata->product_id }}">{{ $pdata->product_name }}</option>
                                @endforeach
                            </select>
                        </form>
                    </div>
                @endif
            </div>
        </div>

        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Order ID</th>
                    <th scope="col">Product Name</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Price</th>
                    <th scope="col">Order Date</th>
                    {{-- <th scope="col">Delivered Date</th> --}}
                </tr>
            </thead>
            <tbody>

                @foreach ($orders as $key => $order)
                    {{-- @dd($order) --}}
                    <tr>
                        <th scope="row">{{ $key + 1 }}</th>
                        <th scope="row">{{ $order->order_id }}</th>
                        <td>{{ $order->product_name }}</td>
                        <td>{{ $order->quantity }}</td>
                        <td>{{ $order->quantity * $order->price }}</td>
                        <td>{{ $order->created_at }}</td>
                        {{-- <td>{{ $order->product_name }}</td> --}}
                    </tr>
                @endforeach

            </tbody>
        </table>
        @if (count($orders) > 0)
            <div class="row ">
                <div class="card">
                    <div class="">
                        {{ $orders->appends(request()->query())->links() }}
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection
