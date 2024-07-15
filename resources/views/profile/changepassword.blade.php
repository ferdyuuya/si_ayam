@extends('layouts.main')

@section('title', 'Profile')

@section('content_header')
  <h1>Profile</h1>
@stop

@section('content')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
  <div class="container-fluid">
  <div class="row mb-2">
    <div class="col-sm-6">
    <h1 class="m-0">Profile</h1>
    </div><!-- /.col -->
    <div class="col-sm-6">
    <ol class="breadcrumb float-sm-right">
    <li class="breadcrumb-item"><a href="/">Home</a></li>
    <li class="breadcrumb-item active">Profile</li>
    </ol>
    </div><!-- /.col -->
  </div><!-- /.row -->
  </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  
  <!-- Register Form -->
  <section class="content">
  <div class="content">
  <div class="card">
    <div class="card-header">
    <h3 class="card-title">Change Password</h3>
    </div>
    <div class="card-body">
    <form action="{{ route('profile.changepassword', ['id' => auth()->user()->id]) }}" method="POST">
      @csrf
      <div class="form-group">
      <label for="current_password">Current Password</label>
      <input type="password" name="current_password" id="current_password" class="form-control" required>
      </div>
      <div class="form-group">
      <label for="new_password">New Password</label>
      <input type="password" name="new_password" id="new_password" class="form-control" required>
      </div>
      <button type="button" class="btn btn-secondary" onclick="window.history.back()">Back</button>
      <button type="submit" class="btn btn-primary">Change Password</button>
    </form>
    </form>
    </div>
  </div>
  </div>
  </section>
</div>


@endsection
