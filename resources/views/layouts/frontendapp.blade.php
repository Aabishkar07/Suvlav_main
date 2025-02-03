<!DOCTYPE html>
<html lang="zxx">

<head>

    <!-- Meta Tag -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name='copyright' content=''>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>SuvLav E-commerce, Shopping site</title>

    <meta name="title" content="{{ 'SuvLav' }}" />
    <meta name="description" content={{ 'SuvLav E-commerce, Shopping site' }} />

    <meta property="twitter:url" content="{{ 'https://suvlav.com' }}" />
    <meta property="twitter:title" content="{{ 'SuvLav' }}" />
    <meta property="twitter:description" content="{{ 'SuvLav E-commerce, Shopping site' }}" />
    <meta property="twitter:image" content="{{ 'https://suvlav.com/public/front_assets/images/swastik.png' }}">


    <meta name="og:title" content="{{ 'SuvLav' }}" />
    <meta name="og:description" content="{{ 'SuvLav E-commerce, Shopping site' }}" />
    <meta property="og:image" content="https://suvlav.com/public/front_assets/images/swastik.png" />

    <script async src="https://www.googletagmanager.com/gtag/js?id=G-VS4PBD50JP"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'G-VS4PBD50JP');
    </script>

    <link rel="icon" type="image/png" href="{{ asset('front_assets/images/swastikk.jpeg') }}">
    <link
        href="https://fonts.googleapis.com/css?family=Poppins:200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('front_assets/css/bootstrap.css') }}">
    <!-- <link rel="stylesheet" href="{{ asset('front_assets/css/magnific-popup.min.css') }}"> -->
    <link rel="stylesheet" href="{{ asset('front_assets/css/font-awesome.css') }}">
    <!-- <link rel="stylesheet" href="{{ asset('front_assets/css/jquery.fancybox.min.css') }}"> -->
    <link rel="stylesheet" href="{{ asset('front_assets/css/themify-icons.css') }}">
    <!-- <link rel="stylesheet" href="{{ asset('front_assets/css/niceselect.css') }}"> -->
    <link rel="stylesheet" href="{{ asset('front_assets/css/animate.css') }}">
    <link rel="stylesheet" href="{{ asset('front_assets/css/flex-slider.min.css') }}">
    <link rel="stylesheet" href="{{ asset('front_assets/css/owl-carousel.css') }}">
    <link rel="stylesheet" href="{{ asset('front_assets/css/slicknav.min.css') }}">
    <link rel="stylesheet" href="{{ asset('front_assets/css/reset.css') }}">
    <link rel="stylesheet" href="{{ asset('front_assets/style.css?v=1.11') }}">
    <link rel="stylesheet" href="{{ asset('front_assets/css/responsive.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <script src="{{ asset('front_assets/js/jquery.min.js') }}"></script>

    <!-- Include Slick Slider -->

    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel/slick/slick.css" />
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel/slick/slick-theme.css" />

    <script src="https://cdn.jsdelivr.net/npm/jquery"></script>
    <script src="https://cdn.jsdelivr.net/npm/slick-carousel/slick/slick.min.js"></script>

<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-QXQR27LSBV"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-QXQR27LSBV');
</script>
</head>

<body class="js">

    <div class="fixed top-0 w-full md:bg-white" style="z-index: 99999;">


        <!-- Header -->



        <header class="header shop">
            <!-- Topbar -->

            <!-- End Topbar -->
            @include('front.common.header')
            <!-- Header Inner -->
            <!--/ End Header Inner -->
        </header>
    </div>
    <!--/ End Header -->

    <div class="mt-5 max-sm:mt-12 herosection">

        @yield('content')
    </div>


    <!-- Start Footer Area -->
    @include('front.common.footer')
    @php
        $searchHistory = json_decode(Cookie::get('search_history', '[]'), true);
    @endphp
    <div class="">
        @include('front.common.searchfooter')

    </div>
    <!-- /End Footer Area -->

    <!-- Jquery -->
    <script src="{{ asset('front_assets/js/jquery-migrate-3.0.0.js') }}"></script>
    <script src="{{ asset('front_assets/js/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('front_assets/js/popper.min.js') }}"></script>
    <script src="{{ asset('front_assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('front_assets/js/slicknav.min.js') }}"></script>
    <script src="{{ asset('front_assets/js/owl-carousel.js') }}"></script>
    <script src="{{ asset('front_assets/js/magnific-popup.js') }}"></script>
    <script src="{{ asset('front_assets/js/waypoints.min.js') }}"></script>
    <script src="{{ asset('front_assets/js/finalcountdown.min.js') }}"></script>
    <!-- <script src="{{ asset('front_assets/js/nicesellect.js') }}"></script> -->
    <script src="{{ asset('front_assets/js/flex-slider.js') }}"></script>
    {{-- <script src="{{ asset('front_assets/js/scrollup.js') }}"></script> --}}
    <script src="{{ asset('front_assets/js/onepage-nav.min.js') }}"></script>
    <script src="{{ asset('front_assets/js/easing.js') }}"></script>
    <script src="{{ asset('front_assets/js/active.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <script src="{{ asset('front_assets/js/easyshop.js') }}"></script>




    <script>
        $(document).ready(function() {
            $('.hero-slider').slick({
                dots: true,
                arrows: true,
                infinite: true,
                speed: 500,
                slidesToShow: 1,
                slidesToScroll: 1,
                autoplay: true,
                autoplaySpeed: 3000,
                responsive: [{
                    breakpoint: 768,
                    settings: {
                        arrows: false,
                        dots: true
                    }
                }]
            });
        });
    </script>

    <style>
        .hero-slider .single-slider {
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            background-size: cover;
            background-position: center;
        }
    </style>

</body>

</html>
