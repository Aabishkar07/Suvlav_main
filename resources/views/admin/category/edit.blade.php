@extends('layouts.backendapp')

@section('content')

@php
// Configure this page 
$pageName = 'Edit Category';
$addEdit = 'Edit';   // Create or Edit

$breadcrumbs = [
    ['title' => 'Dashboard', 'link' => '#', 'isActive' => ''],
    ['title' => 'Categgory', 'link' => '#', 'isActive' => ''],
    ['title' => 'Edit', 'link' => '#', 'isActive' => 'active'],
];

@endphp 
        
  <form action="{{ route('category.update', $category->id) }}" method="POST" enctype="multipart/form-data" class="forms-sample">
        @csrf
        @method('PUT')
    <div class="col-lg-12 grid-margin stretch-card px-5">
                <div class="card">
                  <div class="card-body">
          
                  <div class="form-group row">
              <label for="titleInput" class="col-sm-3 col-form-label">Tilte</label>
              <div class="col-sm-9">
                <input type="text" name="title" class="form-control" value="{{$category->title}}" id="titleInput" placeholder="Name">
                @error('title') <span> {{$message}} </span> @enderror
              </div>
            </div>


            <div class="form-group row">
              <label for="statusInput" class="col-sm-3 col-form-label">Status</label>
              <div class="col-sm-9">
              <select class="form-select" name="status" id="statusInput">
                <option value="1" @if ($category->status == "1") {{ 'selected' }} @endif>Active</option>
                <option value="0" @if ($category->status == "0") {{ 'selected' }} @endif >Deactive</option>
              </select>
                @error('status') <span> {{$message}} </span> @enderror
              </div>
            </div>

                  <button type="submit" class="btn btn-info sfw">{{$addEdit}}</button>
                      <a href="{{route('category.index')}}" class="btn btn-info sfw" ><i class="fa fa-mail-reply"></i> Cancel </a>
      </form>
           


        </div>
      </div>
    </div>
             
    
@endsection