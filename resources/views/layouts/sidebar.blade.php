<div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <img src="{{ asset ('lte/dist/img/me.jpg') }}" class="img-circle elevation-2" alt="User Image">
      </div>
      <div class="info">
        <a href="#" class="d-block">runa</a>
      </div>
    </div>

    <!-- SidebarSearch Form -->
    {{-- <div class="form-inline">
      <div class="input-group" data-widget="sidebar-search">
        <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-sidebar">
            <i class="fas fa-search fa-fw"></i>
          </button>
        </div>
      </div>
    </div> --}}

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
             with font-awesome or any other icon font library -->
        <li class="nav-item">
          <a href="/" class="nav-link">
            <i class="nav-icon fas fa-th"></i>
            {{-- <i class="nav-icon fas fa-house"></i> --}}
            <p>
              Dashboard
              {{-- <span class="right badge badge-danger">New</span> --}}
            </p>
          </a>
        </li>
        <li class="nav-item {{ request()->is('pangan') ? 'menu-open' : '' }}">
          <a href="{{ route('pangan') }}" class="nav-link {{ request()->is('pangan') ? 'active' : '' }}">
              <i class="nav-icon fas fa-th"></i>
              <p>
                  Pangan
                  <i class="right fas fa-angle-left"></i>
              </p>
          </a>
{{-- Dropdown Menu Pangan --}}
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{ route('pangan') }}" class="nav-link active">
                <i class="far fa-circle nav-icon"></i>
                <p>Laporan Pangan</p>
              </a>
            </li>
          </ul>    
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('input_pangan') }}" class="nav-link active">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Input Pangan</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item {{ request()->is('ternak') ? 'menu-open' : '' }}">
            <a href="{{ route('ternak') }}" class="nav-link {{ request()->is('ternak') ? 'active' : '' }}">
                <i class="nav-icon fas fa-th"></i>
                <p>
                    Ternak
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            {{-- Dropdown Menu Ternak --}}
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{ route('ternak') }}" class="nav-link active">
                <i class="far fa-circle nav-icon"></i>
                <p>Laporan Ternak</p>
              </a>
            </li>
          </ul>       
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('input_ternak') }}" class="nav-link active">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Input Ternak</p>
                </a>
              </li>
            </ul>
          </li>
        <li class="nav-item">
            <a href="{{ route('profile') }}" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              {{-- <i class="nav-icon fas fa-house"></i> --}}
              <p>
                Profile
                {{-- <span class="right badge badge-danger">New</span> --}}
              </p>
            </a>
          </li>
    </nav>
</div>
    <!-- /.sidebar-menu -->
  </div>