@extends('layouts.backendapp')

@section('content')

@php
// Configure this page 
$pageName = 'Faqs';
$showChildFormat = 'yes';
$post_per_page = siteSettings('posts_per_page'); 

$breadcrumbs = [
    ['title' => 'Dashboard', 'link' => '#', 'isActive' => ''],
    ['title' => 'faqs ', 'link' => '#', 'isActive' => 'active'],
];


$start = (isset($request->page) && !empty($request->page))? (($request->page -1 ) * $post_per_page )+ 1 : 1

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

                      @can('Add Faqs')
                        <div class="col-sm-6">  <a href="{{ route('faqs.create') }}" class="btn btn-info sfw btn-sm"><i class="fa fa-plus"></i> Add New </a> </div>
                        @endcan
                        <div class="col-sm-3">
                          <input type="text" name= "title" class="form-control" id="searchName" value="{{ $request->title }}" placeholder="Search...">
                            </div>
                            <div class="col-sm-3">
                          <button class="btn btn-info sfw btn-sm btn_search" type="submit"><i class="fa fa-search"></i> Search</button>
                          <a href="{{route('page.index')}}" class="btn btn-info sfw btn-sm" ><i class="fa fa-mail-reply"></i> Reset </a>
                        </div>
                      </div>

                    </form>
                </div>
                    <table class="table table-bordered table-hover">
                      <thead class="table-light">
                        <tr>
                          <th> # </th>
                       
                          <th> Title </th>

                          <th> Description </th>
                          <th> Action </th>

                          <th> Remove </th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php $GLOBALS['counter'] = $start;?>
                      @if(count($pages) > 0)
                      @foreach ($pages as $key => $page)
                  
                        <tr>
                            <td>{{ ( $GLOBALS['counter']++ )  }}</td> 
                            <td>{!! wordwrap($page->title,15,"<br>\n") !!}</td>  
                            <td>{!! Str::limit($page->description, 100) !!}</td>
                            @can('Edit Faqs')
                            <td><a href="{{ route('faqs.edit', $page->id)}}" class="btn btn-success btn-sm"><i class="fa fa-edit"></i> </a>
                            </td>
                            @endcan


                            @can('Delete Faqs')
              <td>
                <form action="{{route('faqs.destroy', $page->id)}}" method="POST" class="delete_confirm">
                <input type="hidden" name="_token" value="{{csrf_token()}}">
                <input type="hidden" name="_method" value="DELETE">
                <button class="btn btn-danger sfw btn-sm"><i class="fa fa-trash-o"></i> </button>
              </form>
              </td>
              @endcan
                        </tr>
                      

                        @endforeach

                        @else
                        <tr><td colspan="6"><p class="text-danger">No record found!</p></td></tr>
                        @endif
                      </tbody>
                    </table>

                    <div class="row margin-top-30">
                      <div class="card">
                          <div class="card-body">
                          {{ $pages->appends(request()->query())->links() }}
                          </div>
                      </div>
                    </div>
                  
            </div>
            </div>
            </div>


@endsection