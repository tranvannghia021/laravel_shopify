@extends('admin.layouts.layout')
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1 class="m-0">Sản phẩm</h1>
                </div>

            </div>
        </div>
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="card">
            @if (session('message'))
    <div class="custom_message {{session('class')}}" ><h5 class="text-message">{{session('message')}}</h5></div>
    @endif

            <div class="card-header">
                <h3 class="card-title"></h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card card-default">
                                <div class="card-header bg-info">
                                    <h3 class="card-title">Lọc sản phẩm</h3>

                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                            <i class="fas fa-minus"></i>
                                        </button>
                                        <button type="button" class="btn btn-tool" data-card-widget="remove">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </div>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body" style="display: block;">
                                    <form method="post">
                                        @csrf
                                        <div class="row">
                                            <div class="col-md-6" data-select2-id="30">
                                                <div class="form-group" data-select2-id="29">
                                                    <label>Trạng thái</label>
                                                    <select name="status" class="form-control select2bs4 select2-hidden-accessible"
                                                        style="width: 100%;" data-select2-id="17" tabindex="-1"
                                                        aria-hidden="true">
                                                        <option value="" >All</option>
                                                        <option value="pending" >Pending</option>
                                                        <option value="approve" >Approve</option>
                                                        <option value="reject" >Reject</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6" data-select2-id="30">
                                                <div class="form-group" data-select2-id="29">
                                                    <label>Tìm kiếm</label>
                                                    <input type="text" name="search" class="form-control select2bs4 select2-hidden-accessible" placeholder="Tìm kiếm tên sản phẩm ...">
                                                </div>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-block btn-primary btn-lg">Filter</button>
                                    </form>
                                    </div>
                                    
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header bg-info">
                          <h3 class="card-title">Trạng thái</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body p-0">
                          <table class="table table-striped">
                            <thead>
                              <tr>
                                <th style="width: 10px">STT</th>
                                <th>Trạng thái</th>
                                <th>Tổng</th>
                              </tr>
                            </thead>
                            <tbody>
                                @foreach ($status_sum as $key => $status)
                                    
                                <tr>
                                    <td>{{++$key}}</td>
                                    <td>{{$status->status}}</td>
                                    <td>
                                        {{$status->total}}
                                    </td>
                                </tr>
                                @endforeach
                             
                            </tbody>
                          </table>
                        </div>
                        <!-- /.card-body -->
                      </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <table id="example1" class="table table-bordered table-striped dataTable dtr-inline"
                                aria-describedby="example1_info">
                                <div class="card-footer bg-info clearfix">
                                   <h5 class="d-inline ">Danh sách sản phẩm</h5>
                                    <button onclick="window.location.href='{{route('products.add')}}'" type="button" class="btn btn-primary float-right"><i class="fas fa-plus"></i> Thêm sản phẩm</button>
                                  </div>
                                <thead>
                                    <tr>
 
                                            <th>STT</th>
                                            <th>Tên sản phẩm</th>
                                            <th>Giá</th>
                                            <th>Số lượng</th>
                                            <th>Trạng thái</th>
                                            <th>#</th>
                                            
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (count($products) == 0)
                                        <tr>

                                           <td colspan="6" class="text-center"> <p>Không có sản phẩm nào</p></td>
                                        </tr>
                                    @endif
                                    @foreach ($products as $key => $item)
                                        
                                    <tr class="col">
                                        <td class="sorting_1 dtr-control">{{++$key}}</td>
                                            <td style=""><a href="{{route('products.show',['id' => $item->id ])}}">{{$item->title}}</a></td>
                                            <td style="">{{number_format($item->price)}}</td>
                                            <td style="">{{$item->quantity}}</td>
                                            <td style="">{{$item->status}}</td>
                                            <td style="">
                                                <a href="{{route('products.edit',['id' => $item->id])}}">
                                                    <button type="button" class="btn btn-info btn-circle btn-lg"><i class="fas fa-edit"></i></button>
                                                </a>
                                                <a href="{{route('products.delete',['id' => $item->id])}}" >
                                                    <button class="btn btn-danger btn-circle btn-lg"><i class="fas fa-trash"></i></button>
                                                </a>
                                              
                                            </td>
                                    </tr>
                                    @endforeach
                                   
                                </tbody>
                                
                            </table>
                        </div>
                    </div>
                    <div class="row">
                        
                        <div class="col-sm-12 col-md-12">
                            <div class="dataTables_paginate paging_simple_numbers" id="example1_paginate">
                                <ul class="pagination">
                                            {!! $products->links() !!}
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.card-body -->
        </div>
    </section>
    <!-- /.content -->
@endsection
