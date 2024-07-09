<div class="sidebar">
  <!-- Sidebar user panel (optional) -->
  {{-- <div class="user-panel mt-3 pb-3 mb-3 d-flex">
    <div class="image">
      <img src="{{ asset('lte/dist/img/me.jpg') }}" class="img-circle elevation-2" alt="User Image">
    </div>
    <div class="info">
      <a href="#" class="d-block">runa</a>
    </div>
  </div> --}}

  <!-- Sidebar Menu -->
  <nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
      <!-- Add icons to the links using the .nav-icon class with font-awesome or any other icon font library -->
      <li class="nav-item">
        <a href="/" class="nav-link">
          <i class="nav-icon fas fa-th"></i>
          <p>
            Dashboard
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
        <!-- Dropdown Menu Pangan -->
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
            <a href="{{ route('pangan.add') }}" class="nav-link active">
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
        <!-- Dropdown Menu Ternak -->
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
            <a href="{{ route('ternak.add') }}" class="nav-link active">
              <i class="far fa-circle nav-icon"></i>
              <p>Input Ternak</p>
            </a>
          </li>
        </ul>
      </li>
      <li class="nav-item">
        <a href="{{ route('profile') }}" class="nav-link">
          <i class="nav-icon fas fa-th"></i>
          <p>
            Profile
          </p>
        </a>
      </li>
      <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
          @csrf
      </form>

      <li class="nav-item">
          <a href="#" class="nav-link" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
              <i class="nav-icon fas fa-sign-out-alt"></i>  
              <p>Logout</p>
          </a>
      </li>
    </ul>
  </nav>
</div>
<!-- /.sidebar-menu -->
