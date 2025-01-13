@extends('layouts.frontendapp')
@section('content')
    <style>
        /* Style the tab */
        .tab {
            overflow: hidden;
            border: 1px solid #ccc;
            background-color: #f1f1f1;
            margin-top: 10px;
        }

        /* Style the buttons that are used to open the tab content */
        .tab button {
            background-color: inherit;
            float: left;
            border: none;
            outline: none;
            cursor: pointer;
            padding: 14px 46px;
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

        .submitbtm {
            width: 150px;
            text-align: center;
            height: 35px;
            background-color: orange !important;
            color: #FFF !important;
            display: block;
            margin: 10px auto;
        }

        .fulllg {
            width: 100%;
        }

        .form-group label {
            width: 150px;
        }

        .form-group {
            margin-top: 16px;
            margin-bottom: 5px;
        }

        .form-group input {
            width: 240px;
        }

        /* .btn {
            background-color: #000 !important;
        } */

        .changepw {
            margin: 0px auto;
        }

        #ajax_res_pw {
            text-align: center;
        }

        .form-group span {
            width: 73px;
            display: block;
            float: left;
        }

        .updatebtm {
            text-align: center;
            background: #F7941D;
            color: #FFF !important;
            padding: 10px 55px;
            font-size: 15px;
        }

        .popupdatebtm {
            text-align: center;
            margin: 15px 0px;
        }

        .modal-body {
            margin: 20px;
            padding: 10px 0px 0px 25px !important;
        }

        .modal-dialog .modal-content .modal-body {
            height: auto !important;
        }

        .modal-dialog .modal-content .modal-header .close {
            background: #F7941D !important;
        }

        .row {
            margin: 0px !important;
        }

        .form-control {
            display: inline !important;
            width: 240px !important;
        }

        .form-group input[type="radio"] {
            width: 42px !important;
        }

        .longtext {
            width: 58% !important;
        }
    </style>

    <!-- Start Checkout -->
    <section class="shop checkout section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-12">
                    <div>
                        <div style="background-color: green" class="my-4 text-center text-white rounded card-header">
                            <h4 class="mb-0" style="font-size: 14px;font-weight: bold;">My Profile </h4>
                        </div>

                        @if (Session::has('message'))
                            <p class="alert alert-info">{{ Session::get('message') }}</p>
                        @endif
                        <!--<p>Please register in order to checkout more quickly</p> -->

                        <div class="tab">
                            <button class="tablinks" onclick="clicktab(event, 'order_history')" id="defaultOpen">Order
                                History</button>
                            <button class="tablinks" onclick="clicktab(event, 'Profile')" id="profileTab">Profile</button>
                            <button class="tablinks" onclick="clicktab(event, 'deladdress')" id="deleveryTab">Delivery
                                Address</button>
                            <button class="tablinks" onclick="clicktab(event, 'changepw')" id="changepwTab">Change
                                Password</button>
                            <button class="tablinks" onclick="clicktab(event, 'mypoints')" id="changemypointsTab">
                                My Points</button>
                        </div>

                        <!-- Tab content -->
                        <div id="order_history" class="tabcontent">
                            <div class="row">
                                <div class="mt-12 col-12 table-responsive">
                                    <!-- Shopping Summery -->
                                    <table class="table ">
                                        <thead>
                                            <tr style="background-color: orange" class="text-white main-hading">
                                                <th> # </th>
                                                <th> Tracking Code </th>
                                                <th> OrderId </th>

                                                <th> Total Items </th>
                                                <th> Amount </th>
                                                <th> Status </th>
                                                <th> Order Date </th>
                                                <th> Action </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
												$sn =1;
											 	foreach($orders as $order) {
													$cdate = explode(' ',$order->created_at);
											    ?>
                                            <tr class="text-center">
                                                <td><?php echo $sn; ?></td>
                                                <td class="id">{{ $order->tracking_code }}</td>
                                                <td class="id">{{ $order->id }}</td>
                                                <td class="text-center qty">{{ $order->total_items }}</td>
                                                <td>
                                                    <div class="">
                                                        <div class="">
                                                            <label>
                                                                Total :
                                                            </label>
                                                            Rs. {{ $order->total_amt }}
                                                        </div>
                                                        @if ($order->use_point)
                                                            <div class="mt-2">
                                                                <label>Point Use : </label>
                                                                Rs. {{ $order->use_point }}
                                                            </div>
                                                            <hr />
                                                            <div class="">
                                                                To Be Paid : <span style="font-weight: bold"
                                                                    class="text-danger">Rs.
                                                                    {{ $order->total_amt - $order->use_point }}
                                                                </span>
                                                            </div>
                                                        @endif
                                                    </div>
                                                </td>



                                                <td class="text-center"> @switch($order->status)
                                                        @case('Pending')
                                                            <label class="badge bg-warning">{{ strtoupper($order->status) }}</label>
                                                        @break

                                                        @case('Ongoing')
                                                            <label class="badge badge-info">{{ strtoupper($order->status) }}</label>
                                                        @break

                                                        @case('Cancel')
                                                            <label
                                                                class="badge badge-danger">{{ strtoupper($order->status) }}</label>
                                                        @break

                                                        @case('Delevered')
                                                            <label
                                                                class="badge badge-success">{{ strtoupper($order->status) }}</label>
                                                        @break

                                                        @default
                                                            <label
                                                                class="badge badge-info">{{ strtoupper($order->status) }}</label>
                                                    @endswitch
                                                </td>
                                                <td class="text-center">{{ $order->created_at }}</td>
                                                <td class="">
                                                    <a href="{{ route('profile.order', $order->id) }}">

                                                        <div style="background-color: green;width: 50px;color:white"
                                                            class="rounded">

                                                            <i class="fa fa-eye"></i>
                                                        </div>
                                                    </a>
                                                </td>
                                            </tr>
                                            <?php $sn++; } ?>
                                        </tbody>
                                    </table>
                                    <!--/ End Shopping Summery -->
                                </div>
                            </div>
                        </div>

                        <!-- Start login and register form -->

                        <div id="Profile" class="tabcontent">
                            <div style="background-color: orange" class="my-4 text-center text-white rounded card-header">
                                <h4 class="mb-0" style="font-size: 14px;font-weight: bold;">Personal Profile </h4>
                            </div>


                            <div class="row">
                                <div class="col-lg-4 col-md-4 col-12">
                                    <div class="form-group">
                                        <span>Full Name</span> &nbsp; : &nbsp; {{ $userdata[0]->name }}
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4 col-12">
                                    <div class="form-group">
                                        <span>Email</span>&nbsp; : &nbsp; {{ $userdata[0]->email }}
                                    </div>
                                </div>

                                <div class="col-lg-4 col-md-4 col-12">
                                    <div class="form-group">
                                        <span>Mobile No.</span>&nbsp; : &nbsp; {{ $userdata[0]->mobileno }}
                                    </div>
                                </div>
                            </div>

                            <div class="row">

                                <div class="col-lg-4 col-md-4 col-12">
                                    <div class="form-group">
                                        <span>Gender</span>&nbsp; : &nbsp; {{ $userdata[0]->gender }}
                                    </div>
                                </div>

                                <div class="col-lg-4 col-md-4 col-12">
                                    <div class="form-group">
                                        <span>State</span>&nbsp; : &nbsp; {{ $userdata[0]->statename }}
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4 col-12">
                                    <div class="form-group">
                                        <span>District</span> &nbsp; : &nbsp; {{ $userdata[0]->district }}
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-8 col-md-8 col-12">
                                    <div class="form-group">
                                        <span>Address.</span> &nbsp; : &nbsp; {{ $userdata[0]->address }}
                                    </div>
                                </div>
                            </div>

                            <div class="row fulllg">
                                <div class="col-lg-12 col-md-12 col-12 popupdatebtm">
                                    <a data-toggle="modal" data-target="#exampleModal" title="Quick View" href="#"
                                        class="updatebtm">Update it </a>
                                </div>
                            </div>
                        </div>

                        <!-- Start  delivery Addresss form -->
                        <div id="deladdress" class="tabcontent">

                            <div style="background-color: orange" class="my-4 text-center text-white rounded card-header">
                                <h4 class="mb-0" style="font-size: 14px;font-weight: bold;">Delivery Address </h4>
                            </div>


                            <div class="row">
                                <div class="col-lg-4 col-md-4 col-12">
                                    <div class="form-group">
                                        <span>Full Name</span> &nbsp; : &nbsp; {{ @$shippings[0]->fullname }}
                                    </div>
                                </div>
                                <!-- <div class="col-lg-4 col-md-4 col-12">
                                                                  <div class="form-group">
                                                                   <span>Email</span> &nbsp; : &nbsp; {{ @$shippings[0]->email }}
                                                                   </div>
                                                               </div> -->

                                <div class="col-lg-4 col-md-4 col-12">
                                    <div class="form-group">
                                        <span>Mobile No.</span> &nbsp; : &nbsp; {{ @$shippings[0]->mobile }}
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4 col-12">
                                    <div class="form-group">
                                        <span>State</span>&nbsp; : &nbsp; {{ @$shippings[0]->statename }}
                                    </div>
                                </div>
                            </div>

                            <div class="row">

                                <div class="col-lg-4 col-md-4 col-12">
                                    <div class="form-group">
                                        <span>District</span> &nbsp; : &nbsp; {{ @$shippings[0]->district }}
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4 col-12">
                                    <div class="form-group">
                                        <span>City</span> &nbsp; : &nbsp; {{ @$shippings[0]->city }}
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4 col-12">
                                    <div class="form-group">
                                        <span>Address.</span> &nbsp; : &nbsp; {{ @$shippings[0]->address }}
                                    </div>
                                </div>


                            </div>
                            <div class="row">


                                <div class="col-lg-4 col-md-4 col-12">
                                    <div class="form-group">
                                        <span>Tole.</span> &nbsp; : &nbsp; {{ @$shippings[0]->tole }}
                                    </div>
                                </div>

                                <div class="col-lg-4 col-md-4 col-12">
                                    <div class="form-group">
                                        <span>House No.</span> &nbsp; : &nbsp; {{ @$shippings[0]->houseno }}
                                    </div>
                                </div>

                                <div class="col-lg-4 col-md-4 col-12">
                                    <div class="form-group">
                                        <span>Gaupalika</span> &nbsp; : &nbsp; {{ @$shippings[0]->gaupalika }}
                                    </div>
                                </div>


                                <div class="col-lg-4 col-md-4 col-12">
                                    <div class="form-group">
                                        <span>Nagarpalika</span> &nbsp; : &nbsp; {{ @$shippings[0]->nagarpalika }}
                                    </div>
                                </div>


                                <div class="col-lg-4 col-md-4 col-12">
                                    <div class="form-group">
                                        <span>Wardno</span> &nbsp; : &nbsp; {{ @$shippings[0]->wardno }}
                                    </div>
                                </div>
                            </div>



                            <div class="row fulllg">
                                <div class="col-lg-12 col-md-12 col-12 popupdatebtm">
                                    <a data-toggle="modal" data-target="#deleveryAddresssModal" title="Quick View"
                                        href="#" class="updatebtm">Update it </a>
                                </div>
                            </div>
                        </div>

                        <!--	 End login register fomr-->

                        <div id="mypoints" class="tabcontent">
                            <div style="background-color: orange" class="my-4 text-center text-white rounded card-header">
                                <h4 class="mb-0" style="font-size: 14px;font-weight: bold;">My Points </h4>
                            </div>
                            <label>Available Points</label>
                            <div class="">{{ $userdata[0]->total_points ?? 0 }}</div>

                        </div>

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
                        <h4>Exchange</h4>
                        <p>Within 7 days </p>
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

    <!-- Modal  Profile-->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            class="ti-close" aria-hidden="true"></span></button>
                </div>
                <div class="modal-body">
                    <h5> Personal Profile</h2>
                        <form id="data_shipping" class="forms-sample" action="<?php echo route('member.profileupdate'); ?>" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-lg-4 col-md-4 col-12">
                                    <div class="form-group">
                                        <input type="hidden" name="memberid" value="{{ $userdata[0]->id }}" <span>Full
                                        Name</span> &nbsp;<input type="text" name="fname" placeholder=""
                                            value="{{ $userdata[0]->name }}" required="required">
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4 col-12">
                                    <div class="form-group">
                                        <span>Email</span>&nbsp;{{ $userdata[0]->email }}
                                    </div>
                                </div>

                                <div class="col-lg-4 col-md-4 col-12">
                                    <div class="form-group">
                                        <span>Mobile No.</span>&nbsp;<input type="text" name="mobileno"
                                            value="{{ @$userdata[0]->mobileno }}" maxlength="10">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-4 col-md-4 col-12">
                                    <div class="form-group">
                                        <span>Gender.</span>&nbsp;<input type="radio" name="gender" value="male"
                                            <?php if (@$userdata[0]->gender == 'male' || @$userdata[0]->gender == '') {
                                                echo 'checked';
                                            } ?>> Male
                                        <input type="radio" name="gender" value="female" <?php if (@$userdata[0]->gender == 'female') {
                                            echo 'checked';
                                        } ?>> Female

                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4 col-12">
                                    <div class="form-group">
                                        <span>State</span>&nbsp;<select id="province_data" required
                                            class="form-control district" name="province_id"
                                            onchange="getDistrictsByState('<?php echo url('getdistricts'); ?>')">
                                            <option value=''> --- Select State ---</option>
                                            <?php foreach($states as $st){ ?>
                                            <option value="<?php echo $st->id; ?>" <?php if ($st->id == @$userdata[0]->state) {
                                                echo 'selected';
                                            } ?>><?php echo $st->name; ?>
                                            </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4 col-12">
                                    <div class="form-group">
                                        <span>District</span> &nbsp;<select class="form-control" name="district"
                                            id="district_id" required>
                                            <option value=''> --- Select district ---</option>
                                            <?php 
											if($districts !=''){
											foreach($districts as $dt){?>
                                            <option value="<?php $dt->id; ?>" <?php if ($dt->id == @$userdata[0]->district_id) {
                                                echo 'selected';
                                            } ?>><?php $dt->district; ?>
                                            </option>
                                            <?php } 
											}?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-12">
                                    <div class="form-group">
                                        <span>Address.</span> &nbsp;<input type="text" class="longtext" name="address"
                                            value="{{ @$userdata[0]->address }}" required="required">
                                    </div>
                                </div>
                            </div>
                            <div class="row fulllg">
                                <div class="col-lg-6 col-md-6 col-12 changepw">
                                    <div id="ajax_res_pw"></div>
                                    <input type="submit" name="loginsmt" class="submitbtm" id="delsubmitbtm"
                                        value="Submit">
                                </div>
                            </div>
                        </form>

                </div>
            </div>
        </div>
    </div>
    <!-- Modal end -->


    <!-- Modal  Delivery Address-->
    <div class="modal fade" id="deleveryAddresssModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            class="ti-close" aria-hidden="true"></span></button>
                </div>
                <div class="modal-body">

                    <form id="data_shipping" class="forms-sample" action="<?php echo route('member.profileshipping'); ?>" method="POST">
                        @csrf

                        <h5> Delevery Address </h2>

                            <div class="row">
                                <div class="col-lg-4 col-md-4 col-12">
                                    <div class="form-group">
                                        <span>Full Name</span> &nbsp;<input type="text" name="fname_del"
                                            value="{{ @$shippings[0]->fullname }}">
                                    </div>
                                </div>
                                <!-- <div class="col-lg-4 col-md-4 col-12">
                                                                   <div class="form-group">
                                                                   <span>Email</span> &nbsp; : &nbsp; {{ $userdata[0]->email }}
                                                                   </div>
                                                                  </div> -->

                                <div class="col-lg-4 col-md-4 col-12">
                                    <div class="form-group">
                                        <span>Mobile No.</span> &nbsp;<input type="number" name="mobileno_del"
                                            value="{{ @$shippings[0]->mobile }}" maxlength="10">
                                    </div>
                                </div>

                                <div class="col-lg-4 col-md-4 col-12">
                                    <div class="form-group">
                                        <span>State</span>&nbsp;<select id="province_data_del"
                                            class="form-control district" name="province_id_Del"
                                            onchange="getDistrictsByStatedel('<?php echo url('getdistricts'); ?>')">
                                            <option value=''> --- Select State ---</option>
                                            <?php foreach($states as $st){ ?>
                                            <option value="{{ $st->id }}" <?php if ($st->id == @$shippings[0]->province) {
                                                echo 'selected';
                                            } ?>> {{ $st->name }}
                                            </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>


                            </div>

                            <div class="row">
                                <div class="col-lg-4 col-md-4 col-12">
                                    <div class="form-group">
                                        <span>District</span> &nbsp;<select class="form-control" name="district_del"
                                            id="district_id_del">
                                            <?php
											if($district_del != ''){
											foreach($district_del as $dt){ ?>
                                            <option value="{{ $dt->id }}" <?php if ($dt->id == @$shippings[0]->district_id) {
                                                echo 'selected';
                                            } ?>> {{ $dt->district }}
                                            </option>
                                            <?php } }?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-4 col-md-4 col-12">
                                    <div class="form-group">
                                        <span>City</span> &nbsp; <input type="text" name="city_del"
                                            value="{{ @$shippings[0]->city }}">
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4 col-12">
                                    <div class="form-group">
                                        <span>Address.</span> &nbsp; <input type="text" name="address_del"
                                            value="{{ @$shippings[0]->address }}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4 col-md-4 col-12">
                                    <div class="form-group">
                                        <span>Tole.</span> &nbsp;<input type="text" name="tole_del"
                                            value="{{ @$shippings[0]->tole }}">
                                    </div>
                                </div>

                                <div class="col-lg-4 col-md-4 col-12">
                                    <div class="form-group">
                                        <span>House No.</span> &nbsp;<input type="text" name="house_del"
                                            value="{{ @$shippings[0]->houseno }}">
                                    </div>
                                </div>


                                <div class="col-lg-4 col-md-4 col-12">
                                    <div class="form-group">
                                        <span>Gaupalika.</span> &nbsp;<input type="text" name="gaupalika"
                                            value="{{ @$shippings[0]->gaupalika }}">
                                    </div>
                                </div>


                                <div class="col-lg-4 col-md-4 col-12">
                                    <div class="form-group">
                                        <span>Nagarpalika.</span> &nbsp;<input type="text" name="nagarpalika"
                                            value="{{ @$shippings[0]->nagarpalika }}">
                                    </div>
                                </div>

                                <div class="col-lg-4 col-md-4 col-12">
                                    <div class="form-group">
                                        <span>Wardno.</span> &nbsp;<input type="text" name="wardno"
                                            value="{{ @$shippings[0]->wardno }}">
                                    </div>
                                </div>





                            </div>



                            <div class="row fulllg">
                                <div class="col-lg-6 col-md-6 col-12 changepw">
                                    <div id="ajax_res_pw"></div>
                                    <input type="submit" name="loginsmt" class="submitbtm" id="delsubmitbtm"
                                        value="Submit">
                                </div>
                            </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
    <!-- Modal end -->


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

        function getDistrictsByStatedel(urlLink) {
            var stateid = $("#province_data_del").val();
            $.ajax({
                type: "GET",
                url: urlLink,
                data: {
                    state_id: stateid
                },
                success: function(msg) {
                    // alert(msg);
                    $("#district_id_del").html(msg);

                }
            });

        }

        function changepassword(urlLink) {
            $('#loading').show();
            var str = $("#form_changepw").serialize();
            $.ajax({
                type: "POST",
                url: urlLink,
                data: str,
                success: function(msg) {
                    //alert(msg);
                    $("#ajax_res_pw").html(msg);
                    $("#old_password").val("");
                    $("#newpassword").val("");
                    $("#confirmpassword").val("");
                    $('#loading').hide();

                }
            });
            return false;

        }

        $("#data_shipping").submit(function() {

            var agform = $('#data_shipping');
            var reportValidity = agform[0].reportValidity();

            // Then submit if form is OK.
            if (reportValidity) {
                $("#pageloader").show();
                $("#delsubmitbtm").attr("disabled", true);
                // agform.submit();
            }

        })
    </script>
    <?php if(isset($_GET['tab']) && $_GET['tab'] == 2){ ?>
    <script type="text/javascript">
        document.getElementById("profileTab").click();
    </script>
    <?php  } ?>
    <?php if(isset($_GET['tab']) && $_GET['tab'] == 3){ ?>
    <script type="text/javascript">
        document.getElementById("deleveryTab").click();
    </script>
    <?php  } ?>
    <?php if(isset($_GET['tab']) && $_GET['tab'] == 4){ ?>
    <script type="text/javascript">
        document.getElementById("changepwTab").click();
    </script>
    <?php  } ?>
@endsection
