@extends('layouts.backendapp')

@section('content')

    @php
        // Configure this page
        $pageName = 'Orders';
        $showChildFormat = 'yes';
        $post_per_page = siteSettings('posts_per_page');
        $site_currency = siteSettings('site_currency');

        $breadcrumbs = [
            ['title' => 'Dashboard', 'link' => '#', 'isActive' => ''],
            ['title' => 'Orders & Reviews', 'link' => '#', 'isActive' => ''],
            ['title' => 'Orders', 'link' => '#', 'isActive' => 'active'],
        ];

        $start = isset($request->page) && !empty($request->page) ? ($request->page - 1) * $post_per_page + 1 : 1;

    @endphp

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            {{ $message }}
        </div>
    @endif

    <div class="px-5 col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">

                <div class="row margin-bottom-30">
                    <form method="get" class="forms-sample deceased-search">
                        <input type="hidden" name="search" value="search">
                        <div class="form-group row">
                            <div class="col-sm-4"> </div>
                            <div class="col-sm-5">
                                <input type="text" name= "tracking_code" class="form-control" id="searchName"
                                    value="{{ $request->tracking_code }}" placeholder="Search by OrderId..">
                            </div>
                            <div class="col-sm-3">
                                <button class="btn btn-info sfw btn-sm btn_search" type="submit"><i
                                        class="fa fa-search"></i> Search</button>
                                <a href="{{ route('order.index') }}" class="btn btn-info sfw btn-sm"><i
                                        class="fa fa-mail-reply"></i> Reset </a>
                            </div>
                        </div>

                    </form>
                </div>
                <table class="table table-bordered table-hover">
                    <thead class="table-light">
                        <tr>
                            <th> # </th>
                            <th> OrderId </th>
                            <th> Customer Name </th>
                            <th> Mobile </th>
                            <th> Amount </th>
                            <th> Status </th>
                            <th> Order Date </th>

                            <th> Action </th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php $GLOBALS['counter'] = $start; ?>
                        @if (count($orders) > 0)
                            @foreach ($orders as $key => $order)
                                <tr>
                                    <td>{{ $GLOBALS['counter']++ }}</td>
                                    <td>{{ $order->id }}</td>
                                    <td>{{ $order->fullname }}</td>

                                    <td>{{ $order->mobile }}</td>
                                    <td>
                                        <div class="">
                                            <div class="">
                                                <label>
                                                    Total :
                                                </label>
                                                Rs. {{ $order->total_amt }}
                                            </div>
                                            @if ($order->use_point)
                                                <div class="mt-2">
                                                    <label>Point Use : </label>
                                                    Rs. {{ $order->use_point }}
                                                </div>
                                                <hr />
                                                <div class="">
                                                    To Be Receive : <span style="font-weight: bold" class="text-danger">Rs.
                                                        {{ $order->total_amt - $order->use_point }}
                                                    </span>
                                                </div>
                                            @endif
                                        </div>
                                    </td>

                                    <td>
                                        @switch($order->status)
                                            @case('Pending')
                                                <label class="badge bg-warning">{{ strtoupper($order->status) }}</label>
                                            @break

                                            @case('Ongoing')
                                                <label class="badge badge-info">{{ strtoupper($order->status) }}</label>
                                            @break

                                            @case('Cancel')
                                                <label class="badge badge-danger">{{ strtoupper($order->status) }}</label>
                                            @break

                                            @case('Delevered')
                                                <label class="badge badge-success">{{ strtoupper($order->status) }}</label>
                                            @break

                                            @default
                                                <label class="badge badge-info">{{ strtoupper($order->status) }}</label>
                                        @endswitch

                                    </td>
                                    <td>{{ $order->created_at->format('Y/m/d H:i') }}</td>

                                    <td><a href="<?php echo url('admin/order/showdetails/' . $order->id); ?>" class="btn btn-success btn-sm"><i
                                                class="fa fa-eye"></i> </a>
                                        <a href="{{ route('order.edit', $order->id) }}" class="btn btn-success btn-sm"><i
                                                class="fa fa-edit"></i> </a>
                                    </td>

                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="8">
                                    <p class="text-danger">No record found!</p>
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>

                <div class="row margin-top-30">
                    <div class="card">
                        <div class="card-body">
                            {{ $orders->appends(request()->query())->links() }}
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>


@endsection
