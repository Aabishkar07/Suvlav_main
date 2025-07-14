@php
    //echo '<pre>';
    //echo $list->title;
    ///print_r($list);
    use App\Models\Wishlist;

    $product_image_url = $list->image != '' ? $list->image : 'assets/images/no_photo.jpg';
    $user_id = Session::get('memeber_id_ss');
    $wishlist = Wishlist::where('user_id', $user_id)->get();
    $exchange = request()->query('details');
@endphp
{!! $slider == '0' ? '<div class="col-xl-3 col-lg-4 col-md-4 col-12">' : '' !!}

<div class="border rounded shadow single-product product-card" style="height: 700px"
    @if (isset($index)) style="{{ $index >= 4 ? 'display: none;' : '' }}" @endif>
    <div class="justify-between p-1 bg-white d-flex" >
        <a class="font-bold text-black text-[14px]" style="color: black"
            href="{{ $exchange ? route('productdetails', ['slug' => $list->slug, 'details' => $exchange]) : url('product/' . $list->slug) }}">{{ $list->title }}</a>
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


    @if ($exchange)
        <a class="" href="{{ route('productdetails', ['slug' => $list->slug, 'details' => $exchange]) }}">
            <span class="p-2">{!! $list->short_desc !!}</span>
        </a>
    @else
        <a class="" href="{{ url('product/' . $list->slug) }}">
            <span class="p-2">{!! $list->short_desc !!}</span>
        </a>
    @endif






    <div class="product-img">


        <a href="{{ $exchange ? route('productdetails', ['slug' => $list->slug, 'details' => $exchange]) : url('product/' . $list->slug) }}"
            style="display: block; height: 450px; position: relative;">
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
                        <a data-product-id="{{ $list->id }}" title="Wishlist"
                            class="px-2 pt-3 wishlistToggle flex items-center {{ $wishlist->contains('product_id', $list->id) ? 'text-red-500' : 'text-blue-500' }}">
                            @if ($wishlist->contains('product_id', $list->id))
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24"
                                    height="24" color="orange" fill="orange">
                                    <path
                                        d="M19.4626 3.99415C16.7809 2.34923 14.4404 3.01211 13.0344 4.06801C12.4578 4.50096 12.1696 4.71743 12 4.71743C11.8304 4.71743 11.5422 4.50096 10.9656 4.06801C9.55962 3.01211 7.21909 2.34923 4.53744 3.99415C1.01807 6.15294 0.221721 13.2749 8.33953 19.2834C9.88572 20.4278 10.6588 21 12 21C13.3412 21 14.1143 20.4278 15.6605 19.2834C23.7783 13.2749 22.9819 6.15294 19.4626 3.99415Z"
                                        stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                                </svg>
                            @else
                                <i class="mr-1 text-lg ti-heart"></i>
                            @endif
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

                                                // Replace SVG with an icon
                                                const svg = button.querySelector('svg');
                                                if (svg) svg.remove();

                                                const icon = document.createElement('i');
                                                icon.className = 'mr-1 text-lg ti-heart';
                                                button.prepend(icon);

                                                button.querySelector('span').textContent = 'Wish to Buy';
                                            } else {
                                                button.classList.remove('text-blue-500');
                                                button.classList.add('text-red-500');

                                                // Replace icon with SVG
                                                const icon = button.querySelector('i');
                                                if (icon) icon.remove();

                                                const svg = document.createElementNS('http://www.w3.org/2000/svg',
                                                    'svg');
                                                svg.setAttribute('xmlns', 'http://www.w3.org/2000/svg');
                                                svg.setAttribute('viewBox', '0 0 24 24');
                                                svg.setAttribute('width', '24');
                                                svg.setAttribute('height', '24');
                                                svg.setAttribute('color', 'orange');
                                                svg.setAttribute('fill', 'orange');

                                                const path = document.createElementNS('http://www.w3.org/2000/svg',
                                                    'path');
                                                path.setAttribute('d',
                                                    'M19.4626 3.99415C16.7809 2.34923 14.4404 3.01211 13.0344 4.06801C12.4578 4.50096 12.1696 4.71743 12 4.71743C11.8304 4.71743 11.5422 4.50096 10.9656 4.06801C9.55962 3.01211 7.21909 2.34923 4.53744 3.99415C1.01807 6.15294 0.221721 13.2749 8.33953 19.2834C9.88572 20.4278 10.6588 21 12 21C13.3412 21 14.1143 20.4278 15.6605 19.2834C23.7783 13.2749 22.9819 6.15294 19.4626 3.99415Z'
                                                );
                                                path.setAttribute('stroke', 'currentColor');
                                                path.setAttribute('stroke-width', '1.5');
                                                path.setAttribute('stroke-linecap', 'round');

                                                svg.appendChild(path);
                                                button.prepend(svg);

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
                @if (!$exchange)
                    <div class="product-action-2 ">
                        {{-- <a class="px-2" title="Add to cart" href="javascript:void(0)"
                        onclick="addToCart(this, {{ $list->id }}, '{{ csrf_token() }}', '{{ route('cart.addtocart') }}', 'card');">Add
                        to cart</a> --}}

                        <div class="px-2 transition duration-300 ease-in-out addToCartButton hover:text-orange-500"
                            title="Add to cart" id="addToCartButton_{{ $list->id }}"
                            data-product-id="{{ $list->id }}" data-csrf-token="{{ csrf_token() }}"
                            data-url="{{ route('cart.addtocart') }}">Add to cart
                        </div>

                        <script>
                            document.addEventListener('DOMContentLoaded', function() {
                                const button = document.getElementById('addToCartButton_{{ $list->id }}');

                                if (button) {
                                    button.addEventListener('click', function() {
                                        let quantity = 1;
                                        let cartColor = '';
                                        let cartSize = '';
                                        let isCartProcessing = false;

                                        // Retrieve quantity, size, and color values if available
                                        const elementSize = document.getElementById('cart_size');
                                        if (elementSize) {
                                            cartSize = elementSize.value || '';
                                        }

                                        const elementColor = document.getElementById('cart_color');
                                        if (elementColor) {
                                            cartColor = elementColor.value || '';
                                        }

                                        // Validate quantity
                                        if (quantity <= 0) {
                                            toastr.error(
                                                "Your quantity is " + quantity + ". Please increase the Quantity.",
                                                "Error"
                                            );
                                            return;
                                        }

                                        const productId = this.getAttribute('data-product-id');
                                        const csrfToken = this.getAttribute('data-csrf-token');
                                        const url = this.getAttribute('data-url');

                                        const payload = {
                                            product_id: productId,
                                            quantity: 1,
                                            cartSize: cartSize,
                                            cartColor: cartColor,
                                            type: 'single'
                                        };

                                        // Prevent multiple requests
                                        if (isCartProcessing) {
                                            toastr.warning("Cart is already processing. Please wait.");
                                            return;
                                        }
                                        isCartProcessing = true;

                                        // Send AJAX request
                                        fetch(url, {
                                                method: 'POST',
                                                headers: {
                                                    'Content-Type': 'application/json',
                                                    'X-CSRF-TOKEN': csrfToken
                                                },
                                                body: JSON.stringify(payload)
                                            })
                                            .then(response => response.json())
                                            .then(data => {
                                                if (data.status === "success") {
                                                    toastr.success(data.msg, "Success");
                                                    const cartInfo = document.getElementById("js_cartInfo");
                                                    if (cartInfo) {
                                                        cartInfo.innerHTML = data.content;
                                                    }
                                                } else {
                                                    toastr.error(data.message, "Error");
                                                }
                                            })
                                            .catch(error => {
                                                console.error("Error adding to cart:", error);
                                                toastr.error("An unexpected error occurred.", "Error");
                                            })
                                            .finally(() => {
                                                isCartProcessing = false;
                                            });
                                    });
                                }
                            });
                        </script>



                    </div>
                @endif
            </div>
        </div>



    </div>
    <div class="px-3 py-2 ">
        {{-- <h3><a href="{{ url('product/' . $list->slug) }}">{{ $list->title }}</a></h3> --}}
        <div class="items-center justify-between d-flex">
            @if (!$exchange)
                <div class="product-price">



                    <div class="px-2 py-1 text-xs text-white rounded cursor-pointer buynowButton discount-badge bg-primary"
                        title="Buy Now" id="mybuynowCartButton_{{ $list->id }}"
                        data-product-id="{{ $list->id }}" data-csrf-token="{{ csrf_token() }}"
                        data-url="{{ route('cart.addtocart') }}">Buy
                        Now</div>


                    <script>
                        document.addEventListener('DOMContentLoaded', function() {
                            const button = document.getElementById('mybuynowCartButton_{{ $list->id }}');

                            if (button) {
                                button.addEventListener('click', function() {
                                    let quantity = 1;
                                    let cartColor = '';
                                    let cartSize = '';
                                    let isCartProcessing = false;

                                    // Retrieve quantity, size, and color values if available
                                    const elementSize = document.getElementById('cart_size');
                                    if (elementSize) {
                                        cartSize = elementSize.value || '';
                                    }

                                    const elementColor = document.getElementById('cart_color');
                                    if (elementColor) {
                                        cartColor = elementColor.value || '';
                                    }

                                    // Validate quantity
                                    if (quantity <= 0) {
                                        toastr.error(
                                            "Your quantity is " + quantity + ". Please increase the Quantity.",
                                            "Error"
                                        );
                                        return;
                                    }

                                    const productId = this.getAttribute('data-product-id');
                                    const csrfToken = this.getAttribute('data-csrf-token');
                                    const url = this.getAttribute('data-url');

                                    const payload = {
                                        product_id: productId,
                                        quantity: 1,
                                        cartSize: cartSize,
                                        cartColor: cartColor,
                                        type: 'single'
                                    };

                                    // Prevent multiple requests
                                    if (isCartProcessing) {
                                        toastr.warning("Cart is already processing. Please wait.");
                                        return;
                                    }
                                    isCartProcessing = true;

                                    // Send AJAX request
                                    fetch(url, {
                                            method: 'POST',
                                            headers: {
                                                'Content-Type': 'application/json',
                                                'X-CSRF-TOKEN': csrfToken
                                            },
                                            body: JSON.stringify(payload)
                                        })
                                        .then(response => response.json())
                                        .then(data => {
                                            if (data.status === "success") {
                                                toastr.success(data.msg, "Success");
                                                const cartInfo = document.getElementById("js_cartInfo");
                                                if (cartInfo) {
                                                    cartInfo.innerHTML = data.content;
                                                    window.location.href = "https://suvlav.com/checkout";
                                                }
                                            } else {
                                                toastr.error(data.message, "Error");
                                            }
                                        })
                                        .catch(error => {
                                            console.error("Error adding to cart:", error);
                                            toastr.error("An unexpected error occurred.", "Error");
                                        })
                                        .finally(() => {
                                            isCartProcessing = false;
                                        });
                                });
                            }
                        });
                    </script>
                </div>
            @else
                <div class="p-2 text-xs text-white rounded">
                    {{-- View --}}
                </div>
            @endif


            <div class="product-price">
                <span style="font-size: 12px">
                    {!! showProductPrice($list->regular_price, $list->sale_price) !!}
                </span>
            </div>
            @php
                $regular_price = $list->regular_price;
                $sale_price = $list->sale_price;
                $percent = (($regular_price - $sale_price) / $regular_price) * 100;
            @endphp




            @if (!$exchange)
                <div class="px-2 py-1 text-xs text-white rounded product-price discount-badge bg-success">
                    <a href="{{ url('product/' . $list->slug) }}#thissection" style="font-size: 12px">
                        <i class="ti-comment"></i>
                        Comment</a>
                </div>
            @endif

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
