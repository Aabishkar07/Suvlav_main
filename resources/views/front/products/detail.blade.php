@extends('layouts.frontendapp')
@section('content')
    <!-- Custom Styles -->
    <style>
        /* General styles */
        body {
            font-family: Arial, sans-serif;
        }

        .custom-btn {
            padding: 10px 15px;
            border: none;
            cursor: pointer;
            background-color: #007bff;
            color: white;
            border-radius: 4px;
            transition: background-color 0.3s;
        }

        .custom-btn.secondary-btn {
            background-color: #6c757d;
        }

        .custom-btn:hover {
            background-color: #0056b3;
        }

        /* Modal styles */
        .custom-modal {
            display: none;
            /* Hidden by default */
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 1000;
            justify-content: center;
            align-items: center;
        }

        .custom-modal-content {
            background: white;
            width: 90%;
            max-width: 500px;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            animation: fadeIn 0.3s ease-in-out;
        }

        .custom-modal-header,
        .custom-modal-footer {
            padding: 15px;
            background-color: #f1f1f1;
            border-bottom: 1px solid #ddd;
        }

        .custom-modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .custom-modal-body {
            padding: 20px;
        }

        .close-btn {
            background: transparent;
            border: none;
            font-size: 20px;
            cursor: pointer;
        }

        .close-btn:hover {
            color: red;
        }

        /* Animations */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: scale(0.9);
            }

            to {
                opacity: 1;
                transform: scale(1);
            }
        }
    </style>
    @php
        $product_images = [];
        $productDefaultSize = '';
        $productDefaultColor = '';
        if (isset($product->images) && !empty($product->images)) {
            $product_images = json_decode($product->images, true);
        }

        //echo '<pre>';

    @endphp

    <!-- Breadcrumbs -->
    <!-- <div class="breadcrumbs">
                                                                                                                                                                          <div class="container">
                                                                                                                                                                           <div class="row">
                                                                                                                                                                            <div class="col-12">
                                                                                                                                                                             <div class="bread-inner">
                                                                                                                                                                              <ul class="bread-list">
                                                                                                                                                                               <li><a href="index1.html">Home<i class="ti-arrow-right"></i></a></li>
                                                                                                                                                                               <li class="active"><a href="blog-single.html">Products</a></li>
                                                                                                                                                                              </ul>
                                                                                                                                                                             </div>
                                                                                                                                                                            </div>
                                                                                                                                                                           </div>
                                                                                                                                                                          </div>
                                                                                                                                                                         </div> -->
    <!-- End Breadcrumbs -->

    {{-- @if ($message = Session::get('success'))
        <div class="alert alert-success" role="alert">
            {{ $message }}
        </div>
    @endif --}}


    <section class="shop single section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="row">
                        <div class="col-lg-6 col-12">
                            <!-- Product Slider -->
                            @if (count($product_images) > 0)
                                <div class="product-gallery">
                                    <!-- Images slider -->
                                    <div class="flexslider-thumbnails">
                                        <ul class="slides">
                                            @foreach ($product_images as $product_image)
                                                <li data-thumb="{{ '/public' . $product_image }}" rel="adjustX:10, adjustY:"
                                                    style="display: block; height: 450px; position: relative;">
                                                    <img src="{{ '/public' . $product_image }}" alt="{{ $product->title }}"
                                                        style="width: 100%; height: 100%; object-fit: contain; display: block;">
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    <!-- End Images slider -->
                                </div>
                            @endif
                            <!-- End Product slider -->
                        </div>
                        <div class="col-lg-6 col-12">
                            <div class="product-des">
                                <!-- Description -->
                                <div class="short">
                                    <h4>{{ $product->title }}</h4>
                                    <div class="rating-main">
                                        <ul class="rating">
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star-half-o"></i></li>
                                            <li class="dark"><i class="fa fa-star-o"></i></li>
                                        </ul>
                                        <a href="#" class="total-review">(102) Review</a>
                                    </div>
                                    <p class="price">
                                        @php
                                            if ($product->sale_price != '') {
                                                $regular_price = $product->regular_price;
                                                $sale_price = $product->sale_price;
                                                $percent = (($regular_price - $sale_price) / $regular_price) * 100;

                                                echo '<div class="discount" style="display: flex; gap: 15px; align-items: center;font-size: 20px;">' .
                                                    '<span class="discount" style="color: #F7941D;">' .
                                                    moneyFormat($product->sale_price) .
                                                    '</span>' .
                                                    '<s>' .
                                                    moneyFormat($product->regular_price) .
                                                    '</s>' .
                                                    '<div class="px-2 py-1 text-xs text-white rounded bg-success">' .
                                                    number_format($percent) .
                                                    '% OFF' .
                                                    '</div>' .
                                                    '</div>';
                                            } else {
                                                echo '<span class="discount">' .
                                                    moneyFormat($product->regular_price) .
                                                    '</span>';
                                            }
                                        @endphp
                                    </p>
                                    {!! $product->short_desc ? '<p class="description">' . $product->short_desc . '</p>' : '' !!}

                                </div>
                                <!--/ End Description -->
                                <!-- Color -->
                                @if (count($prod_colors) > 0)
                                    <div class="color">
                                        <h4>Available Options <span>Color</span></h4>
                                        <ul>
                                            @foreach ($prod_colors as $prod_color)
                                                @php
                                                    if ($loop->first) {
                                                        $color_classes = '<i class = "ti-check active"></i>';
                                                        $productDefaultColor = $prod_color->title;
                                                    } else {
                                                        $color_classes = '<i class = "ti-check"></i>';
                                                    }
                                                @endphp
                                                <li class="js_color"><a href="javascript:void(0)"
                                                        style="background-color:{{ $prod_color->color_code }};"
                                                        title="{{ $prod_color->title }}"> {!! $color_classes !!}</a></li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                <!--/ End Color -->
                                <!-- Size -->
                                @if (count($prod_sizes) > 0)
                                    <div class="size">
                                        <h4>Size</h4>
                                        <ul>
                                            @foreach ($prod_sizes as $prod_size)
                                                @php
                                                    if ($loop->first) {
                                                        $size_classes = ' class = "active"';
                                                        $productDefaultSize = $prod_size->display_name;
                                                    } else {
                                                        $size_classes = ' class = "" ';
                                                    }
                                                @endphp
                                                <li class="js_size"><a {!! $size_classes !!} href="javascript:void(0)"
                                                        title="{{ $prod_size->display_name }}">{{ $prod_size->display_name }}</a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                <!--/ End Size -->
                                <!-- Product Buy -->
                                <div class="product-buy">
                                    <div class="quantity">
                                        <h6>Quantity :</h6>
                                        <!-- Input Order -->
                                        <div class="input-group">
                                            <div class="button minus" onclick="decrementQuantity()">
                                                <button type="button" class="btn btn-primary btn-number" data-type="minus"
                                                    data-field="quant[1]">
                                                    <i class="ti-minus"></i>
                                                </button>
                                            </div>
                                            <input type="number" id="quantity" name="quant[1]" class="input-number"
                                                data-min="1" max="{{ $product->availablestock }}" value="1">
                                            <div onclick="incrementQuantity()" class="button plus">
                                                <button type="button" class="btn btn-primary btn-number" data-type="plus"
                                                    data-field="quant[1]">
                                                    <i class="ti-plus"></i>
                                                </button>
                                            </div>
                                        </div>
                                        <!--/ End Input Order -->
                                    </div>
                                    {{-- @dd($product->stock_status) --}}
                                    <div class="mt-3 add-to-cart">
                                        @if ($product->stock_status !== '0')
                                            <input type="hidden" id="cart_color" value="{{ $productDefaultColor }}">
                                            <input type="hidden" id="cart_size" value="{{ $productDefaultSize }}">
                                            <input type="hidden" name="cart_url" value="{{ route('cart.addtocart') }}">

                                            {{-- add to cart --}}
                                            <button type="button" class="btn addtocart" id="addToCartButton"
                                                data-product-id="{{ $product->id }}"
                                                data-csrf-token="{{ csrf_token() }}"
                                                data-url="{{ route('cart.addtocart') }}">
                                                Add to Cart
                                            </button>

                                            {{-- addtocart script --}}
                                            <script>
                                                document.getElementById('addToCartButton').addEventListener('click', function() {
                                                    let quantity = 1;
                                                    let cartColor = '';
                                                    let cartSize = '';
                                                    let isCartProcessing = false; // Initialize the variable

                                                    const elementQuantity = document.getElementById('quantity');
                                                    if (elementQuantity) {
                                                        quantity = parseInt(elementQuantity.value, 10); // Ensure quantity is an integer
                                                    }

                                                    const elementSize = document.getElementById('cart_size');
                                                    if (elementSize) {
                                                        cartSize = elementSize.value;
                                                    }

                                                    const elementColor = document.getElementById('cart_color');
                                                    if (elementColor) {
                                                        cartColor = elementColor.value;
                                                    }

                                                    // Check if quantity is valid
                                                    if (quantity <= 0) {
                                                        toastr.error(
                                                            "Your quantity is " + quantity + ". Please increase the Quantity.",
                                                            "Error"
                                                        );
                                                        return; // Exit the function if quantity is invalid
                                                    }

                                                    const productId = this.getAttribute('data-product-id');
                                                    const csrfToken = this.getAttribute('data-csrf-token');
                                                    const url = this.getAttribute('data-url');

                                                    const payload = JSON.stringify({
                                                        product_id: productId,
                                                        quantity: quantity,
                                                        cartSize: cartSize,
                                                        cartColor: cartColor,
                                                        type: 'single'
                                                    });

                                                    const xhr = new XMLHttpRequest();
                                                    xhr.open('POST', url, true); // Use asynchronous requests for better performance
                                                    xhr.setRequestHeader('Content-Type', 'application/json');
                                                    xhr.setRequestHeader('X-CSRF-TOKEN', csrfToken);

                                                    xhr.onreadystatechange = function() {
                                                        if (xhr.readyState === XMLHttpRequest.DONE) {
                                                            const response = JSON.parse(xhr.responseText);
                                                            console.log("test", response)
                                                            if (response.status === "success") {
                                                                toastr.success(response.msg, "Success");
                                                                document.getElementById("js_cartInfo").innerHTML = response.content;
                                                                isCartProcessing = false;
                                                            } else {
                                                                toastr.error(response.message, "Error");
                                                            }
                                                        }
                                                    };

                                                    xhr.send(payload);
                                                });
                                            </script>

                                            {{-- Buy Now --}}
                                            <button type="button" class="btn buynow" id="buyNowButton"
                                                data-product-id="{{ $product->id }}"
                                                data-csrf-token="{{ csrf_token() }}"
                                                data-url="{{ route('cart.addtocart') }}">
                                                Buy Now
                                            </button>

                                            {{-- buynow script --}}
                                            <script>
                                                document.getElementById('buyNowButton').addEventListener('click', function() {
                                                    let quantity = 1;
                                                    let cartColor = '';
                                                    let cartSize = '';
                                                    let isCartProcessing = false; // Initialize the variable

                                                    const elementQuantity = document.getElementById('quantity');
                                                    if (elementQuantity) {
                                                        quantity = parseInt(elementQuantity.value, 10); // Ensure quantity is an integer
                                                    }

                                                    const elementSize = document.getElementById('cart_size');
                                                    if (elementSize) {
                                                        cartSize = elementSize.value;
                                                    }

                                                    const elementColor = document.getElementById('cart_color');
                                                    if (elementColor) {
                                                        cartColor = elementColor.value;
                                                    }

                                                    // Check if quantity is valid
                                                    if (quantity <= 0) {
                                                        toastr.error(
                                                            "Your quantity is " + quantity + ". Please increase the Quantity.",
                                                            "Error"
                                                        );
                                                        return; // Exit the function if quantity is invalid
                                                    }

                                                    const productId = this.getAttribute('data-product-id');
                                                    const csrfToken = this.getAttribute('data-csrf-token');
                                                    const url = this.getAttribute('data-url');

                                                    const payload = JSON.stringify({
                                                        product_id: productId,
                                                        quantity: quantity,
                                                        cartSize: cartSize,
                                                        cartColor: cartColor,
                                                        type: 'single'
                                                    });

                                                    const xhr = new XMLHttpRequest();
                                                    xhr.open('POST', url, true); // Use asynchronous requests for better performance
                                                    xhr.setRequestHeader('Content-Type', 'application/json');
                                                    xhr.setRequestHeader('X-CSRF-TOKEN', csrfToken);

                                                    xhr.onreadystatechange = function() {
                                                        if (xhr.readyState === XMLHttpRequest.DONE) {
                                                            const response = JSON.parse(xhr.responseText);
                                                            console.log("test", response)
                                                            if (response.status === "success") {
                                                                toastr.success(response.msg, "Success");
                                                                document.getElementById("js_cartInfo").innerHTML = response.content;
                                                                window.location.href = "https://suvlav.com/checkout";
                                                                isCartProcessing = false;
                                                            } else {
                                                                toastr.error(response.message, "Error");
                                                            }
                                                        }
                                                    };

                                                    xhr.send(payload);
                                                });
                                            </script>




                                            <style>
                                                .addtocart {
                                                    background-color: #316FF6 !important;
                                                    border: 1px solid #316FF6;
                                                    color: white !important;
                                                    border-radius: 40px !important;
                                                }

                                                .addtocart:hover {
                                                    background-color: #ffffff !important;
                                                    color: #316FF6 !important;

                                                }
                                            </style>

                                            {{-- <button type="button" class="btn buynow"
                                                onclick="mybuynow(this, {{ $product->id }}, '{{ csrf_token() }}', '{{ route('cart.addtocart') }}', 'buy');">
                                                Buy Now</button> --}}

                                            <style>
                                                .buynow {
                                                    background-color: #ffffff !important;
                                                    border: 1px solid #316FF6;
                                                    color: #316FF6 !important;
                                                    border-radius: 40px !important;
                                                }
                                            </style>
                                        @endif

                                        {{-- <a href="#" class="btn min"><i class="ti-heart"></i></a> --}}
                                        {{-- <a href="#" class="btn min"><i class="fa fa-compress"></i></a> --}}

                                        <!-- Button to Trigger Modal -->
                                        <!--<button id="openModal" class="custom-btn btn min">Share </button>-->


                                        <button id="openModal" type="button" class="btn custom-btn btn-secondary share"
                                            @if (!$member) data-toggle="tooltip" @endif
                                            data-placement="top" title="Please Login To Share">
                                            Share
                                        </button>


                                        <style>
                                            .share {
                                                background-color: #316FF6 !important;
                                                border: 1px solid #316FF6;
                                                color: white !important;
                                                border-radius: 40px !important;
                                            }
                                        </style>

                                        <script>
                                            $(function() {
                                                $('[data-toggle="tooltip"]').tooltip()
                                            })
                                        </script>

                                        {{-- (@if (!$member)
                                            Please Login to share ..
                                        @endif) --}}
                                        <!-- Modal -->
                                        @if ($member)
                                            <div id="customModal" class="custom-modal">
                                                <div class="custom-modal-content">
                                                    <div class="custom-modal-header">
                                                        <h5 class="custom-modal-title">{{ $product->title }}</h5>
                                                        <button class="close-btn" id="closeModal">&times;</button>
                                                    </div>
                                                    <div class="custom-modal-body">
                                                        <p>Copy the current page URL below:</p>
                                                        <div style="">
                                                            <input type="text" style="width:100%" id="urlField"
                                                                class="custom-input"
                                                                value="{{ url()->current() . '?suvcode=' . $member->affilate_code }}"
                                                                readonly>
                                                            <button id="copyButton" class="mt-2 custom-btn">Copy</button>
                                                        </div>
                                                    </div>

                                                    <div class="custom-modal-footer">
                                                        <button class="custom-btn secondary-btn "
                                                            id="closeFooterModal">Close</button>
                                                        {{-- <button class="custom-btn primary-btn">Save changes</button> --}}
                                                    </div>
                                                </div>
                                            </div>
                                        @endif



                                        <!-- Custom Script -->
                                        <script>
                                            // Get elements
                                            const openModalBtn = document.getElementById('openModal');
                                            const closeModalBtn = document.getElementById('closeModal');
                                            const closeFooterModalBtn = document.getElementById('closeFooterModal');
                                            const customModal = document.getElementById('customModal');

                                            // Open modal
                                            openModalBtn.addEventListener('click', () => {
                                                customModal.style.display = 'flex';
                                            });

                                            // Close modal
                                            closeModalBtn.addEventListener('click', () => {
                                                customModal.style.display = 'none';
                                            });

                                            closeFooterModalBtn.addEventListener('click', () => {
                                                customModal.style.display = 'none';
                                            });

                                            // Close modal when clicking outside of it
                                            window.addEventListener('click', (e) => {
                                                if (e.target === customModal) {
                                                    customModal.style.display = 'none';
                                                }
                                            });

                                            // Copy URL to clipboard
                                            copyButton.addEventListener('click', () => {
                                                urlField.select();
                                                urlField.setSelectionRange(0, 99999); // For mobile devices
                                                navigator.clipboard.writeText(urlField.value).then(() => {
                                                    alert('URL copied to clipboard!');
                                                });
                                            });
                                        </script>



                                    </div>
                                    @if (count($prod_categories) > 0)
                                        <p class="cat">Category :
                                            @foreach ($prod_categories as $cat)
                                                <a href="/category/{{ $cat->slug }}">{{ $cat->title }}</a>
                                            @endforeach
                                        </p>
                                    @endif
                                    <p class="availability">Availability : {!! $product->stock_status === '1' ? 'In Stock' : 'Out of Stock' !!}</p>
                                </div>
                                <!--/ End Product Buy -->
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="product-info">
                                <div class="nav-main">
                                    <h4>Description </h4>
                                    <!-- Tab Nav -->
                                    <!-- <ul class="nav nav-tabs" id="myTab" role="tablist">
                                                                                                                                                                                  <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#description" role="tab">Description</a></li> -->
                                    <!-- <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#reviews" role="tab">Reviews</a></li> -->
                                    <!-- </ul> -->
                                    <!--/ End Tab Nav -->
                                </div>
                                <div class="tab-content" id="myTabContent">
                                    <!-- Description Tab -->
                                    <div class="tab-pane fade show active" id="description" role="tabpanel">
                                        <div class="tab-single">
                                            <div class="row">
                                                <div class="col-12">
                                                    {!! $product->content !!}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--/ End Description Tab -->
                                    <!-- Reviews Tab -->
                                    <!-- <div class="tab-pane fade" id="reviews" role="tabpanel">
                                                                                                                                                                                  <div class="tab-single review-panel">
                                                                                                                                                                                   <div class="row">
                                                                                                                                                                                    <div class="col-12">
                                                                                                                                                                                     <div class="ratting-main">
                                                                                                                                                                                      <div class="avg-ratting">
                                                                                                                                                                                       <h4>4.5 <span>(Overall)</span></h4>
                                                                                                                                                                                       <span>Based on 1 Comments</span>
                                                                                                                                                                                      </div>
                                                                                                                                                                                     
                                                                                                                                                                                      <div class="single-rating">
                                                                                                                                                                                       <div class="rating-author">
                                                                                                                                                                                        <img src="{{ asset('front_assets/images/comments1.jpg') }}" alt="#">
                                                                                                                                                                                       </div>
                                                                                                                                                                                       <div class="rating-des">
                                                                                                                                                                                        <h6>Naimur Rahman</h6>
                                                                                                                                                                                        <div class="ratings">
                                                                                                                                                                                         <ul class="rating">
                                                                                                                                                                                          <li><i class="fa fa-star"></i></li>
                                                                                                                                                                                          <li><i class="fa fa-star"></i></li>
                                                                                                                                                                                          <li><i class="fa fa-star"></i></li>
                                                                                                                                                                                          <li><i class="fa fa-star-half-o"></i></li>
                                                                                                                                                                                          <li><i class="fa fa-star-o"></i></li>
                                                                                                                                                                                         </ul>
                                                                                                                                                                                         <div class="rate-count">(<span>3.5</span>)</div>
                                                                                                                                                                                        </div>
                                                                                                                                                                                        <p>Duis tincidunt mauris ac aliquet congue. Donec vestibulum consequat cursus. Aliquam pellentesque nulla dolor, in imperdiet.</p>
                                                                                                                                                                                       </div>
                                                                                                                                                                                      </div>
                                                                                                                                                                                    
                                                                                                                                                                                      <div class="single-rating">
                                                                                                                                                                                       <div class="rating-author">
                                                                                                                                                                                        <img src="{{ asset('front_assets/images/comments1.jpg') }}" alt="#">
                                                                                                                                                                                       </div>
                                                                                                                                                                                       <div class="rating-des">
                                                                                                                                                                                        <h6>Advin Geri</h6>
                                                                                                                                                                                        <div class="ratings">
                                                                                                                                                                                         <ul class="rating">
                                                                                                                                                                                          <li><i class="fa fa-star"></i></li>
                                                                                                                                                                                          <li><i class="fa fa-star"></i></li>
                                                                                                                                                                                          <li><i class="fa fa-star"></i></li>
                                                                                                                                                                                          <li><i class="fa fa-star"></i></li>
                                                                                                                                                                                          <li><i class="fa fa-star"></i></li>
                                                                                                                                                                                         </ul>
                                                                                                                                                                                         <div class="rate-count">(<span>5.0</span>)</div>
                                                                                                                                                                                        </div>
                                                                                                                                                                                        <p>Duis tincidunt mauris ac aliquet congue. Donec vestibulum consequat cursus. Aliquam pellentesque nulla dolor, in imperdiet.</p>
                                                                                                                                                                                       </div>
                                                                                                                                                                                      </div>
                                                                                                                                                                                      
                                                                                                                                                                                     </div>
                                                                                                                                                                                    
                                                                                                                                                                                     <div class="comment-review">
                                                                                                                                                                                      <div class="add-review">
                                                                                                                                                                                       <h5>Add A Review</h5>
                                                                                                                                                                                       <p>Your email address will not be published. Required fields are marked</p>
                                                                                                                                                                                      </div>
                                                                                                                                                                                      <h4>Your Rating</h4>
                                                                                                                                                                                      <div class="review-inner">
                                                                                                                                                                                       <div class="ratings">
                                                                                                                                                                                        <ul class="rating">
                                                                                                                                                                                         <li><i class="fa fa-star"></i></li>
                                                                                                                                                                                         <li><i class="fa fa-star"></i></li>
                                                                                                                                                                                         <li><i class="fa fa-star"></i></li>
                                                                                                                                                                                         <li><i class="fa fa-star"></i></li>
                                                                                                                                                                                         <li><i class="fa fa-star"></i></li>
                                                                                                                                                                                        </ul>
                                                                                                                                                                                       </div>
                                                                                                                                                                                      </div>
                                                                                                                                                                                     </div>
                                                                                                                                                                                    
                                                                                                                                                                                     <form class="form" method="post" action="mail/mail.php">
                                                                                                                                                                                      <div class="row">
                                                                                                                                                                                       <div class="col-lg-6 col-12">
                                                                                                                                                                                        <div class="form-group">
                                                                                                                                                                                         <label>Your Name<span>*</span></label>
                                                                                                                                                                                         <input type="text" name="name" required="required" placeholder="">
                                                                                                                                                                                        </div>
                                                                                                                                                                                       </div>
                                                                                                                                                                                       <div class="col-lg-6 col-12">
                                                                                                                                                                                        <div class="form-group">
                                                                                                                                                                                         <label>Your Email<span>*</span></label>
                                                                                                                                                                                         <input type="email" name="email" required="required" placeholder="">
                                                                                                                                                                                        </div>
                                                                                                                                                                                       </div>
                                                                                                                                                                                       <div class="col-lg-12 col-12">
                                                                                                                                                                                        <div class="form-group">
                                                                                                                                                                                         <label>Write a review<span>*</span></label>
                                                                                                                                                                                         <textarea name="message" rows="6" placeholder=""></textarea>
                                                                                                                                                                                        </div>
                                                                                                                                                                                       </div>
                                                                                                                                                                                       <div class="col-lg-12 col-12">
                                                                                                                                                                                        <div class="form-group button5">
                                                                                                                                                                                         <button type="submit" class="btn">Submit</button>
                                                                                                                                                                                        </div>
                                                                                                                                                                                       </div>
                                                                                                                                                                                      </div>
                                                                                                                                                                                     </form>
                                                                                                                                                                                     
                                                                                                                                                                                    </div>
                                                                                                                                                                                   </div>
                                                                                                                                                                                  </div>
                                                                                                                                                                                 </div> -->
                                    <!--/ End Reviews Tab -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>




        <div class="w-full mx-auto mt-4 max-w-screen-2xl md:px-20" id="thissection">

            @if ($hasOrdered)
                @if (Session::get('memeber_id_ss'))
                    <div class="flex justify-center rounded-lg bg-gray-50 item-center" id="review" role="tabpanel"
                        aria-labelledby="review-tab">
                        <div class="flex flex-col items-start p-4 rounded-lg md:flex-row md:items-center ">
                            <div class="flex items-center mb-4 md:mb-0">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-12 h-12 text-yellow-400"
                                    viewBox="0 0 20 20" fill="currentColor">
                                    <path
                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                </svg>
                                <div>
                                    <div class="text-2xl font-bold text-blue-500">{{ $averagerating }} </div>
                                    <div class="text-sm text-zinc-500 ">Average User Rating</div>
                                </div>
                            </div>

                            <form method="POST" action="{{ route('review', ['slug' => $product->slug]) }}">

                                @csrf

                                <div class="flex-1 md:ml-8">
                                    <h2 class="text-xl font-semibold text-zinc-900 ">Write a Review</h2>
                                    <div class="mb-1 text-zinc-600">Rate us</div>


                                    <div class="flex items-center space-x-2" id="rating">
                                        <span class="cursor-pointer" data-rating="1">
                                            <svg class="w-6 h-6 fill-current " xmlns="http://www.w3.org/2000/svg"
                                                viewBox="0 0 24 24">
                                                <path
                                                    d="M12 2l2.25 6.722h7.161l-5.722 4.899 2.197 6.5-6.433-4.791-6.433 4.791 2.197-6.5-5.722-4.899h7.161z" />
                                            </svg>
                                        </span>
                                        <span class="cursor-pointer" data-rating="2"><svg class="w-6 h-6 fill-current"
                                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                                <path
                                                    d="M12 2l2.25 6.722h7.161l-5.722 4.899 2.197 6.5-6.433-4.791-6.433 4.791 2.197-6.5-5.722-4.899h7.161z" />
                                            </svg></span>
                                        <span class="cursor-pointer" data-rating="3"><svg class="w-6 h-6 fill-current"
                                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                                <path
                                                    d="M12 2l2.25 6.722h7.161l-5.722 4.899 2.197 6.5-6.433-4.791-6.433 4.791 2.197-6.5-5.722-4.899h7.161z" />
                                            </svg></span>
                                        <span class="cursor-pointer" data-rating="4"><svg class="w-6 h-6 fill-current"
                                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                                <path
                                                    d="M12 2l2.25 6.722h7.161l-5.722 4.899 2.197 6.5-6.433-4.791-6.433 4.791 2.197-6.5-5.722-4.899h7.161z" />
                                            </svg></span>
                                        <span class="cursor-pointer" data-rating="5"><svg class="w-6 h-6 fill-current"
                                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                                <path
                                                    d="M12 2l2.25 6.722h7.161l-5.722 4.899 2.197 6.5-6.433-4.791-6.433 4.791 2.197-6.5-5.722-4.899h7.161z" />
                                            </svg></span>
                                    </div>
                                    <p id="selected-rating" class="mt-2 text-center"></p>
                                    <input id="selected-rating-value" type="hidden" value="" name="rating" />
                                    <script>
                                        const stars = document.querySelectorAll('#rating span');
                                        const selectedRating = document.getElementById('selected-rating');
                                        const selectedRatingValue = document.getElementById('selected-rating-value');

                                        stars.forEach((star) => {
                                            star.addEventListener('click', () => {
                                                const rating = star.getAttribute('data-rating');
                                                selectedRatingValue.value = rating;
                                                stars.forEach((s) => {
                                                    if (s.getAttribute('data-rating') <= rating) {
                                                        s.classList.add('text-yellow-500');
                                                    } else {
                                                        s.classList.remove('text-yellow-500');
                                                    }
                                                });
                                            });
                                        });
                                    </script>



                                    <textarea name="feedback" placeholder="Your Review" class="w-full p-2 mb-4 border rounded-md border-zinc-300"></textarea>

                                    <button type="submit"
                                        class="w-full p-2 text-white rounded-lg md:w-auto bg-zinc-900 hover:bg-zinc-700">
                                        Post Review &rarr;
                                    </button>



                                </div>
                            </form>
                        </div>


                    </div>
                @else
                    <div class="flex items-center justify-center p-4 bg-gray-100 rounded-md">
                        <p class="mr-2 text-sm text-gray-600">Login to write a review</p>
                        <a href="{{ route('login') }}"
                            class="border p-1.5 bg-blue-500 px-5  border-black  rounded-xl  text-white">
                            Login
                        </a>
                    </div>
                @endif
            @else
                @if (!Session::get('memeber_id_ss'))
                    <div class="flex items-center justify-center p-4 bg-gray-100 rounded-md">
                        <p class="mr-2 text-sm text-gray-600">Login to write a review</p>
                        <a href="{{ route('login') }}"
                            class="border p-1.5 bg-blue-500 px-5  border-black  rounded-xl  text-white">
                            Login
                        </a>
                    </div>
                @else
                    <div class="flex items-center justify-center p-4 bg-gray-100 rounded-md">
                        <p class="mr-2 text-sm text-gray-600"> Purchase a product to leave a review.</p>

                    </div>
                @endif
            @endif
    </section>






    <section class="relative h-full py-5 bg-white shadow-md">
        <div class="w-full px-4 mx-auto max-w-7xl md:px-5 lg-6">
            <div class="w-full">
                <h2 class="mb-8 text-xl font-bold text-center text-black font-manrope">Our customer reviews
                </h2>
                <div
                    class="grid grid-cols-1 border-b border-gray-100 xl:grid-cols-2 gap-11 pb-11 max-xl:max-w-2xl max-xl:mx-auto">
                    <div class="flex flex-col w-full box gap-y-4 ">



                        <ul class="w-full pl-5 mt-2 mb-6 space-y-2 border-l-2">
                            @for ($i = 1; $i <= 5; $i++)
                                @php
                                    $count = $reviews->where('rating', $i)->count();
                                @endphp
                                <li class="flex items-center text-sm font-medium">
                                    <span class="w-3">{{ $i }}</span>
                                    <span class="mr-4 text-yellow-400">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20"
                                            fill="currentColor">
                                            <path
                                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                        </svg>
                                    </span>
                                    <div class="w-full h-2 mr-4 overflow-hidden bg-gray-300 rounded-full">
                                        @if ($count)
                                            <div class="h-full w-{{ $count * 2 }}/12 bg-yellow-400"></div>
                                        @else
                                            <div class="w-0 h-full bg-yellow-400"></div>
                                        @endif
                                    </div>
                                    <span class="w-3">{{ $count }}</span>
                                </li>
                            @endfor
                        </ul>

                    </div>
                    <div class="flex flex-col items-center justify-center p-5 rounded-2xl">
                        <h2 class="mb-3 text-xl font-bold font-manrope text-amber-400">
                            {{ $averagerating }}</h2>
                        <div class="flex items-center justify-center gap-1 mb-4 sm:gap-6">

                            @for ($i = 1; $i <= 5; $i++)
                                @php
                                    $fullStar = floor((int) $averagerating);
                                    $halfStar = ceil((int) $averagerating - (int) $fullStar);
                                @endphp
                                @if ($i <= $fullStar)
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-yellow-500"
                                        viewBox="0 0 20 20" fill="currentColor">
                                        <path
                                            d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                    </svg>
                                @elseif ($i == $fullStar + 1 && $halfStar)
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-yellow-500"
                                        viewBox="0 0 20 20" fill="currentColor">
                                        <path
                                            d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                    </svg>
                                @else
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-300"
                                        viewBox="0 0 20 20" fill="currentColor">
                                        <path
                                            d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                    </svg>
                                @endif
                            @endfor
                        </div>
                        <p class="text-xl font-medium leading-8 text-center text-gray-900">{{ $reviewcount }} Reviews</p>
                    </div>
                </div>


                @foreach ($allfeedback as $key => $feedback)
                    <div class="w-full pt-6 pb-8 border-b border-gray-100 max-xl:max-w-2xl max-xl:mx-auto">
                        <div class="flex items-center gap-2 mb-3">


                            @php
                                $rating = $feedback->rating;
                            @endphp

                        </div>


                        <div class="mb-4 transition-shadow duration-300 bg-white rounded-lg shadow-md hover:shadow-lg">
                            <div class="sm:flex items-center justify-between min-[400px]:flex-row w-full gap-4 p-3 ">

                                <div class="flex gap-x-3">

                                    <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/7/7e/Circle-icons-profile.svg/768px-Circle-icons-profile.svg.png"
                                        alt="Daley Bhai"
                                        class="object-cover w-10 h-10 border border-gray-300 rounded-full shadow-sm">

                                    <div>
                                        <h6 class="flex items-center gap-2 text-sm font-semibold leading-5 text-gray-800">
                                            {{ $feedback->cname->name ?? '' }}
                                        </h6>
                                        <div class="d-flex gap-x-2">

                                            @for ($i = 1; $i <= 5; $i++)
                                                <span class="cursor-pointer" get-data-rating="{{ $i }}">
                                                    <svg class="w-4 h-5 fill-current @if ($i <= $rating) text-yellow-500 @endif"
                                                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                                        <path
                                                            d="M12 2l2.25 6.722h7.161l-5.722 4.899 2.197 6.5-6.433-4.791-6.433 4.791 2.197-6.5-5.722-4.899h7.161z" />
                                                    </svg>
                                                </span>
                                            @endfor
                                        </div>


                                        <!-- Optional: Add feedback date or other information -->
                                        {{-- <p class="text-xs text-gray-500">Reviewed on
                                            {{ $feedback->created_at->format('F d, Y') }}</p> --}}
                                    </div>
                                </div>

                                <p class="text-sm font-normal leading-8 text-gray-500">
                                    {{ $feedback->created_at->format('F, d,Y') }}
                                </p>

                            </div>

                            <div class="px-3 pb-3 ">
                                {{ $feedback->review_detail }}
                            </div>




                            <div class="">


                                @if (Auth::guard('web')->user())
                                    <form method="POST" action="{{ route('admin.review.frontdelete', $feedback->id) }}"
                                        id="deletes-form-{{ $feedback->id }}">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" onclick="deleteSingleImage(event, {{ $feedback->id }})"
                                            class="flex px-2 py-1 mx-2 text-white bg-red-500">
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                class="icon icon-tabler icon-tabler-trash" width="24" height="24"
                                                viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                                fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                <path d="M4 7l16 0"></path>
                                                <path d="M10 11l0 6"></path>
                                                <path d="M14 11l0 6"></path>
                                                <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12"></path>
                                                <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3"></path>
                                            </svg>
                                        </button>
                                    </form>
                                    <script>
                                        function deleteSingleImage(event, imageId) {
                                            event.preventDefault();


                                            Swal.fire({
                                                title: 'Are you sure?',
                                                text: 'You will not be able to recover this !',
                                                icon: 'warning',
                                                showCancelButton: true,
                                                confirmButtonColor: '#d33',
                                                cancelButtonColor: '#3085d6',
                                                confirmButtonText: 'Yes, delete it!'
                                            }).then((result) => {
                                                if (result.isConfirmed) {
                                                    document.getElementById('deletes-form-' + imageId).submit();
                                                }
                                            });
                                        }
                                    </script>
                                @endif

                                {{-- <p class="text-sm font-normal leading-8 text-gray-400">
                                    {{ $feedback->created_at->format('F, d,Y') }}
                                </p> --}}

                            </div>


                        </div>

                        {{-- <p class="text-sm font-normal leading-8 text-gray-600 max-xl:text-justify">
                            {{ $feedback->review_detail }}</p> --}}
                    </div>
                @endforeach
            </div>
        </div>
    </section>



    <style>
        body {

            font-family: "Fira Sans", serif;
            font-weight: 400;
            font-style: normal;
        }

        .colored-toast.swal2-icon-success {
            background-color: #55ac23 !important;
        }

        .colored-toast.swal2-icon-error {

            background-color: #f27474 !important;
        }

        .colored-toast.swal2-icon-warning {
            background-color: #f8bb86 !important;
        }

        .colored-toast.swal2-icon-info {
            background-color: #3fc3ee !important;
        }

        .colored-toast.swal2-icon-question {
            background-color: #87adbd !important;
        }

        .colored-toast .swal2-title {
            color: white;
        }

        .colored-toast .swal2-close {
            color: white;
        }

        .colored-toast .swal2-html-container {
            color: white;
        }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.6/dist/sweetalert2.all.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.20/dist/sweetalert2.all.min.js"></script>
    <script>
        function incrementQuantity() {
            // let quantity = document.querySelector('#quantity');
            let availableStock = @json($product->availablestock);
            let quantity = document.querySelector('#quantity');

            let currentValue = parseInt(quantity.value, 10) || 0;
            if (currentValue >= availableStock) {

                toastr.error('Maximum quantity reached!');
                return;
            } else {

                quantity.value = currentValue + 1;
            }
        }

        function decrementQuantity() {

            let quantity = document.querySelector('#quantity');
            let currentValue = parseInt(quantity.value, 10) || 0;
            if (currentValue > 1) {
                quantity.value = currentValue - 1;
            }
        }
    </script>
@endsection
