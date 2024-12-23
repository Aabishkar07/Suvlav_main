@extends('layouts.backendapp')

@section('content')

@php
// Configure this page 
$pageName = 'Edit Blog';
$addEdit = 'Edit';   // Create or Edit

$breadcrumbs = [
    ['title' => 'Dashboard', 'link' => '#', 'isActive' => ''],
    ['title' => 'Blog', 'link' => '#', 'isActive' => ''],
    ['title' => 'Edit', 'link' => '#', 'isActive' => 'active'],
];

@endphp 
        
  <form action="{{ route('blog.update', $page->id) }}" method="POST" enctype="multipart/form-data" class="forms-sample">
        @csrf
        @method('PUT')
    <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
          
                  <div class="form-group row">
              <label for="titleInput" class="col-sm-3 col-form-label">Tilte</label>
              <div class="col-sm-9">
                <input type="text" name="title" class="form-control" value="{{$page->title}}" id="titleInput" placeholder="Name">
                @error('title') <span> {{$message}} </span> @enderror
              </div>
            </div>

      

            <div class="form-group row">
              <label for="description" class="col-sm-3 col-form-label">Description</label>
              <div class="col-sm-9">
              <textarea name="description" rows="4" id="description">{!!$page->description !!}</textarea>
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
          
          
            <div class="form-group row">
              <label for="short_descInput" class="col-sm-3 col-form-label">Upload Image</label>
              <div class="col-sm-6">
                <input type="file" name="featured_image" id="featured_image" class="file-upload-default">
                <div class="input-group col-xs-12">
                  <input type="text" class="form-control file-upload-info" disabled placeholder="Upload featured_image">
                  <span class="input-group-append">
                    <button class="file-upload-browse btn btn-gradient-primary py-3" type="button">Upload</button>
                  </span>
                </div>
              </div>
              <div class="col-sm-3">
                @php 
                if($page->featured_image != ''){
                  echo '<img src="'. asset($page->featured_image) .'" alt="'. $page->title .'" class="mb-2 mw-100 w-100 rounded">'; 
                }
                @endphp
                
              </div>
              
            </div>

            <div class="form-group row">
              <label for="titleInput" class="col-sm-3 col-form-label">Order</label>
              <div class="col-sm-9">
                <input type="text" name="order" class="form-control" value="{{$page->order}}" id="titleInput" placeholder="Name">
                @error('order') <span> {{$message}} </span> @enderror
              </div>
            </div>

                  <button type="submit" class="btn btn-info sfw">{{$addEdit}}</button>
                      <a href="{{route('blog.index')}}" class="btn btn-info sfw" ><i class="fa fa-mail-reply"></i> Cancel </a>
      </form>
           


        </div>
      </div>
    </div>
             
    
@endsection