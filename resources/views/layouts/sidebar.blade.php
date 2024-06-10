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
        <li class="nav-item">
            <a href="pages/pangan.html" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              {{-- <i class="nav-icon fas fa-house"></i> --}}
              <p>
                Pangan
                {{-- <span class="right badge badge-danger">New</span> --}}
              </p>
            </a>
          </li>
        <li class="nav-item">
            <a href="pages/ternak.html" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              {{-- <i class="nav-icon fas fa-house"></i> --}}
              <p>
                Ternak
                {{-- <span class="right badge badge-danger">New</span> --}}
              </p>
            </a>
          </li>
        <li class="nav-item">
            <a href="pages/profile.html" class="nav-link">
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