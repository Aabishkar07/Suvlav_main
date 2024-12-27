@extends('layouts.backendapp')

@section('content')

    @php
        $pageName = 'Dashboard';
        $breadcrumbs = [['title' => 'Dashboard', 'link' => '#', 'isActive' => 'Active']];

        //echo '<pre>';
        //print_r($posts);

    @endphp

    <div class="row px-5">

        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 px-3 g-2 mb-4">
            <!-- Total Services -->
            <div class="col">
                <a style="text-decoration: none" href="{{ route('product.index') }}">
                <div class="card shadow-sm border-0 p-3 h-100 transition-shadow hover-shadow-lg">
                    <div class="d-flex justify-content-between align-items-start">
                        <div class="d-flex flex-column">
                            <span>Total Products</span>
                            <span class="h5 fw-bold">{{ $totalproducts }}</span>
                        </div>
                        <svg class="w-25 h-25 text-dark" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M5 4h1.5L9 16m0 0h8m-8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm-8.5-3h9.3L19 7h-1M8 7h-.7M13 5v4m-2-2h4" />
                        </svg>
                    </div>
                </div>
                </a>
            </div>
        
            <!-- Total Blogs -->
            <div class="col">
                <a style="text-decoration: none" href="{{ route('order.index') }}">
                <div class="card shadow-sm border-0 p-3 h-100 transition-shadow hover-shadow-lg">

                    <div class="d-flex justify-content-between align-items-start">
                        <div class="d-flex flex-column">
                            <span>Total Order</span>
                            <span class="h5 fw-bold">{{ $totalorder }}</span>
                        </div>
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon w-25 h-25 text-dark" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M8 21h8a5 5 0 0 0 5 -5v-3a3 3 0 0 0 -3 -3h-1v-2a5 5 0 0 0 -5 -5h-4a5 5 0 0 0 -5 5v8a5 5 0 0 0 5 5z" />
                            <path d="M7 7m0 1.5a1.5 1.5 0 0 1 1.5 -1.5h3a1.5 1.5 0 0 1 1.5 1.5v0a1.5 1.5 0 0 1 -1.5 1.5h-3a1.5 1.5 0 0 1 -1.5 -1.5z" />
                            <path d="M7 14m0 1.5a1.5 1.5 0 0 1 1.5 -1.5h7a1.5 1.5 0 0 1 1.5 1.5v0a1.5 1.5 0 0 1 -1.5 1.5h-7a1.5 1.5 0 0 1 -1.5 -1.5z" />
                        </svg>
                    </div>
                </div>
                </a>
            </div>
        
            <!-- Total Contacts -->
            <div class="col">
                <a style="text-decoration: none" href="{{ route('order.index') }}">

                <div class="card shadow-sm border-0 p-3 h-100 transition-shadow hover-shadow-lg">
                    <div class="d-flex justify-content-between align-items-start">
                        <div class="d-flex flex-column">
                            <span>Pending  Orders</span>
                            <span class="h5 fw-bold">{{ $pendingorders }}</span>
                        </div>
                        <svg class="w-25 h-25 text-dark" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                            <path fill-rule="evenodd"
                                d="M8 4a4 4 0 1 0 0 8 4 4 0 0 0 0-8Zm-2 9a4 4 0 0 0-4 4v1c0 1.1.9 2 2 2h8a2 2 0 0 0 2-2v-1a4 4 0 0 0-4-4H6Zm7.3-2a6 6 0 0 0 0-6A4 4 0 0 1 20 8a4 4 0 0 1-6.7 3Zm2.2 9a4 4 0 0 0 .5-2v-1a6 6 0 0 0-1.5-4H18a4 4 0 0 1 4 4v1a2 2 0 0 1-2 2h-4.5Z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                </div>
                </a>
            </div>
        
            <!-- Additional Card -->
            <div class="col">
                <a style="text-decoration: none" href="{{ route('member.index') }}">

                <div class="card shadow-sm border-0 p-3 h-100 transition-shadow hover-shadow-lg">
                    <div class="d-flex justify-content-between align-items-start">
                        <div class="d-flex flex-column">
                            <span>Total Users</span>
                            <span class="h5 fw-bold">{{ $totalmembers }}</span>
                        </div>
                        <svg class="w-25 h-25 text-dark" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                            <path fill-rule="evenodd"
                                d="M8 4a4 4 0 1 0 0 8 4 4 0 0 0 0-8Zm-2 9a4 4 0 0 0-4 4v1c0 1.1.9 2 2 2h8a2 2 0 0 0 2-2v-1a4 4 0 0 0-4-4H6Zm7.3-2a6 6 0 0 0 0-6A4 4 0 0 1 20 8a4 4 0 0 1-6.7 3Zm2.2 9a4 4 0 0 0 .5-2v-1a6 6 0 0 0-1.5-4H18a4 4 0 0 1 4 4v1a2 2 0 0 1-2 2h-4.5Z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                </div>
                </a>
            </div>
        </div>
        
        

        
        <!-- Order card start -->
        <div class="col-md-7 grid-margin stretch-card ">
            <div class="card">
                <div class="card-body" >
                    <h4 class="card-title text-white" style="background-color: black">Recent Orders</h4>
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
                        <a href="{{ route('order.index') }}" class="btn btn-inverse-success btn-sm bg-black text-white"> VIEW ALL </a>
                    </div>

                </div>
            </div>
        </div>

        <!-- Recent Posts start here  -->
        <div class="col-md-5 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title text-white" style="background-color: black">Recent Posts</h4>
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
                        <a href="{{ route('post.index') }}" class="btn btn-inverse-success btn-sm bg-black text-white"> VIEW ALL </a>
                    </div>

                </div>
            </div>
        </div>

    </div>

@endsection
