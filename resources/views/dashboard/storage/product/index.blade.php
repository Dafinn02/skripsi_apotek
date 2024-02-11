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
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Filter Berdasarkan</label>
                    <select name="option" id="filter-1" class="select2" style="width: 100%; height: 100%" >
                      <option disabled selected>Pilih Filter</option>
                      @foreach($option as $key => $value)
                        <option {{$request->option == $key ? 'selected':''}} value="{{$key}}">{{$value}}</option>
                      @endforeach
                    </select>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Masukkan Kata Kunci</label>
                    <div class="input-group">
                      <input type="search" name="search" class="form-control" placeholder="Cari data..." value="{{$request->search}}">
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
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
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Tipe</label>
                    <select name="status" id="filter-3" class="select2" style="width: 100%; height: 100%" >
                      <option value="">Semua Tipe</option>
                      <option {{$request->status == 'for_sale' ? 'selected':''}} value="for_sale">Dijual</option>
                      <option {{$request->status == 'not_for_sale' ? 'selected':''}} value="not_for_sale">Tidak Dijual</option>
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
          <a href="#" type="button" class="btn btn-primary">
            <i class="fas fa-upload"></i>
            Import
          </a>
          <a href="#" type="button" class="btn btn-primary">
            <i class="fas fa-download"></i>
            Export
          </a>
          <a type="button" class="btn btn-primary" href="{{url('product/create')}}">
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
                    <th>Kategori</th>
                    <th>Kode</th>
                    <th>Nama</th>
                    <th>Unit</th>
                    <th>Type</th>
                    <th>Harga Beli</th>
                    <th>Harga Jual</th>
                    <th>Markup</th>
                    <th>% Markup</th>
                    <th>Stock</th>
                    <th>Action</th>
                  </tr>
                </thead>
                @foreach($data as $key => $item)
                  <tr>
                    <td>{{$key+1}}</td>
                    <td>{{$item->category_name}}</td>
                    <td>{{$item->code}}</td>
                    <td>{{$item->name}}</td>
                    <td>{{$item->unit}}</td>
                    <td>
                      @if($item->status == 'for_sale')
                        Dijual
                      @else
                        Tidak Dijual
                      @endif
                    </td>
                    <td>{{number_format($item->basic_price, 0, ",", ".")}}</td>
                    <td>{{number_format($item->sales_price, 0, ",", ".")}}</td>
                    <td>{{number_format($item->markup, 0, ",", ".")}}</td>
                    <td>{{$item->markup_percentage}}%</td>
                    <td>{{$item->stock_total}}</td>
                    <td>
                      <a class="btn btn-warning btn-sm" 
                         href="{{url('product/edit/'.$item->id)}}">
                        <i class="fas fa-edit"></i>
                      </a>
                      &nbsp;
                      <a style="color: black;" class="btn btn-danger btn-sm"
                         href="{{url('supplier/delete/'.$item->id)}}" 
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