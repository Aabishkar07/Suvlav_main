@php
	$setting= getSetting();
@endphp

<footer class="footer pb-20">
		<!-- Footer Top -->
		<div class="footer-top section">
			<div class="container">
				<div class="row">
					<div class="col-lg-6 col-md-6 col-12">
						<!-- Single Widget -->
						<div class="single-footer about">
							<div class="logo d-flex">
								{{-- <a href="index.html"><img width="100px" src="{{ asset('front_assets/images/logo.png') }}" alt="#"></a> --}}
								<h1 class="text-white text-3xl font-bold">Suvlav </h1>
							</div>

						
							<p class="text">{{ $setting['description'] }}</p>
							<div class="">
								<div class="row align-items-center">
									<!-- Column 1: Call to Action -->
									<div class="col-md-6  text-md-start mb-3 mb-md-0">
										<p class="call mb-0">
											Got Question? Call us 24/7 
											<span><a href="tel:123456789" class="text-primary">{{ $setting['site_phone'] }}</a></span>
										</p>
									</div>
							
									<!-- Column 2: Search Form -->
									{{-- <div class="col-md-6">
										<form action="{{ route('product.search') }}" method="GET" class="d-flex">
											<div class="input-group">
												<input 
													class="form-control rounded-pill text-xs pl-2" 
													name="query" 
													type="search" 
													id="form1" 
													placeholder="Search..." 
												/>
												<button 
													type="submit" 
													class="btn" 
													style="background-color: orange; color: white; border-radius: 0px; padding: 8px 16px; border: none;">
													Search
												</button>
											</div>
										</form>
									</div> --}}
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
								<li><a href="{{ url('/contactus')}}">Contact Us</a></li>
								<li><a href="{{ url('/faqs')}}">Faqs</a></li>

								<li><a href="{{ url('/termsandcondition')}}">Terms and Condition</a></li>
								<li><a href="{{ url('/privacypolicy')}}">Privacy Policy</a></li>


								
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
									<li>{{ $setting['address'] }}.</li>
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
								<p>Copyright © {{ date('Y') }} <a href="" target="_blank">Suvlav</a>  -  All Rights Reserved.</p>
							</div>
						</div>
						{{-- <div class="col-lg-6 col-12">
							<div class="right">
								<img src="{{ asset('front_assets/images/payments.png') }}" alt="#">
							</div>
						</div> --}}
					</div>
				</div>
			</div>
		</div>
	</footer>