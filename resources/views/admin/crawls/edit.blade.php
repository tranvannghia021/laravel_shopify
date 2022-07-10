@extends('admin.layouts.layout')
@section('ckeditor')
    <script>
        CKEDITOR.replace( 'sub_title-post' );
    </script>
@endsection
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-12">
              <h1 class="m-0">Cập nhập chi tiết</h1>
            </div>
          
          </div>
        </div>
      </div>
      <!-- /.content-header -->
  
      <!-- Main content -->
      <section class="content">
        <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Cập nhập bài báo</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
           
            <form method="post" action="" id="form-post-update">
                @csrf
              <div class="card-body">
                <div class="form-group">
                  <label for="title_post">Tiêu đề</label>
                  <input type="text" class="form-control" id="title_post" value="{{$posts->title}}" name="title" placeholder="Enter title">
                  <span class="form-message"></span>
                </div>
                <div class="form-group">
                  <label for="desc_post">Thông tin hiện thị chi tiết</label>
                  <input type="text" class="form-control" id="desc_post" value="{{$posts->description}}" name="desc" placeholder="Enter description">
                  <span class="form-message"></span>
                </div>
                <div class="form-group">
                    <label >Chi tiết</label>
                    <textarea id="sub_title-post" class="form-control" name="sub_desc">{{$posts->description_sub}}</textarea>
                  </div>
                  <div class="form-group">
                    <label >Trạng thái</label>

                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="status" value="publish" {{$posts->status == 'publish' ? 'checked':''}}>
                      <label class="form-check-label">Publish</label>
                    </div>
                    <div class="form-check">
                      <input class="form-check-input" name="status" value="unpublish" type="radio" {{$posts->status == 'unpublish' ? 'checked':''}} >
                      <label class="form-check-label">Unpublish</label>
                    </div>
                  </div>
              </div>
              <!-- /.card-body -->

              {{-- <div class="card-footer">
                <button type="submit" class="btn btn-primary">Cập nhập</button>
              </div> --}}
              <div class="card-footer">
                  <button id="btnLoading" class="btn btn-primary" onclick="addClass('#btnLoading','#spanLoading')" type="submit">
                    <span id="spanLoading" class=" spinner-border-sm" role="status" aria-hidden="true"></span>
                    Cập nhập
                  </button>
              </div>
            </form>
         
          </div>
      </section>
      <!-- /.content -->
    
@endsection