<!-- Brand Logo -->
<a href="{{route('admin.dashboard')}}" class="brand-link">
    <img src="{{asset('Template/admin/dist/img/AdminLTELogo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
    <span class="brand-text font-weight-light">ADMIN</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <img src="{{asset('Template/admin/dist/img/user2-160x160.jpg')}}" class="img-circle elevation-2" alt="User Image">
      </div>
      <div class="info" style="flex: 1">
        <a href="#" class="d-block">{{$info_name}}</a>
      </div>
      <div><a type="button" class="btn btn-block btn-outline-danger btn-sm" href="{{route('admin.logout')}}">Đăng Xuất</a></div>
    </div>

    <!-- SidebarSearch Form -->
    <div class="form-inline">
      <div class="input-group" data-widget="sidebar-search">
        <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-sidebar">
            <i class="fas fa-search fa-fw"></i>
          </button>
        </div>
      </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
             with font-awesome or any other icon font library -->
             {{-- trang chủ --}}
        {{-- <li class="nav-item menu-open">
          <a href="{{route('admin.dashboard')}}" class="nav-link ">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
              Trang chủ
            </p>
          </a>
        </li> --}}
        {{-- products --}}
        {{-- <li class="nav-item menu-open">
            <a href="{{route('products.list')}}" class="nav-link ">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Sản phẩm
              </p>
            </a>
          </li> --}}

          {{-- category --}}
          {{-- <li class="nav-item menu-open">
            <a href="{{route('categorys.list')}}" class="nav-link ">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Danh mục
              </p>
            </a>
          </li> --}}
          {{-- dan tri --}}
          {{-- <li class="nav-item menu-open">
            <a href="{{route('crawls.list')}}" class="nav-link ">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dân trí
              </p>
            </a>
          </li> --}}
          {{-- product shopify --}}
          <li class="nav-item menu-open">
            <a href="{{route('shopify.product.list')}}" class="nav-link ">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                sản phẩm
              </p>
            </a>
          </li>
         
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>

  <!-- /.sidebar -->