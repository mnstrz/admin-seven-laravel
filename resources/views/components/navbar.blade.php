<!-- Navbar -->
  <nav class="{{ config('adminSeven.navbar.'.AdminSeven::navbarSkin()) }} {{ AdminSeven::theme("is_no_navbar_border") }} {{ AdminSeven::theme("is_navbar_small") }}" id="adminSeven_navbar">

    @if( AdminSeven::theme("is_top_nav") != null)
    <div class="container">
      <a href="{{ url("/") }}" class="adminSeven_brand {{ config('adminSeven.brand.'.AdminSeven::brandSkin()) }} {{ AdminSeven::theme("is_brand_small") }} p-2" style="min-width: 150px;">
        @if(AdminSeven::appConfig()->logo)
          <img src="{{ \Storage::url(AdminSeven::appConfig()->logo) }}" alt="Admin Seven" class="brand-image img-circle elevation-3" style="opacity: .8">
        @else
          <img src="{{ asset('admin/images/admin-seven-logo.png') }}" alt="Admin Seven" class="brand-image img-circle elevation-3" style="opacity: .8">
        @endif
        <span class="">
          {{ AdminSeven::appConfig()->app_name }}
        </span>
      </a>

      <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
    @endif
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      @foreach($link_navbar as $key => $value)
      <li class="nav-item d-none d-sm-inline-block">
        <a href="{{ $value['url'] }}" class="nav-link">{{ $value['name'] }}</a>
      </li>
      @endforeach
    </ul>

    <!-- SEARCH FORM -->
    {{-- <form class="form-inline ml-3">
      <div class="input-group input-group-sm">
        <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-navbar" type="submit">
            <i class="fas fa-search"></i>
          </button>
        </div>
      </div>
    </form> --}}

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-bell"></i>
          <span class="badge badge-warning navbar-badge">0</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-item dropdown-header">15 Notifications</span>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-envelope mr-2"></i> 4 new messages
            <span class="float-right text-muted text-sm">3 mins</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-users mr-2"></i> 8 friend requests
            <span class="float-right text-muted text-sm">12 hours</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-file mr-2"></i> 3 new reports
            <span class="float-right text-muted text-sm">2 days</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="{{ url('backend/logout') }}" role="button">
          Logout <i class="fas fa-sign-out-alt"></i>
        </a>
      </li>
    </ul>
    @if( AdminSeven::theme("is_top_nav") != null)
      </div>
    @endif
  </nav>
<!-- /.navbar -->

<!-- Main Sidebar Container -->
  <aside class="main-sidebar elevation-4 {{ config('adminSeven.sidebar.'.AdminSeven::sidebarSkin()) }} {{ AdminSeven::theme("is_sidebar_disable_expand") }}" id="adminSeven_sidebar">
    <!-- Brand Logo -->
    <a href="index3.html" class="adminSeven_brand brand-link {{ config('adminSeven.brand.'.AdminSeven::brandSkin()) }} {{ AdminSeven::theme("is_brand_small") }}">
      @if(AdminSeven::appConfig()->logo)
        <img src="{{ \Storage::url(AdminSeven::appConfig()->logo) }}" alt="Admin Seven" class="brand-image img-circle elevation-3" style="opacity: .8">
      @else
        <img src="{{ asset('admin/images/admin-seven-logo.png') }}" alt="Admin Seven" class="brand-image img-circle elevation-3" style="opacity: .8">
      @endif
      <span class="brand-text font-weight-light">{{ AdminSeven::appConfig()->app_name }}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          @if(file_exists(\Storage::path(AdminSeven::UserInfo()->avatar)))
          <img src="{{ \Storage::url(AdminSeven::UserInfo()->avatar) }}" class="img-circle elevation-2" alt="User Image">
          @else
          <i class="fas fa-user-circle fa-2x"></i>
          @endif
        </div>
        <div class="info">
          <a href="#" class="d-block">{{ AdminSeven::UserInfo()->username }}</a>
        </div>
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
        <ul class="nav nav-pills nav-sidebar flex-column {{ AdminSeven::theme('is_sidebar_small')}} {{ AdminSeven::theme('is_sidebar_flat')}} {{ AdminSeven::theme('is_sidebar_legacy')}} {{ AdminSeven::theme('is_sidebar_compact')}} {{ AdminSeven::theme('is_sidebar_child_indent')}} {{ AdminSeven::theme('is_sidebar_child_hide')}} {{ AdminSeven::theme('is_sidebar_disable_expand')}}" data-widget="treeview" role="menu" data-accordion="false" id="sidebar">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <x-sidebar-menu />
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>