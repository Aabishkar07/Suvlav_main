@extends('layouts.backendapp')

@section('content')

@php
// Configure this page 
$pageName = 'Edit Order';
$addEdit = 'Edit';   // Create or Edit

$breadcrumbs = [
    ['title' => 'Dashboard', 'link' => '#', 'isActive' => ''],
    ['title' => 'Orders & Reviews', 'link' => '#', 'isActive' => ''],
    ['title' => 'Update Order', 'link' => '#', 'isActive' => 'active'],
];

@endphp 
        
  <form action="{{ route('order.update', $order->id) }}" method="POST" enctype="multipart/form-data" class="forms-sample">
        @csrf
        @method('PUT')
    <div class="col-lg-12 grid-margin stretch-card px-5">
                <div class="card">
                  <div class="card-body">
          
                
            <div class="form-group row">
              <label for="statusInput" class="col-sm-3 col-form-label">Status</label>
              <div class="col-sm-9">
              <select class="form-select" name="status" id="statusInput">
              <option value="Pending" @if ($order->status == "Pending") {{ 'selected' }} @endif>Pending</option>
                <option value="Ongoing" @if ($order->status == "Ongoing") {{ 'selected' }} @endif>Ongoing</option>
                <option value="Delevered" @if ($order->status == "Delevered") {{ 'selected' }} @endif >Delevered</option>
                <option value="Cancel" @if ($order->status == "Cancel") {{ 'selected' }} @endif >Canceled</option>
              </select>
                @error('status') <span> {{$message}} </span> @enderror
              </div>
            </div>

                  <button type="submit" class="btn btn-info sfw">Update</button>
                      <a href="{{route('order.index')}}" class="btn btn-info sfw" ><i class="fa fa-mail-reply"></i> Cancel </a>
      </form>
           


        </div>
      </div>
    </div>
             
    
@endsection