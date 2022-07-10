@extends('admin.layouts.layout')
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header bg-primary">
        <div class="container-fluid ">
            <div class="row mb-2">
                <div class="col-sm-12 ">
                    <h1 class="m-0">Chi tiết sản phẩm</h1>
                </div>

            </div>
        </div>
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        @foreach ($products as $item)
            
      
        <div class="row background_show">
            <div class="col-sm-7">
                <div class="img_top">
                    <img src="{{asset('storage/uploads/'.$images[0]->thumb)}}" class="img_big" alt="" id="show">
                </div>
                <div class="img_sub">
                   <div class="img_sub_overfolw">
                        @foreach ($images as $img)
                            
                        <div class="div_bottom">
                            <img onclick="document.getElementById('show').src=this.src" src="{{asset('storage/uploads/'.$img->thumb)}}" alt="" class="div_bottom-img">
                        </div>
                        @endforeach
                   </div>
                    
                </div>
            </div>
            <div class="col-sm-5">
                <div class="div_right">
                    <div class="div_right-top">
                        <h1>{{$item->title}}</h1>
                        <h3>Giá: <span>{{number_format($item->price)}}</span>VNĐ</h3>
                        <h3>Số lượng: <span>{{$item->quantity}}</span></h3>
                        <h3>Loại:<span>{{$item->name}}</span></h3>
                        <h3>Status :<span>{{$item->status}}</span></h3>
                        
                    </div>
                    <div class="div_right-bottom">
                        <h4>Thông tin chi tiết:</h4>
                        <p>{{$item->description}}</p>
                        <h4>Ngày tạo:</h4>
                        <p>{{date ('d-m-Y', strtotime($item->created_at)) }}</p>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </section>
   <Script>scrollproduct();</Script>
    <!-- /.content -->
@endsection

