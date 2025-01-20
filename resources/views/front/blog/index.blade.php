{{-- <section class="ezy__blog1 light">
    <div class="container py-5">
      <div class="row align-items-center">
        <!-- Blog Header Section -->
        <div class="col-lg-5 mb-4 mb-lg-0">
          <div class="text-center text-lg-start px-lg-5">
            <h2 class="ezy__blog1-heading mb-3">A Guide to the Latest in Fashion</h2>
            <p class="ezy__blog1-sub-heading mb-4">
              Vitae bibendum egestas magna sit elit non. Netus volutpat dignissim pharetra felis. Orci commodo mauris
              adipiscing semper amet.
            </p>
            <a href="{{ route('allblogs') }}" class="btn btn-primary btn-lg px-4 text-white">All Posts</a>
          </div>
        </div>
        <!-- Blog Cards Section -->
        <div class="col-lg-7 mt-4 mt-lg-0">
          <div class="row g-4">
            <!-- Single Blog Card -->


            @foreach ($blogs as $list)

            <div class="col-12 col-md-6">
              <article class="ezy__blog1-post h-100">
                <div class="position-relative">
                  <img
                    src="{{ asset($list->featured_image) }}"
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
                  <a href="{{ route('blogsdetails' , $list->slug) }}" class="btn btn-outline-primary text-white btn-sm px-3 mt-3">Read More</a>
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
   --}}


<section class="ezy__blog2 light">
    <div class="container">

        <div class="row ">
            @foreach ($blogs as $list)
                <div class="col-12 col-md-6 col-lg-4">
                    <article class="ezy__blog2-post rounded overflow-hidden h-100">
                        <img src="{{ asset('public/' . $list->featured_image) }}" alt="{{ $list->title }}" class="img-fluid" />

                        <div class="p-3 p-md-4">
                            <h4 class="ezy__blog2-title fs-4 mb-2"> {!! Str::limit($list->title, 50) !!} </h4>
                            <p class="ezy__blog2-author">
                                <span>At <span> {{ $list->updated_at->format('Y M d') }}</span></span>
                            </p>
                            <p class="ezy__blog2-description mt-2">
                                {!! Str::limit($list->description, 150) !!} </p>

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

        <div class="mt-5 d-flex justify-content-center">

            <a href="{{ route('allblogs') }}" class=" buttoncolor  px-4 py-2 text-white">View All</a>
        </div>

    </div>
</section>

<style>
    .ezy__blog2 {
        /* Bootstrap variables */
        --bs-body-color: #28303b;
        --bs-body-bg: #fff;

        /* easy frontend variables */
        --ezy-theme-color: rgb(13, 110, 253);
        --ezy-theme-color-rgb: 13, 110, 253;
        --ezy-card-bg: #fff;
        --ezy-card-shadow: 0 25px 41px rgba(89, 88, 109, 0.15);

        background-color: var(--bs-body-bg);
        padding: 60px 0;
        color: var(--bs-body-color);
    }

    @media (min-width: 768px) {
        .ezy__blog2 {
            padding: 100px 0;
        }
    }

    /* Gray Block Style */
    .gray .ezy__blog2,
    .ezy__blog2.gray {
        /* Bootstrap variables */
        --bs-body-bg: rgb(246, 246, 246);

        /* easy frontend variables */
        --ezy-card-bg: #fff;
        --ezy-card-shadow: 0px 8px 44px rgba(182, 198, 222, 0.48);
    }

    /* Dark Gray Block Style */
    .dark-gray .ezy__blog2,
    .ezy__blog2.dark-gray {
        /* Bootstrap variables */
        --bs-body-color: rgb(241, 241, 241);
        --bs-body-bg: rgb(30, 39, 53);

        /* easy frontend variables */
        --ezy-card-bg: rgb(11, 23, 39);
        --ezy-card-shadow: none;
    }

    /* Dark Block Style */
    .dark .ezy__blog2,
    .ezy__blog2.dark {
        /* Bootstrap variables */
        --bs-body-color: rgb(255, 255, 255);
        --bs-body-bg: rgb(11, 23, 39);

        /* easy frontend variables */
        --ezy-card-bg: rgb(30, 39, 53);
        --ezy-card-shadow: none;
    }

    /* heading and sub-heading */
    .ezy__blog2-heading {
        font-weight: 700;
        font-size: 32px;
        line-height: 1;
        color: var(--bs-body-color);
    }

    .ezy__blog2-sub-heading {
        color: var(--bs-body-color);
        font-size: 18px;
        font-weight: 500;
        line-height: 26px;
        opacity: 0.8;
    }

    @media (min-width: 991px) {
        .ezy__blog2-heading {
            font-size: 45px;
        }
    }

    .ezy__blog2-post {
        border-radius: 10px;
        overflow: hidden;
        background-color: var(--ezy-card-bg);
        box-shadow: var(--ezy-card-shadow);
    }

    .ezy__blog2-title {
        font-weight: 500;
        margin-top: 0 !important;
        color: var(--bs-body-color);
    }

    .ezy__blog2-description {
        color: var(--bs-body-color);
        opacity: 0.6;
    }

    .ezy__blog2-btn {
        padding: 12px 30px;
        font-weight: bold;
        color: #ffffff;
        background-color: var(--ezy-theme-color);
        border-color: var(--ezy-theme-color);
    }

    .ezy__blog2-btn:hover {
        color: #ffffff;
        background-color: rgba(var(--ezy-theme-color-rgb), 0.9);
    }

    .ezy__blog2-btn-read-more {
        padding: 7px 20px;
        color: var(--bs-body-color);
        border-color: var(--ezy-theme-color);
    }

    .ezy__blog2-btn-read-more:hover {
        background-color: rgba(var(--ezy-theme-color-rgb), 0.9);
        color: #ffffff;
    }

    .ezy__blog2-author a {
        color: var(--ezy-theme-color);
        opacity: 0.7;
    }
</style>
