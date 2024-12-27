@extends('layouts.backendapp')

@section('content')

@php
// Configure this page 
$pageName = 'Create Faq';

$breadcrumbs = [
    ['title' => 'Dashboard', 'link' => '#', 'isActive' => ''],
    ['title' => 'Pages', 'link' => '#', 'isActive' => ''],
    ['title' => 'faq', 'link' => '#', 'isActive' => 'active'],
];
$currencyName = currencyName();
@endphp 

       
  <form action="{{ route('faqs.store') }}" method="POST" class="forms-sample" enctype="multipart/form-data">
        @csrf
    <div class="col-lg-12 grid-margin stretch-card px-5">
      <div class="card">
        <div class="card-body">

            <div class="form-group row">
              <label for="titleInput" class="col-sm-3 col-form-label">Name</label>
              <div class="col-sm-9">
                <input type="text" name="title" class="form-control" value="" id="titleInput" placeholder="Name">
                @error('title') <span> {{$message}} </span> @enderror
              </div>
            </div>


            <div class="form-group row">
              <label for="description" class="col-sm-3 col-form-label">Description</label>
              <div class="col-sm-9">
              <textarea name="description" rows="4" id="description"></textarea>
              <script>
                  // Initialize CKEditor
                  ClassicEditor
                    .create(document.getElementById('description'))
                    .then(editor => {
                        console.log('Editor was initialized', editor);
                    })
                    .catch(error => {
                        console.error('Error during initialization of the editor', error);
                    });
              </script>  
              @error('description') <span> {{$message}} </span> @enderror 
              </div>
            </div>
          
 

            <button type="submit" class="btn btn-info sfw">Create</button>
            <a href="{{route('faqs.index')}}" class="btn btn-info sfw" ><i class="fa fa-mail-reply"></i> Cancel </a>
            </form>
      </div>
    </div>
</div>
             
    
@endsection