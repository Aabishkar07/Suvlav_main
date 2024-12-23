@extends('layouts.backendapp')

@section('content')

@php
// Configure this page 
$pageName = 'Create Product Size';

$breadcrumbs = [
    ['title' => 'Dashboard', 'link' => '#', 'isActive' => ''],
    ['title' => 'Product Size', 'link' => '#', 'isActive' => ''],
    ['title' => 'Create', 'link' => '#', 'isActive' => 'active'],
];

@endphp 


        
  <form action="{{ route('productsize.store') }}" method="POST" class="forms-sample" enctype="multipart/form-data">
        @csrf
    <div class="col-lg-12 grid-margin stretch-card">
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
              <label for="display_nameInput" class="col-sm-3 col-form-label">Display Name</label>
              <div class="col-sm-9">
                <input type="text" name="display_name" class="form-control" value="" id="display_nameInput" placeholder="Display Name">
                @error('display_name') <span> {{$message}} </span> @enderror
              </div>
            </div>
        
            <div class="form-group row">
              <label for="statusInput" class="col-sm-3 col-form-label">Status</label>
              <div class="col-sm-9">
              <select class="form-select" name="status" id="statusInput">
                <option value="1">Active</option>
                <option value="0" >Deactive</option>
              </select>
                @error('status') <span> {{$message}} </span> @enderror
              </div>
            </div>

            <button type="submit" class="btn btn-info sfw">Create</button>
            <a href="{{route('productsize.index')}}" class="btn btn-info sfw" ><i class="fa fa-mail-reply"></i> Cancel </a>
            </form>
      </div>
    </div>
</div>
             
    
@endsection