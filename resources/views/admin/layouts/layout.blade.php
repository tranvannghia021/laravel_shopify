<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>ADMIN</title>
  
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="{{asset('Template/admin/plugins/fontawesome-free/css/all.min.css')}}">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{asset('Template/admin/plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('Template/admin/dist/css/adminlte.min.css')}}">
  {{-- css custom --}}
  <link rel="stylesheet" href="{{asset('dashboard/assets/css/main.css')}}">
  {{-- css-show-detailsp --}}
  {{-- slick --}}
  


</head>
<body  class="hold-transition  sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
<div  class="wrapper">

  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__wobble" src="{{asset('Template/admin/dist/img/AdminLTELogo.png')}}" alt="AdminLTELogo" height="60" width="60">
  </div>

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-dark">
    {{-- header --}}
    @include('admin.layouts.header')
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    @include('admin.layouts.navbar')
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    
    <div class="toast__message-custom">
    </div>
    @yield('content')
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->

  <!-- Main Footer -->
  <footer class="main-footer">
    @include('admin.layouts.footer')
  </footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->
<!-- jQuery -->
<script src="{{asset('Template/admin/plugins/jquery/jquery.min.js')}}"></script>
{{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script> --}}
<!-- Bootstrap -->
<script src="{{asset('Template/admin/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- overlayScrollbars -->
<script src="{{asset('Template/admin/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('Template/admin/dist/js/adminlte.js')}}"></script>

<!-- PAGE PLUGINS -->
<!-- jQuery Mapael -->
<script src="{{asset('Template/admin/plugins/jquery-mousewheel/jquery.mousewheel.js')}}"></script>
<script src="{{asset('Template/admin/plugins/raphael/raphael.min.js')}}"></script>
<script src="{{asset('Template/admin/plugins/jquery-mapael/jquery.mapael.min.js')}}"></script>
<script src="{{asset('Template/admin/plugins/jquery-mapael/maps/usa_states.min.js')}}"></script>
{{-- ckeditor --}}
<script src="//cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
{{-- <script src="{{asset('Template/admin/dist/js/pages/dashboard2.js')}}"></script> --}}
{{-- js validate --}}
<script src="{{asset('dashboard/assets/js/varians.js')}}"></script>
<script src="{{asset('dashboard/assets/js/remove.js')}}"></script>
<script src="{{asset('dashboard/assets/js/main.js')}}"></script>
<script src="{{asset('dashboard/assets/js/form.js')}}"></script>
<script src="{{asset('dashboard/assets/js/validate.js')}}"></script>
{{-- toast mess --}}
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@yield('ckeditor')
@yield('javacript')
</body>
</html>
