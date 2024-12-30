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
            <div class="">

                <form method="GET">


                    <div class="flex-wrap w-full gap-3 d-flex align-items-center">
                        <!-- Product Dropdown -->
                        <div class="w-auto">
                            <label class="text-sm text-gray-600 form-label">Choose Product</label>
                            <select name="product" class="form-select">
                                <option disabled value="" {{ request()->product ? '' : 'selected' }}>Select the Product
                                </option>
                                @foreach ($products as $product)
                                    <option {{ request()->product == $product->id ? 'selected' : '' }}
                                        value="{{ $product->id }}">
                                        {{ $product->title }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- From Date Picker -->
                        <div class="w-auto">
                            <label class="text-sm text-gray-600 form-label">From</label>
                            <input id="datepicker-from" name="from" class="form-control" type="date"
                                value="{{ old('form',request()->from) }}" placeholder="YYYY-MM-DD" required>
                        </div>

                        <!-- To Date Picker -->
                        <div class="w-auto">
                            <label class="text-sm text-gray-600 form-label">To</label>
                            <input id="datepicker-to" name="to" class="form-control" type="date"
                                value="{{ old('to',request()->to) }}" placeholder="YYYY-MM-DD" required>
                        </div>

                        <!-- Filter Button -->
                        <div>
                            <button class="gap-2 btn btn-primary d-flex align-items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-filter"
                                    width="20" height="20" viewBox="0 0 24 24" stroke-width="1.5" stroke="#fff"
                                    fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <path
                                        d="M4 4h16v2.172a2 2 0 0 1 -.586 1.414l-4.414 4.414v7l-6 2v-8.5l-4.48 -4.928a2 2 0 0 1 -.52 -1.345v-2.227z">
                                    </path>
                                </svg>
                                <span>Filter</span>
                            </button>
                        </div>
                    </div>
                    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

                    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
                    <script>
                        flatpickr("#datepicker-from, #datepicker-to", {
                            // dateFormat: "Y-m-d",
                        });
                    </script>



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
