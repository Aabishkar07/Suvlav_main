@extends('layouts.backendapp')

@section('content')

    @php
        // Configure this page
        $pageName = 'Products';
        $showChildFormat = 'yes';
        $post_per_page = siteSettings('posts_per_page');

        $breadcrumbs = [
            ['title' => 'Dashboard', 'link' => '#', 'isActive' => ''],
            ['title' => 'Products', 'link' => '#', 'isActive' => 'active'],
        ];

        $start = isset($request->page) && !empty($request->page) ? ($request->page - 1) * $post_per_page + 1 : 1;

    @endphp

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            {{ $message }}
        </div>
    @endif

    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">

                <div class="row margin-bottom-30">
                    <form method="get" class="forms-sample deceased-search">
                        <input type="hidden" name="search" value="search">
                        <div class="form-group row">
                            @can('Add Product')
                                <div class="col-sm-6"> <a href="{{ route('product.create') }}"
                                        class="btn btn-info sfw btn-sm"><i class="fa fa-plus"></i> Add New </a> </div>
                            @endcan
                            <div class="col-sm-3">
                                <input type="text" name= "title" class="form-control" id="searchName"
                                    value="{{ $request->title }}" placeholder="Search...">
                            </div>
                            <div class="col-sm-3">
                                <button class="btn btn-info sfw btn-sm btn_search" type="submit"><i
                                        class="fa fa-search"></i> Search</button>
                                <a href="{{ route('product.index') }}" class="btn btn-info sfw btn-sm"><i
                                        class="fa fa-mail-reply"></i> Reset </a>
                            </div>
                        </div>

                    </form>
                </div>
                <table class="table table-bordered table-hover">
                    <thead class="table-light">
                        <tr>
                            <th> # </th>
                            <th> Image </th>
                            <th> Name </th>
                            <th> Price </th>
                            <th> Product Code </th>
                            <th> Stock</th>
                            <th> Status </th>
                            {{-- <th> Active </th> --}}
                            <th> Action </th>
                            <th> Remove </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $GLOBALS['counter'] = $start; ?>
                        @if (count($products) > 0)
                            @foreach ($products as $key => $product)
                                @php
                                    $product_image_url =
                                        $product->image != ''
                                            ? 'public' . $product->image
                                            : 'assets/images/no_photo.jpg';
                                @endphp
                                <tr>
                                    <td>{{ $GLOBALS['counter']++ }} 666</td>
                                    <td><img src="{{ asset($product_image_url) }}" alt="{{ $product->title }}"></td>
                                    <td>{!! wordwrap($product->title, 15, "<br>\n") !!}</td>
                                    <td>@php $showProductPrice = showProductPrice($product->regular_price, $product->sale_price); @endphp
                                        {!! $showProductPrice !!}
                                    </td>
                                    <td>{{ $product->prod_code }}</td>
                                    <td>{!! $product->stock_status === '1' ? 'In Stock' : 'Out of Stock' !!}</td>
                                    {{-- <td>{!! $product->status === '1' ? '<i class="fa fa-check"></i>' : '<i class="fa fa-times"></i>' !!}</td> --}}

                                    <td class="px-5 py-5 text-sm bg-white ">

                                        <form method="POST" action="{{ route('togleActive', $product->id) }}">
                                            @csrf
                                            <label class="inline-flex items-center cursor-pointer">
                                                <div class="form-check d-flex form-switch">
                                                    <div class="px-5">
                                                        <input class=" form-check-input bigger-toggle" type="checkbox"
                                                            role="switch" id="flexSwitchCheckChecked"
                                                            onchange="this.form.submit()"
                                                            {{ $product->status == '1' ? 'checked' : '' }}>
                                                    </div>
                                                </div>
                                                <div>
                                                    @if ($product->status == '1')
                                                        <div class="px-4 py-1 text-white rounded bg-success">
                                                            Active
                                                        </div>
                                                    @else
                                                        <div class="px-4 py-1 text-white rounded bg-danger">
                                                            InActive
                                                        </div>
                                                    @endif
                                                </div>
                                                <style>
                                                    .bigger-toggle {
                                                        width: 50px !important;
                                                        height: 25px !important;
                                                    }
                                                </style>


                                            </label>
                                        </form>
                                    </td>
                                    @can('Edit Product')
                                        <td><a href="{{ route('product.edit', $product->id) }}"
                                                class="btn btn-success btn-sm"><i class="fa fa-edit"></i> </a>
                                        </td>
                                    @endcan

                                    <td>
                                        @can('Delete Product')
                                            <form action="{{ route('product.destroy', $product->id) }}" method="POST"
                                                class="delete_confirm">
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                <input type="hidden" name="_method" value="DELETE">
                                                <button class="btn btn-danger sfw btn-sm"><i class="fa fa-trash-o"></i>
                                                </button>
                                            </form>
                                        @endcan
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="9">
                                    <p class="text-danger">No record found!</p>
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>

                <div class="row margin-top-30">
                    <div class="card">
                        <div class="card-body">
                            {{ $products->appends(request()->query())->links() }}
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>


@endsection
