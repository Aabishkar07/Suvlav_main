@php
    //echo '<pre>';
    //echo $list->title;
    ///print_r($list);

    $product_image_url = $list->image != '' ? $list->image : 'assets/images/no_photo.jpg';
@endphp
{!! $slider == '0' ? '<div class="col-xl-3 col-lg-4 col-md-4 col-12">' : '' !!}

<div class="single-product shadow  rounded ">
    <div class="product-img">
 <a href="{{ url('product/' . $list->slug) }}" style="display: block; height: 450px; position: relative;">
    <img class="default-img" src="{{ asset('public/'. $product_image_url) }}" alt="{{ $list->title }}" style="width: 100%; height: 100%; object-fit: contain; display: block;">
    {!! productBadge($list) !!}
</a>

        <div class="button-head ">
            <div class="product-action ">
                <a data-toggle="modal" title="Quick View" href="{{ url('product/' . $list->slug) }}"><i
                        class=" ti-eye"></i><span>Quick Shop</span></a>
                <a title="Wishlist" class="px-2" href="#"><i class=" ti-heart"></i><span>Add to Wishlist</span></a>
                <!--<a title="Compare" href="#"><i class="ti-bar-chart-alt"></i><span>Add to Compare</span></a>-->
            </div>
            <div class="product-action-2 ">
                <a class="px-2" title="Add to cart" href="javascript:void(0)"
                    onclick="addToCart(this, {{ $list->id }}, '{{ csrf_token() }}', '{{ route('cart.addtocart') }}', 'card');">Add
                    to cart</a>
            </div>
        </div>
    </div>
    <div class="product-content px-3 py-2">
        <h3><a href="{{ url('product/' . $list->slug) }}">{{ $list->title }}</a></h3>
        <div class="product-price">
            <span>{!! showProductPrice($list->regular_price, $list->sale_price) !!}</span>
        </div>
    </div>
</div>
{!! $slider == '0' ? '</div>' : '' !!}
