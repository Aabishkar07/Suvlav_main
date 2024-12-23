@if(Request::is('/'))
<style>
.shop .main-category{ display: block;}
</style>
@else
<style>
.shop .main-category{ display: none;}
</style>
@endif
<div class="header-inner">
    <div class="container">
        <div class="cat-nav-head">
            <div class="row">
            
						{{-- <div class="col-lg-3">
							<div class="all-category">
								<?php
									$listcates = array();
									$i = 0;
									foreach($categories as $listcat){
										$childid = ($listcat->childid == '') ? 0 : $listcat->childid;
										$listcates[$listcat->catid.'~~~'.$listcat->title][$listcat->childid] = $listcat->childid.'~~~'.$listcat->child;
									}
				
									//echo '<pre>';
									//print_r($listcates);
									//die();
								?>
								<h3 class="cat-heading" id="product_category"><i class="fa fa-bars" aria-hidden="true"></i>CATEGORIES</h3>
								 <ul class="main-category">
									<?php foreach($listcates as $key => $catvalue): 
										$catnamepp = explode('~~~',$key); 
										$ischild = 0;
										foreach($catvalue as $mm):
											// echo $mm;
											// die();
											if($mm !='~~~') 
												$ischild = 1;
											//return;
										 endforeach; ?>
									
									<li><a href="{{url('/productcategory/'.$catnamepp[0])}}"><?php echo $catnamepp[1]; ?> <i class="fa <?php if($ischild == 1){ echo 'fa-angle-right'; }?>" aria-hidden="true"></i></a>
										
										<?php if($ischild == 1): ?>
											<ul class="sub-category">
											<?php foreach($catvalue as $mm): 
												$catnamechild = explode('~~~',$mm);
												?>
												<li><a href="{{url('/productcategory/'.$catnamechild[0])}}"><?php echo $catnamechild[1]; ?></a></li>
											<?php endforeach; ?>
											</ul>
										<?php endif; ?>	
									</li>
									<?php endforeach; ?>
								</ul> 
							</div>
						</div> --}}
					
					<div class="col-lg-6 col-12">
				
                    <div class="menu-area">
                        <!-- Main Menu -->
                        <nav class="navbar navbar-expand-lg">
                            <div class="navbar-collapse">	
                                <div class="nav-inner">	
                                    <ul class="nav main-menu menu navbar-nav">
                                            <li class="active"><a href="{{ url('/') }}">Shop</a></li>
                                          
                                            <!-- <li><a href="{{ url('/') }}">Shop</a> -->
                                                <!-- <ul class="dropdown">
                                                    <li><a href="">Shop Grid</a></li>
                                                    <li><a href="cart.html">Cart</a></li>
                                                    
                                                </ul> -->
                                            </li>
											<li><a href="{{ url('/view-cart')}}">Cart</a></li>
											<li><a href="{{ url('/checkout')}}">Checkout</a></li>
                                            <li><a href="{{ url('/contactus')}}">Contact Us</a></li>
											
                                        </ul>
                                </div>
                            </div>
							
                        </nav>
                        <!--/ End Main Menu -->	

						
                    </div>
                </div>
				<div class="col-lg-3 col-12 hiname"> <?php $dd = explode(' ',Session::get('memeber_name_ss')); 
							if($dd[0] != ''){
							?>
					Hi <?php  echo $dd[0]; ?>
					<?php } ?></div>
            </div>
        </div>
		
    </div>
</div>
<script type="text/javascript">

$("#product_category").hover(function() {
  $(".shop .main-category").show();
});

$(".all-category").mouseleave(function(){
	$(".shop .main-category").hide();
});

</script>