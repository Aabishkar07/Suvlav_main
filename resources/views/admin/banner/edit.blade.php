@extends('layouts.backendapp')

@section('content')

@php
// Configure this post 
$pageName = 'Edit Banner';
$addEdit = 'Edit';   // Create or Edit

$breadcrumbs = [
    ['title' => 'Dashboard', 'link' => '#', 'isActive' => ''],
    ['title' => 'Edit Banner', 'link' => '#', 'isActive' => 'active'],
];

@endphp 
        
  <form action="{{ route('banner.update', $banner->id) }}" method="POST" enctype="multipart/form-data" class="forms-sample">
        @csrf
        @method('PUT')
    <div class="col-lg-12 grid-margin stretch-card px-5">
                <div class="card">
                  <div class="card-body">
          
                  <div class="form-group row">
              <label for="titleInput" class="col-sm-3 col-form-label">Tilte</label>
              <div class="col-sm-9">
                <input type="text" name="title" class="form-control" value="{{$banner->title}}" id="titleInput" placeholder="Name">
                @error('title') <span> {{$message}} </span> @enderror
              </div>
            </div>

            <div class="form-group row">
              <label for="short_descInput" class="col-sm-3 col-form-label">Short Description</label>
              <div class="col-sm-9">
              <textarea class="form-control" name="short_desc" id="short_descInput" rows="4">{!! $banner->short_desc !!}</textarea>
                @error('short_desc') <span> {{$message}} </span> @enderror
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
                if($banner->image != ''){
                  echo '<img src="'. asset($banner->image) .'" alt="'. $banner->title .'" class="mb-2 mw-100 w-100 rounded">'; 
                }
                @endphp
                
              </div>              
            </div>

            
            <div class="form-group row">
              <label for="main_headingInput" class="col-sm-3 col-form-label">Top Heading</label>
              <div class="col-sm-6">
                <input type="text" name="top_heading" class="form-control" value="{{$banner->top_heading}}" id="top_headingInput" placeholder="Top Heading">
                @error('top_heading') <span> {{$message}} </span> @enderror
              </div>
            <label class="col-sm-3 col-form-label"> ( Eg. UP TO 50% OFF )</label> 
            </div>

            <div class="form-group row">
              <label for="main_headingInput" class="col-sm-3 col-form-label">Main Heading</label>
              <div class="col-sm-6">
                <input type="text" name="main_heading" class="form-control" value="{{$banner->main_heading }}" id="main_headingInput" placeholder="Main Heading">
                @error('main_heading') <span> {{$message}} </span> @enderror
              </div>
            <label class="col-sm-3 col-form-label"> ( Eg. Shirt For Man )</label> 
            </div>

            <div class="form-group row">
              <label for="btn_nameInput" class="col-sm-3 col-form-label">Button Name</label>
              <div class="col-sm-6">
                <input type="text" name="btn_name" class="form-control" value="{{$banner->btn_name}}" id="btn_nameInput" placeholder="Button Name">
                @error('btn_name') <span> {{$message}} </span> @enderror
              </div>
            <label class="col-sm-3 col-form-label"> ( Eg. SHOP NOW )</label> 
            </div>

            <div class="form-group row">
              <label for="btn_urlInput" class="col-sm-3 col-form-label">Button URL</label>
              <div class="col-sm-6">
                <input type="text" name="btn_url" class="form-control" value="{{$banner->btn_url }}" id="btn_urlInput" placeholder="Button URL">
                @error('btn_url') <span> {{$message}} </span> @enderror
              </div>
            <label class="col-sm-3 col-form-label"> ( Eg. category/mens-collections )</label> 
            </div>

            <div class="form-group row">
              <label for="display_optionInput" class="col-sm-3 col-form-label">Display Options</label>
              <div class="col-sm-9">
              <select class="form-select" name="display_option" id="display_optionInput">
                <option value="3" @if ($banner->display_option == "3") {{ 'selected' }} @endif >Three Column Card on Home Page</option>
                <option value="2" @if ($banner->display_option == "2") {{ 'selected' }} @endif >Two Column Card on Home Page</option>
                <option value="1" @if ($banner->display_option == "1") {{ 'selected' }} @endif >Main Banner on Home Page</option>
              </select>
                @error('display_option') <span> {{$message}} </span> @enderror
              </div>
            </div>


            <div class="form-group row">
              <label for="statusInput" class="col-sm-3 col-form-label">Status</label>
              <div class="col-sm-9">
              <select class="form-select" name="status" id="statusInput">
                <option value="1" @if ($banner->status == "1") {{ 'selected' }} @endif>Active</option>
                <option value="0" @if ($banner->status == "0") {{ 'selected' }} @endif >Deactive</option>
              </select>
                @error('status') <span> {{$message}} </span> @enderror
              </div>
            </div>

                  <button type="submit" class="btn btn-info sfw">{{$addEdit}}</button>
                      <a href="{{route('banner.index')}}" class="btn btn-info sfw" ><i class="fa fa-mail-reply"></i> Cancel </a>
      </form>
           


        </div>
      </div>
    </div>
             
    
@endsection