<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Login</title>

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
<body class="hold-transition login-page bg-light">
  @if (session('message'))
    <div class="alert alert-danger" ><h5 class="text-message">{{session('message')}}</h5></div>
    @endif
  <div class="toast__message-custom">
  </div>
<div class="login-box">
  <!-- /.login-logo -->
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <a href="#" class="h1"><b>Shopify</b></a>
    </div>
    <div class="card-body">
      <p class="login-box-msg"></p>

      <form action="" method="post" id="form-create-shopify">
        @csrf
        <div class="form-group">
          <div class="input-group mb-3" style="margin-bottom: 0 !important;">
            <input type="text" class="form-control" id="domain_shopify" name="domain" placeholder="Domain">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="">.myshopify.com</span>
              </div>
            </div>
          </div>
          <span class="form-message"></span>
        </div>
       
        <div class="row">
          <div class="col-4">
            
          </div>
          <!-- /.col -->
          <div class="col-8">
            <button id="btn-login" class="btn btn-primary btn-block"  type="submit">
              <span id="span-login" class=" spinner-border-sm" role="status" aria-hidden="true"></span>
              Login App
            </button>
            {{-- <button type="submit" class="btn btn-primary btn-block">Sign In</button> --}}
          </div>
          <!-- /.col -->
        </div>
      </form>

     
      
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
</div>
<!-- /.login-box -->



    

<!-- jQuery -->
<script src="{{asset('Template/admin/plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{asset('Template/admin/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('Template/admin/dist/js/adminlte.min.js')}}"></script>
<script src="{{asset('dashboard/assets/js/login.js')}}"></script>
<script src="{{asset('dashboard/assets/js/shopify.js')}}"></script>
<script src="{{asset('dashboard/assets/js/form.js')}}"></script>
<script src="{{asset('dashboard/assets/js/main.js')}}"></script>
<script src="{{asset('dashboard/assets/js/validate.js')}}"></script>

</body>
</html>
