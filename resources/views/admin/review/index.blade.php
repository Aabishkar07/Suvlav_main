@extends('layouts.backendapp')

@section('content')

@php
// Configure this page 
$pageName = 'Product Reviews';
$showChildFormat = 'yes';
$review_per_page = siteSettings('posts_per_page'); 

$breadcrumbs = [
    ['title' => 'Dashboard', 'link' => '#', 'isActive' => ''],
    ['title' => 'Product Reviews', 'link' => '#', 'isActive' => 'active'],
];


$start = (isset($request->page) && !empty($request->page))? (($request->page -1 ) * $review_per_page )+ 1 : 1

@endphp

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            {{ $message }}
        </div>     
    @endif 

    <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
              
                <div class="row margin-bottom-30">
                    <form method="get" class="forms-sample deceased-search">
                    <input type="hidden" name="search" value="search">
                    <div class="form-group row">
                        <div class="col-sm-4">  <a href="{{ route('review.create') }}" class="btn btn-info sfw btn-sm"><i class="fa fa-plus"></i> Add New </a> </div>
                        <div class="col-sm-5">
                        <select class="form-select" name="product_id" id="prodInput">
                          <option value=""> Filter Reviews by product... </option>
                        @if(count($products) > 0)
                          @foreach ($products as $key => $product)
                          <option value="{{ $product->id}}" @if ($product->id == $request->product_id) {{ 'selected' }} @endif>{{ $product->title}}</option>
                          @endforeach
                        @endif 
                        </select>
                       </div>
                            <div class="col-sm-3">
                          <button class="btn btn-info sfw btn-sm btn_search" type="submit"><i class="fa fa-search"></i> Filter</button>
                          <a href="{{route('review.index')}}" class="btn btn-info sfw btn-sm" ><i class="fa fa-mail-reply"></i> Reset </a>
                        </div>
                      </div>

                    </form>
                </div>
                    <table class="table table-bordered table-hover">
                      <thead class="table-light">
                        <tr>
                          <th> # </th>
                          <th> Review </th>
                          <th> Product </th>
                          <th> Read/New </th>
                          <th> Status </th>
                          <th> Action </th>
                          <th> Remove </th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php $GLOBALS['counter'] = $start;?>
                      @if(count($reviews) > 0)
                      @foreach ($reviews as $key => $review)
                       <tr>
                            <td>{{ ( $GLOBALS['counter']++ )  }}</td> 
                            <td>
                            <div class="row">
                              <div class="col-md-6">{!! showRating($review->rating) !!}</div>
                              <div class="col-md-6">{{ $review->created_at->format('Y/m/d H:i') }}</div>  
                            </div>
                            <br />
                            <p> {!! wordwrap($review->review_detail,40,"<br>\n") !!} </p>
                            <div class="col float-end"> -  {{ $review->user->name }} </div>
                          </td>  
                            <td>{{ $review->product->title; }}</td>
                            <td>{!! ($review->isNew === '0')? '<label class="badge badge-success">READ</label>':'<label class="badge badge-danger">UNREAD</label>' !!}  </td>                        
                            <td>{!! ($review->status === '0')? '<i class="fa fa-times"></i>':'<i class="fa fa-check"></i>' !!} </td>
                            <td><a href="{{ route('review.edit', $review->id)}}" class="btn btn-success btn-sm"><i class="fa fa-edit"></i> </a>
              </td>
              <td>
                <form action="{{route('review.destroy', $review->id)}}" method="POST" class="delete_confirm">
                <input type="hidden" name="_token" value="{{csrf_token()}}">
                <input type="hidden" name="_method" value="DELETE">
                <button class="btn btn-danger sfw btn-sm"><i class="fa fa-trash-o"></i> </button>
              </form>
              </td>
                        </tr>
                      

                        @endforeach

                        @else
                        <tr><td colspan="7"><p class="text-danger">No record found!</p></td></tr>
                        @endif
                      </tbody>
                    </table>

                    <div class="row margin-top-30">
                      <div class="card">
                          <div class="card-body">
                          {{ $reviews->appends(request()->query())->links() }}
                          </div>
                      </div>
                    </div>
                  
            </div>
            </div>
            </div>


@endsection