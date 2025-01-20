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

    @media (max-width: 576px) {
        .form-wrapper {
            padding: 15px 10px;
        }

        h2 {
            font-size: 20px;
        }

        #submitbtm {
            font-size: 16px;
        }
    }
</style>

<section class="checkout-section md:my-52">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6 col-md-8 col-sm-10">
                <div class="form-wrapper">
                    <h2>Forget Password</h2>
                    @if($errors->any())
                        <div class="alert alert-danger">
                            {{ $errors->first() }}
                        </div>
                    @endif
                    <form action="{{ route('member.forgotpwformstore') }}" method="POST">
                        @csrf
                        <input type="hidden" name="prev_url" value="{{ url()->previous() }}">
                        <div class="form-group">
                            <label for="email">Email <span>*</span></label>
                            <input type="email" id="email" name="email" placeholder="Enter your email" required>
                        </div>
                
                        <button type="submit" id="submitbtm">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
