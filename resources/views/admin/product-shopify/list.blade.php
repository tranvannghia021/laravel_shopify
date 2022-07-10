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
                            <table id="example1" class="table table-bordered table-striped dataTable dtr-inline"
                                aria-describedby="example1_info">
                                <div class="card-footer bg-info clearfix">
                                   <h5 class="d-inline ">Danh sách sản phẩm</h5>
                                    <button onclick="window.location.href='{{route('shopify.product.add')}}'" type="button" class="btn btn-primary float-right"><i class="fas fa-plus"></i> Thêm sản phẩm</button>
                                  </div>
                                <thead>
                                    <tr>
 
                                            <th>STT</th>
                                            <th>Sản phẩm</th>
                                            <th>Trạng Thái</th>
                                            <th>Kho hàng</th>
                                            <th>loại</th>
                                            <th>Người tạo</th>
                                            <th>#</th>
                                                
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (count($products) == 0)
                                        <tr>

                                           <td colspan="6" class="text-center"> <p>Không có sản phẩm nào</p></td>
                                        </tr>
                                    @else
                                    {!! \App\Helpers\Helper::listProductShopify($products) !!}
                                    @endif
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
