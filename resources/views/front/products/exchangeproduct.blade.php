
@extends('layouts.frontendapp')
@section('content')

<div class="product-area section">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section-title">
                    <h2>Choose any product to exchange</h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="product-info" style="margin-top: -15px;">
                    <div class="row">
                        @foreach ($myresults as $list)
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
</div>

@endsection