@extends('layouts.frontendapp')
@section('content')


{{-- <div class="container">
    <h1 class="mb-5">Searched Results for <span class="text-[#Ec1464]">{{ $query }}</span></h1>

    @if (count($products) > 0)
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-4 gap-6 ">

            @foreach ($products as $list)
            @include('front.components.productcard', ['list' => $list, 'slider' => '1'])
            @endforeach
        @else
            <p>No results found.</p>
    @endif
</div>

</div> --}}


<div class="product-area section">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section-title">
                    <h2>Searched Results for <span class="text-[#Ec1464]">{{ $query }}</span></h2>
                </div>
            </div>
        </div>


        @if (count($products) > 0)

        <div class="row">
            <div class="col-12">
                <div class="product-info" style="margin-top: -15px;">
                    <div class="row">
                        @foreach ($products as $list)
                        @include('front.components.productcard', [
                                'list' => $list,
                                'slider' => '0',
                            ])
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        @else
        <p>No results found.</p>

        @endif
    </div>
</div>

@endsection