@extends('admin.layouts.layout')
@section('content')
<div class="card card-primary">
    <div class="card-header">
      <h3 class="card-title">Cập nhập sản phẩm</h3>
    </div>
    <!-- /.card-header -->
    <!-- form start -->
    @if (session('message'))
    <div class="custom_message {{session('class')}}" ><h5 class="text-message">{{session('message')}}</h5></div>
    @endif
    <form method="post" enctype="multipart/form-data" id="form-edit-products" >
      
          
      
      @csrf
      <div class="card-body">

        <div class="row">
            <div class="col col-ms-6">
                <div class="form-group">
                  <label for="products_name">Tên sản phẩm</label>
                  <input type="text" class="form-control" name="title" id="products_name" value="{{$products[0]->title}}" placeholder="Tên sản phẩm...">
                  <span class="form-message"></span>
                </div>
            </div>
           <div class="col col-ms-6">
                <div class="form-group">
                  <label >Danh mục</label>
                  <select name="category" class="form-control" id="categorys" >
                    <option value="">--Danh mục--</option>
                    @foreach ($categorys as $category)
                      <option value="{{$category->id}}" {{ $products[0]->category_id == $category->id ? 'selected' : '' }} >
                        {{str_repeat('--', $category->level ).$category->name}}
                      </option>
                    @endforeach
                  </select>
                  <span class="form-message"></span>

                </div>
           </div>
        </div>
        <div class="row">
            <div class="col col-ms-4">
                <div class="form-group">
                  <label for="Products_price">Giá sản phẩm</label>
                  <input type="text" name="price" class="form-control" value="{{$products[0]->price}}" id="Products_price" placeholder="Giá sản phẩm...">
                  <span class="form-message"></span>
                </div>
            </div>
           <div class="col col-ms-4">
                <div class="form-group">
                  <label for="products_quantity">Số lượng sản phẩm</label>
                  <input type="text" class="form-control" name="quantity" id="products_quantity" value="{{$products[0]->quantity}}" placeholder="Số lượng sản phẩm...">
                  <span class="form-message"></span>
                </div>
           </div>
           <div class="col col-ms-4">
               <div class="form-group">
                 <label >Trạng thái</label>
                 <select name="status" class="form-control" id="">
                   <option {{ $products[0]->status == 'pending' ? 'selected' : '' }} value="pending">Pending</option>
                   <option {{ $products[0]->status == 'approve' ? 'selected' : '' }} value="approve">Approve</option>
                   <option {{ $products[0]->status == 'reject' ? 'selected' : '' }} value="reject">Reject</option>
                 </select>
               </div>
        </div>
    </div>
    <div class="form-group">
     <label for="products_desc">Chi tiết sản phẩm</label>
     <input type="text" class="form-control" name="description" value="{{$products[0]->description}}" id="products_desc" placeholder="Chi tiết sản phẩm...">
   </div>
        <div class="form-group">
          <label for="products_file">File input</label>
          <div class="input-group">
            <div class="custom-file">
              <input type="file" class="custom-file-input"  name="images[]" id="products_file" accept=".png,.jpeg,.jpg,.gif" multiple >
              <label class="custom-file-label" for="products_file">Choose file</label>
            </div>
            <div class="input-group-append">
              <span class="input-group-text">Upload</span>
            </div>
          </div>
          <span class="form-message"></span>
          @foreach ($images as $item)
            
          <a href="{{asset('storage/Uploads/'.$item->thumb)}}" target="_blank">
            <img class="custom-img" src="{{asset('storage/Uploads/'.$item->thumb)}}" alt="">
          </a>
          @endforeach
        </div>
        
      </div>
      <!-- /.card-body -->

      <div class="card-footer">
        <button type="submit" class="btn btn-primary">Cập nhập sản phẩm</button>
      </div>
   
    </form>
  </div>  
@endsection