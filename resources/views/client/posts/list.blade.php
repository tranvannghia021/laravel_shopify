<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Home</title>

  <!-- Google Font: Source Sans Pro -->
  {{-- <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback"> --}}
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('Template/admin/plugins/fontawesome-free/css/all.min.css')}}">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="{{asset('Template/admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('Template/admin/dist/css/adminlte.min.css')}}">
  <link rel="stylesheet" href="{{asset('dashboard/assets/css/main.css')}}">
</head>
<body class="">
  <div class="card card-default color-palette-box">
    <div class="card-header">
      <h3 class="card-title">
        <i class="fas fa-tag"></i>
        Tin Tức
      </h3>
    </div>
    <div class="card-body">
      {!! \App\Helpers\Helper::listPostClient($posts)!!}
    <div class="paginate_post">{!!$posts->links()!!}</div>
    </div>
    <!-- /.card-body -->
  </div>
  


    

<!-- jQuery -->
<script src="{{asset('Template/admin/plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{asset('Template/admin/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('Template/admin/dist/js/adminlte.min.js')}}"></script>
<script src="{{asset('dashboard/assets/js/login.js')}}"></script>
<script src="{{asset('dashboard/assets/js/form.js')}}"></script>
<script src="{{asset('dashboard/assets/js/main.js')}}"></script>
<script src="{{asset('dashboard/assets/js/validate.js')}}"></script>

</body>
</html>
