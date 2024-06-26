@extends('layouts.main')

@section('title', 'Ternak')

@section('content_header')
  <h1>Pangan</h1>
@stop

@section('content')
<div class="content-wrapper">
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Pangan</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Pangan</li>
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
              <h3>150</h3>
              <p>Hari</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <div class="col-lg-3 col-6">
          <div class="small-box bg-success">
            <div class="inner">
              <h3>{{ date('Y-m-d') }}</h3>
              <p>Tanggal Ternak Mulai</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <div class="col-lg-3 col-6">
          <div class="small-box bg-warning">
            <div class="inner">
              <h3>38</h3>
              <p class="text-wrap">Stok Awal Ayam</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <div>
          <div class="view-button">
            <button id="openPanganBtn" class="btn btn-primary" style="width: 200px; height: 100%; display: flex; align-items: center; justify-content: center; background-color: green; color: white; margin-bottom: 10px;">Tambahkan Pangan</button>
          </div>
          <div class="view-button">
            <button id="openPanganBtn" class="btn btn-primary" style="width: 200px; height: 100%; display: flex; align-items: center; justify-content: center; background-color: green; color: white; margin-bottom: 10px;">Export ke PDF dan Excel</button>
          </div>
        </div>
        <!-- The Modal -->
        <div id="myModal" class="modal">
          <!-- Modal content -->
          <div class="modal-content">
            <span class="close">&times;</span>
            <h2>Tambahkan Pangan</h2>
            <form action="{{ route('ternak.store') }}" method="POST">
              @csrf
              <label for="totalAwalAyam">Jumlah pangan</label>
              <input type="text" id="total_awal_ayam" name="total_awal_ayam" placeholder="60kg">
              <button type="submit">Tambahkan Pangan</button>
            </form>
          </div>
        </div>
      </div>
    </div>

    <div class="card">
      <div class="card-body">
        <table id="example1" class="table table-bordered table-striped">
          <thead>
            <tr>
              <th>No</th>
              <th>Ayam Mati</th>
              <th>Ayam Hidup</th>
              <th>Ayam Berhasil</th>
              <th>Total Ayam</th>
              <th>Total Awal Ayam</th>
              <th>Status</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($ternak as $kolom_ternak)
            <tr>
              <td>{{ $loop->iteration }}</td>
              <td>{{ $kolom_ternak->ayam_mati }}</td>
              <td>{{ $kolom_ternak->ayam_sakit }}</td>
              <td>{{ $kolom_ternak->ayam_berhasil }}</td>
              <td>{{ $kolom_ternak->total_ayam }}</td>
              <td>{{ $kolom_ternak->total_awal_ayam }}</td>
              <td>{{ $kolom_ternak->is_ongoing }}</td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </section>
</div>

@endsection
