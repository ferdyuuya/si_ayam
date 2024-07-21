  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="index3.html" class="nav-link">Home</a>
      </li>
      {{-- <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">Contact</a>
      </li> --}}
    </ul>

    @php
    $role = Auth::user()->status ? 1 : 0;
    $ternak = App\Models\Ternak::all(); 
    $pangan = App\Models\Pangan::all(); 
    use Carbon\Carbon;
    $latestOngoingTernak = $ternak->where('is_ongoing', 1)->sortByDesc('created_at')->first();
    $daysSinceTernakStarted = $latestOngoingTernak ? Carbon::parse($latestOngoingTernak->created_at)->diffInDays() : 0;
    @endphp    

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-user"></i>
          {{-- <span class="badge badge-warning navbar-badge">15</span> --}}
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-item dropdown-header">Selamat Datang</span>
          <div class="dropdown-divider"></div>
          @php
    $user = Auth::user();
    @endphp
      <a href="#" class="d-block" style="color: #000000; text-decoration: none; font-weight: bold;">Log as : {{$user->name }}</a>
      @if($user->status == 0)
        <a href="#" class="d-block" style="color: #000000; text-decoration: none; font-weight: bold;">Role : Admin</a>
      @else
        <a href="#" class="d-block" style="color: #000000; text-decoration: none; font-weight: bold;">Role : Pengurus</a>
      @endif
    </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
      {{-- <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-controlsidebar-slide="true" href="#" role="button">
          <i class="fas fa-th-large"></i>
        </a>
      </li> --}}
    </ul>
  </nav>