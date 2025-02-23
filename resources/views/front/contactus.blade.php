@extends('layouts.frontendapp')
@section('content')
    @php
        $setting = getSetting();
    @endphp
    <script src="https://www.google.com/recaptcha/enterprise.js?render=6LfFAuAqAAAAAHitLbft9rSa7H6QVT8VNCzYW-K7"></script>
    <!-- Start Contact -->
    <section id="contact-us" class="contact-us section">
        <div class="container">
            <div class="contact-head">
                <div class="row">
                    <div class="col-lg-8 col-12">
                        @if (Session::has('message'))
                            <p class="alert alert-info">{{ Session::get('message') }}</p>
                        @endif
                        <div class="form-main">
                            <div class="title">
                                <h4>Get in touch</h4>
                                <h3>Write us a message</h3>
                            </div>
                            <form id="submitform" class="form" method="post" action="{{ url('/contactmail') }}">
                                @csrf
                                <div class="row">
                                    <div class="col-lg-6 col-12">
                                        <div class="form-group">
                                            <label>Your Name<span>*</span></label>
                                            <input name="name" type="text" placeholder="" required>
                                        </div>
                                    </div>
                                    <input type="hidden" name="g-token" id="g-token" value="" />

                                    <div class="col-lg-6 col-12">
                                        <div class="form-group">
                                            <label>Your Subjects<span>*</span></label>
                                            <input name="subject" type="text" placeholder="" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-12">
                                        <div class="form-group">
                                            <label>Your Email<span>*</span></label>
                                            <input name="email" type="email" placeholder="" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-12">
                                        <div class="form-group">
                                            <label>Your Phone<span>*</span></label>
                                            <input name="phone_no" type="text" placeholder="">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group message">
                                            <label>your message<span>*</span></label>
                                            <textarea name="message" placeholder=""></textarea>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group button">
                                            <button id="buttonsubmit" type="button" onclick="onClick()" class="btn ">Send Message</button>
                                        </div>
                                    </div>
                                </div>
                            </form>

                            <script>
                                function onClick(e) {
                                    alert("aa")
        
                                    grecaptcha.enterprise.ready(async () => {
                                        const token = await grecaptcha.enterprise.execute('6LfFAuAqAAAAAHitLbft9rSa7H6QVT8VNCzYW-K7', {
                                            action: 'LOGIN'
                                        });
        
                                        console.log("token", token)
                                      
                                        document.getElementById("g-token").value = token;
                                        document.getElementById("submitform").submit();
                                    });
                                }
                            </script>
                        </div>
                    </div>
                    <div class="col-lg-4 col-12">
                        <div class="single-head">
                            <div class="single-info">
                                <i class="fa fa-phone"></i>
                                <h4 class="title">Call us Now:</h4>
                                <ul>
                                    <li>{{ $setting['site_phone'] }}</li>
                                </ul>
                            </div>
                            <div class="single-info">
                                <i class="fa fa-envelope-open"></i>
                                <h4 class="title">Email:</h4>
                                <ul>
                                    <li><a href="mailto:{{ $setting['site_email'] }}">{{ $setting['site_email'] }}</a></li>
                                </ul>
                            </div>
                            <div class="single-info">
                                <i class="fa fa-location-arrow"></i>
                                <h4 class="title">Our Address:</h4>
                                <ul>
                                    <li>{{ $setting['address'] }}.</li>
                                </ul>
                            </div>

                            <div class="single-info">
                                <ul class="d-flex social-links">
                                    <li class="p-2"><a href="{{ $setting['facebook_link'] }}" target="_blank"><i
                                                class="ti-facebook"></i></a></li>
                                    <li class="p-2"><a href="{{ $setting['youtube_link'] }}" target="_blank"><i
                                                class="ti-youtube"></i></a></li>
                                    <li class="p-2"><a href="{{ $setting['instagram_link'] }}" target="_blank"><i
                                                class="ti-instagram"></i></a></li>
                                </ul>
                            </div>

                            <style>
                                .social-links {
                                    justify-content: start;
                                }

                                @media (max-width: 768px) {
                                    .social-links {
                                        justify-content: center;
                                    }
                                }
                            </style>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--/ End Contact -->

    <!-- Map Section -->
    <!-- <div class="map-section">
      <div id="myMap"></div>
     </div> -->
    <!--/ End Map Section -->
@endsection
