@extends('layouts.frontendapp')
@section('content')
    <div class="container mb-5 mt-28 max-sm:mt-0">

        <div class="">

            <h2 class="text-2xl text-black New Arrivals text-start fs-3" style="font-weight: 600">
                Wishlist
            </h2>
            <div class="pt-3 d-flex">
                <div class="flex-shrink-0" style="width: 10%; border-top: 2px solid #ff6f10;"></div>
                <div class="flex-grow-1 border-top"></div>
            </div>
        </div>


        <div class="row">
            <div class="col-12">
                <div class="product-info" style="margin-top: -15px;">
                    <div class="row">
                        @foreach ($wishlistProducts as $list)
                            @include('front.components.productcard', [
                                'list' => $list,
                                'slider' => '0',
                            ])
                        @endforeach
                    </div>
                </div>
            </div>
        </div>



    </div>
@endsection
