@extends('layouts.frontendapp')
@section('content')
{{-- <style>
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
.form-group label{width: 135px;}
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
					<div class="col-lg-6 col-12 acenter">
						<div class="checkout-form">
							<h2>Forget Password Form </h2><br>
							<p>Please put registered email, System will send your password in your email.</p>
							

							<!-- Tab content -->
							<div id="login" class="tabcontent">
							<form class="forms-sample" action="{{ route('member.login') }}" method="POST">
							@csrf
									<div class="row">
										<div class="col-lg-12 col-md-12 col-12">
											<div class="form-group">
												<label>Registered Email<span>*</span></label>
												<input type="email" name="email" placeholder="" required="required">
											</div>
										</div>
										
									</div>

									<div class="row fulllg">
										<div class="col-lg-12 col-md-12 col-12">
												<input type="submit" name="loginsmt" id="submitbtm" value="Submit">
										</div>
									</div>
									
								</form>
							</div>
							
						<!-- Start login and register form -->
					
				</div>
			</div>
		</section> --}}



		<style>
			/* General Styles */
			body {
				font-family: Arial, sans-serif;
				background-color: #f8f9fa;
			}
		
			.checkout-section {
				padding: 40px 0;
				margin: 220px;
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
				border: 1px solid black;
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
		
		<section class="checkout-section">
			<div class="container">
				<div class="row justify-content-center">
					<div class="col-lg-6 col-md-8">
						<div class="form-wrapper">
							<h2>OTP
							</h2>
							@if($errors->any())
								<div class="alert alert-danger">
									{{ $errors->first() }}
								</div>
							@endif
							<form action="{{ route('checkotp') }}" method="POST">
								@csrf
								<input type="hidden" name="prev_url" value="{{ url()->previous() }}">
								<div class="form-group">
                                    <input type="hidden" name="email" value="{{ $email }}" />
									<label for="otp">Otp <span class="text-danger">* Check your email</span></label>
									<input type="number" id="otp" name="otp" placeholder="Enter your otp" required>
								</div>
						
								<button type="submit" id="submitbtm">Submit</button>
						
							</form>
						</div>
					</div>
				</div>
			</div>
		</section>
		
@endsection