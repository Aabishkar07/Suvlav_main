<section class="ezy__blog2 light">
  <div class="container">
    {{-- <div class="row justify-content-center">
      <div class="col-lg-8 text-center">
        <h2 class="ezy__blog2-heading mb-3 mt-0">Latest Blogs</h2>
     
        <a href="{{ route('allblogs') }}" class="btn btn-primary btn-lg px-4 text-white">View All</a>
      </div>
    </div> --}}

    <div class="container">
      <div class="d-flex justify-content-between align-items-center flex-wrap">
          <!-- Title -->
          <h2 class="New Arrivals  text-black text-2xl text-start fs-3" style="font-weight: 600">
             Latest Blogs
          </h2>
      
          
          <a href="{{ route('allblogs') }}" class="text-decoration-none">
              <div class="d-none d-sm-flex align-items-center gap-2 text-danger hover-underline">
                  View All
                  <div class="bg-danger text-white rounded-circle p-1 d-flex justify-content-center align-items-center">
                      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" width="24" height="24">
                          <path d="M12 2l.324 .005a10 10 0 1 1 -.648 0l.324 -.005zm.613 5.21a1 1 0 0 0 -1.32 1.497l2.291 2.293h-5.584l-.117 .007a1 1 0 0 0 .117 1.993h5.584l-2.291 2.293l-.083 .094a1 1 0 0 0 1.497 1.32l4 -4l.073 -.082l.064 -.089l.062 -.113l.044 -.11l.03 -.112l.017 -.126l.003 -.075l-.007 -.118l-.029 -.148l-.035 -.105l-.054 -.113l-.071 -.111a1.008 1.008 0 0 0 -.097 -.112l-4 -4z"></path>
                        </svg>
                  </div>
              </div>
  
              <!-- For smaller screens -->
              <div class="d-flex d-sm-none">
                  <span class="text-danger">View All</span>
              </div>
          </a>
      </div>
  
      <!-- Divider -->
      <div class="d-flex py-4">
          <div class="flex-shrink-0" style="width: 10%; border-top: 2px solid #ff6f10;"></div>
          <div class="flex-grow-1 border-top"></div>
      </div>
  </div>

    <div class="row mt-3 mt-md-5">

      @foreach ($blogs as $list)
        
 
      <div class="col-12 col-md-6 col-lg-4 mt-4">
        <article class="ezy__blog2-post rounded overflow-hidden h-100">
          <img src="{{ asset('public/' . $list->featured_image) }}" alt="" class="img-fluid w-100 h-96 object-contain" />
          <div class="p-3 p-md-4">
            <h4 class="ezy__blog2-title fs-4 mb-2">{!! Str::limit($list->title, 50) !!}</h4>
            <p class="ezy__blog2-author">
              <span>At <span>{{ $list->updated_at->format('Y M d') }}</span></span>
            </p>
            <p class="ezy__blog2-description mb-3">
              {!! Str::limit($list->description, 120) !!}
            </p>
<div class="mt-3">

  <a href="{{ route('blogsdetails', $list->slug) }}"
    class=" text-white btn-sm px-3 py-2 mt-3 bg-black"> Read More </a>
</div>
          </div>
        </article>
      </div>
      @endforeach
      
    
   
     
    
 
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