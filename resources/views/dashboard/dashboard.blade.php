@extends('layouts.app')
@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Dashboard Umum</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard Umum</li>
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
                <h3>{{$penjualan}}</h3>

                <p>Total Penjualan</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="{{url('laporan/report_penjualan')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
         
          <div class="col-lg-6 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3>{{$pembelian}}</h3>

                <p>Total Pembelian</p>
              </div>
              <div class="icon">
               <i class="ion ion-stats-bars"></i>
              </div>
              <a href="{{url('pembelian/pesanan')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
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
            <div class="small-box bg-teal">
              <div class="inner">
                <h3>{{$jumlah_pelanggan}}</h3>
                <p>Total Pelanggan</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-stalker"></i>
              </div>
              <a href="{{url('penjualan/pelanggan')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
         
          <div class="col-lg-6 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3>{{$supplier}}</h3>

                <p>Total Supplier</p>
              </div>
              <div class="icon">
                <i class="ion ion-ios-filing"></i>
              </div>
              <a href="{{url('pembelian/supplier')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>

          <div class="col-lg-6 col-6">
            <!-- small box -->
            <div class="small-box bg-primary">
              <div class="inner">
                <h3>{{$produk}}</h3>
                <p>Total Produk</p>
              </div>
              <div class="icon">
                <i class="ion ion-medkit"></i>
              </div>
              <a href="{{url('master/produk')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>

          <div class="col-lg-6 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3>{{$itemKadaluarsa}}</h3>
                <p>Total Produk Mendekati Kadaluarsa</p>
              </div>
              <div class="icon">
                <i class="ion ion-medkit"></i>
              </div>
              <a style="cursor: pointer;"
                 data-toggle="modal" data-target="#modal-kadaluarsa-info"
                 class="small-box-footer">
                More info <i class="fas fa-arrow-circle-right"></i>
              </a>
            </div>
          </div>

        </div>
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
      <div class="modal fade" id="modal-kadaluarsa-info">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title">Informasi Obat Yang Akan Kadaluarsa</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <p>
                  List Obat
                </p>
                <ul>
                  @if(count($itemProdukKadaluarsa) > 0)
                  @foreach($itemProdukKadaluarsa as $itemProdukKadaluarsaKey => $val)
                  @if($val['kadaluarsa'] <= 5)
                    <li>
                      @if($val['kadaluarsa'] == 0)
                        {{$val['qty']}} 
                        {{$val['product_name']}} yang ada di gudang 
                        {{$val['warehouse_name']}} rack {{$val['rack_name']}} 
                        <b style="color:blue;">sudah kadaluarsa</b> mulai Hari ini
                      @elseif($val['kadaluarsa'] > 0)
                        @if($val['kadaluarsa'] <= 5)
                          {{$val['qty']}} {{$val['product_name']}} 
                          yang ada di gudang {{$val['warehouse_name']}} 
                          rack {{$val['rack_name']}} <b style="color:green;">akan segera kadaluarsa</b> dalam 
                          {{$val['kadaluarsa']}} Hari
                        @endif
                      @elseif($val['kadaluarsa'] < 0)
                        {{$val['qty']}} {{$val['product_name']}} 
                        yang ada di gudang {{$val['warehouse_name']}} 
                        rack {{$val['rack_name']}} <b style="color:red;">sudah kadaluarsa</b> 
                        dalam {{abs($val['kadaluarsa'])}} Hari yang lalu
                      @endif
                    </li>
                    @endif
                  @endforeach
                  @else
                  <li>
                    Belum ada informasi obat yang mendekati kadaluarsa
                  </li>
                  @endif
                </ul>
                <p>
                  Ketika ada informasi obat yang akan mendekati kadaluarsa kurang dari sama dengan 5 hari, maka sistem akan otomatis mengirimkan email ke 
                  <b style="color: red">{{$email}}</b> pada jam 00:00 WIB !
                </p>
                <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
              </div>
            </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->
    </div>
    </section>
    <!-- /.content -->
  </div>
  @endsection
 
