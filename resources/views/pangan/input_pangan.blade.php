@extends('layouts.main')

@section('title', 'Pangan')

@section('content_header')
    <h1>Input Pangan</h1>
@stop

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Input Pangan</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Input Pangan</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3>150</h3>

                <p>Pengeluaran Pangan Harian</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3>53<sup style="font-size: 20px">%</sup></h3>

                <p>Stok Pangan Sekarang</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3>38</h3>
                <p class="text-wrap">Pemasukan Pangan 1 Bulan Terakhir</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <div>
  <!-- Tambahkan Pangan button -->
          <div class="view-button">
          <a href="#" class="btn btn-primary" style="width: 200px; height: 100%; display: flex; align-items: center; justify-content: center; background-color: green; color: white; margin-bottom: 10px;">Tambahkan Pangan</a>
          </div>

          <div class="export-button">
            <a href="#" class="btn btn-primary" style="width: 200px; height: 100%; display: flex; align-items: center; justify-content: center; background-color: rgb(19, 84, 4); color: white;">Export ke PDF dan Excel</a>
            </div>
          </div>
        </div>
      </div>

      <div class="container">
        <form action="#" method="post">
            <label for="jumlahPangan">Jumlah pangan</label>
            <input type="text" id="jumlahPangan" name="jumlahPangan" value="60kg">
            <button type="submit" class="btn-submit">Tambahkan Pangan</button>
        </form>
    </div>
    </section>
</div>

@endsection