@extends('admin.layouts.layout')
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header bg-info">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1 class="m-0">Danh mục</h1>
                </div>

            </div>
        </div>
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="row">
          @if (session('message'))
          <div class="custom_message {{session('class')}}" ><h5 class="text-message">{{session('message')}}</h5></div>
          @endif
            <div class="col-sm-6">
              
                <div class="card card-primary">
                    <div class="card-header">
                      <h3 class="card-title">{{$button}} danh mục</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form method="POST" id="form-add-cate">
                        @csrf
                      <div class="card-body">
                        <div class="form-group">
                          <label for="category_name">Tên danh mục</label>
                          <input type="text" class="form-control" value="{{$name}}" name="category_name" id="category_name" placeholder="Tên danh mục ...">
                          <span class="form-message"></span>
                        </div>
                        <div class="form-group">
                          <label for="">Danh mục cha</label>
                         <select name="category_id" class="form-control" id="parent_category">
                            <option {{$cate_id == 0 ? 'selected' : ''}} value="0">--Danh mục--</option>
                            @foreach ($categorys as $category)
                            <option {{$cate_id == $category->id ? 'selected' : ''}} value="{{$category->id}}" >
                              {{str_repeat('--', $category->level ).$category->name}}
                            </option>
                          @endforeach
                         </select>
                        </div>
                        
                      </div>
                      <!-- /.card-body -->
      
                      <div class="card-footer">
                        <button type="submit" data-id="{{$id}}" id="btn_catgory" data-set={{$action}} class="btn btn-primary ">{{$button}}</button>
                      </div>
                    </form>
                  </div>
            </div>
            <div class="col-sm-6">
                <div class="row">
                    <div class="col-12">
                      <div class="card card-primary">
                        <div class="card-header">
                          <h3 class="card-title">Danh sách danh mục</h3>
          
                          <div class="card-tools">
                            
                              <div class="input-group input-group-sm" style="width: 150px;">
                                <input type="text" name="table_search" class="form-control float-right" placeholder="Search">
            
                                <div class="input-group-append">
                                  <button type="submit" class="btn btn-default">
                                    <i class="fas fa-search"></i>
                                  </button>
                                </div>
                              </div>
                           
                          </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table-responsive p-0" style="height: 300px;">
                          <table class="table table-head-fixed text-nowrap">
                            <thead>
                              <tr>
                                <th>STT</th>
                                <th>Tên danh mục</th>
                                <th>Ngày tạo</th>
                                <th>#</th>
                                
                              </tr>
                            </thead>
                            <tbody id="show_table">
                              @if (count($categorys) ==0)
                                  <tr>
                                    <td colspan="4" class="text-center">Không có danh mục nào</td>
                                  </tr>
                              @else
                                  {!! \App\Helpers\Helper::category($categorys)!!}
                              @endif
                                
                            </tbody>
                          </table>
                        </div>
                        <!-- /.card-body -->
                      </div>
                      <!-- /.card -->
                    </div>
                  </div>
            </div>
        </div>
 
    </section>
    <!-- /.content -->
@endsection
@section('javacript')
<script>
  // form-add-cate
  const btn_cate=document.getElementById("btn_catgory");
    const form = document.getElementById("form-add-cate");
    const bodyTable = document.getElementById("show_table");
    const classBtnCate=btn_cate.getAttribute("data-set");
    if(classBtnCate == 'add'){
        
        //add-category
        Validator({
            form: "#form-add-cate",
            formGroupSelector: ".form-group",
            errorSelector: ".form-message",
            rules: [
                Validator.isRequired(
                    "#category_name",
                    "Vui lòng nhập tên danh mục"
                ),
            ],
            onSubmit: function (data) {
                $.ajax({
                    url: "/admin/category/list",
                    type: "POST",
                    datatype: "JSON",
                    data: $("#form-add-cate").serialize(),
                    success: function (res) {
                        if (res.error == false) {
                           
                            
                            form.reset();
                            // bodyTable.innerHTML=`<?php \App\Helpers\Helper::category(${res.data}) ?>`;
                            var key = 0;
                            var html = res.data.map((item) => {
                                key++;
                                return `<tr>
                            <td>${key}</td>
                            <td>${item.name}</td>
                            <td>${new Date(item.created_at).toLocaleDateString(
                                "vi-VN"
                            )}</td>
                            <td style="">
                                <a href="/admin/category/list/${item.id}">
                                    <button  type="button" class="btn btn-info btn-circle btn-lg"><i class="fas fa-edit"></i></button>
                                </a>
                                <a href="/admin/category/destroy/${item.id}" >
                                    <button class="btn btn-danger btn-circle btn-lg"><i class="fas fa-trash"></i></button>
                                </a>
                              
                            </td>
                          </tr>`;
                            });
                            bodyTable.innerHTML = html.join("");
                            showMessage("Success", res.message, "success", 10000);
                            
                        } else {
                            showMessage("Error", res.message, "error", 10000);
                        }
                    },
                });
            },
        });
    }else{
        // update cate
        const idCate=btn_cate.getAttribute("data-id");
        Validator({
            form: "#form-add-cate",
            formGroupSelector: ".form-group",
            errorSelector: ".form-message",
            rules: [
                Validator.isRequired(
                    "#category_name",
                    "Vui lòng nhập tên danh mục"
                ),
            ],
            onSubmit: function (data) {
                $.ajax({
                    url: `/admin/category/list/${idCate}`,
                    type: "POST",
                    datatype: "JSON",
                    data: $("#form-add-cate").serialize(),
                    success: function (res) {
                        if (res.error == false) {
                            // const bodyTable = document.getElementById("show_table");
                            // const form = document.getElementById("form-add-cate");
                            form.reset();
                            
                            var key = 0;
                            var html = res.data.map((item) => {
                                key++;
                                return `<tr>
                            <td>${key}</td>
                            <td>${item.name}</td>
                            <td>${new Date(item.created_at).toLocaleDateString(
                                "vi-VN"
                            )}</td>
                            <td style="">
                                <a href="/admin/category/list/${item.id}">
                                    <button type="button" class="btn btn-info btn-circle btn-lg"><i class="fas fa-edit"></i></button>
                                </a>
                                <a href="/admin/category/destroy/${item.id}" >
                                    <button class="btn btn-danger btn-circle btn-lg"><i class="fas fa-trash"></i></button>
                                </a>
                              
                            </td>
                          </tr>`;
                            });
                            bodyTable.innerHTML = html.join("");
                            setTimeout(function(){
                                window.location.href='/admin/category/list';
                            },1500);
                            showMessage("Success", res.message, "success", 10000);
                        } else {
                            showMessage("Error", res.message, "error", 10000);
                        }
                    },
                });
            },
        });
    }
</script>
@endsection
