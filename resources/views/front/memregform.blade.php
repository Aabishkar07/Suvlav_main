@extends('layouts.frontendapp')
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
							@if($errors->any())
							<div class="error_msg">{{$errors->first()}}</div>
							@endif
							<form class="forms-sample" action="{{ route('memberstore') }}" method="POST">
							@csrf
							<input type="hidden" name="prev_url" value="<?php echo url()->previous();?>" >
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
		
@endsection