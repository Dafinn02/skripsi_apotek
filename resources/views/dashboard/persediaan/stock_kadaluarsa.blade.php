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
          <h1>Daftar Kadaluarsa</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Kadaluarsa</li>
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
            <div class="card-body" style="background-color:#1166d8;">
              <form action="{{url('persediaan/stock_kadaluarsa')}}" id="form-option">
              <div class="row">
                <div class="col-md-3">
                  <div class="form-group">
                    <label style="color: white">Cari Berdasarkan Produk</label>
                    <select class="form-control" name="produk">
                       <option value="" selected disabled>Pilih Produk</option>
                       <option value="">All</option>
                       @foreach($products as $pKey => $pItem)
                        <option value="{{$pItem->id}}" {{$request->produk == $pItem->id ? 'selected' : ''}}>
                          {{$pItem->name}} ({{$pItem->code}})
                        </option>
                       @endforeach
                     </select>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <label style="color: white">Cari Berdasarkan Gudang</label>
                    <select class="form-control" name="warehouse">
                       <option value="" selected disabled>Pilih Gudang</option>
                       <option value="">All</option>
                       @foreach($warehouses as $wKey => $wItem)
                        <option value="{{$wItem->id}}" {{$request->warehouse == $wItem->id ? 'selected' : ''}}>
                          {{$wItem->name}} 
                        </option>
                       @endforeach
                     </select>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <label style="color: white">Cari Berdasarkan Rak</label>
                    <select class="form-control" name="rack">
                       <option value="" selected disabled>Pilih Rak</option>
                       <option value="">All</option>
                       @foreach($racks as $rKey => $rItem)
                        <option value="{{$rItem->id}}" {{$request->rack == $rItem->id ? 'selected' : ''}}>
                          {{$rItem->name}} 
                        </option>
                       @endforeach
                     </select>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <label style="color: white">Tanggal</label>
                    <div class="input-group">
                      <input type="date" name="kadaluarsa" class="form-control" placeholder="Cari data..." value="{{$request->kadaluarsa}}">
                    </div>
                  </div>
                </div>
                <div class="col-md-12" align="right">
                  <button class="btn btn-success" type="submit"><i class="fas fa-search"></i> Filter</button>
                </div>
              </div>
             </form>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Daftar data kadaluarsa</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example2" class="table table-bordered table-hover">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Produk</th>
                    <th>Gudang</th>
                    <th>Rak</th>
                    <th>Jumlah</th>
                    <th>Tanggal</th>
                  </tr>
                </thead>
                @foreach($data as $key => $item)
                  <tr>
                    <td>{{$key+1}}</td>
                    <td>{{$item->product_name}}</td>
                    <td>{{$item->warehouse_name}}</td>
                    <td>{{$item->rack_name}}</td>
                    <td>{{$item->qty}}</td>
                    <td>{{\Carbon\Carbon::make($item->created_at)->format('d F Y')}}</td>
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