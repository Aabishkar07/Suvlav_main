@extends('layouts.frontendapp')
@section('content')
    <!-- Main Banner  -->







    <section class="hero-slider">
        @foreach ($home_banners as $list)
            @include('front.components.bannerCol3Card', ['list' => $list, 'display_option' => '1'])
        @endforeach
    </section>




    <!--/ End Main Banner  -->



    <!-- Start Most Popular -->
    <div class="product-area most-popular section ">
        <div class="container">
            {{-- <div class="row">
                <div class="col-12">
                    <div class="section-title">
                        <h2>Featured Products</h2>
                    </div>
                </div>
            </div> --}}


            <div class="container">
                <div class="d-flex justify-content-between align-items-center flex-wrap">
                    <!-- Title -->
                    <h2 class="Featured Products  text-black text-2xl text-start fs-3" style="font-weight: 600">
                        Featured Products
                    </h2>
                    
                    <a href="{{ route('featuredproduct') }}" class="text-decoration-none">
                        <div class="d-none d-sm-flex align-items-center gap-2 text-danger hover-underline">
                            View All
                            <div class="bg-danger text-white rounded-circle p-1 d-flex justify-content-center align-items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" width="24" height="24">
                                    <path d="M12 2l.324 .005a10 10 0 1 1 -.648 0l.324 -.005zm.613 5.21a1 1 0 0 0 -1.32 1.497l2.291 2.293h-5.584l-.117 .007a1 1 0 0 0 .117 1.993h5.584l-2.291 2.293l-.083 .094a1 1 0 0 0 1.497 1.32l4 -4l.073 -.082l.064 -.089l.062 -.113l.044 -.11l.03 -.112l.017 -.126l.003 -.075l-.007 -.118l-.029 -.148l-.035 -.105l-.054 -.113l-.071 -.111a1.008 1.008 0 0 0 -.097 -.112l-4 -4z"></path>
                                  </svg>
                            </div>
                        </div>
            
                        <!-- For smaller screens -->
                        <div class="d-flex d-sm-none">
                            <span class="text-danger">View All</span>
                        </div>
                    </a>
                </div>
            
                <!-- Divider -->
                <div class="d-flex py-4">
                    <div class="flex-shrink-0" style="width: 10%; border-top: 2px solid #ff6f10;"></div>
                    <div class="flex-grow-1 border-top"></div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="owl-carousel popular-slider" style="margin-top: -15px;">
                        <!-- Slider Product -->
                        @foreach ($home_prod_featured as $list)
                            @include('front.components.productcard', ['list' => $list, 'slider' => '1'])
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Most Popular Area -->

    <!-- Start Product Area -->
    <div class="product-area section">
        
        <div class="container">
            {{-- <div class="row">
                <div class="col-12">
                    <div class="section-title">
                        <h2>New Arrivals</h2>
                    </div>
                </div>
            </div> --}}

            <div class="container">
                <div class="d-flex justify-content-between align-items-center flex-wrap">
                    <!-- Title -->
                    <h2 class="New Arrivals  text-black text-2xl text-start fs-3" style="font-weight: 600">
                        New Arrivals
                    </h2>
                    
                    <a href="{{ route('newarrivals') }}" class="text-decoration-none">
                        <div class="d-none d-sm-flex align-items-center gap-2 text-danger hover-underline">
                            View All
                            <div class="bg-danger text-white rounded-circle p-1 d-flex justify-content-center align-items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" width="24" height="24">
                                    <path d="M12 2l.324 .005a10 10 0 1 1 -.648 0l.324 -.005zm.613 5.21a1 1 0 0 0 -1.32 1.497l2.291 2.293h-5.584l-.117 .007a1 1 0 0 0 .117 1.993h5.584l-2.291 2.293l-.083 .094a1 1 0 0 0 1.497 1.32l4 -4l.073 -.082l.064 -.089l.062 -.113l.044 -.11l.03 -.112l.017 -.126l.003 -.075l-.007 -.118l-.029 -.148l-.035 -.105l-.054 -.113l-.071 -.111a1.008 1.008 0 0 0 -.097 -.112l-4 -4z"></path>
                                  </svg>
                            </div>
                        </div>
            
                        <!-- For smaller screens -->
                        <div class="d-flex d-sm-none">
                            <span class="text-danger">View All</span>
                        </div>
                    </a>
                </div>
            
                <!-- Divider -->
                <div class="d-flex py-4">
                    <div class="flex-shrink-0" style="width: 10%; border-top: 2px solid #ff6f10;"></div>
                    <div class="flex-grow-1 border-top"></div>
                </div>
            </div>

            

            
            <div class="row">
                <div class="col-12">
                    <div class="product-info" style="margin-top: -15px;">
                        <div class="row">
                            @foreach ($home_prod_new_arrivals as $list)
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



    <div class="product-area section mt-5">
        <div class="container">
     
            <div class="row">
                <div class="col-12">
                    <div class="product-info" style="margin-top: -15px;">
                        <div class="row">
                            {{-- @foreach ($home_prod_new_arrivals as $list)
							@include('front.components.productcard', ['list' => $list, 'slider' => '0'])
							@endforeach									 --}}

                                @include('front.blog.index')
                          
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>







    <!-- Start Product Categories  -->
    <!-- <section class="shop-home-list section">
      <div class="container">
       <div class="row">
        <div class="col-12">
        <div class="shop-section-title">
         <h1>Product categories</h1>
        </div>
          <div class="row">
           @foreach ($categories as $list)
    @include('front.components.productCatCard', ['list' => $list])
    @endforeach
          </div>
        </div>
       </div>
      </div>
     </section> -->
    <!-- End Shop Home List  -->


    <!-- Start Shop Services Area -->
    <section class="shop-services section home">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-12">
                    <!-- Start Single Service -->
                    <div class="single-service">
                        <i class="ti-rocket"></i>
                        <h4>Free shiping</h4>
    <p>Orders over Rs 1000</p> 
                    </div>
                    <!-- End Single Service -->
                </div>
                <div class="col-lg-3 col-md-6 col-12">
                    <!-- Start Single Service -->
                    <div class="single-service">
                        <i class="ti-reload"></i>
                        <h4>Exchange</h4>
                        <p>Within 7 days</p>
                    </div>
                    <!-- End Single Service -->
                </div>
                <div class="col-lg-3 col-md-6 col-12">
                    <!-- Start Single Service -->
                    <div class="single-service">
                        <i class="ti-lock"></i>
                        <h4>Sucure Payment</h4>
                        <p>100% secure payment</p>
                    </div>
                    <!-- End Single Service -->
                </div>
                <div class="col-lg-3 col-md-6 col-12">
                    <!-- Start Single Service -->
                    <div class="single-service">
                        <i class="ti-tag"></i>
                        <h4>Best Peice</h4>
                        <p>Guaranteed price</p>
                    </div>
                    <!-- End Single Service -->
                </div>
            </div>
        </div>
    </section>
    <!-- End Shop Services Area -->

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span class="ti-close"
                            aria-hidden="true"></span></button>
                </div>
                <div class="modal-body">
                    <div class="row no-gutters">
                        <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                            <!-- Product Slider -->
                            <div class="product-gallery">
                                <div class="quickview-slider-active">
                                    <div class="single-slider">
                                        <img src="https://via.placeholder.com/569x528" alt="#">
                                    </div>
                                    <div class="single-slider">
                                        <img src="https://via.placeholder.com/569x528" alt="#">
                                    </div>
                                    <div class="single-slider">
                                        <img src="https://via.placeholder.com/569x528" alt="#">
                                    </div>
                                    <div class="single-slider">
                                        <img src="https://via.placeholder.com/569x528" alt="#">
                                    </div>
                                </div>
                            </div>
                            <!-- End Product slider -->
                        </div>
                        <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                            <div class="quickview-content">
                                <h2>Flared Shift Dress</h2>
                                <div class="quickview-ratting-review">
                                    <div class="quickview-ratting-wrap">
                                        <div class="quickview-ratting">
                                            <i class="yellow fa fa-star"></i>
                                            <i class="yellow fa fa-star"></i>
                                            <i class="yellow fa fa-star"></i>
                                            <i class="yellow fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                        </div>
                                        <a href="#"> (1 customer review)</a>
                                    </div>
                                    <div class="quickview-stock">
                                        <span><i class="fa fa-check-circle-o"></i> in stock</span>
                                    </div>
                                </div>
                                <h3>$29.00</h3>
                                <div class="quickview-peragraph">
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Mollitia iste laborum ad
                                        impedit pariatur esse optio tempora sint ullam autem deleniti nam in quos qui nemo
                                        ipsum numquam.</p>
                                </div>
                                <div class="size">
                                    <div class="row">
                                        <div class="col-lg-6 col-12">
                                            <h5 class="title">Size</h5>
                                            <select>
                                                <option selected="selected">s</option>
                                                <option>m</option>
                                                <option>l</option>
                                                <option>xl</option>
                                            </select>
                                        </div>
                                        <div class="col-lg-6 col-12">
                                            <h5 class="title">Color</h5>
                                            <select>
                                                <option selected="selected">orange</option>
                                                <option>purple</option>
                                                <option>black</option>
                                                <option>pink</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="quantity">
                                    <!-- Input Order -->
                                    <div class="input-group">
                                        <div class="button minus">
                                            <button type="button" class="btn btn-primary btn-number" disabled="disabled"
                                                data-type="minus" data-field="quant[1]">
                                                <i class="ti-minus"></i>
                                            </button>
                                        </div>
                                        <input type="text" name="quant[1]" class="input-number" data-min="1"
                                            data-max="1000" value="1">
                                        <div class="button plus">
                                            <button type="button" class="btn btn-primary btn-number" data-type="plus"
                                                data-field="quant[1]">
                                                <i class="ti-plus"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <!--/ End Input Order -->
                                </div>
                                <div class="add-to-cart">
                                    <a href="#" class="btn">Add to cart</a>
                                    <a href="#" class="btn min"><i class="ti-heart"></i></a>
                                    <a href="#" class="btn min"><i class="fa fa-compress"></i></a>
                                </div>
                                <div class="default-social">
                                    <h4 class="share-now">Share:</h4>
                                    <ul>
                                        <li><a class="facebook" href="#"><i class="fa fa-facebook"></i></a></li>
                                        <li><a class="twitter" href="#"><i class="fa fa-twitter"></i></a></li>
                                        <li><a class="youtube" href="#"><i class="fa fa-pinterest-p"></i></a></li>
                                        <li><a class="dribbble" href="#"><i class="fa fa-google-plus"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal end -->
@endsection
