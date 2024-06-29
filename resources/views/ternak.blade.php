@extends('layouts.main')

@section('title', 'Ternak')

@section('content_header')
    <h1>Ternak</h1>
@stop

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Ternak</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Ternak</li>
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

                <p>Hari</p>
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

                <p>Tanggal Ternak Mulai</p>
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
                <p class="text-wrap">Total Awal Ayam</p>
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
          <button id="openPanganBtn" class="btn btn-primary" style="width: 200px; height: 100%; display: flex; align-items: center; justify-content: center; background-color: rgb(2, 196, 2); color: white; margin-bottom: 10px;" >Mulai Ternak</button>
          </div>

          <div class="view-button">
            <button id="openPanganBtn" class="btn btn-primary" style="width: 200px; height: 100%; display: flex; align-items: center; justify-content: center; background-color: green; color: white; margin-bottom: 10px;" >Export ke PDF dan Excel</button>
            </div>
          </div>
        </div>
      </div>

<!-- The Modal -->
<div id="myModal" class="modal">
  <!-- Modal content -->
  <div class="modal-content">
      <span class="close">&times;</span>
      <h2>Tambahkan Pangan</h2>
      <form>
          <label for="jumlahPangan">Jumlah pangan</label>
          <input type="text" id="jumlahPangan" name="jumlahPangan" placeholder="60kg">
          <button type="submit">Tambahkan Pangan</button>
      </form>
  </div>
</div>

      <div class="card">
        {{-- <div class="card-header">
          <h3 class="card-title">DataTable with default features</h3>
        </div> --}}
        <!-- /.card-header -->
        <div class="card-body">
          <table id="example1" class="table table-bordered table-striped">
            <thead>
            <tr>
              <th>Tanggal</th>
              <th>Ayam Mati</th>
              <th>Ayam Sakit</th>
              <th>Ayam Berhasil Ternak</th>
              <th>Total Ayam</th>
            </tr>
            </thead>
            <tbody>
            <tr>
              <td>Trident</td>
              <td>Internet
                Explorer 4.0
              </td>
              <td>Win 95+</td>
              <td> 4</td>
              <td>X</td>
            </tr>
            </tbody>
          </table>
        </div>
        <!-- /.card-body -->
      </div>
    </section>
</div>

@endsection