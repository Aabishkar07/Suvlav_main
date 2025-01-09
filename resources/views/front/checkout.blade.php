@extends('layouts.frontendapp')
@section('content')
    <style>
        /* Style the tab */
        .tab {
            overflow: hidden;
            border: 1px solid #ccc;
            background-color: #f1f1f1;
        }

        /* Style the buttons that are used to open the tab content */
        .tab button {
            background-color: inherit;
            float: left;
            border: none;
            outline: none;
            cursor: pointer;
            padding: 14px 16px;
            transition: 0.3s;
        }

        /* Change background color of buttons on hover */
        .tab button:hover {
            background-color: #ddd;
        }

        /* Create an active/current tablink class */
        .tab button.active {
            background-color: #ccc;
        }

        /* Style the tab content */
        .tabcontent {
            display: none;
            padding: 6px 12px;
            border: 1px solid #ccc;
            border-top: none;
        }

        #submitbtm {
            width: 150px;
            text-align: center;
            height: 35px;
            background-color: orange;
            color: #FFF;
            display: block;
            margin: 10px auto;
        }

        .fulllg {
            width: 100%;
        }

        .form-group label {
            width: 80px;
        }

        .form-group {
            margin-top: 16px;
            margin-bottom: 5px;
        }

        .form-group input {
            width: 240px;
        }

        .btn {
            background-color: #000 !important;
        }
    </style>

    <!-- Start Checkout -->
    <section class="shop checkout section">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-12">
                    <div class="checkout-form">
                        <!-- <h2>Make Your Checkout Here</h2>
                               <p>Please register in order to checkout more quickly</p> -->
                        <?php if (Session::get('memeber_email_ss') == '') { ?>
                        <div class="tab">
                            <button class="tablinks" onclick="clicktab(event, 'login')" id="defaultOpen">login Here</button>
                            <button class="tablinks" onclick="clicktab(event, 'register')">Join/Register Here</button>
                        </div>


                        <!-- Tab content -->
                        <div id="login" class="tabcontent">
                            @if ($errors->any())
                                <div class="error_msg">{{ $errors->first() }}</div>
                            @endif
                            <form class="forms-sample" action="{{ route('member.login') }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-12">
                                        <div class="form-group">
                                            <label>Email<span>*</span></label>
                                            <input type="email" name="email" placeholder="" required="required">
                                            <input type="hidden" name="current_url" value="<?php echo url('/checkout'); ?>" />
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
                            </form>
                        </div>

                        <!-- Start login and register form -->
                        <div id="register" class="tabcontent">
                            <p style="text-align: center;">Please register in order to checkout more quickly</p>
                            @if ($errors->any())
                                <div class="error_msg">{{ $errors->first() }}</div>
                            @endif
                            <form class="forms-sample" action="{{ route('memberstore') }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-12">
                                        <div class="form-group">
                                            <label>Full Name<span>*</span></label>
                                            <input type="text" name="fname" placeholder="" required="required">
                                            <input type="hidden" name="current_url" value="<?php echo url('/checkout'); ?>" />
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-12">
                                        <div class="form-group">
                                            <label>Email<span>*</span></label>
                                            <input type="email" name="email" placeholder="Please write valid email"
                                                required="required">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-12">
                                        <div class="form-group">
                                            <label>Password<span>*</span></label>
                                            <input type="password" name="password" placeholder="" required="required"
                                                minlength="6">
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-12">
                                        <div class="form-group">
                                            <label>Mobile No.<span></span></label>
                                            <input type="text" name="mobileno" placeholder="" maxlength="10">
                                        </div>
                                    </div>
                                </div>

                                <div class="row fulllg">
                                    <div class="col-lg-12 col-md-12 col-12">
                                        <input type="submit" name="register" id="submitbtm" value="Register">

                                    </div>
                                </div>
                            </form>
                        </div>
                        <!-- End login register fomr-->


                        <?php } else{ ?>
                        <h2>Make Your Checkout Here</h2>
                        <p>Please fill <b><i>delevery address</i></b> to checkout more quickly</p>
                        <!-- Form -->
                        <form class="form" action="{{ route('cart.checkoutsmt') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-12">
                                    <div class="form-group">
                                        <label>Full Name<span>*</span></label>
                                        <input type="text" name="name" value="{{ @$shippings[0]->fullname }}"
                                            required="required">
                                        {{-- <input type="hidden" readonly name="email"
                                            value="{{ Session::get('memeber_email_ss') }}" required="required"> --}}
                                    </div>
                                    
                                </div>

                                <!-- <div class="col-lg-6 col-md-6 col-12">
                                  <div class="form-group">
                                   <label>Email<span>*</span></label>
                                   <input type="email" readonly name="email" value="{{ Session::get('memeber_email_ss') }}" required="required">
                                  </div>
                                 </div> -->
                                <div class="col-lg-6 col-md-6 col-12">
                                    <div class="form-group">
                                        <label>Mobile No.<span>*</span></label>
                                        <input type="number" name="mobileno" placeholder=""
                                            value="{{ @$shippings[0]->mobile }}" maxlength="10" required="required">
                                    </div>
                                </div>
                                <div class="form-group col-12">
                                    <label>Email<span>*</span></label>
                                    <input type="text" name="email" value="{{ @$shippings[0]->email }}"
                                        required="required">
                                    {{-- <input type="hidden" readonly name="email"
                                        value="{{ Session::get('memeber_email_ss') }}" required="required"> --}}
                                </div>
                                <?php
                                // echo '<pre>';
                                // print_r($states_del);
                                // foreach($states_del as $dd){
                                
                                // 	echo $dd->id;
                                // }
                                // die();
                                ?>
                                <div class="col-lg-6 col-md-6 col-12">
                                    <div class="form-group">
                                        <label>State<span>*</span></label>
                                        <select id="province_data" class="form-control district" name="province_id"
                                            required onchange="getDistrictsByState('<?php echo url('getdistricts'); ?>')">
                                            <option value=''> --- Select State ---</option>
                                            <?php foreach($states_del as $dd){ ?>
                                            <option value="<?php echo $dd->id; ?>" <?php if ($dd->id == @$shippings[0]->province) {
                                                echo 'selected';
                                            } ?>> <?php echo $dd->name; ?>
                                            </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-12">
                                    <div class="form-group">
                                        <label>District<span>*</span></label>
                                        <select class="form-control" name="district" id="district_id" required>
                                            <option value=''> Select District </option>
                                            <?php
											 if($districts != ''):
											 foreach($districts as $dt): ?>
                                            <option value="<?php echo $dt->id; ?>" <?php if ($dt->id == @$shippings[0]->district_id) {
                                                echo 'selected';
                                            } ?>> <?php echo $dt->district; ?>
                                            </option>
                                            <?php endforeach;
											      endif;
											?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-12">
                                    <div class="form-group">
                                        <label>City<span>*</span></label> &nbsp; <input type="text" name="city_del"
                                            value="{{ @$shippings[0]->city }}" required="required">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-12">
                                    <div class="form-group">
                                        <label>Address<span>*</span></label>
                                        <input type="text" name="address" placeholder=""
                                            value="{{ @$shippings[0]->address }}" required="required">
                                    </div>
                                </div>


                                <div class="col-lg-6 col-md-6 col-12">
                                    <div class="form-group">
                                        <span>Tole.</span> &nbsp;<input type="text" name="tole_del"
                                            value="{{ @$shippings[0]->tole }}">
                                    </div>
                                </div>

                                <div class="col-lg-6 col-md-6 col-12">
                                    <div class="form-group">
                                        <span>House No.</span> &nbsp;<input type="text" name="house_del"
                                            value="{{ @$shippings[0]->houseno }}">
                                    </div>
                                </div>

                                <div class="col-lg-6 col-md-6 col-12">
                                    <div class="form-group">
                                        <span>Gaupalika</span> &nbsp;<input type="text" name="gaupalika"
                                            value="{{ @$shippings[0]->gaupalika }}">
                                    </div>
                                </div>


                                <div class="col-lg-6 col-md-6 col-12">
                                    <div class="form-group">
                                        <span>Nagarpalika</span> &nbsp;<input type="text" name="nagarpalika"
                                            value="{{ @$shippings[0]->nagarpalika }}">
                                    </div>
                                </div>

                                <div class="col-lg-6 col-md-6 col-12">
                                    <div class="form-group">
                                        <span>Ward no</span> &nbsp;<input type="text" name="wardno"
                                            value="{{ @$shippings[0]->wardno }}">
                                    </div>
                                </div>



                            </div>

                            <!-- End checkout Form -->

                            <!-- Button Widget -->

                            <div class="single-widget">
                                <h2>Payments</h2>
                                <div class="content">
                                    <div class="checkbox">
                                        <!-- <label class="checkbox-inline" for="1"><input name="updates" id="1" type="checkbox"> Check Payments</label> -->
                                        <input name="payment_method" id="2" type="radio" checked> &nbsp; Cash
                                        On Delivery
                                        <!-- <label class="checkbox-inline" for="3"><input name="news" id="3" type="checkbox"> PayPal</label> -->
                                    </div>
                                </div>
                            </div>
                            <input id="redeem_point" type="hidden" name="redeem_point" value="0" />
                            <div class="single-widget get-button">
                                <div class="content">
                                    <div class="button">
                                        <!-- <a href="#" class="btn">proceed to checkout</a> -->
                                        <input type="submit" class="btn" name="register" value="Checkout">
                                    </div>
                                </div>
                            </div>
                        </form>

                        <!--/ End Button Widget -->

                        <?php } ?>
                    </div>

                </div>
                <div class="col-lg-4 col-12">
                    <div class="order-details">
                        <!-- Order Widget -->
                        <div class="single-widget">
                            <h2>CART TOTALS</h2>

                            <div class="sinlge-bar shopping header">

                                <!-- Shopping Item -->
                                <div class="shopping-item" style="padding-left: 25px;">
                                    <div class="dropdown-cart-header">
                                        <span>Total Items on Cart : <?php echo count($cartItems); ?></span>
                                        <a href="{{ route('view.cart') }}">View Cart</a>
                                    </div>
                                    <ul class="shopping-list">
                                        <?php
                                        $delete_url = "'" . route('cart.remove') . "'";
                                        $csrf_token = "'" . csrf_token() . "'";
                                        $total_amt = 0;
                                        ?>
                                        @foreach ($cartItems as $cartItem)
                                            <li>

                                                <a class="cart-img" href="javascript:void(0);"><img
                                                        src="{{ asset('public/' . $cartItem->product_image) }}"
                                                        width="50px"></a>
                                                <h4>{{ $cartItem->product_title }}</a></h4>
                                                <p class="quantity">{{ $cartItem->quantity }} - <span
                                                        class="amount">{{ moneyFormat($cartItem->price) }}</span></p>
                                            </li>
                                            <?php $total_amt = $total_amt + $cartItem->quantity * $cartItem->price; ?>
                                        @endforeach

                                    </ul>
                                    <div class="bottom">
                                        <div class="total">
                                            <span>Total</span>
                                            <span class="total-amount" id="total-amount"><?php echo moneyFormat($total_amt); ?>&nbsp;</span>
                                        </div>

                                    </div>
                                </div>
                                <!--/ End Shopping Item -->
                            </div>
                        </div>

                        <div class="container mt-4">
                            <div class="shadow-sm card">
                                <div class="card-body">
                                    <!-- Available Points Section -->
                                    <div class="mb-3">
                                        <label class="form-label text-muted">Available Points</label>
                                        <div id="available-points" class="fw-bold text-primary h5">
                                            {{ $member->total_points ?? 0 }}
                                        </div>
                                    </div>
                        
                                    <!-- Remaining Points Section -->
                                    <div class="mb-3 remaining-points" id="remaining-points-container" style="display: none;">
                                        <label class="form-label text-muted">Remaining Points</label>
                                        <span id="remaining-points" class="fw-bold text-success">0</span>
                                    </div>
                        
                                    <!-- Redeem Button -->
                                    <div class="d-grid">
                                        <button id="redeem-btn" class="btn btn-primary btn-lg">Redeem Points</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        




                        <script>
                            // Convert PHP variable values to JavaScript
                            const totalPoints = {{ $member->total_points ?? 0 }};
                            let totalAmount = {{ $total_amt }};

                            // Attach event listener to the button
                            document.getElementById("redeem-btn").addEventListener("click", () => {
                                if (totalPoints > 0) {
									document.getElementById("redeem_point").value = 1;

                                    if (totalAmount <= totalPoints) {
                                        // Deduct the entire total amount from points
                                        const remainingPoints = totalPoints - totalAmount;

                                        // Update the UI
                                        totalAmount = 0;
                                        document.getElementById("total-amount").textContent = new Intl.NumberFormat('en-US', {
                                            style: 'currency',
                                            currency: 'USD'
                                        }).format(totalAmount);

                                        document.getElementById("available-points").textContent = remainingPoints;

                                        // Show remaining points
                                        document.getElementById("remaining-points").textContent = remainingPoints;
                                        document.getElementById("remaining-points-container").style.display = 'block';
                                    } else {
                                        // Deduct points equal to the total amount
                                        totalAmount -= totalPoints;

                                        // Update the UI
                                        document.getElementById("total-amount").textContent = new Intl.NumberFormat('en-US', {
                                            style: 'currency',
                                            currency: 'USD'
                                        }).format(totalAmount);

                                        document.getElementById("available-points").textContent = 0;

                                        // Hide remaining points container
                                        document.getElementById("remaining-points-container").style.display = 'none';
                                    }

                                    // Disable the button after redeeming points
                                    document.getElementById("redeem-btn").disabled = true;
                                } else {
                                    alert("No points available to redeem.");
                                }
                            });
                        </script>



                        <!--/ End Order Widget -->
                        <!-- Order Widget -->

                        <!--/ End Order Widget -->
                        <!-- Payment Method Widget -->
                        <div class="single-widget payement">
                            <div class="content">
                                <!-- <img src="{{ asset('front_assets/images/payment-method.png') }}"> -->
                            </div>
                        </div>
                        <!--/ End Payment Method Widget -->

                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--/ End Checkout -->

    <!-- Start Shop Services Area  -->
    <section class="shop-services section home">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-12">
                    <!-- Start Single Service -->
                    <div class="single-service">
                        <i class="ti-rocket"></i>
                        <h4>Free shiping</h4>
                        <p>Orders over Rs 1000</p>
                    </div>
                    <!-- End Single Service -->
                </div>
                <div class="col-lg-3 col-md-6 col-12">
                    <!-- Start Single Service -->
                    <div class="single-service">
                        <i class="ti-reload"></i>
                        <h4>Free Return</h4>
                        <p>Within 7 days returns</p>
                    </div>
                    <!-- End Single Service -->
                </div>
                <div class="col-lg-3 col-md-6 col-12">
                    <!-- Start Single Service -->
                    <div class="single-service">
                        <i class="ti-lock"></i>
                        <h4>Sucure Payment</h4>
                        <p>100% secure payment</p>
                    </div>
                    <!-- End Single Service -->
                </div>
                <div class="col-lg-3 col-md-6 col-12">
                    <!-- Start Single Service -->
                    <div class="single-service">
                        <i class="ti-tag"></i>
                        <h4>Best Peice</h4>
                        <p>Guaranteed price</p>
                    </div>
                    <!-- End Single Service -->
                </div>
            </div>
        </div>
    </section>
    <!-- End Shop Services -->
    <script type="text/javascript">
        function clicktab(evt, cityName) {
            // Declare all variables
            var i, tabcontent, tablinks;

            // Get all elements with class="tabcontent" and hide them
            tabcontent = document.getElementsByClassName("tabcontent");
            for (i = 0; i < tabcontent.length; i++) {
                tabcontent[i].style.display = "none";
            }

            // Get all elements with class="tablinks" and remove the class "active"
            tablinks = document.getElementsByClassName("tablinks");
            for (i = 0; i < tablinks.length; i++) {
                tablinks[i].className = tablinks[i].className.replace(" active", "");
            }

            // Show the current tab, and add an "active" class to the button that opened the tab
            document.getElementById(cityName).style.display = "block";
            evt.currentTarget.className += " active";
        }

        document.getElementById("defaultOpen").click();

        function getDistrictsByState(urlLink) {
            //$('#loading').show();

            var stateid = $("#province_data").val();

            $.ajax({
                type: "GET",
                url: urlLink,
                data: {
                    state_id: stateid
                },
                success: function(msg) {
                    // alert(msg);
                    $("#district_id").html(msg);

                }
            });

        }
    </script>
@endsection
