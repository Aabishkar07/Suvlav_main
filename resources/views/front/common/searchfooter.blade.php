@php
	$setting= getSetting();
@endphp

<footer class="lg:bg-[#222] fixed w-full z-50 bottom-0 border-top border-top-1">
	
		<!-- End Footer Top -->
		<div class="copyright">
			<div class="container">
				<div class="">
					<div class="row">
						
						<div class="col-lg-6 col-12">
							<div class="left">
                                {{-- <form action="{{ route('product.search') }}" method="GET" class="d-flex">
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
                                </form> --}}
                                <div class="bg-white flex items-center border rounded-lg shadow-lg max-md:order-1 border-transparent focus-within:border-black focus-within:bg-gray-50 px-1 py-2 rounded-lg h-12 min-w-[40%] lg:w-2/4 max-md:w-full transition-all duration-300">
                                    <!-- Search Form -->
                                    <form action="{{ route('product.search') }}" method="GET" class="w-full flex items-center">
                                        <!-- Search Icon -->
                                        <!--<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 192.904 192.904" class="fill-gray-400 mr-3 w-4 h-4 max-md:w-3 max-md:h-3">-->
                                        <!--    <path d="m190.707 180.101-47.078-47.077c11.702-14.072 18.752-32.142 18.752-51.831C162.381 36.423 125.959 0 81.191 0 36.422 0 0 36.423 0 81.193c0 44.767 36.422 81.187 81.191 81.187 19.688 0 37.759-7.049 51.831-18.751l47.079 47.078a7.474 7.474 0 0 0 5.303 2.197 7.498 7.498 0 0 0 5.303-12.803zM15 81.193C15 44.694 44.693 15 81.191 15c36.497 0 66.189 29.694 66.189 66.193 0 36.496-29.692 66.187-66.189 66.187C44.693 147.38 15 117.689 15 81.193z"></path>-->
                                        <!--</svg>-->
                                
                                        <!-- Search Input -->
                                        <input 
                                            type="text" 
                                            name="query" 
                                            placeholder="Search..." 
                                            class="w-full outline-none bg-transparent text-black text-sm focus:ring-2 focus:ring-black focus:border-transparent transition-all duration-300 px-1 py-2 rounded-lg" 
                                            required
                                        />
                                
                                        <!-- Submit Button -->
                                        <button type="submit" class="ml-2 p-1 px-3 bg-black text-white text-sm font-semibold rounded-lg hover:bg-black hover:text-white border-2 border-transparent hover:border-white focus:outline-none focus:ring-2 focus:ring-black transition-all duration-300 ease-in-out transform hover:scale-105 shadow-lg">
                                            Search
                                        </button>
                                    </form>
                                </div>

								{{-- <img src="{{ asset('front_assets/images/payments.png') }}" alt="#"> --}}
							</div>
						</div>

                        <div class="col-lg-6 col-12">
                            <?php if (Session::get('memeber_email_ss') != ''): ?>
                            <div class="right flex items-center">
                                <p>My Points {{ $userdata[0]->total_points ?? 0 }}</p>
                            </div>
                            <?php else: ?>
                            <div class="right flex items-center">
                                {{-- <p>                            <a href="{{ url('/memberloginform') }}" style="display: inline;" class="login-btn">Login</a>
                                </p> --}}
                            </div>
                            <?php endif; ?>
                            
                            
						</div>
					</div>
				</div>
			</div>
		</div>
	</footer>