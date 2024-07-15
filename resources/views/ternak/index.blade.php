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
              @php
                  $latestOngoingTernak = $ternak->where('is_ongoing', 1)->sortByDesc('created_at')->first();
                  $role = Auth::user()->status ? 1 : 0;
              @endphp
              @if ($latestOngoingTernak)
                  <h3 id="elapsedTime">
                      {{ \Carbon\CarbonInterval::seconds(\Carbon\Carbon::parse($latestOngoingTernak->created_at)->diffInSeconds())->cascade()->forHumans() }}
                  </h3>
                  <p>Telah Berlalu</p>
              @else
                  <h4>No data available</h4>
              @endif

            </div>
            <div class="icon">
              {{-- <i class="ion ion-bag"></i> --}}
            </div>
            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            
            </div>
        </div>
        <div class="col-lg-3 col-6">
          <div class="small-box bg-success">
            <div class="inner">
              @if($latestOngoingTernak)
              <h3>{{ $ternak->sortByDesc('created_at')->first()->created_at->format('Y-m-d') }}</h3>
              <p>Tanggal Ternak Mulai</p>
              @else
                  <h4>No data available</h4>
              @endif
            </div>
            <div class="icon">
              {{-- <i class="ion ion-stats-bars"></i> --}}
            </div>
            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        
            </div>
        </div>

        <div class="col-lg-3 col-6">
          <div class="small-box bg-warning">
            <div class="inner">
              @if($latestOngoingTernak)
              <h3>{{ $ternak->sortByDesc('created_at')->first()->total_awal_ayam }}</h3>
              <p class="text-wrap">Stok Awal Ayam</p>
              @else
                  <h4>No data available</h4>
              @endif
            </div>
            <div class="icon">
              {{-- <i class="ion ion-person-add"></i> --}}
            </div>
            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            
           </div>
        </div>

        <div class="view-button">
            @php
                $ongoingTernak = $ternak->where('is_ongoing', 1)->first();
            @endphp
            @if($role == 0)
              @if ($ongoingTernak)
                  {{-- <a href="{{ route('ternak.update', ['id' => $ongoingTernak->id]) }}" class="btn btn-danger" style="width: 200px; height: 100%; display: flex; align-items: center; justify-content: center;">Akhiri Masa Ternak</a> --}}
                  <button id="endTernak" class="btn btn-danger" style="width: 200px; height: 20%; display: flex; align-items: center; justify-content: center; background-color: red; color: white; margin-bottom: 10px;">Selesaikan ternak</button> 
              @else
                  <button id="startTernak" class="btn btn-success" style="width: 200px; height: 25%; display: flex; align-items: center; justify-content: center; background-color: #96C9F4; color: white; margin-bottom: 10px;">Mulai Ternak</button> 
              @endif
            @endif
            <button id="exportPDFBtn" class="btn btn-danger" style="width: 200px; height: 25%; display: flex; align-items: center; justify-content: center; background-color: red; color: white; margin-bottom: 10px;">Export PDF</button>
            <button id="exportExcelBtn" class="btn btn-primary" style="width: 200px; height: 25%; display: flex; align-items: center; justify-content: center; background-color: #50B498; color: white; margin-bottom: 10px;">Export ke Excel</button>
        </div>
        
        <div id="startTernakModal" class="modal">
          <div class="modal-content" style="padding: 20px; background-color: #f5f5f5; border-radius: 10px;">
            <span class="close" style="cursor: pointer; font-size: 24px; font-weight: bold;">&times;</span>
            <h2>Mulai Ternak</h2>
            <form action="{{ route('ternak.store') }}" method="POST">
              @csrf
              <div style="margin-bottom: 15px;">
                <label for="total_awal_ayam" style="display: block; margin-bottom: 5px;">Jumlah pangan</label>
                <input type="text" id="total_awal_ayam" name="total_awal_ayam" placeholder="60kg" style="width: 100%; padding: 8px;">
              </div>
              <button type="submit" style="background-color: #4CAF50; color: white; padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer;">Tambahkan Pangan</button>
            </form>
          </div>
        </div>
        
        
        <div id="endTernakModal" class="modal"> //for ternak is_ongoing == true
          <div class="modal-content" style="padding: 20px; background-color: #f5f5f5; border-radius: 10px;">
            <span class="close" style="cursor: pointer; font-size: 24px; font-weight: bold;">&times;</span>
            <h2>Akhiri Masa Ternak</h2>
            <form action="{{ $ongoingTernak ? route('ternak.update', ['id' => $ongoingTernak->id]) : '#' }}" method="POST">
              @csrf
              @method('PUT')
          
              <div style="margin-bottom: 15px;">
                <label for="ayam_mati">Ayam Mati:</label>
                <input type="number" id="ayam_mati" name="ayam_mati" placeholder="0" min="0" required style="width: 100%; padding: 8px; margin-top: 5px;">
              </div>
          
              <div style="margin-bottom: 15px;">
                <label for="ayam_sakit">Ayam Sakit:</label>
                <input type="number" id="ayam_sakit" name="ayam_sakit" placeholder="0" min="0" required style="width: 100%; padding: 8px; margin-top: 5px;">
              </div>
          
              <div style="margin-bottom: 15px;">
                <label for="ayam_berhasil">Ayam Berhasil:</label>
                <input type="number" id="ayam_berhasil" name="ayam_berhasil" placeholder="0" min="0" required style="width: 100%; padding: 8px; margin-top: 5px;">
              </div>
          
              <button type="submit" style="background-color: #4CAF50; color: white; padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer;">Selesaikan Ternak</button>
            </form>
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