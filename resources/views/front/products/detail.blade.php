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
                                                echo '<span class="discount">' .
                                                    moneyFormat($product->sale_price) .
                                                    '</span><s>' .
                                                    moneyFormat($product->regular_price) .
                                                    '</s>';
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
                                                <button type="button" class="btn btn-primary btn-number"
                                                     data-type="minus" data-field="quant[1]">
                                                    <i class="ti-minus"></i>
                                                </button>
                                            </div>
                                            <input type="number" id="quantity" name="quant[1]" class="input-number"
                                                data-min="1" data-max="1000" value="1">
                                            <div onclick="incrementQuantity()" class="button plus">
                                                <button type="button" class="btn btn-primary btn-number" data-type="plus"
                                                    data-field="quant[1]">
                                                    <i class="ti-plus"></i>
                                                </button>
                                            </div>
                                        </div>
                                        <!--/ End Input Order -->
                                    </div>
                                    <div class="add-to-cart mt-3">
                                        <input type="hidden" id="cart_color" value="{{ $productDefaultColor }}">
                                        <input type="hidden" id="cart_size" value="{{ $productDefaultSize }}">
                                        <input type="hidden" name="cart_url" value="{{ route('cart.addtocart') }}">
                                        <button type="button" class="btn addtocart"
                                            onclick="addToCart(this, {{ $product->id }}, '{{ csrf_token() }}', '{{ route('cart.addtocart') }}', 'single');">
                                            Add to Cart </button>

                                        <style>
                                            .addtocart {
                                                background-color: #316FF6 !important;
                                                border: 1px solid #316FF6;
                                                color:white !important;
                                                border-radius: 40px !important;
                                            }
                                            .addtocart:hover {
                                                background-color: #ffffff !important;
                                                color: #316FF6 !important;
                                            
                                            }
                                        </style>

                                        <button type="button" class="btn buynow"
                                            onclick="mybuynow(this, {{ $product->id }}, '{{ csrf_token() }}', '{{ route('cart.addtocart') }}', 'buy');">
                                            Buy Now</button>

                                            <style>
                                                .buynow {
                                                    background-color: #ffffff !important;
                                                    border: 1px solid #316FF6;
                                                    color:#316FF6 !important;
                                                    border-radius: 40px !important;
                                                }
                                             
                                            </style>
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
                                                color:white !important;
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
    </section>
    
     <script>
                                        function incrementQuantity() {

                                            let quantity = document.querySelector('#quantity');
                                            let currentValue = parseInt(quantity.value, 10) || 0;
                                            quantity.value = currentValue + 1;
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
