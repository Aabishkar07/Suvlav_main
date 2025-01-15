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
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>


    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
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

                <div class="">
                    <form method="GET">


                        <div class="flex-wrap w-full gap-3 d-flex align-items-center">
                            <!-- Product Dropdown -->
                            <div class="w-auto">
                                <div class="pt-2 form-group row">
                                    <label for="statusInput" class="text-sm text-gray-600 form-label">Status</label>
                                    <div class="">
                                        <select class="form-select" name="status" id="">
                                            <option value="">
                                                Choose Status
                                            </option>
                                            <option {{ request()->status == 'Pending' ? 'selected' : '' }} value="Pending">
                                                Pending
                                            </option>
                                            <option {{ request()->status == 'Ongoing' ? 'selected' : '' }} value="Ongoing">
                                                Ongoing
                                            </option>
                                            <option {{ request()->status == 'Delevered' ? 'selected' : '' }} value="Delevered">
                                                Delevered</option>
                                            <option {{ request()->status == 'Cancel' ? 'selected' : '' }} value="Cancel">
                                                Canceled
                                            </option>
                                        </select>

                                    </div>
                                </div>
                            </div>

                            <!-- From Date Picker -->
                            <div class="w-auto">
                                <label class="text-sm text-gray-600 form-label">From</label>
                                <input id="datepicker-from" name="from" class="form-control" type="date"
                                    value="{{ old('form', request()->from) }}" placeholder="YYYY-MM-DD" required>
                            </div>

                            <!-- To Date Picker -->
                            <div class="w-auto">
                                <label class="text-sm text-gray-600 form-label">To</label>
                                <input id="datepicker-to" name="to" class="form-control" type="date"
                                    value="{{ old('to', request()->to) }}" placeholder="YYYY-MM-DD" required>
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
                </div>
                <table class="table table-bordered table-hover">
                    <thead class="table-light">
                        <tr>
                            <th> # </th>
                            <th> OrderId </th>
                            <th> Tracking Id </th>
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
                                    <td>{{ $order->tracking_code }}</td>
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
                                        <button type="button" class="rounded btn-success" data-toggle="modal"
                                            data-target="#exampleModal{{ $key }}">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="20"
                                                height="20" color="#ffffff" fill="none">
                                                <path
                                                    d="M16.4249 4.60509L17.4149 3.6151C18.2351 2.79497 19.5648 2.79497 20.3849 3.6151C21.205 4.43524 21.205 5.76493 20.3849 6.58507L19.3949 7.57506M16.4249 4.60509L9.76558 11.2644C9.25807 11.772 8.89804 12.4078 8.72397 13.1041L8 16L10.8959 15.276C11.5922 15.102 12.228 14.7419 12.7356 14.2344L19.3949 7.57506M16.4249 4.60509L19.3949 7.57506"
                                                    stroke="currentColor" stroke-width="1.5" stroke-linejoin="round" />
                                                <path
                                                    d="M18.9999 13.5C18.9999 16.7875 18.9999 18.4312 18.092 19.5376C17.9258 19.7401 17.7401 19.9258 17.5375 20.092C16.4312 21 14.7874 21 11.4999 21H11C7.22876 21 5.34316 21 4.17159 19.8284C3.00003 18.6569 3 16.7712 3 13V12.5C3 9.21252 3 7.56879 3.90794 6.46244C4.07417 6.2599 4.2599 6.07417 4.46244 5.90794C5.56879 5 7.21252 5 10.5 5"
                                                    stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                                    stroke-linejoin="round" />
                                            </svg>
                                        </button>

                                        <!-- Modal -->
                                        <div class="modal fade" id="exampleModal{{ $key }}" tabindex="-1"
                                            role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Change Status of
                                                            Order Id : {{ $order->id }}</h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">



                                                        <form action="{{ route('order.update', $order->id) }}"
                                                            method="POST" enctype="multipart/form-data"
                                                            class="forms-sample">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="px-5">
                                                                <div class="">
                                                                    <div class="">
                                                                        <div class="form-group row">
                                                                            <label for="statusInput"
                                                                                class="col-sm-3 col-form-label">Status</label>
                                                                            <div class="col-sm-9">
                                                                                <select class="form-select" name="status"
                                                                                    id="statusInput">
                                                                                    <option value="Pending"
                                                                                        @if ($order->status == 'Pending') {{ 'selected' }} @endif>
                                                                                        Pending
                                                                                    </option>
                                                                                    <option value="Ongoing"
                                                                                        @if ($order->status == 'Ongoing') {{ 'selected' }} @endif>
                                                                                        Ongoing
                                                                                    </option>
                                                                                    <option value="Delevered"
                                                                                        @if ($order->status == 'Delevered') {{ 'selected' }} @endif>
                                                                                        Delevered</option>
                                                                                    <option value="Cancel"
                                                                                        @if ($order->status == 'Cancel') {{ 'selected' }} @endif>
                                                                                        Canceled
                                                                                    </option>
                                                                                </select>
                                                                                @error('status')
                                                                                    <span> {{ $message }} </span>
                                                                                @enderror
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-dismiss="modal">Close</button>
                                                                <button type="submit"
                                                                    class="btn btn-info sfw">Update</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

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
