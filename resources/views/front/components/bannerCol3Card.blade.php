{{-- @php
    $image_url = $list->image != '' ? $list->image : '';
@endphp --}}




{{-- @switch($list->display_option)
    @case('1')
        @if ($display_option == $list->display_option)
            <div class="single-slider" style="background-image: url('{{ asset("public/".$image_url) }}');">
                <div class="container">
                    <div class="row no-gutters">
                        <div class="col-lg-9 offset-lg-3 col-12">
                            <div class="text-inner">
                                <div class="row">
                                    <div class="col-lg-7 col-12">
                                        <div class="hero-text">
                                            <h1>
                                                {!! $list->top_heading ? '<span>' . $list->top_heading . '</span>' : '' !!}
                                                {!! $list->main_heading ? $list->main_heading : '' !!}</h1>
                                            <p>{!! $list->short_desc ? wordwrap($list->short_desc, 45, "<br>\n") : '' !!}</p>
                                            @if ($list->btn_name && $list->btn_url)
                                                <div class="button">
                                                    <a href="{{ $list->btn_url }}" class="btn">{{ $list->btn_name }}</a>
                                                </div>
                                            @endif

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    @break

    @case('2')
        @if ($display_option == $list->display_option)
            <div class="col-lg-6 col-md-6 col-12">
                <div class="single-banner">
                    <img src="{{ asset($image_url) }}" alt="{{ $list->title }}">
                    <div class="content">
                        {!! $list->top_heading ? '<p>' . $list->top_heading . '</p>' : '' !!}
                        {!! $list->main_heading ? '<h3>' . $list->main_heading . '</h3>' : '' !!}
                        @if ($list->btn_name && $list->btn_url)
                            <a href="{{ $list->btn_url }}">{{ $list->btn_name }}</a>
                        @endif
                    </div>
                </div>
            </div>
        @endif
    @break

    @default
        @if ($display_option == $list->display_option)
            <div class="col-lg-4 col-md-6 col-12">
                <div class="single-banner">
                    <img src="{{ asset($image_url) }}" alt="{{ $list->title }}">
                    <div class="content">
                        {!! $list->top_heading ? '<p>' . $list->top_heading . '</p>' : '' !!}
                        {!! $list->main_heading ? '<h3>' . $list->main_heading . '</h3>' : '' !!}
                        @if ($list->btn_name && $list->btn_url)
                            <a href="{{ $list->btn_url }}">{{ $list->btn_name }}</a>
                        @endif
                    </div>
                </div>
            </div>
        @endif

@endswitch --}}




<link href="https://cdn.jsdelivr.net/npm/owl.carousel@2.3.4/dist/assets/owl.carousel.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/owl.carousel@2.3.4/dist/assets/owl.theme.default.min.css" rel="stylesheet">

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


<script src="https://cdn.jsdelivr.net/npm/owl.carousel@2.3.4/dist/owl.carousel.min.js"></script>


<div style="margin-top:71px">

</div>
<!-- Include Owl Carousel CSS -->
<link href="https://cdn.jsdelivr.net/npm/owl.carousel@2.3.4/dist/assets/owl.carousel.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/owl.carousel@2.3.4/dist/assets/owl.theme.default.min.css" rel="stylesheet">

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


<script src="https://cdn.jsdelivr.net/npm/owl.carousel@2.3.4/dist/owl.carousel.min.js"></script>


    
  
<div class="md:max-w-screen-2xl md:mx-auto">
    <div id="bannerCarousel" class="owl-carousel owl-theme">
        @foreach ($home_banners as $key => $product)
            <div class="item">
                <a href="#" class="text-decoration-none">
                    <div class="card border-0 shadow-sm relative single-banner">
                     
                        <div class="relative h-[470px]">
                            <img src="{{ asset('public/' . $product->image) }}" class="card-img-top img-fluid h-100 w-full object-contain" alt="Banner">
                        
                       
                            <div class="absolute inset-0 flex items-center justify-center">
                                <div class="text-center text-orange-500 p-4">
                                    {!! $product->top_heading ? '<p class="text-sm font-semibold text-orange-500">' . $product->top_heading . '</p>' : '' !!}
                                    {!! $product->main_heading ? '<h3 class="text-xl font-bold">' . $product->main_heading . '</h3>' : '' !!}
                                   <div class="mt-3">

                               
                                    @if ($product->btn_name && $product->btn_url)
                                        <a class="bg-orange-500 text-white p-2 mt-5 text-xs rounded-md" href="{{ $product->btn_url }}">{{ $product->btn_name }}</a>
                                    @endif
                                </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        @endforeach
    </div>
</div>



<script>
    $(document).ready(function(){
        $("#bannerCarousel").owlCarousel({
            items: 4,            
            margin: 10,          
            loop: true,          
            autoplay: true,      
            autoplayTimeout: 2000,  
            autoplayHoverPause: true,  
            nav: false,          
            // navText: [
            //     "<span class='carousel-control-prev-icon bg-dark rounded-circle p-3' aria-hidden='true'></span>",
            //     "<span class='carousel-control-next-icon bg-dark rounded-circle p-3' aria-hidden='true'></span>"
            // ],
            responsive: {
                0: {
                    items: 1, 
                },
                576: {
                    items: 2,  
                },
                768: {
                    items: 3,  
                },
                992: {
                    items: 4,  
            }
        }
        });
    });
</script>






