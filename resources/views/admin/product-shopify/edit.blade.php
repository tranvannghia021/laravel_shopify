@extends('admin.layouts.layout')
@section('ckeditor')
    <script>
        CKEDITOR.replace('description_product_shopify');
    </script>
@endsection
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1 class="m-0">Cập nhập sản phẩm</h1>
                </div>
               
            </div>
        </div>
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        @if (session('message'))
        <div class="custom_message {{session('class')}}" ><h5 class="text-message">{{session('message')}}</h5></div>
        @endif
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title"></h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form action="" method="POST" id="form_edit_product_shopify" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="col col-sm-6">
                            <div class="form-group">
                                <label for="title">Tên sản phẩm</label>
                                <input type="text" class="form-control"  value="{{$products->title}}" name="title_pr" id="title"
                                    placeholder="Tên sản phẩm">
                                    <span class="form-message"></span>
                            </div>
                        </div>
                        <div class="col col-sm-4">
                            <div class="form-group">
                                <label for="category">Tên danh mục</label>
                                <input type="text" class="form-control" id="category" value="{{$products->name_category}}" name="category"
                                    placeholder="Tên danh mục">
                                    
                            </div>
                        </div>
                        <div class="col col-sm-2">
                            <div class="form-group">
                                <label>Trạng thái</label>

                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="status"{{$products->status == 'active' ? 'checked':''}} value="active">
                                    <label class="form-check-label">Active</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" name="status" value="draft" type="radio" {{$products->status == 'draft' ? 'checked':''}}>
                                    <label class="form-check-label">Draft</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Thông tin chi tiết</label>
                        <textarea class="form-control" name="description" id="description_product_shopify">{{$products->body_html}}</textarea>
                    </div>


                </div>
                <!-- /.card-body -->


                <div id="show_varians">
                   {!! \App\Helpers\Helper::showVarianEdit($products)!!}
                    
                </div>


                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">update</button>
                </div>
            </form>
            
          
        </div>
       
    </section>
    <!-- /.content -->
@endsection
@section('javacript')
    <script>
       
    </script>
@endsection