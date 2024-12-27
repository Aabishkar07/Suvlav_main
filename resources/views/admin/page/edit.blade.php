@extends('layouts.backendapp')

@section('content')

@php
// Configure this page 
$pageName = 'Edit Page';
$addEdit = 'Edit';   // Create or Edit

$breadcrumbs = [
    ['title' => 'Dashboard', 'link' => '#', 'isActive' => ''],
    ['title' => 'Pages', 'link' => '#', 'isActive' => ''],
    ['title' => 'Edit', 'link' => '#', 'isActive' => 'active'],
];

@endphp 
        
  <form action="{{ route('page.update', $page->id) }}" method="POST" enctype="multipart/form-data" class="forms-sample">
        @csrf
        @method('PUT')
    <div class="col-lg-12 grid-margin stretch-card px-5">
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
              <label for="short_descInput" class="col-sm-3 col-form-label">Short Description</label>
              <div class="col-sm-9">
              <textarea class="form-control" name="short_desc" id="short_descInput" rows="4">{!! $page->short_desc !!}</textarea>
                @error('short_desc') <span> {{$message}} </span> @enderror
              </div>
            </div>

            <div class="form-group row">
              <label for="content" class="col-sm-3 col-form-label">Description</label>
              <div class="col-sm-9">
              <textarea name="content" rows="4" id="content">{!!$page->content !!}</textarea>
              <script>
                  // Initialize CKEditor
                  ClassicEditor
                    .create(document.getElementById('content'))
                    .then(editor => {
                        console.log('Editor was initialized', editor);
                    })
                    .catch(error => {
                        console.error('Error during initialization of the editor', error);
                    });
              </script>  
              @error('content') <span> {{$message}} </span> @enderror 
              </div>
            </div>
          
          
            <div class="form-group row">
              <label for="short_descInput" class="col-sm-3 col-form-label">Upload Image</label>
              <div class="col-sm-6">
                <input type="file" name="image" id="image" class="file-upload-default">
                <div class="input-group col-xs-12">
                  <input type="text" class="form-control file-upload-info" disabled placeholder="Upload Image">
                  <span class="input-group-append">
                    <button class="file-upload-browse btn btn-gradient-primary py-3" type="button">Upload</button>
                  </span>
                </div>
              </div>
              <div class="col-sm-3">
                @php 
                if($page->image != ''){
                  echo '<img src="'. asset($page->image) .'" alt="'. $page->title .'" class="mb-2 mw-100 w-100 rounded">'; 
                }
                @endphp
                
              </div>
              
            </div>

            <div class="form-group row">
              <label for="statusInput" class="col-sm-3 col-form-label">Status</label>
              <div class="col-sm-9">
              <select class="form-select" name="status" id="statusInput">
                <option value="1" @if ($page->status == "1") {{ 'selected' }} @endif>Active</option>
                <option value="0" @if ($page->status == "0") {{ 'selected' }} @endif >Deactive</option>
              </select>
                @error('status') <span> {{$message}} </span> @enderror
              </div>
            </div>

                  <button type="submit" class="btn btn-info sfw">{{$addEdit}}</button>
                      <a href="{{route('page.index')}}" class="btn btn-info sfw" ><i class="fa fa-mail-reply"></i> Cancel </a>
      </form>
           


        </div>
      </div>
    </div>
             
    
@endsection