@extends('layouts.frontendapp')

@section('content')

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

<section class="faq-section py-5">
  <div class="container">
    <div class="row justify-content-center mb-4">
      <div class="col-lg-8 col-xl-7 text-center">
        <h2 class="fw-bold">Frequently Asked Questions</h2>
        <p class="text-muted">Find answers to commonly asked questions below.</p>
      </div>
    </div>

  

    <div class="row">
      @foreach($pages as $faq)
      <div class="col-md-6">
        <div class="accordion mt-3" id="accordion{{ $faq['id'] }}">
          <div class="accordion-item">
            <h2 class="accordion-header" id="heading{{ $faq['id'] }}">
              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $faq['id'] }}" aria-expanded="false" aria-controls="collapse{{ $faq['id'] }}">
                {{ $faq['title'] }}
              </button>
            </h2>
            <div id="collapse{{ $faq['id'] }}" class="accordion-collapse collapse" aria-labelledby="heading{{ $faq['id'] }}" data-bs-parent="#accordion{{ $faq['id'] }}">
              <div class="accordion-body">
                {!! $faq['description'] !!}
              </div>
            </div>
          </div>
        </div>
      </div>
      @endforeach
    </div>



  </div>
</section>
@endsection

<style>
  .faq-section {
    background-color: #f9f9f9;
  }
  .accordion-button:focus {
    box-shadow: none;
  }
  .accordion-item {
    border: 1px solid #ddd;
    margin-bottom: 10px;
  }
</style>
