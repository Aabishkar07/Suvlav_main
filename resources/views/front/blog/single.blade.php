
@extends('layouts.frontendapp')

@section('content')


<section class="ezy__blogdetails1 light" id="ezy__blogdetails1">
  <div class="container">
    <div class="row">
      <div class="col-12 col-md-11">
        <h1 class="ezy__blogdetails1-heading mb-5">{{ $blog->title }}</h1>
      </div>
    </div>
    <div class="row">
      <div class="col-12 col-md-8">
        <img src="{{ asset("public/". $blog->featured_image) }}" alt="" class="img-fluid rounded" />
        <div class="d-flex justify-content-between my-5 me-5">
          <div class="d-flex align-items-center">
        
          
            <p class="mb-0 ms-3">{{ $blog->updated_at->format('Y M s') }}</p>

          

          </div>
          <div class="ezy__blogdetails1-social">
            <ul class="nav ezy__footer13-quick-links">
              <a href=""><i class="fab fa-facebook me-3"></i></a>
              <a href=""><i class="fab fa-instagram me-3"></i></a>
              <a href=""><i class="fab fa-linkedin-in me-3"></i></a>
              <a href=""><i class="fab fa-twitter me-3"></i></a>
              <a href=""><i class="fab fa-whatsapp me-3"></i></a>
              <a href=""><i class="fas fa-share-alt me-3"></i></a>
              <a href=""><i class="fas fa-bookmark"></i></a>
            </ul>
          </div>
        </div>
        <div class="ezy__blogdetails1-content">
          <p>
           {!! $blog->description!!}
          </p>
       

          <br />
  

   
        </div>
      </div>


     
      <div class="col-12 col-md-4 col-lg-3">
        <div class="ezy__blogdetails1-top py-4 px-3 mb-4">
          <h5 class="mb-0">Popular Blogs</h5>
        </div>
        <!-- blog item -->

        @foreach ($otherblogs as $key=>$value )
          
    
        <a href="{{ route('blogsdetails' , $value->slug) }}">
        <div class="ezy__blogdetails1-item d-flex justify-content-between align-items-start">
          <img src="{{ asset("public/". $value->featured_image) }}" alt="" class="img-fluid rounded" style="height: 100px; width:100px" />
          <div class="ms-3 p-2">
            <h6>{{ \Illuminate\Support\Str::limit($value->title , '25')}}
            </h6>
                <div class="d-flex flex-wrap opacity-50">
              <span class="me-3">{{ $value->updated_at->format('Y M s') }}</span>
              <p class="me-3 text-xs">Read more..</p>
            </div>
          </div>
        </div>
        </a>
        <hr class="my-4" />
        @endforeach
      </div>
    </div>
  </div>
</section>

<style>
.ezy__blogdetails1 {
  /* Bootstrap variables */
  --bs-body-bg: rgb(255, 255, 255);

  /* Easy Frontend variables */
  --ezy-theme-color: rgb(13, 110, 253);
  --ezy-theme-color-rgb: 13, 110, 253;
  --ezy-blog-top-color: #21252d;

  background-color: var(--bs-body-bg);
  color: var(--bs-body-color);
  overflow: hidden;
  padding: 60px 0;
  position: relative;
}

@media (min-width: 768px) {
  .ezy__blogdetails1 {
    padding: 100px 0;
  }
}

/* Gray Block Style */
.gray .ezy__blogdetails1,
.ezy__blogdetails1.gray {
  /* Bootstrap variables */
  --bs-body-bg: rgb(246, 246, 246);
}

/* Dark Gray Block Style */
.dark-gray .ezy__blogdetails1,
.ezy__blogdetails1.dark-gray {
  /* Bootstrap variables */
  --bs-body-color: #ffffff;
  --bs-body-bg: rgb(30, 39, 53);

  /* Easy Frontend variables */
  --ezy-blog-top-color: rgb(11, 23, 39);
}

/* Dark Block Style */
.dark .ezy__blogdetails1,
.ezy__blogdetails1.dark {
  /* Bootstrap variables */
  --bs-body-color: #ffffff;
  --bs-body-bg: rgb(11, 23, 39);

  /* Easy Frontend variables */
  --ezy-blog-top-color: rgb(30, 39, 53);
}

.ezy__blogdetails1-heading {
  font-weight: 400;
  font-size: 20px;
  line-height: 1;
}

@media (min-width: 768px) {
  .ezy__blogdetails1-heading {
    font-size: 45px;
  }
}

.ezy__blogdetails1-social a {
  color: var(--bs-body-color);
  font-size: 22px;
}

/* sidebar */
.ezy__blogdetails1-top {
  background-color: var(--ezy-blog-top-color);
  color: #fff;
  border-radius: 10px 10px 0 0;
}

.ezy__blogdetails1 hr {
  color: var(--ezy-theme-color);
}

/* Content style */
.ezy__blogdetails1-content,
.ezy__blogdetails1-content p {
  color: var(--bs-body-color);
  font-size: 17px;
  line-height: 25px;
  opacity: 0.8;
}
</style>
  @endsection
 
  