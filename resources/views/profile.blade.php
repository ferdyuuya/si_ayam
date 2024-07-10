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

    <!-- Main content -->
    <section class="content">
      <div class="content">
        <div class="card">
          <div class="firstinfo">
            {{-- <img src="{{ asset ('lte/dist/img/me.jpg') }}"> --}}
            <div class="profileinfo">
               <h1>Runa </h1>
               <h3>Peternak Ayam</h3>
               <p class="bio">
                 Lorem ipsum, dolor sit amet consectetur adipisicing elit. Culpa error animi quia debitis facere voluptatibus odio esse
               </p>
            </div>
          </div>
        </div>
        {{-- <div class="badgescard">
          <span class="devicons devicons-django"></span>
          <span class="devicons devicons-python"></span>
          <span class="devicons devicons-codepen"></span>
          <span class="devicons devicons-javascript_badge"></span>
          <span class="devicons devicons-gulp"></span>
          <span class="devicons devicons-angular"></span>
          <span class="devicons devicons-sass"></span>
        </div> --}}
      </div>
      
    </section>
</div>

<link rel="stylesheet" href="{{ asset ('css/profile.css') }}">
@endsection