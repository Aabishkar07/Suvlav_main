@extends('layouts.frontendapp')
@section('content')


{{-- <div class="container">
    <h1 class="mb-5">Searched Results for <span class="text-[#Ec1464]">{{ $query }}</span></h1>

    @if (count($products) > 0)
        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-4 ">

            @foreach ($products as $list)
            @include('front.components.productcard', ['list' => $list, 'slider' => '1'])
            @endforeach
        @else
            <p>No results found.</p>
    @endif
</div>

</div> --}}


<div class="product-area section">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section-title">
                    <h2>Searched Results for <span class="text-[#Ec1464]">{{ $query }}</span></h2>
                </div>
            </div>
        </div>


        @if (count($products) > 0)

        <div class="row">
            <div class="col-12">
                <div class="product-info" style="margin-top: -15px;">
                    <div class="row">
                        @foreach ($products as $list)
                        @include('front.components.productcard', [
                                'list' => $list,
                                'index' => $loop->index,
                                'slider' => '0',
                            ])
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        @else
       

        <section class="md:pt-4 ezy__signup16 light d-flex align-items-center justify-content-center">
            <div class="container">
                
              <div class="row justify-content-center">
                <div class="col-12 col-md-8">
                  <div class="p-3 rounded shadow ezy__signup16-card">
                    <p class="pb-2 text-sm text-danger">* No results found. If you want to receive notifications regarding this product,.</p>

                    <div class="md:shadow p-lg-5">
                        
                      <h2 class="pt-2 text-center ezy__signup16-heading"> Please fill out this form</h2>
          
                      <!-- form -->
                      <form action="{{ route('search.history.store') }}" class="mt-4" method="POST">
                        @csrf
                        <div class="row">
                          <div class="col-12 col-md-6">
                            <div class="mb-4 form-group position-relative">
                              <label class="mb-2" for="uname">NAME:</label>
                              <input type="text" placeholder="Enter Name" name="name" class="form-control" id="uname"  required/>
                              
                            </div>
                          </div>
                          <div class="col-12 col-md-6">
                            <div class="mb-4 form-group position-relative">
                              <label class="mb-2" for="email">EMAIL:</label>
                              <input type="email"  placeholder="Enter Your Email" name="email" class="form-control" id="email" required/>
                            
                            </div>
                          </div>
                          <div class="col-12 col-md-6">
                            <div class="mb-4 form-group position-relative">
                              <label class="mb-2" for="pass">Contact no:</label>
                              <input type="number" class="form-control" name="phonenumber" id="pass" placeholder="Enter your contact number" required/>
                          
                            </div>
                          </div>
                          <div class="col-12 col-md-6">
                            <div class="mb-4 form-group position-relative">
                              <label class="mb-2" for="conPass">Address</label>
                              <input type="text" class="form-control" id="conPass"  name="district" placeholder="Enter your address" required />
                              
                            </div>
                          </div>
                          <input type="text" class="form-control" id="conPass"  name="query" value="{{ $query }}" placeholder="Enter your address" hidden />

                
                          <div class="col-12 ">
                            <div class="mt-3 d-flex">
                              <button type="submit" class="bg-black btn">
                                Register <i class="fas fa-arrow-right"></i>
                              </button>
                            </div>
                          </div>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </section>
          
          <style>
          .ezy__signup16 {
            /* Bootstrap variables */
            --bs-body-color: #1c1c1f;
            --bs-body-bg: rgb(255, 255, 255);
          
            /* Easy Frontend variables */
            --ezy-theme-color: rgb(13, 110, 253);
            --ezy-theme-color-rgb: 13, 110, 253;
            --ezy-form-card-bg: #ffffff;
            --ezy-form-card-shadow: 6px 0px 118px rgba(0, 0, 0, 0.08);
            --ezy-border-color: rgba(0, 0, 0, 0.125);
          
            color: var(--bs-body-color);
            background-color: var(--bs-body-bg);
            background-size: cover;
            background-position: right;
            /* padding: 60px 0; */
          }
          
          @media (min-width: 991px) {
            .ezy__signup16 {
              /* padding: 100px 0; */
            }
          }
          
          /* Gray Block Style */
          .gray .ezy__signup16,
          .ezy__signup16.gray {
            /* Bootstrap variables */
            --bs-body-bg: rgb(246, 246, 246);
          
            /* Easy Frontend variables */
            --ezy-form-card-bg: #f6f6f6;
            --ezy-form-card-shadow: 6px 0px 118px rgba(38, 38, 38, 0.08);
          }
          
          /* Dark Gray Block Style */
          .dark-gray .ezy__signup16,
          .ezy__signup16.dark-gray {
            /* Bootstrap variables */
            --bs-body-color: #ffffff;
            --bs-body-bg: rgb(30, 39, 53);
            --bs-dark-rgb: 255, 255, 255;
          
            /* Easy Frontend variables */
            --ezy-form-card-bg: rgb(11, 23, 39);
            --ezy-form-card-shadow: none;
            --ezy-border-color: rgb(58, 68, 80);
          }
          
          /* Dark Block Style */
          .dark .ezy__signup16,
          .ezy__signup16.dark {
            /* Bootstrap variables */
            --bs-body-color: #ffffff;
            --bs-body-bg: rgb(11, 23, 39);
            --bs-dark-rgb: 255, 255, 255;
          
            /* Easy Frontend variables */
            --ezy-form-card-bg: rgb(30, 39, 53);
            --ezy-form-card-shadow: none;
            --ezy-border-color: rgba(127, 127, 127, 0.35);
          }
          
          .ezy__signup16-heading {
            font-weight: bold;
            font-size: 26px;
            line-height: 1;
            letter-spacing: 1px;
          }
          @media (min-width: 991px) {
            .ezy__signup16-heading {
              font-size: 34px;
            }
          }
          
          .ezy__signup16-icon {
            position: absolute;
            top: 48px;
            left: 15px;
            font-size: 14px;
            opacity: 0.8;
          }
          .ezy__signup16-card {
            background-color: var(--ezy-form-card-bg);
            box-shadow: var(--ezy-form-card-shadow);
          }
          .ezy__signup16-form-card {
            border: 1px solid var(--ezy-border-color);
          }
          
          .ezy__signup16-form-card label {
            font-size: 15px;
            font-weight: 500;
            opacity: 0.8;
          }
          .ezy__signup16 .form-control,
          .ezy__signup16 .form-select {
            min-height: 48px;
            line-height: 1;
            border: 1px solid var(--ezy-border-color);
            background-color: transparent;
            color: var(--bs-body-color);
            border-radius: 0;
            font-size: 16px;
            padding-left: 10px;
            opacity: 0.75;
          }
          .ezy__signup16 .form-select {
            background-color: var(--ezy-form-card-bg);
            border-color: var(--ezy-border-color) !important;
          }
          .ezy__signup16 .form-control:focus {
            border-color: var(--ezy-theme-color);
            box-shadow: none;
          }
          
          .ezy__signup16-btn-submit {
            padding: 12px 40px;
            background-color: var(--ezy-theme-color);
            color: #ffffff;
            border-radius: 0;
          }
          
          .ezy__signup16-btn-submit:hover {
            color: #ffffff;
            background-color: rgba(var(--ezy-theme-color-rgb), 0.9);
          }
          .ezy__signup16 a {
            color: var(--bs-body-color);
          }
          .ezy__signup16 a:hover {
            color: var(--ezy-theme-color);
          }
          </style>

        @endif
    </div>
</div>

@endsection