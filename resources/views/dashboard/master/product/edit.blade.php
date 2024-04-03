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
            <h1>Edit Data Produk</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Edit Data Produk</li>
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
                <h3 class="card-title">Edit Data Produk</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="{{url('/master/produk/update/'.$data->id)}}" method="POST">
                @csrf
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-4">
                       <div class="form-group">
                        <label for="filter-3">Kategori</label>
                        <select name="category_id" id="filter-3" class="select2" style="width: 100%; height: 100%" >
                          <option required value="" disabled>Pilih Kategori</option>
                          @foreach($categories as $ctgKey => $ctgItem)
                            <option value="{{$ctgItem->id}}" {{$ctgItem->id == $data->category_id ? 'selected' : ''}}>
                              {{$ctgItem->name}}
                            </option>
                          @endforeach
                        </select>
                      </div>
                    </div>
                    <div class="col-md-4">
                       <div class="form-group">
                        <label for="nama">Nama</label>
                        <input required type="text" class="form-control" name="name" placeholder="Panadol Extra" value="{{$data->name}}">
                      </div>
                    </div>
                     <div class="col-md-4">
                      <div class="form-group">
                       <label for="filter-3">Unit</label>
                       <select name="unit_id" class="select2" style="width: 100%; height: 100%" >
                         <option selected disabled>Pilih Unit</option>
                         @foreach($unit as $uKey => $uItem)
                           <option value="{{$uItem->id}}" {{$uItem->id == $data->unit_id ? 'selected':''}}>
                            {{$uItem->name}}
                          </option>
                         @endforeach
                       </select>
                     </div>
                   </div>
                  </div>
                

                <div class="row">
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="filter-3">Kode</label>
                       <input required type="text" class="form-control" name="code" placeholder="ANC-001" value="{{$data->code}}">
                      </div>
                    </div>
                    <div class="col-md-4">
                       <div class="form-group">
                        <label for="nama">Harga</label>
                        <input required type="number" class="form-control" name="price" placeholder="100000" value="{{$data->price}}">
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                       <label for="filter-3">Supplier</label>
                       <select name="supplier_id" class="select2" style="width: 100%; height: 100%" >
                         <option selected disabled>Pilih Unit</option>
                         @foreach($supplier as $sKey => $sItem)
                           <option value="{{$sItem->id}}" {{$sItem->id == $data->supplier_id ? 'selected':''}}>
                            {{$sItem->name}}
                          </option>
                         @endforeach
                       </select>
                     </div>
                   </div>
                  </div>
                  <div class="row">
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="filter-3">Resep</label>
                        <select name="recipe" class="select2" style="width: 100%; height: 100%" >
                          <option selected disabled>Pilih Resep</option>
                          <option value="yes" {{$data->recipe == 'yes' ? 'selected':''}}>Iya</option>
                          <option value="no" {{$data->recipe == 'no' ? 'selected':''}}>Tidak</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="filter-3">Minimal Stock</label>
                        <input class="form-control" type="text" name="min_stock" value="{{$data->min_stock}}">
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="filter-3">Maximal Stock</label>
                        <input class="form-control" type="text" name="max_stock" value="{{$data->max_stock}}">
                      </div>
                    </div>
                  </div>
                </div>

                <!-- /.card-body -->

                <div class="card-footer" align="right">
                  <a style="color: white" href="{{url('master/product')}}" class="btn btn-warning">Batal</a>
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