@extends('layouts.backendapp')

@section('content')

@php
// Configure this page 
$pageName = 'Edit Faq';
$addEdit = 'Edit';   // Create or Edit

$breadcrumbs = [
    ['title' => 'Dashboard', 'link' => '#', 'isActive' => ''],
    ['title' => 'Pages', 'link' => '#', 'isActive' => ''],
    ['title' => 'Edit', 'link' => '#', 'isActive' => 'active'],
];

@endphp 
        
  <form action="{{ route('faqs.update', $page->id) }}" method="POST" enctype="multipart/form-data" class="forms-sample">
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
          
          
        
  

                  <button type="submit" class="btn btn-info sfw">{{$addEdit}}</button>
                      <a href="{{route('faqs.index')}}" class="btn btn-info sfw" ><i class="fa fa-mail-reply"></i> Cancel </a>
      </form>
           


        </div>
      </div>
    </div>
             
    
@endsection