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
  <div class="toast__message-custom">
  </div>
<div class="login-box">
  <!-- /.login-logo -->
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <a href="#" class="h1"><b>Admin</b></a>
    </div>
    <div class="card-body">
      <p class="login-box-msg">Sign in to start your session</p>

      <form action="" method="post" id="form-login-admin">
        @csrf
        <div class="form-group">
          <div class="input-group mb-3" style="margin-bottom: 0 !important;">
            <input type="email" class="form-control"   id="usename_login-admin" name="email" placeholder="Email">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-envelope"></span>
              </div>
            </div>
          </div>
          <span class="form-message"></span>
        </div>
       <div class="form-group">
          <div class="input-group mb-3" style="margin-bottom: 0 !important;">
            <input type="password" class="form-control"  id="password_login-admin" name="password" placeholder="Password">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>
          <span class="form-message"></span>
       </div>
        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" id="remember">
              <label for="remember">
                Remember Me
              </label>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button id="btn-login" class="btn btn-primary btn-block" onclick="toggleLoginLoading('#btn-login','#span-login','#usename_login-admin','#password_login-admin')" type="submit">
              <span id="span-login" class=" spinner-border-sm" role="status" aria-hidden="true"></span>
              Sign In
            </button>
            {{-- <button type="submit" class="btn btn-primary btn-block">Sign In</button> --}}
          </div>
          <!-- /.col -->
        </div>
      </form>

      <div class="social-auth-links text-center mt-2 mb-3">
        <a href="#" class="btn btn-block btn-primary">
          <i class="fab fa-facebook mr-2"></i> Sign in using Facebook
        </a>
        <a href="#" class="btn btn-block btn-danger">
          <i class="fab fa-google-plus mr-2"></i> Sign in using Google+
        </a>
      </div>
      <!-- /.social-auth-links -->

      <p class="mb-1">
        <a href="#">I forgot my password</a>
      </p>
      
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
<script src="{{asset('dashboard/assets/js/form.js')}}"></script>
<script src="{{asset('dashboard/assets/js/main.js')}}"></script>
<script src="{{asset('dashboard/assets/js/validate.js')}}"></script>

</body>
</html>
