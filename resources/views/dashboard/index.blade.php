@extends('layouts.app')
@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard</li>
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
        <div class="row mb-2">
          <div class="col-sm-3">
            <h4 class="m-0">Status Persediaan</h4>
          </div>
          <div class="col-sm-9">
            <hr class="hr" />
          </div>
        </div><!-- /.col -->
        <div class="row">
          <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box">
              <span class="info-box-icon bg-danger"><i class="fas fa-balance-scale-right"></i></span>

              <div class="info-box-content">
                <span class="info-box-number">Berpotensi Rugi</span>
                <span class="info-box-number">1,410 Produk</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box">
              <span class="info-box-icon bg-danger"><i class="fas fa-file-medical-alt"></i></span>

              <div class="info-box-content">
                <span class="info-box-number">Stok Negatif</span>
                <span class="info-box-number">410 Produk</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box">
              <span class="info-box-icon bg-danger"><i class="fas fa-hourglass-half"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Dekat Kadaluarsa</span>
                <span class="info-box-number">20 Produk</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box">
              <span class="info-box-icon bg-danger"><i class="fas fa-calendar-times"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Sudah Kadaluarsa</span>
                <span class="info-box-number">20 Produk</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
        </div>
        <div class="row mb-2">
          <div class="col-sm-3">
            <h4 class="m-0">Ringkasan Penjualan</h4>
          </div>
          <div class="col-sm-9">
            <hr class="hr" />
          </div>
        </div><!-- /.col -->
        <div class="row mb-2">

          <div class="col-lg-6 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3>150</sup></h3>

                <p>Total Penjualan</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
         
          <div class="col-lg-6 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3>65</h3>

                <p>Barang Kembali</p>
              </div>
              <div class="icon">
                <i class="ion ion-ios-refresh"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
         
        </div>
        <!-- /.row -->
        <!-- Main row -->
        <div class="row mb-2">
          <div class="col-sm-3">
            <h4 class="m-0">Database Apotek</h4>
          </div>
          <div class="col-sm-9">
            <hr class="hr" />
          </div>
        </div><!-- /.col -->
        <div class="row mb-2">
          <div class="col-lg-6 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3>50</sup></h3>

                <p>Pelanggan</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-stalker"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
         
          <div class="col-lg-6 col-6">
            <!-- small box -->
            <div class="small-box bg-primary">
              <div class="inner">
                <h3>20</h3>

                <p>Supplier</p>
              </div>
              <div class="icon">
                <i class="ion ion-ios-filing"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>

          <div class="col-lg-6 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3>50</sup></h3>

                <p>Produk</p>
              </div>
              <div class="icon">
                <i class="ion ion-medkit"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
         
          <div class="col-lg-6 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3>20</h3>

                <p>Apoteker</p>
              </div>
              <div class="icon">
                <i class="ion ion-fork-repo"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>

        </div>
       
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  @endsection
 
