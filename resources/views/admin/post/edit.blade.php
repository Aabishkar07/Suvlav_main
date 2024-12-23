@extends('layouts.backendapp')

@section('content')

@php
// Configure this post 
$pageName = 'Edit Post';
$assigned_cats = [];
$addEdit = 'Edit';   // Create or Edit

$breadcrumbs = [
    ['title' => 'Dashboard', 'link' => '#', 'isActive' => ''],
    ['title' => 'Posts', 'link' => '#', 'isActive' => ''],
    ['title' => 'Edit', 'link' => '#', 'isActive' => 'active'],
];

// Post Assigned on categories
if( count($post->categories) > 0){    
    foreach ($post->categories as $category) {
      $assigned_cats[] = $category->id;
    }
}

@endphp 
        
  <form action="{{ route('post.update', $post->id) }}" method="POST" enctype="multipart/form-data" class="forms-sample">
        @csrf
        @method('PUT')
    <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
          
                  <div class="form-group row">
              <label for="titleInput" class="col-sm-3 col-form-label">Tilte</label>
              <div class="col-sm-9">
                <input type="text" name="title" class="form-control" value="{{$post->title}}" id="titleInput" placeholder="Name">
                @error('title') <span> {{$message}} </span> @enderror
              </div>
            </div>

            <div class="form-group row">
              <label for="short_descInput" class="col-sm-3 col-form-label">Short Description</label>
              <div class="col-sm-9">
              <textarea class="form-control" name="short_desc" id="short_descInput" rows="4">{!! $post->short_desc !!}</textarea>
                @error('short_desc') <span> {{$message}} </span> @enderror
              </div>
            </div>

            <div class="form-group row">
              <label for="content" class="col-sm-3 col-form-label">Description</label>
              <div class="col-sm-9">
              <textarea name="content" rows="4" id="content">{!!$post->content !!}</textarea>
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
              <label for="brand_idInput" class="col-sm-3 col-form-label">Post Categories</label>
              <div class="col-sm-9 section_scroll">
                  <div class="form-group">
                    @if(count($categories) > 0)
                    @foreach ($categories as $key => $category)
                    <div class="form-check">
                        <label class="form-check-label">
                        <input type="checkbox"  @if(in_array($category->id, $assigned_cats)){{ 'checked'}} @endif name="categories_id[]" value="{{ $category->id}}" class="form-check-input">{{$category->title}}</label>
                    </div>
                    @endforeach
                  @endif
                  </div>                  
                  @error('categories_id') <span> {{$message}} </span> @enderror 
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
                if($post->image != ''){
                  echo '<img src="'. asset($post->image) .'" alt="'. $post->title .'" class="mb-2 mw-100 w-100 rounded">'; 
                }
                @endphp
                
              </div>
              
            </div>

            <div class="form-group row">
              <label for="statusInput" class="col-sm-3 col-form-label">Status</label>
              <div class="col-sm-9">
              <select class="form-select" name="status" id="statusInput">
                <option value="1" @if ($post->status == "1") {{ 'selected' }} @endif>Active</option>
                <option value="0" @if ($post->status == "0") {{ 'selected' }} @endif >Deactive</option>
              </select>
                @error('status') <span> {{$message}} </span> @enderror
              </div>
            </div>

                  <button type="submit" class="btn btn-info sfw">{{$addEdit}}</button>
                      <a href="{{route('post.index')}}" class="btn btn-info sfw" ><i class="fa fa-mail-reply"></i> Cancel </a>
      </form>
           


        </div>
      </div>
    </div>
             
    
@endsection