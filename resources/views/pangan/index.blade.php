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
              @php
                  $latestOngoingpangan = $pangan->where('is_ongoing', 1)->sortByDesc('created_at')->first();
              @endphp
              @if ($latestOngoingpangan)
                  <h3 id="elapsedTime">
                      {{ \Carbon\CarbonInterval::seconds(\Carbon\Carbon::parse($latestOngoingpangan->created_at)->diffInSeconds())->cascade()->forHumans() }}
                  </h3>
                  <p>Telah Berlalu</p>
              @else
                  <h3>No data available</h3>
              @endif

            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
            </div>
        </div>
        <div class="col-lg-3 col-6">
          <div class="small-box bg-success">
            <div class="inner">
              @if($latestOngoingpangan)
              <h3>{{ $pangan->sortByDesc('created_at')->first()->created_at->format('Y-m-d') }}</h3>
              <p>Tanggal pangan Mulai</p>
              @else
                  <h3>No data available</h3>
              @endif
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            </div>
        </div>
        <div class="col-lg-3 col-6">
          <div class="small-box bg-warning">
            <div class="inner">
              @if($latestOngoingpangan)
              <h3>{{ $pangan->sortByDesc('created_at')->first()->total_awal_ayam }}</h3>
              <p class="text-wrap">Stok Awal Ayam</p>
              @else
                  <h3>No data available</h3>
              @endif
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
           </div>
        </div>
        <div class="col-lg-3 col-6">
            <button id="tambahPanganBtn" class="btn btn-danger" style="width: 200px; height: 100%; display: flex; align-items: center; justify-content: center;">Tambahkan pangan</button> 
            <button id="exportBtn" class="btn btn-primary" style="width: 200px; height: 100%; display: flex; align-items: center; justify-content: center; margin-bottom: 10px;">Export ke PDF dan Excel</button>
            </div>
            <div class="col-lg-3 col-6">
              <button id="kurangPanganBtn" class="btn btn-success" style="width: 200px; height: 100%; display: flex; align-items: center; justify-content: center;">Kurang Pangan</button> 
            </div>
            
        {{-- modal --}}
        <div id="tambahPanganModal" class="modal">
            <div class="modal-content">
                <span class="close">&times;</span>
                <h2>Tambahkan Pangan</h2>
                <form action="{{ route('pangan.addStok') }}" method="POST">
                    @csrf
                    <label for="pemasukan_stok">Jumlah pangan</label>
                    <input type="text" id="pemasukan_stok" name="pemasukan_stok" placeholder="60kg">
                    
                    <button type="submit">Tambahkan Pangan</button>
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
                    <input type="text" id="pengeluaran_stok" name="pengeluaran_stok" placeholder="60kg">
                    <button type="submit">Kurangi Pangan</button>
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
  </section>
</div>

@endsection