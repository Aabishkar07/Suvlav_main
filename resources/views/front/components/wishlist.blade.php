@extends('layouts.frontendapp')
@section('content')


<div class="container mb-5 mt-28 max-sm:mt-0">

    <div class="">

        <h2 class="New Arrivals  text-black text-2xl text-start fs-3" style="font-weight: 600">
            Wishlist
        </h2>
        <div class="d-flex pt-3">
            <div class="flex-shrink-0" style="width: 10%; border-top: 2px solid #ff6f10;"></div>
            <div class="flex-grow-1 border-top"></div>
        </div>
    </div>
    @foreach ($wishlistProducts as $list)
    @include('front.components.productcard', [
        'list' => $list,
        'slider' => '0',
    ])
    @endforeach

</div>

@endsection