@extends('layouts.backendapp')

@section('content')

@php
// Configure this page 
$pageName = 'Edit Product Category';
$addEdit = 'Edit';   // Create or Edit

$breadcrumbs = [
    ['title' => 'Dashboard', 'link' => '#', 'isActive' => ''],
    ['title' => 'Product Category', 'link' => '#', 'isActive' => ''],
    ['title' => 'Edit', 'link' => '#', 'isActive' => 'active'],
];
@endphp 


        
  <form action="{{ route('productcat.update', $productcat->id) }}" method="POST" enctype="multipart/form-data" class="forms-sample">
        @csrf
        @method('PUT')
    <div class="col-lg-12 grid-margin stretch-card px-5">
                <div class="card">
                  <div class="card-body">

                      <div class="form-group">
                        <label for="titleId">Name</label>
                        <input type="text" name="title" class="form-control" value="{{$productcat->title}}" id="titleId" placeholder="Name">
                        @error('title') <span> {{$message}} </span> @enderror
                      </div>

                      <div class="form-group">
                        <label for="exampleTextarea1">Short Description</label>
                        <textarea class="form-control" name="short_desc" id="exampleTextarea1" rows="4">{!!$productcat->short_desc!!}</textarea>
                        @error('short_desc') <span> {{$message}} </span> @enderror
                      </div>

                      <div class="form-group">
                        <label for="nameId">Description</label>
                        <textarea name="content"  rows="4" id="content">{!!$productcat->content!!}</textarea>
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
                      
                      <div class="form-group">
                        <label for="CategorySelect">Parent Category</label>
                        <select class="form-select" name="parent_id" id="CategorySelect">

                          <option value="0">Select Parent Category</option>
                                        @if($categories)
                                            @foreach($categories as $category)
                                                <?php $dash=''; ?>
                                                <option value="{{$category->id}}">{{$category->title}}</option>
                                                @if(count($category->subcategory))
                                                    @include('admin.components.subcatdrop',['subcategories' => $category->subcategory, 'selectedId' => $productcat->parent_id ])
                                                @endif
                                            @endforeach
                                        @endif
                            </select>
                      </div>

                      
            <div class="form-group row">
              <label for="short_descInput" class="col-sm-3 col-form-label">Category Image</label>
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
                if($productcat->image != ''){
                  echo '<img src="'. asset('public'.$productcat->image) .'" alt="'. $productcat->title .'" class="mb-2 mw-100 w-100 rounded">'; 
                }
                @endphp                
              </div>              
            </div>

            
            <div class="form-group row">
              <label for="cat_featuredInput" class="col-sm-3 col-form-label">Featured Category</label>
              <div class="col-sm-9">
                  <div class="form-group">
                    <div class="form-check">
                        <label class="form-check-label">
                        <input type="checkbox" id="cat_featured" name="cat_featured" @if($productcat->cat_featured == '1'){{ 'checked'}} @endif value="1" class="form-check-input">Featured Category</label>
                    </div>
                  </div>
              </div>
            </div>
                      <div class="form-group">
                        <label for="exampleSelectGender">Status</label>
                        <select class="form-select" name="status" id="exampleSelectGender">
                        <option value="1" @if ($productcat->status == "1") {{ 'selected' }} @endif>Active</option>
                        <option value="0" @if ($productcat->status == "0") {{ 'selected' }} @endif>Deactive</option>
                        </select>
                        @error('status') <span> {{$message}} </span> @enderror
                      </div>

                      <button type="submit" class="btn btn-info sfw">{{$addEdit}}</button>
                      <a href="{{route('productcat.index')}}" class="btn btn-info sfw" ><i class="fa fa-mail-reply"></i> Cancel </a>
      </form>
           


        </div>
      </div>
    </div>
             
    
@endsection