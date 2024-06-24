@extends('layouts.main')
@section('title', 'Ternak')

@section('content_header')
 <h1>Ternak</h1>
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
              <h3>150</h3>
              <p>Hari</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
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
           </div>
        </div>

        <div class="view-button">
            @php
                $ongoingTernak = $ternak->where('is_ongoing', 1)->first();
            @endphp
        
            @if ($ongoingTernak)
                {{-- <a href="{{ route('ternak.update', ['id' => $ongoingTernak->id]) }}" class="btn btn-danger" style="width: 200px; height: 100%; display: flex; align-items: center; justify-content: center;">Akhiri Masa Ternak</a> --}}
                <button id="endTernak" class="btn btn-danger" style="width: 200px; height: 100%; display: flex; align-items: center; justify-content: center;">Selesaikan ternak</button> 
            @else
                <button id="startTernak" class="btn btn-success" style="width: 200px; height: 100%; display: flex; align-items: center; justify-content: center;">Mulai Ternak</button> 
            @endif
        
            <button id="exportBtn" class="btn btn-primary" style="width: 200px; height: 100%; display: flex; align-items: center; justify-content: center; margin-bottom: 10px;">Export ke PDF dan Excel</button>
        </div>
        
        <div id="startTernakModal" class="modal">
            <div class="modal-content">
                <span class="close">&times;</span>
                <h2>Mulai Ternak</h2>
                <form action="{{ route('ternak.store') }}" method="POST">
                    @csrf
                    <label for="total_awal_ayam">Jumlah pangan</label>
                    <input type="text" id="total_awal_ayam" name="total_awal_ayam" placeholder="60kg">
                    <button type="submit">Tambahkan Pangan</button>
                </form>
            </div>
        </div>
        
        <div id="endTernakModal" class="modal"> //for ternak is_ongoing == true
            <div class="modal-content">
                <span class="close">&times;</span>
                <h2>Akhiri Masa Ternak</h2>
                <form action="{{ $ongoingTernak ? route('ternak.update', ['id' => $ongoingTernak->id]) : '#' }}" method="POST">
                    @csrf
                    @method('PUT')
                    <label for="ayam_mati">Ayam Mati:</label>
                    <input type="number" id="ayam_mati" name="ayam_mati" placeholder="0" min="0" required>

                    <label for="ayam_sakit">Ayam Sakit:</label>
                    <input type="number" id="ayam_sakit" name="ayam_sakit" placeholder="0" min="0" required>

                    <label for="ayam_berhasil">Ayam Berhasil:</label>
                    <input type="number" id="ayam_berhasil" name="ayam_berhasil" placeholder="0" min="0" required>

                    <button type="submit">Selesaikan Ternak</button>
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
                <th>Ayam Sakit</th>
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

    {{-- <div id="myModal" class="modal">
        <div class="modal-content">
          <span class="close">&times;</span>
          <h2>Mulai Ternak</h2>
          <form action="{{ route('ternak.store') }}" method="POST">
            @csrf
            <label for="total_awal_ayam">Jumlah pangan</label>
            <input type="text" id="total_awal_ayam" name="total_awal_ayam" placeholder="60kg">
            <button type="submit">Tambahkan Pangan</button>
          </form>
        </div>
        <div class="modal-content">
          <span class="close">&times;</span>
          <h2>Akhiri Masa Ternak</h2>
          <form action="{{ route('ternak.update', ['id' => $ongoingTernak->id]) }}" method="POST">
            @csrf
            <label for="total_awal_ayam">Jumlah pangan</label>
            <input type="text" id="total_awal_ayam" name="total_awal_ayam" placeholder="60kg">
            <button type="submit">Tambahkan Pangan</button>
          </form>
        </div>
    </div> --}}
  </section>
</div>

@endsection