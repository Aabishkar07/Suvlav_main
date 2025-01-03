<section class="ezy__blog2 light">
  <div class="container">
    <div class="d-flex justify-content-between align-items-center flex-wrap">
      <!-- Title -->
      <h2 class="New Arrivals text-black text-2xl text-start fs-3" style="font-weight: 600">
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
      </a>
    </div>

    <!-- Divider -->
    <div class="d-flex py-4">
        <div class="flex-shrink-0" style="width: 10%; border-top: 2px solid #ff6f10;"></div>
        <div class="flex-grow-1 border-top"></div>
    </div>

    <div class="row mt-3 mt-md-5">
      @foreach ($blogs as $list)
        <div class="col-12 col-md-6 col-lg-4 mt-4">
          <article class="ezy__blog2-post rounded overflow-hidden h-100">
            <div class="blog-image-wrapper">
              <img src="{{ asset('public/' . $list->featured_image) }}" alt="" class="img-fluid w-100 h-100 object-fit-cover" />
            </div>
            <div class="p-3 p-md-4">
              <h4 class="ezy__blog2-title fs-4 mb-2">{!! Str::limit($list->title, 50) !!}</h4>
              <p class="ezy__blog2-author">
                <span>At <span>{{ $list->updated_at->format('Y M d') }}</span></span>
              </p>
              <p class="ezy__blog2-description mb-3">
                {!! Str::limit($list->description, 120) !!}
              </p>
              <div class="mt-3">
                <a href="{{ route('blogsdetails', $list->slug) }}" class="text-white btn-sm px-3 py-2 mt-3 bg-black"> Read More </a>
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
  --bs-body-color: #28303b;
  --bs-body-bg: #fff;
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

/* Image Styling */
.blog-image-wrapper {
  height: 240px; /* Set height of the image container */
  width: 100%; /* Full width */
}

.blog-image-wrapper img {
  object-fit: cover; /* Ensures the image covers the container */
  height: 100%;
  width: 100%;
}
</style>
