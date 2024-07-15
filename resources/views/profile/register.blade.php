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
      <h3 class="card-title">Register Admin</h3>
      </div>
      <div class="card-body">
      <form action="{{ route('profile.store') }}" method="POST">
        @csrf
        <div class="form-group">
        <label for="name">Name</label>
        <input type="text" name="name" id="name" class="form-control" required>
        </div>
        <div class="form-group">
        <label for="email">Email</label>
        <input type="email" name="email" id="email" class="form-control" required>
        </div>
        <div class="form-group">
        <label for="password">Password</label>
        <input type="password" name="password" id="password" class="form-control" required>
        </div>
        <div class="form-group">
        <label for="confirm_password">Confirm Password</label>
        <select name="status" id="status" class="form-control" required>
          <option value="1">Pengurus</option>
          <option value="0">Admin</option>
        </select>
        </div>
        <button type="button" class="btn btn-secondary" onclick="window.history.back()">Back</button>
        <button type="submit" class="btn btn-primary">Register</button>
      </form>
      </form>
      </div>
    </div>
    </div>
  </section>
</div>


@endsection