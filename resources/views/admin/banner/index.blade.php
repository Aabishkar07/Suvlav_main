@extends('layouts.backendapp')

@section('content')

@php
// Configure this page 
$pageName = 'Banners';
$post_per_page = siteSettings('posts_per_page'); 

$breadcrumbs = [
    ['title' => 'Dashboard', 'link' => '#', 'isActive' => ''],
    ['title' => 'Banners', 'link' => '#', 'isActive' => 'active'],
];

$start = (isset($request->page) && !empty($request->page))? ($request->page * $post_per_page )+ 1 : 1

@endphp

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            {{ $message }}
        </div>     
    @endif 

    <div class="col-lg-12 grid-margin stretch-card px-5">
                <div class="card">
                  <div class="card-body">
              
                <div class="row margin-bottom-30">
                    <form method="get" class="forms-sample deceased-search">
                    <input type="hidden" name="search" value="search">
                    <div class="form-group row">

                      @can('View Banner')
                        
                   
                        <div class="col-sm-6 mt-2">  <a href="{{ route('banner.create') }}" class="btn btn-info sfw btn-sm bg-black border-0"><i class="fa fa-plus"></i> Add New </a> </div>
                        @endcan
                        <div class="col-sm-3" >
                          <input type="text" name= "title" class="form-control " id="searchName" value="{{ $request->title }}" placeholder="Search...">
                            </div>
                            <div class="col-sm-3 mt-2">
                          <button class="btn btn-info sfw btn-sm btn_search bg-black border-0" type="submit"><i class="fa fa-search"></i> Search</button>
                          <a href="{{route('banner.index')}}" class="btn btn-info sfw btn-sm bg-black border-0" ><i class="fa fa-mail-reply"></i> Reset </a>
                        </div>
                      </div>

                    </form>
                </div>
                    <table class="table table-bordered table-hover">
                      <thead class="table-light">
                        <tr>
                          <th> # </th>
                          <th> Image </th>
                          <th> Name </th>
                          <th> Main Heading </th>
                          <th> Display On </th>
                          <th> Status </th>
                          <th> Action </th>
                          <th> Remove </th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php $GLOBALS['counter'] = $start;?>
                      @if(count($banners) > 0)
                      @foreach ($banners as $key => $banner)
                      @php
                        $banner_image_url = ($banner->image != '')?$banner->image : 'assets/images/no_photo.jpg';
                      @endphp
                        <tr>
                            <td>{{ ( $GLOBALS['counter']++ )  }}</td>
                            <td><img src="{{asset($banner_image_url) }}" alt="{{ $banner->title }}"></td>
                            <td>{{ $banner->title }}</td>
                            <td>{!! $banner->main_heading !!}</td>
                            <td>
                            @switch($banner->display_option)
                            @case('1')
                            <label class="badge badge-danger">MAIN BANNER</label>
                            @break;
                            @case('2')
                            <label class="badge badge-info">2 COL CARD</label>
                            @break;
                            @default
                            <label class="badge badge-success">3 COL CARD</label>
                            @endswitch

                            </td>
                            <td>{!! ($banner->status === '1')? '<i class="fa fa-check"></i>':'<i class="fa fa-times"></i>' !!}</td>
                          @can('Edit Banner')
                            
                          <td><a href="{{ route('banner.edit', $banner->id)}}" class="btn btn-success btn-sm"><i class="fa fa-edit"></i> </a>
                          @endcan
              </td>

              @can('Delete Banner')
              <td>
                <form action="{{route('banner.destroy', $banner->id)}}" method="POST" class="delete_confirm ">
                <input type="hidden" name="_token" value="{{csrf_token()}}">
                <input type="hidden" name="_method" value="DELETE">
                <button class="btn btn-danger sfw btn-sm "><i class="fa fa-trash-o "></i> </button>
              </form>
              </td>
              @endcan
                        </tr>
                        @endforeach

                        @else
                        <tr><td colspan="8"><p class="text-danger">No record found!</p></td></tr>
                        @endif
                      </tbody>
                    </table>

                    <div class="row margin-top-30">
                      <div class="card">
                          <div class="card-body">
                          {{ $banners->appends(request()->query())->links() }}
                          </div>
                      </div>
                    </div>
                  
            </div>
            </div>
            </div>


@endsection