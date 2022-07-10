@extends('admin.layouts.layout')
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-12">
              <h1 class="m-0">Dân trí</h1>
            </div>
          
          </div>
        </div>
      </div>
      <!-- /.content-header -->
  
      <!-- Main content -->
      <section class="content">
                <div class="parent__post">
    
                    {!! \App\Helpers\Helper::listPost($posts)!!}
                    <div class="paginate_post">{!!$posts->links()!!}</div>
                </div>
      </section>
      <!-- /.content -->
    
@endsection