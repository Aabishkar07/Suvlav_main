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
		</section>
		
@endsection