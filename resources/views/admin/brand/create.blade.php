@extends('layouts.backendapp')

@section('content')

@php
// Configure this page 
$pageName = 'Create Brand';

$breadcrumbs = [
    ['title' => 'Dashboard', 'link' => '#', 'isActive' => ''],
    ['title' => 'Brand', 'link' => '#', 'isActive' => ''],
    ['title' => 'Create', 'link' => '#', 'isActive' => 'active'],
];
@endphp 


        
  <form action="{{ route('brand.store') }}" method="POST" class="forms-sample">
        @csrf
    <div class="col-lg-12 grid-margin stretch-card px-5">
      <div class="card">
        <div class="card-body">

            <div class="form-group">
              <label for="titleId">Name</label>
              <input type="text" name="name" class="form-control" value="" id="titleId" placeholder="Name">
              @error('title') <span> {{$message}} </span> @enderror
            </div>

            <div class="form-group">
              <label for="exampleTextarea1">Short Description</label>
              <textarea class="form-control" name="short_desc" id="exampleTextarea1" rows="4"></textarea>
              @error('short_desc') <span> {{$message}} </span> @enderror
            </div>

            <div class="form-group">
              <label for="nameId">Description</label>
              <textarea name="content"  rows="4" id="content"></textarea>
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
              <label for="exampleSelectGender">Status</label>
              <select class="form-select" name="status" id="exampleSelectGender">
                <option value="active">Active</option>
                <option value="deactive" >Deactive</option>
              </select>
              @error('status') <span> {{$message}} </span> @enderror
            </div>

            <button type="submit" class="btn btn-info sfw">Create</button>
            <a href="{{route('brand.index')}}" class="btn btn-info sfw" ><i class="fa fa-mail-reply"></i> Cancel </a>
            </form>
      </div>
    </div>
</div>
             
    
@endsection