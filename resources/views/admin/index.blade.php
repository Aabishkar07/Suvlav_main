@extends('layouts.backendapp')

@section('content')

    @php
        $pageName = 'Dashboard';
        $breadcrumbs = [['title' => 'Dashboard', 'link' => '#', 'isActive' => 'Active']];

        //echo '<pre>';
        //print_r($posts);

    @endphp

    <div class="row">

        <!-- Order card start -->
        <div class="col-md-7 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Recent Orders</h4>
                    @if ($orders)
                        <table class="table mb-3 table-bordered table-hover">
                            <thead class="table-light">
                                <tr>
                                    <th> OrderId </th>
                                    <th> Customer Name </th>
                                    <th> Order Date </th>
                                    <th> Status </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($orders as $key => $order)
                                    <tr>
                                        <td>{{ $order->tracking_code ?? $order->id }}</td>
                                        <td>{{ $order->fullname }}</td>
                                        <td>{{ $order->created_at->format('Y/m/d H:i') }}</td>
                                        <td>
                                            @switch($order->status)
                                                @case('canceled')
                                                    <label class="badge badge-danger">{{ strtoupper($order->status) }}</label>
                                                @break

                                                @case('delivered')
                                                    <label class="badge badge-success">{{ strtoupper($order->status) }}</label>
                                                @break

                                                @default
                                                    <label class="badge badge-info">{{ strtoupper($order->status) }}</label>
                                            @endswitch

                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <p class="mb-0 font-weight-light">No Reccent order found.</p>
                    @endif
                    <div class="col float-end">
                        <a href="{{ route('order.index') }}" class="btn btn-inverse-success btn-sm"> VIEW ALL </a>
                    </div>

                </div>
            </div>
        </div>

        <!-- Recent Posts start here  -->
        <div class="col-md-5 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Recent Posts</h4>
                    @if ($posts)
                        @foreach ($posts as $key => $post)
                            <div class="mt-3 mb-2 d-flex align-items-top">
                                @if ($post->image)
                                    <img src=" {{ asset('public/' . $post->image) }}" class="img-lg me-3"
                                        alt="{{ $post->title }}" />
                                @endif
                                <div class="flex-grow mb-0">
                                    <h5 class="mb-2 me-2">{{ $post->title }}</h5>
                                    <div class="d-flex align-items-center text-muted font-weight-light">
                                        <span>{{ $post->created_at->format('F jS Y') }}</span>
                                    </div>
                                    <p class="mb-0 font-weight-light">{{ $post->short_desc }}</p>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <p class="mb-0 font-weight-light">No Reccent post found.</p>
                    @endif
                    <div class="col float-end">
                        <a href="{{ route('post.index') }}" class="btn btn-inverse-success btn-sm"> VIEW ALL </a>
                    </div>

                </div>
            </div>
        </div>

    </div>

@endsection
