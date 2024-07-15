@extends('layouts.main')
@section('title', 'Pangan')

@section('content_header')
  <h1>Pangan</h1>
@stop

@php
  $role = Auth::user()->status ? 1 : 0;
  $ternak = App\Models\Ternak::all(); 
  $pangan = App\Models\Pangan::all(); 
  use Carbon\Carbon;
  $latestOngoingTernak = $ternak->where('is_ongoing', 1)->sortByDesc('created_at')->first();
  $daysSinceTernakStarted = $latestOngoingTernak ? Carbon::parse($latestOngoingTernak->created_at)->diffInDays() : 0;
@endphp

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
            <li class="breadcrumb-item"><a href="/">Home</a></li>
            <li class="breadcrumb-item active">Pangan</li>
          </ol>
        </div>
      </div>
    </div>
  </div>

  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-3 col-md-6 col-sm-12 mb-3">
          <div class="small-box bg-info">
            <div class="inner">
              <h3>Hari</h3>
              <h3>{{ floor($daysSinceTernakStarted) }}</h3>
              <p>Setelah Ternak dimulai</p>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-12 mb-3">
          <div class="small-box bg-success">
            <div class="inner">
              <h3>Stok Sekarang</h3>
              <h3>{{ $pangan->sortByDesc('created_at')->first()->stok_sekarang }} Kg</h3>
              
              <p>dalam Satuan Kilogram</p>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-12 mb-3">
          <div class="small-box bg-warning">
            <div class="inner">
              <h3>Status Ternak</h3>
              <h3>{{ $latestOngoingTernak ? ($latestOngoingTernak->is_ongoing ? 'Sedang Berlangsung' : 'Tidak Berlangsung') : 'Tidak Berlangsung' }}</h3>
              <p>Lorem ipsum</p>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-12 mb-3">
          @if($role === 0)
            <button id="tambahPanganBtn" class="btn btn-danger w-100 mb-2" style="background-color: #468585; color: white;">Tambahkan pangan</button>
          @endif
          <a href="{{ route('pangan.exportToPdf') }}" class="btn btn-primary" style="width: 200px; height: 25%; display: flex; align-items: center; justify-content: center; background-color: #50B498; color: white; margin-bottom: 10px;">Export PDF</a>
          {{-- <a href="{{ route('pangan.exportExcel') }}" class="btn btn-primary" style="width: 200px; height: 25%; display: flex; align-items: center; justify-content: center; background-color: #50B498; color: white; margin-bottom: 10px;">Export Excel</a> --}}
          <button id="kurangPanganBtn" class="btn btn-success w-100 mb-2" style="background-color: #9CDBA6; color: white;">Kurang Pangan</button>
        </div>
      </div>

      {{-- modal --}}
      <div id="tambahPanganModal" class="modal">
        <div class="modal-content">
          <span class="close">&times;</span>
          <h2>Tambahkan Pangan</h2>
          <form action="{{ route('pangan.addStok') }}" method="POST">
            @csrf
            <label for="pemasukan_stok">Jumlah pangan</label>
            <input type="text" id="pemasukan_stok" name="pemasukan_stok" placeholder="60kg" class="form-control mb-2">
            <button type="submit" class="btn btn-primary">Tambahkan Pangan</button>
          </form>
        </div>
      </div>
      <div id="kurangPanganModal" class="modal">
        <div class="modal-content">
          <span class="close">&times;</span>
          <h2>Pangan Keluar</h2>
          <form action="{{ route('pangan.subtractStok') }}" method="POST">
            @csrf
            <label for="pengeluaran_stok">Jumlah pangan</label>
            <input type="text" id="pengeluaran_stok" name="pengeluaran_stok" placeholder="60kg" class="form-control mb-2">
            <button type="submit" class="btn btn-primary">Kurangi Pangan</button>
          </form>
        </div>
      </div>
    </div>

    <div class="card mt-4">
      <div class="card-body">
        <div class="table-responsive">
          <table id="example1" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Stok Pangan</th>
                <th>Stok Pangan Keluar</th>
                <th>Stok Sekarang</th>
                <th>Ternak yang sedang berlangsung</th>
                <th>Diupdate oleh</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($pangan as $kolom_pangan)
                <tr>
                  <td>{{ $loop->iteration }}</td>
                  <td>{{ $kolom_pangan->created_at }}</td>
                  <td>{{ $kolom_pangan->pemasukan_stok }}</td>
                  <td>{{ $kolom_pangan->pengeluaran_stok }}</td>
                  <td>{{ $kolom_pangan->stok_sekarang }}</td>
                  <td>{{ $kolom_pangan->id_ternak }}</td>
                  <td>{{ $kolom_pangan->updated_by }}</td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </section>
</div>

@endsection
