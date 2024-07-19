<div class="sidebar">
  <!-- Sidebar user panel (optional) -->
  {{-- <div class="user-panel mt-3 pb-3 mb-3" style="background-color: #2c3e50; padding: 10px; border-radius: 5px; color: #ecf0f1;"> --}}
    <div class="info" style="margin-bottom: 5px;">
    @php
    $user = Auth::user();
    @endphp
      <a href="#" class="d-block" style="color: #ecf0f1; text-decoration: none; font-weight: bold;">Log as : {{$user->name }}</a>
    </div>
    <div class="info">
      @if($user->status == 0)
        <a href="#" class="d-block" style="color: #ecf0f1; text-decoration: none; font-weight: bold;">Role : Admin</a>
      @else
        <a href="#" class="d-block" style="color: #ecf0f1; text-decoration: none; font-weight: bold;">Role : Pengurus</a>
      @endif
    </div>
  {{-- </div> --}}
  
@php
  $role = Auth::user()->status ? 1 : 0;
  $ternak = App\Models\Ternak::all(); 
  $pangan = App\Models\Pangan::all(); 
  use Carbon\Carbon;
  $latestOngoingTernak = $ternak->where('is_ongoing', 1)->sortByDesc('created_at')->first();
  $daysSinceTernakStarted = $latestOngoingTernak ? Carbon::parse($latestOngoingTernak->created_at)->diffInDays() : 0;
@endphp

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
          </p>
        </a>
      <li class="nav-item {{ request()->is('ternak') ? 'menu-open' : '' }}">
        <a href="{{ route('ternak') }}" class="nav-link {{ request()->is('ternak') ? 'active' : '' }}">
          <i class="nav-icon fas fa-th"></i>
          <p>
            Ternak
          </p>
        </a>
      </li>
      <li class="nav-item">
        <a href="{{ route('profile.userlist') }}" class="nav-link">
          <i class="nav-icon fas fa-th"></i>
          <p>
        Profile
          </p>
        </a>
        <!-- Dropdown Menu Ternak -->
        <ul class="nav nav-treeview">
          @if($role !== 0)
          <li class="nav-item">
            <a href="{{ route('profile.userlist') }}" class="nav-link active">
              <i class="far fa-circle nav-icon"></i>
              <p>List User</p>
            </a>
          </li>
          @endif
        </ul>
        <ul class="nav nav-treeview">
          <li class="nav-item">
        <a href="{{ route('profile.changepassword', ['id' => $user->id]) }}" class="nav-link active">
          <i class="far fa-circle nav-icon"></i>
          <p>Change Password</p>
        </a>
        </a>
          </li>
        </ul>
      </li>
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
