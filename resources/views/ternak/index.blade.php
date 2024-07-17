@extends('layouts.main')

@section('title', 'Ternak')

@section('content_header')
  <h1>Ternak</h1>
@stop

@php
  $latestOngoingTernak = $ternak->where('is_ongoing', 1)->sortByDesc('created_at')->first();
  $role = Auth::user()->status ? 1 : 0;
  $ongoingTernak = $ternak->where('is_ongoing', 1)->first();
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
        <div class="col-lg-3 col-md-6 col-sm-12 mb-3">
          <div class="small-box bg-info">
            <div class="inner">
              @if ($latestOngoingTernak)
                <h3>Hari</h3>
                <h3 id="elapsedTime">
                  {{ \Carbon\CarbonInterval::seconds(\Carbon\Carbon::parse($latestOngoingTernak->created_at)->diffInSeconds())->cascade()->forHumans() }}
                </h3>
                <p>Telah Berlalu</p>
              @else
                <h4>No data available</h4>
              @endif
            </div>
          </div>
        </div>

        <div class="col-lg-3 col-md-6 col-sm-12 mb-3">
          <div class="small-box bg-success">
            <div class="inner">
              @if($latestOngoingTernak)
                <h3>Ternak dimulai</h3>
                <h3>{{ $ternak->sortByDesc('created_at')->first()->created_at->format('Y-m-d') }}</h3>
                <p>Tanggal Ternak dimulai</p>
              @else
                <h4>No data available</h4>
              @endif
            </div>
          </div>
        </div>

        <div class="col-lg-3 col-md-6 col-sm-12 mb-3">
          <div class="small-box bg-warning">
            <div class="inner">
              @if($latestOngoingTernak)
                <h3>Total Awal Ayam</h3>
                <h3>{{ $ternak->sortByDesc('created_at')->first()->total_awal_ayam }} Ekor</h3>
                <p class="text-wrap">Stok Awal Ayam</p>
              @else
                <h4>No data available</h4>
              @endif
            </div>
          </div>
        </div>

        <div class="col-lg-3 col-md-6 col-sm-12 mb-3">
          @if($role === 0)
            @if ($ongoingTernak)
              <button id="endTernak" class="btn btn-danger w-100 mb-2" style="width: 200px; height: 50%; display: flex; align-items: center; justify-content: center; background-color: #dd3131; color: white; margin-bottom: 10px;">Selesaikan ternak</button>
            @else
              <button id="startTernak" class="btn btn-primary" style="width: 200px; height: 50%; display: flex; align-items: center; justify-content: center; background-color: #50B498; color: white; margin-bottom: 10px;">Mulai Ternak</button>
            @endif
          @endif
          <a href="{{ route('ternak.exportToPdf') }}" class="btn btn-primary" style="width: 200px; height: 50%; display: flex; align-items: center; justify-content: center; background-color: #3ce045; color: white; margin-bottom: 10px;">Export PDF</a>
        </div>
      </div>

      <div id="startTernakModal" class="modal">
        <div class="modal-content">
          <span class="close">&times;</span>
          <h2>Mulai Ternak</h2>
          <form action="{{ route('ternak.store') }}" method="POST">
            @csrf
            <label for="total_awal_ayam">Jumlah pangan</label>
            <input type="text" id="total_awal_ayam" name="total_awal_ayam" placeholder="60kg" class="form-control mb-2">
            <button type="submit" class="btn btn-primary">Tambahkan Pangan</button>
          </form>
        </div>
      </div>

      <div id="endTernakModal" class="modal">
        <div class="modal-content" style="padding: 20px; background-color: #f5f5f5; border-radius: 10px;">
          <span class="close" style="cursor: pointer; font-size: 24px; font-weight: bold;">&times;</span>
          <h2>Akhiri Masa Ternak</h2>
          <form action="{{ $ongoingTernak ? route('ternak.update', ['id' => $ongoingTernak->id]) : '#' }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
              <label for="ayam_mati">Ayam Mati:</label>
              <input type="number" id="ayam_mati" name="ayam_mati" placeholder="0" min="0" required class="form-control">
            </div>

            <div class="mb-3">
              <label for="ayam_sakit">Ayam Sakit:</label>
              <input type="number" id="ayam_sakit" name="ayam_sakit" placeholder="0" min="0" required class="form-control">
            </div>

            <div class="mb-3">
              <label for="ayam_berhasil">Ayam Berhasil:</label>
              <input type="number" id="ayam_berhasil" name="ayam_berhasil" placeholder="0" min="0" required class="form-control">
            </div>

            <button type="submit" class="btn btn-success">Selesaikan Ternak</button>
          </form>
        </div>
      </div>

      <div class="card mt-4">
        <div class="card-body">
          <div class="table-responsive">
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
                  <td>{{ $kolom_ternak->is_ongoing ? 'Ongoing' : 'Completed' }}</td> 
                </tr>
                @endforeach
              </tbody>
            </table>
            {{-- <div class="pagination-wrapper mt-3">
              {{ $ternak->links() }}
            </div> --}}
          </div>
        </div>
      </div>
    </div>
  </section>
</div>

@endsection


