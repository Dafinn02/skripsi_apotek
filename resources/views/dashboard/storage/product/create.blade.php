@extends('layouts.app')

@section('custom-css')
<!-- Select2 -->
<link rel="stylesheet" href="{{url('plugins/select2/css/select2.min.css')}}">
<link rel="stylesheet" href="{{url('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
@endsection

@section('custom-js')
<!-- Select2 -->
<script src="{{url('plugins/select2/js/select2.full.min.js')}}"></script>
<script type="text/javascript">
  $(function () {
    $('.select2').select2({
      theme: 'bootstrap4'
    })
  });
</script>
@endsection

@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Tambah Data Produk</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Tambah Data Produk</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
        <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Tambah Data Produk</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="{{url('product/store')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-4">
                       <div class="form-group">
                        <label for="filter-3">Kategori</label>
                        <select name="category_id" id="filter-3" class="select2" style="width: 100%; height: 100%" >
                          <option required value="" disabled>Pilih Kategori</option>
                          @foreach($categories as $ctgKey => $ctgItem)
                            <option value="{{$ctgItem->id}}">{{$ctgItem->name}}</option>
                          @endforeach
                        </select>
                      </div>
                    </div>
                    <div class="col-md-4">
                       <div class="form-group">
                        <label for="nama">Nama</label>
                        <input required type="text" class="form-control" name="name" placeholder="Panadol Extra">
                      </div>
                    </div>
                    <div class="col-md-4">
                       <div class="form-group">
                        <label for="nama">Unit</label>
                        <input required type="text" class="form-control" name="unit" placeholder="Strip">
                      </div>
                    </div>
                  </div>
                

                <div class="row">
                  <div class="col-md-3">
                    <div class="form-group">
                      <label for="filter-3">Kode</label>
                       <input required type="text" class="form-control" name="code" placeholder="ANC-001">
                      </div>
                    </div>
                    <div class="col-md-3">
                       <div class="form-group">
                        <label for="nama">Harga Beli</label>
                        <input required type="number" class="form-control" name="basic_price" placeholder="100000">
                      </div>
                    </div>
                    <div class="col-md-3">
                       <div class="form-group">
                        <label for="nama">Markup (%)</label>
                        <input required type="number" class="form-control" name="markup_percentage" placeholder="30">
                      </div>
                    </div>
                    <div class="col-md-3">
                       <div class="form-group">
                        <label for="nama">Tipe</label>
                        <select class="form-control" name="status" required>
                          <option value="" selected disabled>Pilih Tipe</option>
                          <option value="for_sale">Dijual</option>
                          <option value="not_for_sale">Tidak Dijual</option>
                        </select>
                      </div>
                    </div>
                  </div>
                </div>

                <!-- /.card-body -->

                <div class="card-footer" align="right">
                  <a style="color: white" href="{{url('product')}}" class="btn btn-warning">Batal</a>
                  <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
                </div>
              </form>
           
            <!-- /.card -->
          </div>
        </div>
      </div>
    </section>
  </div>
@endsection