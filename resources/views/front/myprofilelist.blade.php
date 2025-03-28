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
            /* border: 1px solid #ccc; */
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
        <div class="md:container md:mx-auto">
            <div class="row">
                <div class="col-lg-12 col-12">
                    <div>
                        <div class="justify-between my-3 gap-x-3">

                            <div style="background-color: blue" class="px-4 py-2 text-center text-white rounded card-header">
                                <h4 class="mb-0" style="font-size: 14px;font-weight: bold;">
                                    Namaskar{{ $userdata[0]->gender == 'male' ? ' Sir' : ($userdata[0]->gender == 'female' ? ' Maam' : '') }}

                                </h4>
                            </div>

                        </div>

                        @if (Session::has('message'))
                            <p class="alert alert-info">{{ Session::get('message') }}</p>
                        @endif
                        <!--<p>Please register in order to checkout more quickly</p> -->

                        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"
                            rel="stylesheet">

                        <div class="block p-4 bg-white border rounded shadow-lg md:hidden">
                            <a class="flex items-center block py-2 border-b md:hidden" href="{{ route('history') }}">
                                <i class="mr-2 text-blue-500 fas fa-history"></i>
                                <p class="text-sm font-medium">Order History</p>
                            </a>

                            <a class="flex items-center block py-2 border-b md:hidden" href="{{ route('details') }}">
                                <i class="mr-2 text-green-500 fas fa-user"></i>
                                <p class="text-sm font-medium">Profile</p>
                            </a>

                            <a class="flex items-center block py-2 border-b md:hidden" href="{{ route('delivery') }}">
                                <i class="mr-2 text-red-500 fas fa-map-marker-alt"></i>
                                <p class="text-sm font-medium">Delivery Address</p>
                            </a>

                            <a class="flex items-center block py-2 border-b md:hidden" href="{{ route('updatepassword') }}">
                                <i class="mr-2 text-purple-500 fas fa-lock"></i>
                                <p class="text-sm font-medium">Change Password</p>
                            </a>

                            <a class="flex items-center block py-2 md:hidden" href="{{ route('mypoints') }}">
                                <i class="mr-2 text-yellow-500 fas fa-coins"></i>
                                <p class="text-sm font-medium">My Points</p>
                            </a>

                            {{-- <a href="{{ route('wishlist') }}">
                                <i class="ti-heart"> </i>
                               </a> --}}
                            <a class="flex items-center block py-2 border border-b md:hidden"
                                href="{{ route('wishlist') }}">
                                {{-- <i class="mr-2 text-yellow-500 fas fa-coins"></i> --}}
                                <i class="mr-2 text-red-500 ti-heart"> </i>
                                <p class="text-sm font-medium">Wishlist</p>
                            </a>

                            {{-- <a class="max-md:hidden" href="{{ url('/memberlogout') }}">Logout</a> --}}

                            <a class="flex items-center block py-2 md:hidden" href="{{ url('/memberlogout') }}">
                                <i class="mr-2 text-green-500 ti-power-off"></i>
                                <p class="text-sm font-medium">Logout</p>
                            </a>
                        </div>




                        <div class="ptab tab d-none d-sm-flex flex-sm-row flex-column max-md:hidden">
                            <button class="tablinks max-md:hidden" onclick="clicktab(event, 'order_history')"
                                id="defaultOpen">Order
                                Historys</button>


                            {{-- <a class="block md:hidden"  href="{{ route('history') }}" >
                                     <button >Order
                                    History</button></a> --}}

                            <button class="tablinks max-md:hidden " onclick="clicktab(event, 'Profile')"
                                id="profileTab">Profile</button>


                            {{-- <a class="block md:hidden"  href="{{ route('details') }}" >
                                <button >Profile</button></a> --}}


                            <button class="tablinks max-md:hidden " onclick="clicktab(event, 'deladdress')"
                                id="deleveryTab">Delivery
                                Address</button>
                            {{-- <a class="block md:hidden"  href="{{ route('delivery') }}" >
                                    <button >Delivery Address</button></a> --}}
                            <button class="tablinks max-md:hidden" onclick="clicktab(event, 'changepw')"
                                id="changepwTab">Change
                                Password</button>
                            {{-- <a class="block md:hidden"  href="{{ route('updatepassword') }}" >
                                    <button >Change Password</button></a> --}}
                            <button class="tablinks max-md:hidden" onclick="clicktab(event, 'mypoints')"
                                id="changemypointsTab">My
                                Points</button>
                            {{-- <a class="block md:hidden"  href="{{ route('mypoints') }}" >
                                    <button >My points</button></a> --}}

                        </div>
                        <div class="flex justify-end my-2">
                            @if ($userdata[0]->share_status == 'verified')
                                <div class="w-48 cursor-pointer" id="openModal" onclick="openModal()">
                                    <div>
                                        <div class="px-4 py-2 text-center text-white bg-green-700 rounded">
                                            Share Website
                                        </div>
                                    </div>
                                </div>

                                <div id="customModal"
                                    class="fixed z-[999] top-0 left-0 items-center justify-center hidden w-full h-full bg-black bg-opacity-50">
                                    <div class="w-11/12 max-w-md p-4 bg-white rounded-lg shadow-lg">
                                        <div class="flex items-center justify-between pb-2 mb-4 border-b">
                                            <h5 class="text-lg font-semibold">Share the Website</h5>
                                            <button class="text-gray-500 hover:text-gray-700"
                                                id="closeModal">&times;</button>
                                        </div>
                                        <div class="mb-4">
                                            <p class="mb-2 text-gray-700">Copy the current page URL below to share:</p>
                                            <div>
                                                <input type="text" class="w-full px-2 py-1 border rounded" id="urlField"
                                                    value="{{ 'https://suvlav.com?websuvcode=' . $userdata[0]->affilate_code }}"
                                                    readonly>
                                                <button id="copyButton"
                                                    class="px-4 py-2 mt-2 text-white bg-blue-600 rounded hover:bg-blue-700">
                                                    Copy
                                                </button>
                                            </div>

                                            <div class="pt-2">
                                                <label class="font-medium text-md">Or share with</label>
                                                @include('front.popicon')
                                            </div>
                                        </div>
                                        <div class="flex justify-end">
                                            <button class="px-4 py-2 text-white bg-red-600 rounded hover:bg-red-700"
                                                id="closeFooterModal">Close</button>
                                        </div>
                                    </div>
                                </div>

                                <script>
                                    // Get elements
                                    const customModal = document.getElementById('customModal');
                                    const closeModalBtn = document.getElementById('closeModal');
                                    const closeFooterModalBtn = document.getElementById('closeFooterModal');
                                    const copyButton = document.getElementById('copyButton'); // Define copyButton
                                    const urlField = document.getElementById('urlField'); // Define urlField

                                    // Open modal
                                    function openModal() {
                                        customModal.classList.remove('hidden');
                                        customModal.classList.add('flex');
                                    }

                                    // Close modal
                                    closeModalBtn.addEventListener('click', () => {
                                        customModal.classList.remove('flex');
                                        customModal.classList.add('hidden');
                                    });

                                    closeFooterModalBtn.addEventListener('click', () => {
                                        customModal.classList.remove('flex');
                                        customModal.classList.add('hidden');
                                    });

                                    // Close modal when clicking outside of it
                                    window.addEventListener('click', (e) => {
                                        if (e.target === customModal) {
                                            customModal.classList.remove('flex');
                                            customModal.classList.add('hidden');
                                        }
                                    });

                                    // Copy URL to clipboard
                                    copyButton.addEventListener('click', () => {
                                        urlField.select();
                                        urlField.setSelectionRange(0, 99999); // For mobile devices
                                        navigator.clipboard.writeText(urlField.value).then(() => {
                                            alert('URL copied to clipboard!');
                                        });
                                    });
                                </script>
                            @endif
                        </div>

                        <style>
                            @media (max-width: 576px) {
                                .ptab {
                                    display: flex !important;
                                    flex-direction: column;
                                }

                                .ptab button {
                                    width: 100%;
                                    /* margin-bottom: 10px; */
                                }
                            }
                        </style>


                        <div id="order_history" class="tabcontent max-md:hidden">
                            <div class="row max-md:hidden">
                                <div class="mt-2 col-12 table-responsive">
                                    <div>
                                        <table class="table">
                                            <tbody>
                                                <?php 
                        $sn =1;
                        foreach($orders as $order) {
                            $cdate = explode(' ',$order->created_at);
                            $orderId = $order->id;
                            $orderDetails = DB::table('orders as a')
                                ->join('order_details as b', 'b.order_id', '=', 'a.id')
                                ->where('a.id', $orderId)
                                ->get();
                        ?>
                                                <div
                                                    class="p-4 mx-auto mb-5 bg-white border border-black rounded-md shadow-md">
                                                    <div class="flex flex-wrap items-start gap-4">
                                                        <div class="flex-1 w-full sm:w-auto">
                                                            <h3 class="font-semibold text-gray-800">Order
                                                                #<?php echo $order->id; ?></h3>
                                                            <h3 class="font-semibold text-gray-800">Tracking Order
                                                                #<?php echo $order->tracking_code; ?></h3>
                                                            <p class="text-xs text-gray-500">Order Date: <?php echo $cdate[0]; ?>
                                                            </p>
                                                        </div>
                                                        <div class="items-end justify-end flex-1 w-full sm:w-auto">
                                                            <div class="flex">
                                                                <p><strong>Status: </strong></p>
                                                                <span
                                                                    class="badge text-xs bg-{{ strtolower($order->status) == 'completed' ? 'success' : 'warning' }}">
                                                                    {{ $order->status }}
                                                                </span>
                                                            </div>
                                                        </div>
                                                        <div
                                                            class="flex items-center w-full mt-4 gap-x-2 sm:w-auto sm:mt-0">
                                                            <a href="{{ route('profile.order', $order->id) }}">
                                                                <div style="background-color: green;width: 50px;color:white"
                                                                    class="rounded">
                                                                    <i
                                                                        class="flex items-center justify-center px-3 py-1 fa fa-eye"></i>
                                                                </div>
                                                            </a>
                                                            @if (
                                                                $order->status != 'Cancel' &&
                                                                    $order->status != 'Exchange' &&
                                                                    $order->status != 'Wanttoexchange' &&
                                                                    $order->status != 'Delevered')
                                                                <div id="openModalBtn-{{ $order->id }}"
                                                                    class="p-1 text-white bg-red-500 rounded cursor-pointer">
                                                                    Cancel
                                                                </div>
                                                            @endif
                                                        </div>
                                                    </div>


                                                    <div id="customModal-{{ $order->id }}"
                                                        class="fixed z-[999] inset-0 flex items-center justify-center hidden bg-black bg-opacity-50">
                                                        <!-- Modal Content -->
                                                        <div
                                                            class="bg-white rounded-lg shadow-lg w-full max-w-md p-6 relative max-h-[80vh] overflow-y-auto">
                                                            <!-- Close Button -->



                                                            <!-- Modal Header -->
                                                            <h2 class="mb-4 text-2xl font-semibold">Cancel or Exchange
                                                            </h2>

                                                            <!-- Inquiry Form -->
                                                            <form id="inquiryForm" method="post"
                                                                action="{{ route('member.statusupdate', $order->id) }}"
                                                                class="space-y-4">
                                                                <!-- Name -->
                                                                @csrf




                                                                <!-- Subject -->
                                                                <div>
                                                                    <label
                                                                        class="block text-sm font-medium text-gray-700">Cancel
                                                                        /
                                                                        Exchange </label>

                                                                    <select id="status" name="status" required
                                                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                                                        <option value="" disabled>Choose an option
                                                                        </option>




                                                                        @if ($order->status != 'Delevered')
                                                                            <option selected value="Cancel">Cancel</option>
                                                                        @endif
                                                                    </select>


                                                                    @error('status')
                                                                        <div class="text-sm text-red-400 invalid-feedback"
                                                                            style="display: block;">
                                                                            * {{ $message }}
                                                                        </div>
                                                                    @enderror
                                                                </div>

                                                                <!-- Message -->
                                                                <div>
                                                                    <label
                                                                        class="block text-sm font-medium text-gray-700">Reason</label>
                                                                    <textarea id="reason" name="reason"
                                                                        class="w-full px-3 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-500"
                                                                        placeholder="Your Message" rows="4" required>{{ old('reason') }}</textarea>
                                                                    @error('reason')
                                                                        <div class="text-sm text-red-400 invalid-feedback"
                                                                            style="display: block;">
                                                                            * {{ $message }}
                                                                        </div>
                                                                    @enderror
                                                                </div>



                                                                <!-- Modal Footer -->
                                                                <button id="confirmBtn" type="submit"
                                                                    class="px-4 py-2 text-white bg-green-500 rounded hover:bg-green-600">
                                                                    Confirm
                                                                </button>

                                                                <button id="closeModalBtn-{{ $order->id }}"
                                                                    class="px-4 py-2 text-white bg-red-500 rounded hover:bg-red-600">
                                                                    Close
                                                                </button>
                                                            </form>
                                                        </div>
                                                    </div>


                                                    <script>
                                                        // Get elements dynamically for each modal
                                                        const openModalBtn{{ $order->id }} = document.getElementById('openModalBtn-{{ $order->id }}');
                                                        const closeModalBtn{{ $order->id }} = document.getElementById('closeModalBtn-{{ $order->id }}');
                                                        const modal{{ $order->id }} = document.getElementById('customModal-{{ $order->id }}');

                                                        // Open modal function
                                                        const openModal{{ $order->id }} = () => {
                                                            modal{{ $order->id }}.classList.remove('hidden');
                                                        };

                                                        // Close modal function
                                                        const closeModal{{ $order->id }} = () => {
                                                            modal{{ $order->id }}.classList.add('hidden');
                                                        };

                                                        // Event listeners
                                                        openModalBtn{{ $order->id }}.addEventListener('click', openModal{{ $order->id }});
                                                        closeModalBtn{{ $order->id }}.addEventListener('click', closeModal{{ $order->id }});

                                                        // Close modal when clicking outside the content
                                                        window.addEventListener('click', (event) => {
                                                            if (event.target === modal{{ $order->id }}) {
                                                                closeModal{{ $order->id }}();
                                                            }
                                                        });
                                                    </script>





                                                    <?php foreach ($orderDetails as $detail) { ?>
                                                    <div class="flex items-start gap-4 pt-4 mt-4 border-t">
                                                        <img src="{{ asset('public/' . $detail->product_image) }}"
                                                            alt="Product" class="object-cover w-20 h-20 rounded" />
                                                        <div class="flex-1">
                                                            <p class="mb-1 text-sm font-medium text-gray-700">
                                                                <?php echo $detail->product_name; ?>
                                                            </p>
                                                            <div class="flex items-center justify-between mt-2">
                                                                <p class="font-semibold text-gray-800">Rs.
                                                                    <?php echo $detail->price; ?></p>
                                                                <p class="text-sm text-gray-500">Qty: <?php echo $detail->quantity; ?>
                                                                </p>
                                                                @if ($detail->status == 'exchanged')
                                                                    <div
                                                                        class="p-1 text-white bg-blue-500 rounded cursor-pointer">
                                                                        Exchanged
                                                                    </div>
                                                                @elseif ($detail->status == 'wanttoexchange')
                                                                    <div
                                                                        class="p-1 text-white bg-yellow-600 rounded cursor-pointer">
                                                                        Exchange on pending
                                                                    </div>
                                                                @elseif ($order->status == 'Delevered')
                                                                    @php
                                                                        $checkdate =
                                                                            \Carbon\Carbon::parse(
                                                                                $order->delivered_date,
                                                                            )->addDays(7) >= \Carbon\Carbon::now();
                                                                    @endphp
                                                                    @if ($checkdate)
                                                                        <a
                                                                            href="{{ route('exchange', ['details' => $detail->item_id]) }}">
                                                                            <div
                                                                                class="p-1 text-white bg-red-500 rounded cursor-pointer">
                                                                                Want To Exchange
                                                                            </div>
                                                                        </a>
                                                                    @endif
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <?php } ?>
                                                    <div
                                                        class="flex items-center justify-between pt-3 mt-3 text-sm font-semibold text-gray-800 border-t">
                                                        <p>Total (<?php echo count($orderDetails); ?> Item(s)):</p>
                                                        <p>Rs. {{ moneyFormat((float) $order->total_amt) }}</p>
                                                    </div>
                                                    @if ($order->use_point)
                                                        <div>
                                                            <p class="text-right"><strong>Point Use :</strong>
                                                                <strong>{{ moneyFormat((float) $order->use_point) }}</strong>
                                                            </p>
                                                        </div>
                                                        <div>
                                                            <p class="text-right"><strong>To Be Paid :</strong>
                                                                <strong>{{ moneyFormat((float) $order->total_amt - (float) $order->use_point) }}</strong>
                                                            </p>
                                                        </div>
                                                    @endif
                                                </div>
                                                <?php $sn++; } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                        </div>


                        <!-- Start login and register form -->

                        <div id="Profile" class="tabcontent">
                            <div style="background-color: orange" class="mt-2 text-center text-white rounded card-header">
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
                        <!-- Start login and register form -->

                        <div id="changepw" class="tabcontent">
                            <div style="background-color: orange" class="my-2 text-center text-white rounded card-header">
                                <h4 class="mb-0" style="font-size: 14px;font-weight: bold;">Change Password </h4>
                            </div>


                            <div class="container ">
                                <div class="row justify-content-center">
                                    <div class="col-md-4 col-lg-4">
                                        <div class="p-4 bg-white rounded shadow">
                                            <form method="POST" action="{{ route('member.changepw') }}">
                                                @csrf
                                                <div class="mb-3">
                                                    <div class="">
                                                        <label for="oldPassword" class="form-label">Old Password</label>
                                                        <input type="password" class="form-control" id="oldPassword"
                                                            placeholder="Enter old password" name="old_password"
                                                            value="{{ old('old_password') }}">
                                                    </div>
                                                    @error('old_password')
                                                        <div class="text-danger">
                                                            * {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>

                                                <div class="mb-3">
                                                    <div class="">

                                                        <label for="newPassword" class="form-label">New Password</label>
                                                        <input type="password" class="form-control" id="newPassword"
                                                            placeholder="Enter new password" name="new_password"
                                                            value="{{ old('new_password') }}">
                                                    </div>
                                                    @error('new_password')
                                                        <div class="text-danger">
                                                            * {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>

                                                <div class="mb-3">
                                                    <div class="">

                                                        <label for="confirmPassword" class="form-label">Confirm
                                                            Password</label>
                                                        <input type="password" class="form-control" id="confirmPassword"
                                                            placeholder="Enter confirm password" name="confirm_password"
                                                            value="{{ old('confirm_password') }}">
                                                    </div>
                                                    @error('confirm_password')
                                                        <div class="text-danger">
                                                            * {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                                <button type="submit" class="btn btn-primary w-100">Update
                                                    Password</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>




                        </div>

                        <!-- Start  delivery Addresss form -->
                        <div id="deladdress" class="tabcontent">

                            <div style="background-color: orange" class="my-2 text-center text-white rounded card-header">
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
                                {{-- <div class="col-lg-4 col-md-4 col-12">
                                    <div class="form-group">
                                        <span>City</span> &nbsp; : &nbsp; {{ @$shippings[0]->city }}
                                    </div>
                                </div> --}}
                                <div class="col-lg-4 col-md-4 col-12">
                                    <div class="form-group">
                                        <span>Address.</span> &nbsp; : &nbsp;
                                        {{ @$shippings[0]->address }}
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4 col-12">
                                    <div class="form-group">
                                        <span>Tole.</span> &nbsp; : &nbsp;
                                        {{ @$shippings[0]->tole }}
                                    </div>
                                </div>

                            </div>
                            <div class="row">




                                {{-- <div class="col-lg-4 col-md-4 col-12">
                                    <div class="form-group">
                                        <span>House No.</span> &nbsp; : &nbsp; {{ @$shippings[0]->houseno }}
                                    </div>
                                </div> --}}

                                <div class="col-lg-4 col-md-4 col-12">
                                    <div class="form-group">
                                        <span>Gaupalika</span> &nbsp; : &nbsp;
                                        {{ @$shippings[0]->gaupalika }}
                                    </div>
                                </div>


                                <div class="col-lg-4 col-md-4 col-12">
                                    <div class="form-group">
                                        <span>Nagarpalika</span> &nbsp; : &nbsp;
                                        {{ @$shippings[0]->nagarpalika }}
                                    </div>
                                </div>


                                <div class="col-lg-4 col-md-4 col-12">
                                    <div class="form-group">
                                        <span>Wardno</span> &nbsp; : &nbsp;
                                        {{ @$shippings[0]->wardno }}
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

                        <div id="mypoints" class="tabcontent max-sm:hidden">
                            <div style="background-color: orange" class="my-2 text-center text-white rounded card-header">
                                <h4 class="mb-0" style="font-size: 14px;font-weight: bold;">
                                    My Points </h4>
                            </div>
                            {{--  <label>Available Points</label> --}}
                            {{-- <div class="">{{ $userdata[0]->total_points ?? 0 }}</div> --}}


                            <div class="container mt-5">
                                <div class="text-center border-0 shadow-lg card" style="max-width: 400px; margin: auto;">
                                    <div class="p-4 card-body">
                                        <h5 class="font-semibold card-title text-uppercase text-secondary">Available Points
                                        </h5>
                                        <div class="display-4 fw-bold text-primary">{{ $userdata[0]->total_points ?? 0 }}
                                        </div>
                                    </div>
                                </div>
                            </div>
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

                                {{-- <div class="col-lg-4 col-md-4 col-12">
                                    <div class="form-group">
                                        <span>City</span> &nbsp; <input type="text" name="city_del"
                                            value="{{ @$shippings[0]->city }}">
                                    </div>
                                </div> --}}
                                <div class="col-lg-4 col-md-4 col-12">
                                    <div class="form-group">
                                        <span>Address.</span> &nbsp; <input type="text" name="address_del"
                                            value="{{ @$shippings[0]->address }}">
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4 col-12">
                                    <div class="form-group">
                                        <span>Tole.</span> &nbsp;<input type="text" name="tole_del"
                                            value="{{ @$shippings[0]->tole }}">
                                    </div>
                                </div>

                            </div>
                            <div class="row">

                                {{-- <div class="col-lg-4 col-md-4 col-12">
                                    <div class="form-group">
                                        <span>House No.</span> &nbsp;<input type="text" name="house_del"
                                            value="{{ @$shippings[0]->houseno }}">
                                    </div>
                                </div> --}}


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
