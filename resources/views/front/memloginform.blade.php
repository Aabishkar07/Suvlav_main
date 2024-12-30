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
							
							@if($errors->any())
							<div class="error_msg">{{$errors->first()}}</div>
							@endif
							<form class="forms-sample" action="{{ route('member.login') }}" method="POST">
							@csrf
							<input type="hidden" name="prev_url" value="<?php echo url()->previous();?>" >
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

    .checkout-section {
        padding: 40px 0;
		margin: 50px;
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
                    <h2>Login</h2>
                    @if($errors->any())
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
                            <input type="password" id="password" name="password" placeholder="Enter your password" required>
                        </div>
                        <div class="forgot-password">
                            <a href="{{ url('/forgotpwform') }}">Forgot your password?</a>
                        </div>
                        <button type="submit" id="submitbtm">Login</button>
                        <div class="signup">
                            Don't have an account? 
                            <a href="{{ route('member.reg') }}">Sign Up</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
