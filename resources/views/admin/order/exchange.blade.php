@extends('layouts.backendapp')

@section('content')

    @php
        // Configure this page
        $pageName = 'Exchange ';
        $showChildFormat = 'yes';
        $post_per_page = siteSettings('posts_per_page');
        $site_currency = siteSettings('site_currency');

        $breadcrumbs = [
            ['title' => 'Dashboard', 'link' => '#', 'isActive' => ''],
            ['title' => 'Exchange ', 'link' => '#', 'isActive' => ''],
            // ['title' => 'Orders', 'link' => '#', 'isActive' => 'active'],
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



        <div class="">
            <div class="">



                <table class="table table-bordered table-hover">
                    <thead class="table-light">
                        <tr>
                            <th> # </th>
                            <th> OrderId </th>
                            <th> Product Name </th>
                            <th> Customer Name </th>
                            <th> Mobile </th>
                            <th> Amount </th>
                            <th> Status </th>
                            <th> Order Date </th>

                            <th> Action </th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- @dd($orders) --}}

                        <?php $GLOBALS['counter'] = $start; ?>
                        @if (count($orders) > 0)
                            @foreach ($orders as $key => $order)
                                {{-- @dd($order); --}}
                                <tr>
                                    <td>{{ $GLOBALS['counter']++ }}</td>
                                    <td>{{ $order->myorder_id }}</td>
                                    <td>{{ $order->old_product_name }}</td>
                                    <td>{{ $order->name }}</td>

                                    <td>{{ $order->mobile }}</td>
                                    <td>
                                        <div class="">
                                            <div class="">

                                                Rs. {{ $order->old_price }}
                                            </div>

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
                                                            Order Id : {{ $order->myorder_id }}</h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">


                                                        <form action="{{ route('exchangestatus', $order->item_id) }}"
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

                                                                                    <option value="Wanttoexchange"
                                                                                        @if ($order->status == 'Wanttoexchange') {{ 'selected' }} @endif>
                                                                                        Want-to-exchange
                                                                                    </option>
                                                                                    <option value="exchanged"
                                                                                        @if ($order->status == 'exchanged') {{ 'selected' }} @endif>
                                                                                        Exchange
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
                                        {{-- @dd($order) --}}
                                        </br>
                                        <div class="pt-1">

                                            <label class="badge badge-info">{{ strtoupper($order->order_status) }}</label>

                                        </div>

                                    </td>
                                    <td>{{ $order->created_at }}</td>

                                    <td>
                                        <div data-toggle="modal" data-target="#exampleModal2{{ $key }}"
                                            class="btn btn-success btn-sm"><i class="fa fa-eye"></i> </div>
                                        {{-- <a href="<?php echo url('admin/order/showdetails/' . $order->id); ?>" class="btn btn-success btn-sm"><i
                                                class="fa fa-eye"></i> </a> --}}
                                        {{-- <a href="{{ route('order.edit', $order->id) }}" class="btn btn-success btn-sm"><i
                                                class="fa fa-edit"></i> </a> --}}
                                    </td>
                                    {{-- @dd($order) --}}

                                    <!-- Modal -->
                                    <div class="modal fade" id="exampleModal2{{ $key }}" tabindex="-1"
                                        role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">
                                                        Order Id : {{ $order->myorder_id }}</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">

                                                    <div class="px-5">
                                                        <div class="">
                                                            <div class="">
                                                                <div class="form-group row">
                                                                    {{-- <label for="statusInput"
                                                                        style="font-weight: bold;font-size:20px;color:green;text-decoration: underline"
                                                                        class="col-form-label">Reason to
                                                                        {{ $order->order_status }}</label> --}}
                                                                    <div class="">

                                                                        <div class="py-2 font-weight-bold">Wants to
                                                                            Exchange

                                                                            <span
                                                                                class="text-primary">{{ $order->old_product_name }}</span>
                                                                            with
                                                                            <span
                                                                                class="text-success">{{ $order->product_name }}</span>?
                                                                        </div>
                                                                        @php
                                                                            $oldprice =
                                                                                $order->old_quantity *
                                                                                $order->old_price;
                                                                        @endphp
                                                                        <div class="p-3 border rounded bg-light">
                                                                            <p><strong>{{ $order->old_product_name }}
                                                                                    Product
                                                                                    Price:</strong>
                                                                                Rs. {{ $oldprice }} <span
                                                                                    style="font-weight: bold;">(Qty-{{ $order->old_quantity }})</span>
                                                                            </p>

                                                                            <p><strong>Exchange Product Price:
                                                                                    ({{ $order->product_name }})
                                                                                </strong>

                                                                                Rs. {{ $order->price }}
                                                                                @php
                                                                                    $attributes = json_decode(
                                                                                        $order->attribute,
                                                                                        true,
                                                                                    ); // Decode as an associative array
                                                                                @endphp

                                                                                @if (!empty($attributes))
                                                                                    <ul>
                                                                                        @foreach ($attributes as $key => $value)
                                                                                            <li><strong>{{ ucfirst($key) }}:</strong>
                                                                                                {{ $value }}</li>
                                                                                        @endforeach
                                                                                    </ul>
                                                                                @else
                                                                                    <p>No attributes available.</p>
                                                                                @endif
                                                                            </p>
                                                                            <hr>
                                                                            <p class="font-weight-bold">
                                                                                @if ($oldprice > $order->price)
                                                                                    Customer will receive a refund:
                                                                                @elseif ($oldprice == $order->price)
                                                                                    No additional payment required.
                                                                                @else
                                                                                    Customer need to pay the Amount:
                                                                                @endif

                                                                                <span
                                                                                    class="{{ $oldprice > $order->price ? 'text-danger' : 'text-success' }}">
                                                                                    Rs.
                                                                                    {{ abs($oldprice - $order->price) }}
                                                                                </span>
                                                                            </p>
                                                                        </div>

                                                                        {{-- {{ $order->reason }} --}}

                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">Close</button>

                                                    </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


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
                            {{-- {{ $orders->appends(request()->query())->links() }} --}}
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>


@endsection
