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
            ['title' => 'Product Report', 'link' => '#', 'isActive' => 'active'],
        ];

        $start = isset($request->page) && !empty($request->page) ? ($request->page - 1) * $post_per_page + 1 : 1;

    @endphp
    <div class="px-4">
        <div class="py-4 ">
            <div style="width:210px;" class="">

                <form method="GET">
                    <label class="py-1 ">Choose Product</label>
                    <select name="product" onchange="this.form.submit()" class="text-black form-select"
                        aria-label="Default select example">
                        <option disabled value="" {{ request()->product ? '' : 'selected' }}>Select the Product
                        </option>
                        @foreach ($products as $product)
                            <option {{ request()->product == $product->id ? 'selected' : '' }} value="{{ $product->id }}">
                                {{ $product->title }}</option>
                        @endforeach
                    </select>
                </form>
                @if ($myproduct)
                    <div class="py-2">
                        <label style="font-size: 18px;color:black;font-weight: bolder" class="">
                            Availble Stock
                        </label>
                        =
                        <label style="font-size: 18px;">

                            {{ $myproduct->availablestock ?? 0 }}
                        </label>
                    </div>
                @endif
            </div>
        </div>
        {{-- @dd($customers) --}}

        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Order Id</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Total Price</th>
                    <th scope="col">Order Date</th>
                </tr>
            </thead>
            <tbody>
                <div class="py-4">
                    <span style="font-size: 22px;color: blue">Customer List : </span>
                </div>
                @foreach ($customers as $key => $customer)
                    <tr>
                        <th scope="row">{{ $key + 1 }}</th>
                        <td>{{ $customer->fullname }}</td>
                        <td>{{ $customer->email }}</td>
                        <td>{{ $customer->order_id }}</td>
                        <td>{{ $customer->quantity }}</td>
                        <td>{{ $customer->quantity * $customer->price }}</td>
                        <td>{{ $customer->created_at ? \Carbon\Carbon::parse($customer->created_at)->format('Y-m-d') : 'N/A' }}
                        </td>


                    </tr>
                @endforeach

            </tbody>
        </table>
        @if (count($customers) > 0)
            <div class="row ">
                <div class="card">
                    <div class="">
                        {{ $customers->appends(request()->query())->links() }}
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection
