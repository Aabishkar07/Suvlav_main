@php
    $setting = getSetting();
@endphp

<style>
    footer {
        color: black !important;
        background-color: white !important;
    }

    .footer-top {
        background-color: white !important;
    }

    .single-footer h4,
    .single-footer p,
    .single-footer ul li a,
    .single-footer .contact ul li,
    .copyright p {
        color: black !important;
    }

    .single-footer ul li a:hover {
        text-decoration: underline;
        color: black !important;
    }

    .btn {
        background-color: black !important;
        color: white !important;
    }

    .btn:hover {
        background-color: gray !important;
        color: white !important;
    }
</style>

<footer class="pb-20 footer">
    <!-- Footer Top -->
    <div class="footer-top section">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-12">
                    <!-- Single Widget -->
                    <div class="single-footer about">
                        <div class="logo d-flex">
                            {{-- <a href="index.html"><img width="100px" src="{{ asset('front_assets/images/logo.png') }}" alt="#"></a> --}}
                            <h1 class="text-3xl font-bold text-black">Suvlav</h1>
                        </div>

                        <p>{{ $setting['description'] }}</p>
                        <div class="">
                            <div class="row align-items-center">
                                <!-- Column 1: Call to Action -->
                                <div class="mb-3 col-md-6 text-md-start mb-md-0">
                                    <p class="mb-0 call">
                                        Got Question? Call us 24/7
                                        <span><a href="tel:123456789" class="text-primary">{{ $setting['site_phone'] }}</a></span>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Single Widget -->
                </div>

                <div class="col-lg-3 col-md-6 col-12">
                    <!-- Single Widget -->
                    <div class="single-footer links">
                        <h4>Information</h4>
                        <ul>
                            <li><a href="{{ url('/') }}">Home</a></li>
                            <li><a href="{{ url('/contactus') }}">Contact Us</a></li>
                            <li><a href="{{ url('/faqs') }}">Faqs</a></li>
                            <li><a href="{{ url('/termsandcondition') }}">Terms and Condition</a></li>
                            <li><a href="{{ url('/privacypolicy') }}">Privacy Policy</a></li>
                        </ul>
                    </div>
                    <!-- End Single Widget -->
                </div>

                <div class="col-lg-3 col-md-6 col-12">
                    <!-- Single Widget -->
                    <div class="single-footer social">
                        <h4>Get In Touch</h4>
                        <!-- Single Widget -->
                        <div class="contact">
                            <ul>
                                <li>{{ $setting['address'] }}</li>
                                <li>{{ $setting['site_email'] }}</li>
                                <li>{{ $setting['site_phone'] }}</li>
                            </ul>
                        </div>
                        <!-- End Single Widget -->
                        <ul>
                            <li><a href="{{ $setting['facebook_link'] }}" target="_blank"><i class="ti-facebook"></i></a></li>
                            <li><a href="{{ $setting['youtube_link'] }}" target="_blank"><i class="ti-youtube"></i></a></li>
                            <li><a href="{{ $setting['instagram_link'] }}" target="_blank"><i class="ti-instagram"></i></a></li>
                        </ul>
                    </div>
                    <!-- End Single Widget -->
                </div>
            </div>
        </div>
    </div>
    <!-- End Footer Top -->

    <div class="copyright">
        <div class="container">
            <div class="inner">
                <div class="row">
                    <div class="col-lg-6 col-12">
                        <div class="left">
                            <p>Copyright © {{ date('Y') }} <a href="" target="_blank">Suvlav</a> - All Rights Reserved.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
