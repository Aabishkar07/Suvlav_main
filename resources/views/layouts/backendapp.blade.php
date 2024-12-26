<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>{{ siteSettings('site_name') }}</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="{{asset('admincss/vendors/mdi/css/materialdesignicons.min.css')}}">
    <link rel="stylesheet" href="{{asset('admincss/vendors/ti-icons/css/themify-icons.css')}}">
    <link rel="stylesheet" href="{{asset('admincss/vendors/css/vendor.bundle.base.css')}}">
    <link rel="stylesheet" href="{{asset('admincss/vendors/font-awesome/css/font-awesome.min.css')}}">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="{{asset('admincss/vendors/font-awesome/css/font-awesome.min.css')}}" />
    <link rel="stylesheet" href="{{asset('admincss/vendors/bootstrap-datepicker/bootstrap-datepicker.min.css')}}">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="{{asset('admincss/css/style.css')}}">
    <!-- End layout styles -->
    <link rel="shortcut icon" href="{{asset('admincss/images/favicon.png')}}" />
    <script src="https://cdn.ckeditor.com/ckeditor5/34.0.0/classic/ckeditor.js"></script>
  </head>
  <body>
    <div class="container-scroller">
    @include('admin.common.banner')
      <!-- partial:partials/_navbar.html -->
      @include('admin.common.topbar')
      <!-- partial -->
      <div class="container-fluid page-body-wrapper">
        <!-- partial:partials/_sidebar.html -->
        @include('admin.common.menu')
        <!-- partial -->
        <div class="main-panel">
          <div class="content-wrapper" style="background-color: rgb(240, 240, 240);">
            @include('admin.common.heading')
        
             @yield('content')

          </div>
          <!-- content-wrapper ends -->
          <!-- partial:partials/_footer.html -->
          @include('admin.common.footer')
          <!-- partial -->
        </div>
        <!-- main-panel ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="{{ asset('admincss/vendors/js/vendor.bundle.base.js')}}"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="{{ asset('admincss/vendors/chart.js/chart.umd.js')}}"></script>
    <script src="{{ asset('admincss/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js')}}"></script>
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="{{ asset('admincss/js/off-canvas.js')}}"></script>
    <script src="{{ asset('admincss/js/misc.js')}}"></script>
    <script src="{{ asset('admincss/js/settings.js')}}"></script>
    <script src="{{ asset('admincss/js/todolist.js')}}"></script>
    <script src="{{ asset('admincss/js/jquery.cookie.js')}}"></script>
    <!-- endinject -->
    <!-- Custom js for this page -->
    <script src="{{ asset('admincss/js/dashboard.js')}}"></script>
    <script src="{{ asset('admincss/js/file-upload.js')}}"></script>
    <script src="{{ asset('admincss/js/admin.js')}}"></script>
    <!-- End custom js for this page -->
  </body>
</html>