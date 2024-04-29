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
          <h1>Daftar Pesanan Pembelian</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Pesanan Pembelian</li>
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
        </div>
      </div>
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Daftar data pesanan pembelian</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example2" class="table table-bordered table-hover">
                <thead>
                  <tr>
                    <th>Data</th>
                    <th>Detail</th>
                  </tr>
                </thead>
                @foreach($data as $key => $item)
                  <tr>  
                    <td style="line-height: 2">
                      <table>
                        <tr>
                          <th>Kode</th>
                          <th>:</th>
                          <td>{{$item['number_letter']}}</td>
                        </tr>
                        <tr>
                          <th>PIC</th>
                          <th>:</th>
                          <td>{{$item['user_name']}}</td>
                        </tr>
                        <tr>
                          <th>Metode Pembayaran</th>
                          <th>:</th>
                          <td>{{$item['payment_method']}}</td>
                        </tr>
                        <tr>
                          <th>Jatuh Tempo</th>
                          <th>:</th>
                          <td>
                            {{\Carbon\Carbon::make($item['payment_due_date'])->isoFormat('DD MMMM YYYY')}}
                          </td>
                        </tr>
                        <tr>
                          <th>Informasi</th>
                          <th>:</th>
                          <td>{{$item['information']}}</td>
                        </tr>
                        <tr>
                          <th>Dibuat Pada</th>
                          <th>:</th>
                          <td>
                            {{ \Carbon\Carbon::make($item['created_at'])->format('d F Y H:i:s') }}
                          </td>
                        </tr>
                        <tr>
                          <th>Dibayar Pada</th>
                          <th>:</th>
                          <td>
                            {{ \Carbon\Carbon::make($item['updated_at'])->format('d F Y H:i:s') }}
                          </td>
                        </tr>
                        <tr>
                          <th>Grand Total</th>
                          <th>:</th>
                          <td>
                            Rp {{number_format($item['grandtotal'], 0, ",", ".")}}
                          </td>
                        </tr>
                        <tr>
                          <th>Bukti Transfer</th>
                          <th>:</th>
                          <td>
                            
                            <a class="btn btn-sm btn-primary" download target="_blank" href="{{url('dist/img/bukti/'.$item['proof'])}}">
                              <i class="fas fa-download"></i> &nbsp; Download
                            </a>

                          </td>
                        </tr>
                        <tr>
                          <th>Status Distribusi Gudang</th>
                          <th>:</th>
                          <td>
                            @if($item['distribution'] == 1)
                              <i style="color: green" class="fas fa-check"></i> Sudah
                            @else
                              <i style="color: red" class="fas fa-window-close"></i> Belum
                            @endif
                          </td>
                        </tr>
                      </table>
                    </td>
                    <td >
                      <div class="col-sm-12">
                        <div class="row">
                          @foreach($item['item'] as $keyItem => $product)
                          <div class="col-sm-6" style="padding-bottom: 2%">
                            <table>
                              <tr>
                                <th>Item Ke</th>
                                <th>:</th>
                                <td>{{$keyItem + 1}}</td>
                              </tr>
                               <tr>
                                <th>Produk</th>
                                <th>:</th>
                                <td>{{$product['product_name']}}</td>
                              </tr>
                               <tr>
                                <th>Qty</th>
                                <th>:</th>
                                <td>{{$product['qty']}}</td>
                              </tr>
                               <tr>
                                <th>Unit</th>
                                <th>:</th>
                                <td>{{$product['unit_name']}}</td>
                              </tr>
                               <tr>
                                <th>Harga Satuan</th>
                                <th>:</th>
                                <td>Rp {{number_format($product['price'], 0, ",", ".")}}</td>
                              </tr>
                               <tr>
                                <th>Supplier</th>
                                <th>:</th>
                                <td>{{$product['supplier_name']}}</td>
                              </tr>
                               <tr>
                                <th>PIC Supplier</th>
                                <th>:</th>
                                <td>{{$product['supplier_pic']}}</td>
                              </tr>
                               <tr>
                                <th>Subtotal</th>
                                <th>:</th>
                                <td>Rp {{number_format($product['price'] * $product['qty'], 0, ",", ".")}}</td>
                              </tr>
                              <tr>
                                <th>Distribusi Gudang</th>
                                <th>:</th>
                                <td>
                                  @if($product['distribution'] == 1)
                                    <a style="cursor: pointer;color: black;" class="btn btn-info btn-sm" title="Jadikan pesanan" 
                                      data-toggle="modal" data-target="#modal-distribusi-{{$product['id']}}">
                                    <i class="fas fa-search"></i> &nbsp; Lihat Detail Distribusi
                                  @else
                                    @if(Auth::user()->role != 'head_office')
                                       <a style="cursor: pointer;color: black;" class="btn btn-warning btn-sm" title="Jadikan pesanan" 
                                          data-toggle="modal" data-target="#modal-distribusi-{{$product['id']}}">
                                        <i class="fas fa-warehouse"></i> &nbsp; Distribusikan Ke Gudang &nbsp; <i class="fas fa-arrow-right"></i>
                                      </a>
                                    @endif  
                                  @endif
                                  @include('dashboard.pembelian.pesanan.modal-distribusi')
                                </td>
                              </tr>
                            </table>
                          </div>
                          @endforeach
                        </div>
                      </div>
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