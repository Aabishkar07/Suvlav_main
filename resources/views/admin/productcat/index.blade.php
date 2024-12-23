@extends('layouts.backendapp')

@section('content')

@php
// Configure this page 
$pageName = 'Product Categories';
$showChildFormat = 'yes';
$post_per_page = 10; 

$breadcrumbs = [
    ['title' => 'Dashboard', 'link' => '#', 'isActive' => ''],
    ['title' => 'Products', 'link' => '#', 'isActive' => ''],
    ['title' => 'Product Categories', 'link' => '#', 'isActive' => 'active'],
];

if(isset($request->search) && $request->search != ''){
    $showChildFormat = 'no';
}

$start = (isset($request->page) && !empty($request->page))? ($request->page * $post_per_page )+ 1 : 1

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
                        <div class="col-sm-6">  <a href="{{ route('productcat.create') }}" class="btn btn-info sfw btn-sm"><i class="fa fa-plus"></i> Add New </a> </div>
                        <div class="col-sm-3">
                          <input type="text" name= "title" class="form-control" id="searchName" value="{{ $request->title }}" placeholder="Search...">
                            </div>
                            <div class="col-sm-3">
                          <button class="btn btn-info sfw btn-sm btn_search" type="submit"><i class="fa fa-search"></i> Search</button>
                          <a href="{{route('productcat.index')}}" class="btn btn-info sfw btn-sm" ><i class="fa fa-mail-reply"></i> Reset </a>
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
                          <th> Short Desc </th>
                          <th> Status </th>
                          <th> Action </th>
                          <th> Remove </th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php $GLOBALS['counter'] = $start;?>
                      @if(count($productcats) > 0)
                      @foreach ($productcats as $key => $productcat)
                      @php
                        $productcat_image_url = ($productcat->image != '')?'public'.$productcat->image : 'assets/images/no_photo.jpg';
                      @endphp
                        <tr>
                            <td>{{ ( $GLOBALS['counter']++ )  }}</td>
                            <td><img src="{{asset($productcat_image_url) }}" alt="{{ $productcat->title }}"></td>
                            <td>{{ $productcat->title }}</td>
                            <td>{{ $productcat->short_desc }}</td>
                            <td>{!! ($productcat->status === '1')? '<i class="fa fa-check"></i>':'<i class="fa fa-times"></i>' !!}</td>
                            <td><a href="{{ route('productcat.edit', $productcat->id)}}" class="btn btn-success btn-sm"><i class="fa fa-edit"></i> </a>
              </td>

              <td>
                <form action="{{route('productcat.destroy', $productcat->id)}}" method="POST" class="delete_confirm">
                <input type="hidden" name="_token" value="{{csrf_token()}}">
                <input type="hidden" name="_method" value="DELETE">
                <button class="btn btn-danger sfw btn-sm"><i class="fa fa-trash-o"></i> </button>
              </form>
              </td>
                        </tr>
                        <?php $dash=''; ?>
                        @if($showChildFormat === 'yes' && $productcat->parent_id === 0)
                            @include('admin.components.subcatrow',['subcategories' => $productcat->subcategory, 'counter' => $GLOBALS['counter'] ])
                           
                        @endif

                        @endforeach

                        @else
                        <tr><td colspan="7"><p class="text-danger">No record found!</p></td></tr>
                        @endif
                      </tbody>
                    </table>

                    <div class="row margin-top-30">
                      <div class="card">
                          <div class="card-body">
                          {{ $productcats->appends(request()->query())->links() }}
                          </div>
                      </div>
                    </div>
                  
            </div>
            </div>
            </div>


@endsection