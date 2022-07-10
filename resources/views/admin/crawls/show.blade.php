@extends('admin.layouts.layout')
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-12">
              <h1 class="m-0"></h1>
            </div>
          
          </div>
        </div>
      </div>
      <!-- /.content-header -->
  
      <!-- Main content -->
      <section class="content">
        @foreach ($posts  as $item)
            
            <div class="text-center font-weight-bold">
                 <h1>{{$item->title}}</h1>
            </div>
                <h4>{{$item->description}}</h4>
             <p>{!! $item->description_sub !!}</p>
        @endforeach
      </section>
      <!-- /.content -->
    
@endsection