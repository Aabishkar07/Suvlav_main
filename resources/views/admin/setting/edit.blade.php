@extends('layouts.backendapp')

@section('content')

@php
// Configure this page 
$pageName = 'Site Settings';
$showChildFormat = 'yes';
$post_per_page = 10; 

$breadcrumbs = [
    ['title' => 'Dashboard', 'link' => '#', 'isActive' => ''],
    ['title' => 'Site Settings', 'link' => '#', 'isActive' => 'active'],
];

$site_settings = [];
if($settings){
  foreach($settings as $key => $value){
    //echo $value->key; 
    $site_settings[$value->key] = $value->value; 
    //echo '<br />...';
  }
}
 
@endphp

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            {{ $message }}
        </div>     
    @endif 

    <form action="{{ route('admin.setting.update')}}" method="POST" enctype="multipart/form-data" class="forms-sample">
    <div class="col-lg-12 grid-margin stretch-card px-5">
                <div class="card">
                  <div class="card-body">
              
           
            @csrf

            <div class="form-group row">
              <label for="site_nameInput" class="col-sm-3 col-form-label">Tilte</label>
              <div class="col-sm-9">
                <input type="text" name="site_name" value="{{ $site_settings['site_name']}}" class="form-control" id="site_nameInput" placeholder="Site Name">
                @error('site_name') <span> {{$message}} </span> @enderror
              </div>
            </div>
            <div class="form-group row">
              <label for="descriptionInput" class="col-sm-3 col-form-label">Description</label>
              <div class="col-sm-9">
              <textarea class="form-control" name="description" id="descriptionInput" rows="4">{!! $site_settings['description'] !!}</textarea>
                @error('description') <span> {{$message}} </span> @enderror
              </div>
            </div>

            <div class="form-group row">
              <label for="site_emailInput" class="col-sm-3 col-form-label">Site Email</label>
              <div class="col-sm-9">
                <input type="text" name="site_email" value="{{ $site_settings['site_email']}}" class="form-control" id="site_emailInput" placeholder="Site Email">
                @error('site_email') <span> {{$message}} </span> @enderror
              </div>
            </div>

            
            <div class="form-group row">
              <label for="site_phoneInput" class="col-sm-3 col-form-label">Site Phone</label>
              <div class="col-sm-9">
                <input type="text" name="site_phone" value="{{ $site_settings['site_phone']}}" class="form-control" id="site_phoneInput" placeholder="Site Email">
                @error('site_phone') <span> {{$message}} </span> @enderror
              </div>
            </div>

            
            <div class="form-group row">
              <label for="posts_per_pageInput" class="col-sm-3 col-form-label">Posts per page</label>
              <div class="col-sm-9">
                <input type="text" name="posts_per_page" value="{{ $site_settings['posts_per_page']}}" class="form-control" id="posts_per_pageInput" placeholder="Posts per page">
                @error('posts_per_page') <span> {{$message}} </span> @enderror
              </div>
            </div>
          
            <div class="form-group row">
              <label for="site_currencyInput" class="col-sm-3 col-form-label">Site Currency</label>
              <div class="col-sm-9">
                <input type="text" name="site_currency" value="{{ $site_settings['site_currency']}}" class="form-control" id="site_currencyInput" placeholder="Posts per page">
                @error('site_currency') <span> {{$message}} </span> @enderror
              </div>
            </div>




            <div class="form-group row">
              <label for="addressInput" class="col-sm-3 col-form-label">Address</label>
              <div class="col-sm-9">
                <input 
                  type="text" 
                  name="address" 
                  value="{{ $site_settings['address'] ?? '' }}" 
                  class="form-control" 
                  id="addressInput" 
                  placeholder="Enter your address"
                >
                @error('address') 
                  <span class="text-danger"> {{$message}} </span> 
                @enderror
              </div>
            </div>
            
                    <div class="form-group row">
              <label for="addressInput" class="col-sm-3 col-form-label">Review Points</label>
              <div class="col-sm-9">
                <input 
                  type="text" 
                  name="referral_points" 
                  value="{{ $site_settings['referral_points'] ?? '' }}" 
                  class="form-control" 
                  id="addressInput" 
                  placeholder="Enter your address"
                >
                @error('address') 
                  <span class="text-danger"> {{$message}} </span> 
                @enderror
              </div>
            </div>
            

          

     
            <div class="row">
              <!-- Facebook Link -->
              <div class="col-md-4 d-flex">
                <div class="form-group row w-100">
                  <label for="facebookLinkInput" class="col-sm-4 col-form-label">Facebook Link</label>
                  <div class="col-sm-12">
                    <input 
                      type="text" 
                      name="facebook_link" 
                      value="{{ $site_settings['facebook_link'] ?? '' }}" 
                      class="form-control" 
                      id="facebookLinkInput" 
                      placeholder="Enter Facebook link"
                    >
                    @error('facebook_link') 
                      <span class="text-danger"> {{$message}} </span> 
                    @enderror
                  </div>
                </div>
              </div>
            
              <!-- Instagram Link -->
              <div class="col-md-4 d-flex">
                <div class="form-group row w-100">
                  <label for="instagramLinkInput" class="col-sm-4 col-form-label">Instagram Link</label>
                  <div class="col-sm-12">
                    <input 
                      type="text" 
                      name="instagram_link" 
                      value="{{ $site_settings['instagram_link'] ?? '' }}" 
                      class="form-control" 
                      id="instagramLinkInput" 
                      placeholder="Enter Instagram link"
                    >
                    @error('instagram_link') 
                      <span class="text-danger"> {{$message}} </span> 
                    @enderror
                  </div>
                </div>
              </div>
            
              <!-- YouTube Link -->
              <div class="col-md-4 d-flex">
                <div class="form-group row w-100">
                  <label for="youtubeLinkInput" class="col-sm-4 col-form-label">YouTube Link</label>
                  <div class="col-sm-12">
                    <input 
                      type="text" 
                      name="youtube_link" 
                      value="{{ $site_settings['youtube_link'] ?? '' }}" 
                      class="form-control" 
                      id="youtubeLinkInput" 
                      placeholder="Enter YouTube link"
                    >
                    @error('youtube_link') 
                      <span class="text-danger"> {{$message}} </span> 
                    @enderror
                  </div>
                </div>
              </div>
            </div>
            
            
            


            <button type="submit" class="btn btn-info sfw">Update</button>
                  
            </div>
            </div>
            </div>
            </form>


@endsection