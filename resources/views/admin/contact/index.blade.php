@extends('layouts.backendapp')

@section('content')

@php
// Configure this page 
$pageName = 'contact';
$showChildFormat = 'yes';
$post_per_page = siteSettings('posts_per_page'); 

$breadcrumbs = [
    ['title' => 'Dashboard', 'link' => '#', 'isActive' => ''],
    ['title' => 'contact ', 'link' => '#', 'isActive' => 'active'],
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
              
         
                    <table class="table table-bordered table-hover">
                      <thead class="table-light">
                        <tr>
                          <th> # </th>
                       
                          <th> Name </th>

                          <th> Email </th>
                          <th> Subject </th>
                          <th> Phone </th>

                          <th> Message </th>


                          <th> Remove </th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php $GLOBALS['counter'] = $start;?>
                      @if(count($pages) > 0)
                      @foreach ($pages as $key => $page)
                  
                        <tr>
                            <td>{{ ( $GLOBALS['counter']++ )  }}</td> 
                            <td>{{$page->name}}</td>  
                            <td>{{$page->email}}</td>  
                            <td>{!!$page->subject  !!}</td>  
                            <td>{!!$page->phone_no  !!}</td>  

                            <td style="width: 600px; word-wrap: break-word; white-space: normal; padding: 1; margin: 0;">
                              {!! nl2br($page->message) !!}
                          </td>
                          
                  


                            {{-- @can('Delete Faqs') --}}
              <td>
                <form action="{{route('contactdelete', $page->id)}}" method="POST" class="delete_confirm">
                <input type="hidden" name="_token" value="{{csrf_token()}}">
                <input type="hidden" name="_method" value="DELETE">
                <button class="btn btn-danger sfw btn-sm"><i class="fa fa-trash-o"></i> </button>
              </form>
              </td>
              {{-- @endcan --}}
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