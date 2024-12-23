
@extends('layouts.frontendapp')

@section('content')


<section class="ezy__blog1 light">
  <div class="container py-5">
    <div class="row align-items-center">
      
        <div class="col-lg-12  mb-5 text-center">
          <h2 class="fw-bold">All Blogs</h2>
          <p class="text-muted">Find answers through latest Blogs.</p>
        </div>
  
      <!-- Blog Cards Section -->
      <div class="col-lg-12 mt-4 mt-lg-0">
        <div class="row g-4">
          <!-- Single Blog Card -->


          @foreach ($blogs as $list)

          <div class="col-12 col-md-4">
            <article class="ezy__blog1-post h-100">
              <div class="position-relative">
                <img
                  src="{{ asset('public/' .$list->featured_image) }}"
                  alt="How I’m Styling Everyday Black Outfits"
                  class="img-fluid rounded-top"
                />
             
              </div>
              <div class="p-3">
                <p class="ezy__blog1-author mb-1">
                   <a href="#!" class="text-decoration-none">{{ $list->updated_at->format('Y M s' ,) }}</a>
                </p>
                <h4 class="ezy__blog1-title mt-2 mb-3">{{ $list->title }}</h4>
                <p class="ezy__blog1-description mb-3">
                  {!! Str::limit( $list->description, 60)!!}
                </p>
                <div class="mb-3">

                                </div>
                            <a href="{{ route('blogsdetails', $list->slug) }}"
                                class=" text-white btn-sm px-3 py-2 buttoncolor"> Read More </a>

                                <style>
                                    .buttoncolor {
                                        background-color: #316FF6;
                                        border-color: #316FF6;
                                        hover: border-#316FF6;
                                        border: 1px solid #316FF6;
                                        border-radius:10px;
                                        margin-top:10px !important;
                                    }

                                    .buttoncolor:hover {
                                        background-color: #ffff !important;
                                        border-color: #316FF6 !important;
                                        color:#316FF6 !important;
                                        border: 1px solid #316FF6 !important;
                                    }


                                </style>
              </div>
            </article>
          </div>
        
          @endforeach
        </div>
      </div>
    </div>
  </div>
</section>

<style>
  /* General Section Styling */
  .ezy__blog1 {
    /* background-color: #f9f9f9; */
    color: #333;
  }

  /* Heading and Subheading */
  .ezy__blog1-heading {
    font-weight: 700;
    font-size: 2.5rem;
    color: #28303b;
  }

  .ezy__blog1-sub-heading {
    font-size: 1rem;
    color: #555;
    line-height: 1.6;
  }

  /* Blog Post Card */
  .ezy__blog1-post {
    border: 1px solid #ddd;
    border-radius: 8px;
    background-color: #fff;
    transition: transform 0.3s, box-shadow 0.3s;
    overflow: hidden;
  }

  .ezy__blog1-post:hover {
    transform: translateY(-5px);
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
  }

  .ezy__blog1-calendar {
    background: rgba(255, 255, 255, 0.9);
    color: #333;
    border-bottom-right-radius: 8px;
    font-size: 0.9rem;
    text-align: center;
  }

  .ezy__blog1-title {
    font-size: 1.25rem;
    font-weight: 600;
    color: #333;
  }

  .ezy__blog1-description {
    font-size: 0.9rem;
    color: #555;
    line-height: 1.5;
  }

  .ezy__blog1-btn {
    background-color: #0d6efd;
    border-color: #0d6efd;
    color: #fff;
    transition: background-color 0.3s;
  }

  .ezy__blog1-btn:hover {
    background-color: #0056b3;
  }

  .ezy__blog1-btn-read-more {
    font-size: 0.85rem;
  }

  .ezy__blog1-author a {
    color: #0d6efd;
    font-weight: 500;
  }

  .ezy__blog1-author a:hover {
    text-decoration: underline;
  }
</style>

  @endsection
 
  