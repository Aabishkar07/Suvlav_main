@php
    //echo '<pre>';
    //echo $list->title;
    ///print_r($list);
    use App\Models\Wishlist;

    $product_image_url = $list->image != '' ? $list->image : 'assets/images/no_photo.jpg';
    $user_id = Session::get('memeber_id_ss');
    $wishlist = Wishlist::where('user_id', $user_id)->get();
@endphp
{!! $slider == '0' ? '<div class="col-xl-3 col-lg-4 col-md-4 col-12">' : '' !!}

<div class="border rounded shadow single-product ">

    <div class="justify-between p-1 bg-white d-flex">
        <a class="font-bold text-[16px]" href="{{ url('product/' . $list->slug) }}">{{ $list->title }}</a>
        @php
            $regular_price = $list->regular_price;
            $sale_price = $list->sale_price;
            $percent = (($regular_price - $sale_price) / $regular_price) * 100;
        @endphp
        @if ($list->sale_price && $percent > 0)
            <div class="px-2 py-1 text-xs text-white rounded discount-badge bg-danger">
                {{ number_format($percent) }} % OFF
            </div>
        @endif
    </div>

    <a class="" href="{{ url('product/' . $list->slug) }}">

        <span class="p-2">{!! $list->short_desc !!}
        </span>
    </a>



    <div class="product-img">


        <a href="{{ url('product/' . $list->slug) }}" style="display: block; height: 450px; position: relative;">
            {{-- <img class="default-img" src="{{ asset('public/' . $product_image_url) }}" alt="{{ $list->title }}" --}}
            <img class="default-img" src="{{ asset('public/' . $product_image_url) }}" alt="{{ $list->title }}"
                style="width: 100%; height: 100%; object-fit: contain; display: block;">
            {!! productBadge($list) !!}

        </a>




        <div id="colorsss">

            <style>
                #colorsss {
                    padding: 20px;

                }
            </style>

            {{-- <div class="button-head "> --}}
            <div class="button-heads ">

                <div class="product-action ">



                    <div class="flex items-center">
                        {{-- <a title="Quick View" href="{{ url('product/' . $list->slug) }}">
                        <i class="ti-eye"></i><span>Quick Shop</span>
                    </a> --}}
                        <a data-product-id="{{ $list->id }}" title="Wishlist"
                            class="px-2 pt-3 wishlistToggle flex items-center {{ $wishlist->contains('product_id', $list->id) ? 'text-red-500' : 'text-blue-500' }}">
                            <i
                                class="{{ $wishlist->contains('product_id', $list->id) ? 'fas fa-heart text-lg' : 'ti-heart text-lg' }} mr-1"></i>
                            <span>{{ $wishlist->contains('product_id', $list->id) ? 'Remove from Wishlist' : 'Wish to Buy' }}</span>
                        </a>
                    </div>


                    <script>
                        document.querySelectorAll('.wishlistToggle').forEach(button => {
                            button.addEventListener('click', function(event) {
                                event.preventDefault(); // Prevent default link behavior

                                const button = this;
                                const productId = button.getAttribute('data-product-id');
                                const isRemoving = button.classList.contains(
                                    'text-red-500'); // Check if currently in "Remove" state

                                // Check if the button is already processing a request
                                if (button.dataset.processing === "true") {
                                    return; // Prevent further clicks while processing
                                }

                                // Mark button as processing
                                button.dataset.processing = "true";

                                // Disable the button to prevent multiple clicks
                                button.disabled = true;
                                button.querySelector('span').textContent = isRemoving ? 'Removing...' : 'Adding...';

                                // Determine the appropriate URL and method
                                const url = isRemoving ?
                                    `{{ route('wishlist.destroy', ':id') }}`.replace(':id', productId) :
                                    '{{ route('wishlist.add') }}';
                                const method = isRemoving ? 'DELETE' : 'POST';

                                // Send AJAX request
                                fetch(url, {
                                        method: method,
                                        headers: {
                                            'Content-Type': 'application/json',
                                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                        },
                                        body: !isRemoving ? JSON.stringify({
                                            productId: productId
                                        }) : null
                                    })
                                    .then(response => response.json())
                                    .then(data => {
                                        if (data.success) {
                                            // Update button state based on action
                                            if (isRemoving) {
                                                button.classList.remove('text-red-500');
                                                button.classList.add('text-blue-500');
                                                button.querySelector('i').className = 'ti-heart text-lg mr-1';
                                                button.querySelector('span').textContent = 'Wish to Buy';
                                            } else {
                                                button.classList.remove('text-blue-500');
                                                button.classList.add('text-red-500');
                                                button.querySelector('i').className = 'fas fa-heart text-lg mr-1';
                                                button.querySelector('span').textContent = 'Remove from Wishlist';
                                            }
                                        } else if (data.redirect) {
                                            window.location.href = data.redirect;
                                        } else {
                                            console.error('Error:', data.message);
                                        }
                                    })
                                    .catch(error => {
                                        console.error('Error:', error);
                                    })
                                    .finally(() => {
                                        // Re-enable the button and remove processing lock
                                        button.disabled = false;
                                        button.dataset.processing = "false";
                                    });
                            });
                        });
                    </script>



                    {{-- <script>
                    var wishlistButtons = document.getElementsByClassName('wishlistButton');

                    for (var i = 0; i < wishlistButtons.length; i++) {
                        wishlistButtons[i].addEventListener('click', function() {
                            var productId = this.getAttribute('data-product-id');

                            window.location.href = '{{ route('wishlist.add', ['productId' => '__productId__']) }}'.replace(
                                '__productId__', productId);
                        });
                    }
                </script> --}}
                </div>
                <div class="product-action-2 ">
                    <a class="px-2" title="Add to cart" href="javascript:void(0)"
                        onclick="addToCart(this, {{ $list->id }}, '{{ csrf_token() }}', '{{ route('cart.addtocart') }}', 'card');">Add
                        to cart</a>
                </div>
            </div>
        </div>



    </div>
    <div class="px-3 py-2 product-content">
        {{-- <h3><a href="{{ url('product/' . $list->slug) }}">{{ $list->title }}</a></h3> --}}
        <div class="items-center justify-between d-flex">
            <div class="product-price">
                <a class="px-2 py-1 text-xs text-white rounded discount-badge bg-primary" title="Buy Now"
                    href="javascript:void(0)"
                    onclick="addToCart(this, {{ $list->id }}, '{{ csrf_token() }}', '{{ route('cart.addtocart') }}', 'card');">Buy
                    Now</a>
            </div>


            <div class="product-price">
                <span style="font-size: 12px">{!! showProductPrice($list->regular_price, $list->sale_price) !!}</span>
            </div>
            @php
                $regular_price = $list->regular_price;
                $sale_price = $list->sale_price;
                $percent = (($regular_price - $sale_price) / $regular_price) * 100;
            @endphp





            <div class="px-2 py-1 text-xs text-white rounded product-price discount-badge bg-success">
                <a href="{{ url('product/' . $list->slug) }}#thissection" style="font-size: 12px">
                    <i class="ti-comment"></i>
                    Comment</a>
            </div>
            {{-- @if ($list->sale_price && $percent > 0)
                <div class="px-2 py-1 text-xs text-white rounded discount-badge bg-success">
                    {{ number_format($percent) }} % OFF
                </div>
            @endif --}}
        </div>

    </div>
</div>
{!! $slider == '0' ? '</div>' : '' !!}
{{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"> --}}
