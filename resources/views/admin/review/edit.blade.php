@extends('layouts.backendapp')

@section('content')

@php
// Configure this review 
$pageName = 'Edit Review';
$assigned_cats = [];
$addEdit = 'Edit';   // Create or Edit

$breadcrumbs = [
    ['title' => 'Dashboard', 'link' => '#', 'isActive' => ''],
    ['title' => 'Product Reviews', 'link' => '#', 'isActive' => ''],
    ['title' => 'Edit', 'link' => '#', 'isActive' => 'active'],
];

@endphp 
        
  <form action="{{ route('review.update', $review->id) }}" method="POST" enctype="multipart/form-data" class="forms-sample">
        @csrf
        @method('PUT')
    <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
          
                  <div class="form-group row">
              <label for="review_detailInput" class="col-sm-3 col-form-label">Review Detail</label>
              <div class="col-sm-9">
              <textarea class="form-control" name="review_detail" id="review_detailInput" rows="4">{!! $review->review_detail!!}</textarea>
                @error('review_detail') <span> {{$message}} </span> @enderror
              </div>
            </div>
          
            <div class="form-group row">
              <label for="ratingInput" class="col-sm-3 col-form-label">Rating</label>
              <div class="col-sm-6">
                <input type="text" name="rating" class="form-control" value="{{$review->rating}}" id="ratingInput" placeholder="Rating">
                @error('rating') <span> {{$message}} </span> @enderror
              </div><div class="col-sm-3"> [0-5]</div>
            </div>

            <div class="form-group row">
              <label for="product_idInput" class="col-sm-3 col-form-label">Review to Product</label>
              <div class="col-sm-9">
              <select class="form-select" name="product_id" id="product_idInput">
                <option value=""> Choose product... </option>
                  @if(count($products) > 0)
                    @foreach ($products as $key => $product)
                    <option @if ($product->id == $review->product_id) {{ 'selected' }} @endif value="{{ $product->id}}">{{ $product->title}}</option>
                    @endforeach
                  @endif 
              </select>
                @error('product_id') <span> {{$message}} </span> @enderror
              </div>
            </div>

            
            <div class="form-group row">
              <label for="user_idInput" class="col-sm-3 col-form-label">Review By</label>
              <div class="col-sm-9">
              <select class="form-select" name="user_id" id="user_idInput">
                <option value=""> Choose user... </option>
                  @if(count($users) > 0)
                    @foreach ($users as $key => $user)
                    <option  @if($user->id == $review->user_id) {{ 'selected' }} @endif value="{{ $user->id}}">{{ $user->name}}</option>
                    @endforeach
                  @endif 
              </select>
                @error('user_id') <span> {{$message}} </span> @enderror
              </div>
            </div>

            <div class="form-group row">
              <label for="statusInput" class="col-sm-3 col-form-label">Status</label>
              <div class="col-sm-9">
              <select class="form-select" name="status" id="statusInput">
                <option value="1" @if ($review->status == "1") {{ 'selected' }} @endif>Active</option>
                <option value="0" @if ($review->status == "0") {{ 'selected' }} @endif >Deactive</option>
              </select>
                @error('status') <span> {{$message}} </span> @enderror
              </div>
            </div>

                  <button type="submit" class="btn btn-info sfw">{{$addEdit}}</button>
                      <a href="{{route('review.index')}}" class="btn btn-info sfw" ><i class="fa fa-mail-reply"></i> Cancel </a>
      </form>
           


        </div>
      </div>
    </div>
             
    
@endsection