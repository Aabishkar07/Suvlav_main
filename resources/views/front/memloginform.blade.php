{{-- @extends('layouts.frontendapp')
@section('content')
<style>
	/* Style the tab */
.tab {
  overflow: hidden;
  border: 1px solid #ccc;
  background-color: #f1f1f1;
}


/* Style the tab content */
.tabcontent {
  padding: 6px 12px;
  border: 1px solid #ccc;
}
#submitbtm{
	width: 220px;
	text-align: center;
	height: 35px;
	background-color: orange;
	color: #FFF;
	display: block;
	margin: 10px auto;
}
.fulllg{ width: 100%;}
.form-group label{width: 80px;}
.form-group{ margin-top: 16px; margin-bottom: 5px;}
.form-group input{ width: 240px;}
.btn{ background-color: #000!important;}
.signup{text-align: center; display: block; margin: 0px auto;}
.signup a{ color: #125ee0; padding-left: 10px; font-weight: 500; text-decoration: underline;}
.acenter{ margin: 0px auto;}
.rembcheck{margin-left: 82px;}
</style>		
<section class="shop checkout section">
			<div class="container">
				<div class="row"> 
					<div class="col-lg-8 col-12 acenter">
					
						<div class="checkout-form">
							<h2>Login Form </h2><br>
							<!--<p>Please register in order to checkout more quickly</p> -->
							

							<!-- Tab content -->
							<div id="login" class="tabcontent">
							
							@if ($errors->any())
							<div class="error_msg">{{$errors->first()}}</div>
							@endif
							<form class="forms-sample" action="{{ route('member.login') }}" method="POST">
							@csrf
							<input type="hidden" name="prev_url" value="<?php echo url()->previous(); ?>" >
									<div class="row">
										<div class="col-lg-6 col-md-6 col-12">
											<div class="form-group">
												<label>Email<span>*</span></label>
												<input type="email" name="email" placeholder="" required="required">
											</div>
										</div>
										<div class="col-lg-6 col-md-6 col-12">
											<div class="form-group">
												<label>Password<span>*</span></label>
												<input type="password" name="password" placeholder="" required="required">
											</div>
										</div>
									</div>

									<div class="row fulllg">
										<div class="col-lg-12 col-md-12 col-12">
												<input type="submit" name="loginsmt" id="submitbtm" value="Login">
										</div>
									</div>
									<div class="row fulllg signup">
									<a href="{{'/forgotpwform'}}">Forgot your password?</a>
									<br> Don't have an account? <a href="{{ route('member.reg')}}"> Sign Up </a>
									
									</div>
								</form>
							</div>
							
						<!-- Start login and register form -->
					
				</div>
			</div>
		</section>
		
@endsection --}}


@extends('layouts.frontendapp')
@section('content')
    <style>
        /* General Styles */
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
        }

        /* .checkout-section {
            padding: 40px 0;
            margin: 50px;
        } */

    .form-wrapper {
        background: #ffffff;
        padding: 30px 40px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        border-radius: 8px;
    }

    h2 {
        font-size: 28px;
        font-weight: 600;
        margin-bottom: 20px;
        text-align: center;
        color: #333333;
    }

    .form-group {
        margin-bottom: 20px;
    }

    .form-group label {
        font-weight: 600;
        color: #555555;
        margin-bottom: 8px;
        display: block;
    }

    .form-group input {
        width: 100%;
        padding: 10px;
        border: 1px solid #dddddd;
        border-radius: 5px;
        font-size: 16px;
    }

    #submitbtm {
        width: 100%;
        height: 45px;
        background-color: #125ee0;
        color: #ffffff;
        font-size: 18px;
        font-weight: bold;
        border: none;
        border-radius: 5px;
        transition: background-color 0.3s ease;
        cursor: pointer;
    }

    #submitbtm:hover {
        background-color: white;
		color: #125ee0;
        border: 1px solid #125ee0;
    }

    .forgot-password {
        text-align: right;
        font-size: 14px;
        margin-bottom: 10px;
    }

    .forgot-password a {
        color: #125ee0;
        text-decoration: none;
        font-weight: 500;
    }

    .forgot-password a:hover {
        text-decoration: underline;
    }

    .signup {
        text-align: center;
        font-size: 16px;
        margin-top: 15px;
    }

    .signup a {
        color: #125ee0;
        font-weight: 600;
        text-decoration: underline;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .form-wrapper {
            background: #ffffff;
            padding: 30px 40px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        h2 {
            font-size: 28px;
            font-weight: 600;
            margin-bottom: 20px;
            text-align: center;
            color: #333333;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            font-weight: 600;
            color: #555555;
            margin-bottom: 8px;
            display: block;
        }

        .form-group input {
            width: 100%;
            padding: 10px;
            border: 1px solid #dddddd;
            border-radius: 5px;
            font-size: 16px;
        }

        #submitbtm {
            width: 100%;
            height: 45px;
            background-color: black;
            color: #ffffff;
            font-size: 18px;
            font-weight: bold;
            border: none;
            border-radius: 5px;
            transition: background-color 0.3s ease;
            cursor: pointer;
        }

        #submitbtm:hover {
            background-color: white;
            color: #000;
        }

        .forgot-password {
            text-align: right;
            font-size: 14px;
            margin-bottom: 10px;
        }

        .forgot-password a {
            color: #125ee0;
            text-decoration: none;
            font-weight: 500;
        }

        .forgot-password a:hover {
            text-decoration: underline;
        }

        .signup {
            text-align: center;
            font-size: 16px;
            margin-top: 15px;
        }

        .signup a {
            color: #125ee0;
            font-weight: 600;
            text-decoration: underline;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .form-wrapper {
                padding: 20px 15px;
            }

            h2 {
                font-size: 24px;
            }
        }
    </style>

    <section class=" m-2  md:p-[2px] ">
        <div class="">
            <div class="row justify-content-center">
                <div class="col-lg-6 col-md-8">
                    <div class="my-5 form-wrapper">
                        <h2>Login</h2>
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                {{ $errors->first() }}
                            </div>
                        @endif
                        <form action="{{ route('member.login') }}" method="POST">
                            @csrf
                            <input type="hidden" name="prev_url" value="{{ url()->previous() }}">
                            <div class="form-group">
                                <label for="email">Email <span>*</span></label>
                                <input type="email" id="email" name="email" placeholder="Enter your email" required>
                            </div>
                            <div class="form-group">
                                <label for="password">Password <span>*</span></label>
                                <input type="password" id="password" name="password" placeholder="Enter your password"
                                    required>
                            </div>
                            <div class="forgot-password">
                                <a href="{{ url('/forgotpwform') }}">Forgot your password?</a>
                            </div>
                            <button type="submit" id="submitbtm">Login</button>


                        </form>
                        <div class="w-full my-4 sm:flex gap-x-2">

                            <a  href="{{ route('google.redirect') }}"
                                class="flex items-center px-6 py-2 text-sm font-medium text-gray-800 bg-white border border-gray-300 rounded-lg shadow-md max-sm:mb-2 sm:w-1/2 hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                                <svg class="w-6 h-6 mr-2" xmlns="http://www.w3.org/2000/svg"
                                    xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="-0.5 0 48 48" version="1.1">

                                    <g id="Icons" stroke="none" stroke-width="1" fill="none"
                                        fill-rule="evenodd">
                                        <g id="Color-" transform="translate(-401.000000, -860.000000)">
                                            <g id="Google" transform="translate(401.000000, 860.000000)">
                                                <path
                                                    d="M9.82727273,24 C9.82727273,22.4757333 10.0804318,21.0144 10.5322727,19.6437333 L2.62345455,13.6042667 C1.08206818,16.7338667 0.213636364,20.2602667 0.213636364,24 C0.213636364,27.7365333 1.081,31.2608 2.62025,34.3882667 L10.5247955,28.3370667 C10.0772273,26.9728 9.82727273,25.5168 9.82727273,24"
                                                    id="Fill-1" fill="#FBBC05"> </path>
                                                <path
                                                    d="M23.7136364,10.1333333 C27.025,10.1333333 30.0159091,11.3066667 32.3659091,13.2266667 L39.2022727,6.4 C35.0363636,2.77333333 29.6954545,0.533333333 23.7136364,0.533333333 C14.4268636,0.533333333 6.44540909,5.84426667 2.62345455,13.6042667 L10.5322727,19.6437333 C12.3545909,14.112 17.5491591,10.1333333 23.7136364,10.1333333"
                                                    id="Fill-2" fill="#EB4335"> </path>
                                                <path
                                                    d="M23.7136364,37.8666667 C17.5491591,37.8666667 12.3545909,33.888 10.5322727,28.3562667 L2.62345455,34.3946667 C6.44540909,42.1557333 14.4268636,47.4666667 23.7136364,47.4666667 C29.4455,47.4666667 34.9177955,45.4314667 39.0249545,41.6181333 L31.5177727,35.8144 C29.3995682,37.1488 26.7323182,37.8666667 23.7136364,37.8666667"
                                                    id="Fill-3" fill="#34A853"> </path>
                                                <path
                                                    d="M46.1454545,24 C46.1454545,22.6133333 45.9318182,21.12 45.6113636,19.7333333 L23.7136364,19.7333333 L23.7136364,28.8 L36.3181818,28.8 C35.6879545,31.8912 33.9724545,34.2677333 31.5177727,35.8144 L39.0249545,41.6181333 C43.3393409,37.6138667 46.1454545,31.6490667 46.1454545,24"
                                                    id="Fill-4" fill="#4285F4"> </path>
                                            </g>
                                        </g>
                                    </g>
                                </svg>
                                <span>Continue with Google</span>
                            </a>

                            <a href="{{ route('facebook-auth') }}"
                                class="flex items-center px-6 py-2 text-sm font-medium text-gray-800 bg-white border border-gray-300 rounded-lg shadow-md sm:w-1/2 hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                                <svg class="w-6 h-6 mr-2" xmlns="http://www.w3.org/2000/svg"
                                    xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 48 48" version="1.1">
                                    <g id="Icons" stroke="none" stroke-width="1" fill="none"
                                        fill-rule="evenodd">
                                        <g id="Color-" transform="translate(-200.000000, -160.000000)"
                                            fill="#4460A0">
                                            <path
                                                d="M225.638355,208 L202.649232,208 C201.185673,208 200,206.813592 200,205.350603 L200,162.649211 C200,161.18585 201.185859,160 202.649232,160 L245.350955,160 C246.813955,160 248,161.18585 248,162.649211 L248,205.350603 C248,206.813778 246.813769,208 245.350955,208 L233.119305,208 L233.119305,189.411755 L239.358521,189.411755 L240.292755,182.167586 L233.119305,182.167586 L233.119305,177.542641 C233.119305,175.445287 233.701712,174.01601 236.70929,174.01601 L240.545311,174.014333 L240.545311,167.535091 C239.881886,167.446808 237.604784,167.24957 234.955552,167.24957 C229.424834,167.24957 225.638355,170.625526 225.638355,176.825209 L225.638355,182.167586 L219.383122,182.167586 L219.383122,189.411755 L225.638355,189.411755 L225.638355,208 L225.638355,208 Z"
                                                id="Facebook">

                                            </path>
                                        </g>
                                    </g>
                                </svg>

                                <span>Continue with Facebook</span>
                            </a>
                        </div>
                        <div class="signup">
                            Don't have an account?
                            <a href="{{ route('member.reg') }}">Sign Up</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection