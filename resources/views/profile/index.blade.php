@extends('layouts.main')

@section('title', 'Ternak')

@section('content_header')
    <h1>Ternak</h1>
@stop
    @php
        $userCount = App\Models\User::count();
        $user = App\Models\User::all();
    @endphp
@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Ternak</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/">Home</a></li>
                        <li class="breadcrumb-item active">Ternak</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>Users</h3>
                            <h5>Total Pengguna Terdaftar</h5>
                            <h3>{{ $userCount }}</h3>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>Users</h3>
                            <h5>Total Pengguna Terdaftar</h5>
                            <h3>{{ $userCount }}</h3>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3>Users</h3>
                            <h5>Total Pengguna Terdaftar</h5>
                            <h3>{{ $userCount }}</h3>
                        </div>
                    </div>
                </div>
                <div class="view-button">  
                    <a href="{{ route('profile') }}" class="btn btn-primary" style="width: 200px; height: 25%; display: flex; align-items: center; justify-content: center; background-color: #50B498; color: white; margin-bottom: 10px;">Tambah User</a>
                    <button id="exportExcelBtn" class="btn btn-primary" style="width: 200px; height: 25%; display: flex; align-items: center; justify-content: center; background-color: #50B498; color: white; margin-bottom: 10px;">Export ke Excel</button>
                </div>      
            </div>
            <div class="card">
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($user as $users)
                                @if ($users->id != auth()->user()->id)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $users->name }}</td>
                                        <td>{{ $users->email }}</td>
                                        <td>{{ $users->status }}</td> 
                                        <td>
                                            <a href="{{ route('profile.edit', $users->id) }}" class="btn btn-warning">Edit</a>
                                            <form action="{{ route('profile.delete', $users->id) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
</div>

@endsection