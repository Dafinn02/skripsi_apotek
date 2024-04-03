@extends('layouts.app')

@section('custom-css')
<link rel="stylesheet" href="{{url('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{url('plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{url('plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">
<!-- Select2 -->
<link rel="stylesheet" href="{{url('plugins/select2/css/select2.min.css')}}">
<link rel="stylesheet" href="{{url('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
@endsection

@section('custom-js')
<script src="{{url('plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{url('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{url('plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{url('plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
<!-- Select2 -->
<script src="{{url('plugins/select2/js/select2.full.min.js')}}"></script>
<script type="text/javascript">
  $(function () {
    $('.select2').select2({
      theme: 'bootstrap4'
    })
  });
</script>
<script type="text/javascript">
  $(function () {
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
  function optionForm(id) {
    document.getElementById(id).submit();
    return false;
  }
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
          <h1>Daftar Produk</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Produk</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-12">
          <div class="card">
            <div class="card-body">
              <form action="{{url('product')}}" id="form-option">
              <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                    <label>Cari Berdasarkan Nama Obat</label>
                    <div class="input-group">
                      <input type="search" name="search" class="form-control" placeholder="Cari data..." value="{{$request->search}}">
                    </div>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label>Unit</label>
                    <select name="unit_id" id="filter-4" class="select2" style="width: 100%; height: 100%" >
                      <option value="">Semua Unit</option>
                      @foreach($units as $unitKey => $unitValue)
                        <option {{$request->unit_id == $unitValue->id ? 'selected':''}} value="{{$unitValue->id}}">{{$unitValue->name}}</option>
                      @endforeach
                    </select>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label>Kategori</label>
                    <select name="category_id" id="filter-2" class="select2" style="width: 100%; height: 100%" >
                      <option value="">Semua Category</option>
                      @foreach($categories as $ctgKey => $ctgValue)
                        <option {{$request->category_id == $ctgValue->id ? 'selected':''}} value="{{$ctgValue->id}}">{{$ctgValue->name}}</option>
                      @endforeach
                    </select>
                  </div>
                </div>
              </div>
              <div class="col-md-12" align="right">
                <button class="btn btn-primary" type="submit"><i class="fas fa-search"></i> Filter</button>
              </div>
              </form>
            </div>
          </div>
        </div>
      </div>
        <div class="row mb-2 d-flex justify-content-end mr-auto">
        <div class="ml-auto">
         <!--  <a href="#" type="button" class="btn btn-primary">
            <i class="fas fa-upload"></i>
            Import
          </a>
          <a href="#" type="button" class="btn btn-primary">
            <i class="fas fa-download"></i>
            Export
          </a> -->
          <a type="button" class="btn btn-primary" href="{{url('/master/produk/create')}}">
            <i class="fas fa-plus"></i>
            Tambah Data
          </a>
        </div>
      </div>

      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Daftar data produk</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example2" class="table table-bordered table-hover">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Obat</th>
                    <th>Supplier</th>
                    <th>Unit</th>
                    <th>Harga</th>
                    <th>Stock</th>
                    <th>Action</th>
                  </tr>
                </thead>
                @foreach($product as $key => $item)
                  <tr>
                    <td>{{$key+1}}</td>
                    <td>
                      <b>Kategori :</b> {{$item->category_name}}<br>
                      <b>Kode : </b>{{$item->code}}<br>
                      <b>Nama :</b> {{$item->name}}<br>
                      <b>Memerlukan Resep ?</b> : {{$item->recipe == 'yes' ? 'Iya' :'Tidak'}}
                    </td>
                    <td>{{$item->supplier_name}}</td>
                    <td>{{$item->unit_name}}</td>
                    <td>Rp {{number_format($item->price, 0, ",", ".")}}</td>
                    <td>
                      <b>Min :</b>{{$item->min_stock}}<br>
                      <b>Max :</b> {{$item->max_stock}}<br>
                      <b>Total : </b>{{$item->stock}}
                    </td>
                    <td>
                      <a class="btn btn-warning btn-sm" 
                         href="{{url('/master/produk/edit/'.$item->id)}}">
                        <i class="fas fa-edit"></i>
                      </a>
                      &nbsp;
                      <a style="color: black;" class="btn btn-danger btn-sm"
                         href="{{url('/master/produk/delete/'.$item->id)}}" 
                         onclick="return confirm('Yakin untuk menghapus data? penghapusan data akan ber-efek ke data relasional !')">
                        <i class="fas fa-trash"></i>
                      </a>  
                    </td>
                  </tr>
                @endforeach
                <tbody>
                </tbody>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->
@endsection