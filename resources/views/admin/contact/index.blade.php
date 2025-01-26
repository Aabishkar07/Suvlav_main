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

                
                <button type="button" class="btn text-white btn-sm" style="background-color:#0000FF" 
                data-toggle="modal" 
                data-target="#exampleModal" 
                data-id="{{ $page->id }}"
                data-name="{{ $page->name ?? 'No data available' }}"
                data-email="{{ $page->email ?? 'No data available' }}"
                data-subject="{{ $page->subject ?? 'No data available' }}"
                data-phone="{{ $page->phone_no ?? 'No data available' }}"
                data-message="{{ $page->message ?? 'No data available' }}">
            View
        </button>
        
              </form>


         
     


            

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
      <div class="modal-content">
          <!-- Modal Header -->
          <div class="modal-header text-white" style="background-color:#0000FF">
              <h5 class="modal-title" id="exampleModalLabel">User Details</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
          </div>

          <!-- Modal Body -->
          <div class="modal-body px-4 py-3">
              <div class="card border-0">
                  <div class="card-body">
                      <p class="mb-2"><strong>Name:</strong> <span id="modalName">No data available</span></p>
                      <p class="mb-2"><strong>Email:</strong> <span id="modalEmail">No data available</span></p>
                      <p class="mb-2"><strong>Subject:</strong> <span id="modalSubject">No data available</span></p>
                      <p class="mb-2"><strong>Phone:</strong> <span id="modalPhone">No data available</span></p>
                      <p class="mb-2"><strong>Message:</strong> <span id="modalMessage">No data available</span></p>
                  </div>
              </div>
          </div>

          <!-- Modal Footer -->
          <div class="modal-footer">
              <button type="button" class="btn text-white btn-sm" style="background-color:#0000FF" data-dismiss="modal">Close</button>
          </div>
      </div>
  </div>
</div>



<script>

$('#exampleModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget); 
    var email = button.data('email');
    var subject = button.data('subject');
    var phone = button.data('phone');
    var message = button.data('message');
    var name = button.data('name');

    var modal = $(this);
    modal.find('#modalName').text(name);
    modal.find('#modalEmail').text(email);
    modal.find('#modalSubject').text(subject);
    modal.find('#modalPhone').text(phone);
    modal.find('#modalMessage').text(message);
});


  </script>
<!-- jQuery and Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

            


            
  
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>



            


      
              
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