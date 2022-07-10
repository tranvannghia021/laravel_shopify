@extends('admin.layouts.layout')
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-12">
              <h1 class="m-0">Trang chủ</h1>
            </div>
          
          </div>
        </div>
      </div>
      <!-- /.content-header -->
  
      <!-- Main content -->
      <section class="content">
        <h1>Đang bảo trì và nâng cấp</h1>
        
        
      <button onclick="showMessage('Success','Thêm thành công','success',10000)" class="btn btn-success">Success</button>
      <button onclick="showMessage('Error','Thêm thất bại','error',3000)" class="btn btn-danger">Erorr</button>
      </section>
      <!-- /.content -->

@endsection