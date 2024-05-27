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
      "lengthChange": true,
      "searching": true,
      "ordering": true,
      // "info": true,
      "autoWidth": false,
      // "responsive": true,
      "scrollX": true,
      // "scrollY": true,
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
          <h1>Daftar Rencana Pembelian</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Rencana Pembelian</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row mb-2 d-flex justify-content-end mr-auto">
        <div class="ml-auto">
          @if(Auth::user()->role != 'head_office')
          <a style="cursor: pointer;" type="button" class="btn btn-success" href="{{url('/pembelian/rencana/create')}}">
            <i class="fas fa-plus"></i>
            Tambah Data
          </a>
          @endif
        </div>
      </div>
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Daftar data rencana pembelian</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example2" class="table table-striped">
                <thead>
                  <tr>
                    <th>Data</th>
                    <th>Detail</th>
                  </tr>
                </thead>
                @foreach($data as $key => $item)
                @include('dashboard.pembelian.rencana.modal-order')
                <tr>
                  <td style="line-height: 1.5">
                    <table>
                      <tr>
                        <th>Kode</th>
                        <th>PIC</th>
                        <th>Metode Pembayaran</th>
                        <th>Jatuh Tempo</th>
                        <th>Informasi</th>
                        <th>Dibuat Pada</th>
                        <th>Dibayar Pada</th>
                        <th>Grand Total</th>
                      </tr>
                      <tr>
                        <td>{{$item['number_letter']}}</td>
                        <td>{{$item['user_name']}}</td>
                        <td>{{$item['payment_method']}}</td>
                        <td>{{\Carbon\Carbon::make($item['payment_due_date'])->isoFormat('DD MMMM YYYY')}}</td>
                        <td>{{$item['information']}}</td>
                        <td>{{ \Carbon\Carbon::make($item['created_at'])->format('d F Y H:i:s') }}</td>
                        <td>
                          @if($item['updated_at'])
                          {{ \Carbon\Carbon::make($item['updated_at'])->format('d F Y H:i:s') }}
                          @else
                          -
                          @endif
                        </td>
                        <td>Rp {{number_format($item['grandtotal'], 0, ",", ".")}}</td>
                      </tr>
                    </table>
                    @if($item['status'] == 'plan')
                    @if(Auth::user()->role != 'head_office')
                    <br><br>
                    <a style="cursor: pointer;color: black;" class="btn btn-info btn-sm" title="Jadikan pesanan"
                      data-toggle="modal" data-target="#modal-order-{{$item['id']}}">
                      <i class="fas fa-hand-holding-usd"></i>
                    </a>
                    &nbsp;
                    <a style="cursor: pointer;color: black;" class="btn btn-warning btn-sm"
                      href="{{url('/pembelian/rencana/edit/'.$item['id'])}}">
                      <i class="fas fa-edit"></i>
                    </a>
                    &nbsp;
                    <a style="color: black;" class="btn btn-danger btn-sm ondelete"
                      href="{{url('/pembelian/rencana/delete/'.$item['id'])}}">
                      <i class="fas fa-trash"></i>
                    </a>
                    @endif
                    @endif
                  </td>
                  <td style="line-height: 1.5">
                    @foreach($item['item'] as $keyItem => $product)
                    <table>
                      <tr>
                        <th>Item Ke</th>
                        <th>Produk</th>
                        <th>Qty</th>
                        <th>Unit</th>
                        <th>Harga Satuan</th>
                        <th>Supplier</th>
                        <th>PIC Supplier</th>
                        <th>Subtotal</th>
                      </tr>
                      <tr>
                        <td>{{$keyItem + 1}}</td>
                        <td>{{$product['product_name']}}</td>
                        <td>{{$product['qty']}}</td>
                        <td>{{$product['unit_name']}}</td>
                        <td>Rp {{number_format($product['price'], 0, ",", ".")}}</td>
                        <td>{{$product['supplier_name']}}</td>
                        <td>{{$product['supplier_pic']}}</td>
                        <td>Rp {{number_format($product['price'] * $product['qty'], 0, ",", ".")}}</td>
                      </tr>
                    </table>
                    @endforeach
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