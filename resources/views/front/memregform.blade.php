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
</style>		
<section class="shop checkout section">
			<div class="container">
				<div class="row"> 
					<div class="col-lg-8 col-12 acenter">
						<div class="checkout-form">
							<h2>Signup Form </h2><br>
							<!--<p>Please register in order to checkout more quickly</p> -->
							

							<!-- Tab content -->
							<div id="login" class="tabcontent">
							@if ($errors->any())
							<div class="error_msg">{{$errors->first()}}</div>
							@endif
							<form class="forms-sample" action="{{ route('memberstore') }}" method="POST">
							@csrf
							<input type="hidden" name="prev_url" value="<?php echo url()->previous(); ?>" >
							<div class="row acenter">
										<div class="col-lg-6 col-md-6 col-12">
											<div class="form-group">
												<label>Full Name<span>*</span></label>
												<input type="text" name="fname" placeholder="" required="required">
											</div>
										</div>
										<div class="col-lg-6 col-md-6 col-12">
											<div class="form-group">
												<label>Email<span>*</span></label>
												<input type="email" name="email" placeholder="Please write valid email" required="required">
											</div>
										</div>
									</div>

									<div class="row">
										<div class="col-lg-6 col-md-6 col-12">
											<div class="form-group">
												<label>Password<span>*</span></label>
												<input type="password" name="password" placeholder="please write 6 digit password" required="required">
											</div>
										</div>
										<div class="col-lg-6 col-md-6 col-12">
											<div class="form-group">
												<label>Mobile No.<span></span></label>
												<input type="number" name="mobileno" placeholder="" maxlength="10">
											</div>
										</div>
									</div>
									<div class="row fulllg">
										<div class="col-lg-12 col-md-12 col-12">
												<input type="submit" name="register" id="submitbtm" value="Register">
										</div>
									</div>
									<div class="row fulllg signup">
									have an account?  <a href="{{ route('member.loginform')}}"> login </a>
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

        .checkout-section {
            padding: 40px 0;
        }

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
            background-color: #000000;
            color: #ffffff;
            font-size: 18px;
            font-weight: bold;
            border: none;
            border-radius: 5px;
            transition: background-color 0.3s ease;
            cursor: pointer;
        }

        #submitbtm:hover {
            background-color: #ffffff;
            color: #000;
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

        .acenter {
            display: flex;
            justify-content: center;
        }

        .error_msg {
            color: #d9534f;
            text-align: center;
            margin-bottom: 20px;
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

    <section class="checkout-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6 col-md-8">
                    <div class="form-wrapper">
                        <h2>Signup</h2>
                        @if ($errors->any())
                            <div class="error_msg">
                                {{ $errors->first() }}
                            </div>
                        @endif
                        <form action="{{ route('memberstore') }}" method="POST">
                            @csrf
                            <input type="hidden" name="prev_url" value="{{ url()->previous() }}">

                            <div class="form-group">
                                <label for="fname">Full Name <span>*</span></label>
                                <input type="text" id="fname" name="fname" placeholder="Enter your full name"
                                    required>
                            </div>
                            <div class="form-group">
                                <label for="email">Email <span>*</span></label>
                                <input type="email" id="email" name="email" placeholder="Enter a valid email"
                                    required>
                            </div>
                            <div class="form-group">
                                <label for="password">Password <span>*</span></label>
                                <input type="password" id="password" name="password" placeholder="Enter a secure password"
                                    required>
                            </div>
                            <div class="form-group">
                                <label for="mobileno">Mobile No.</label>
                                <input type="number" id="mobileno" name="mobileno" placeholder="Enter your mobile number"
                                    maxlength="10">
                            </div>

                            <div class="">
                                <label for="gender"><strong>Gender</strong></label>
                                <div style="display: flex;flex-direction: row;gap:20px; align-items: center;"
                                    class="">

                                    <div class="">
                                        <input checked type="radio" id="male" name="gender" value="male">
                                        <label for="male"><b>Male</b></label>
                                    </div>
                                    <div class="">
                                        <input type="radio" id="female" name="gender" value="female">
                                        <label for="female"><b>Female</b></label>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" id="submitbtm">Register</button>
                            <div class="signup">
                                Have an account? <a href="{{ route('member.loginform') }}">Login</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
