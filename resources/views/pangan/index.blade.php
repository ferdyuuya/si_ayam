@extends('layouts.main')
@section('title', 'Pangan')

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
              <div class="icon">
                <i class="ion ion-calendar"></i>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-12 mb-3">
          <div class="small-box bg-success">
            <div class="inner">
              <h3>Stok Sekarang</h3>
              <h3>{{ $pangans->sortByDesc('created_at')->first()->stok_sekarang ?? '0' }} Kg</h3>
              <p>dalam Satuan Kilogram</p>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-12 mb-3">
          <div class="small-box bg-warning">
            <div class="inner">
              <h3>Status Ternak</h3>
              @php
                $latestOngoingTernak = $pangans->sortByDesc('created_at')->first();
              @endphp
              <h3>{{ $latestOngoingTernak ? ($latestOngoingTernak->is_ongoing ? 'Sedang Berlangsung' : 'Tidak Berlangsung') : 'Tidak Berlangsung' }}</h3>
              <p>Keadaan Ternak</p>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-12 mb-3">
          @if($role === 0)
            <button id="tambahPanganBtn" class="btn btn-danger w-100 mb-2" style="background-color: #46854c; color: white;">Tambahkan pangan</button>
          @endif
          <a href="{{ route('pangan.exportToPdf') }}" class="btn btn-primary w-100 mb-2" style="background-color: #50B498; color: white;">Export PDF</a>
          <button id="kurangPanganBtn" class="btn btn-success w-100 mb-2" style="background-color: #d82e2e; color: white;">Kurang Pangan</button>
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
                  <th>Stok Pangan Masuk (Kg)</th>
                  <th>Stok Pangan Keluar (Kg)</th>
                  <th>Stok Sebelumnya (Kg)</th>
                  <th>Status Ternak</th>
                  <th>Diupdate oleh</th>
                </tr>
              </thead>
                <tbody>
                @foreach ($pangansData as $key => $pangans)
                  @if ($key > 0)
                  <tr>
                    <td>{{ $key }}</td>
                    <td>{{ $pangans->created_at }}</td>
                    <td>{{ $pangans->stok_masuk ?? 'N/A' }}</td>
                    <td>{{ $pangans->stok_keluar ?? 'N/A' }}</td>
                    <td>{{ $pangans->stok->stok_sekarang ?? 'N/A' }}</td>
                    <td>{{ $pangans->is_ongoing ? 'Sedang Berlangsung' : 'Tidak Berlangsung' }}</td>
                    <td>{{ $pangans->user->name ?? 'N/A' }}</td>
                  </tr>
                  @endif
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
@endsection

<div id="tambahPanganModal" class="modal">
  <div class="modal-content">
    <span class="close">&times;</span>
    <h2>Tambahkan Pangan</h2>
    <form action="{{ route('pangan.addStok') }}" method="POST">
      @csrf
      <label for="tambah_pangan">Jumlah pangan</label>
      <input type="text" id="tambah_pangan" name="tambah_pangan" placeholder="60kg" class="form-control mb-2">
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
      <label for="keluar_pangan">Jumlah pangan</label>
      <input type="text" id="keluar_pangan" name="keluar_pangan" placeholder="60kg" class="form-control mb-2">
      <button type="submit" class="btn btn-primary">Kurangi Pangan</button>
    </form>
  </div>
</div>
