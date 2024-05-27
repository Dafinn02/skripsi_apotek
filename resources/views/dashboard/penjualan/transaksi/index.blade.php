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
       //  "info": true,
       "autoWidth": false,
       "scrollX": true,
      //  "responsive": true,
     });
   });
   function optionForm(id) {
     document.getElementById(id).submit();
     return false;
   }

   function printYa(id)
   {
    window.open("{{url('penjualan/kasir-cetak/')}}"+"/"+id, '_blank', 'location=yes,height=570,width=620,scrollbars=yes,status=yes');
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
               <h1>Daftar Penjualan Kasir</h1>
            </div>
            <div class="col-sm-6">
               <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="#">Home</a></li>
                  <li class="breadcrumb-item active">Penjualan Kasir</li>
               </ol>
            </div>
         </div>
      </div>
      <!-- /.container-fluid -->
   </section>
   <!-- Main content -->
   <section class="content">
      <div class="container-fluid">
         <div class="row">
            <div class="col-12">
               <div class="card">
                  <div class="card-header row">
                     <div class="col-md-4">
                        <h3 class="card-title">
                           @if($request->transaction_id == null)
                           <b>Tanggal</b> :
                           <b style="color: red">
                              {{ \Carbon\Carbon::make($now)->format('d F Y')}}
                           </b>
                           @endif
                        </h3>
                     </div>
                     <div class="col-md-4" style="opacity:  {{Auth::user()->role != 'cashier' ? '0' : ''}};">
                        @if($shift_id == 0)
                        <a href="{{url('penjualan/transaksi')}}?session_trs_shift=true"
                           class="btn btn-{{$shift_id == 0 ? 'warning' : 'success'}}">
                           <i class="fas fa-user"></i> &nbsp;
                           Tampilkan Transaksi Yang Ditangani Oleh Saya
                        </a>
                        @else
                        <a href="{{url('penjualan/transaksi')}}"
                           class="btn btn-{{$shift_id == 0 ? 'warning' : 'success'}}">
                           <i class="fas fa-user"></i> &nbsp;
                           Tampilkan Semua Transaksi
                        </a>
                        @endif
                     </div>
                     <div class="col-md-4" align="right">
                        <h3 class="card-title" style="float: right;">
                           @if($request->transaction_id == null)
                           <b>Total</b> :
                           <b style="color: red">
                              {{count($data)}} Transaksi
                           </b>
                           @endif
                        </h3>
                     </div>

                  </div>
                  <!-- /.card-header -->
                  <div class="card-body">
                     <table id="example2" class="table table-striped">
                        <thead>
                           <tr>
                              <th>Data Pembeli</th>
                              <th>Detail</th>
                           </tr>
                        </thead>
                        @foreach($data as $key => $item)
                        <tr>
                           <td style="line-height: 1.5">
                              <table>
                                 <tr>
                                    <th>ID Transaksi</th>
                                    <th>Kasir</th>
                                    <th>Nama Pembeli</th>
                                    <th>No. Handphone</th>
                                    <th>Tanggal</th>
                                    <th>Biaya Layanan</th>
                                    <th>Biaya Emblase/Tabung</th>
                                    <th>Biaya Pengiriman</th>
                                    <th>Biaya Lainnya</th>
                                    <th>Tipe Diskon</th>
                                    <th>Diskon</th>
                                    <th>Grand Total</th>
                                    <th>Action</th>
                                 </tr>
                                 <tr>
                                    <td>{{$item['id']}}&nbsp;&nbsp;</td>
                                    <td><?php echo $item['kasir']?></td>
                                    <td>{{$item['customer_name']}}</td>
                                    <td>{{$item['customer_phone']}}</td>
                                    <td>{{ \Carbon\Carbon::make($item['created_at'])->format('d F Y H:i:s')}}</td>
                                    <td>Rp {{number_format($item['service_cost'], 0, ",", ".")}}</td>
                                    <td>Rp {{number_format($item['emblase_cost'], 0, ",", ".")}}</td>
                                    <td>Rp {{number_format($item['shipping_cost'], 0, ",", ".")}}</td>
                                    <td>Rp {{number_format($item['lainnya'], 0, ",", ".")}}</td>
                                    @if($item['discount_type'] == 'fix_price')
                                    <td>Harga Tetap</td>
                                    @elseif($item['discount_type'] == 'percentage')
                                    <td>Persentase</td>
                                    @else
                                    <td>-</td>
                                    @endif
                                    <td>Rp {{number_format($item['discount'], 0, ",", ".")}}</td>
                                    <td>Rp {{number_format($item['grandtotal'], 0, ",", ".")}}</td>
                                    <td>
                                       <a class="btn btn-sm btn-app  bg-info" style="cursor: pointer;" onclick="printYa(<?php echo $item['id']?>)">
                                       <i class="fas fa-print"></i> &nbsp; Cetak
                                    </a>
                                    </td>
                                 </tr>
                              </table>
                           </td>
                           <td style="line-height: 1.5">
                              @foreach($item['item'] as $keyItem => $product)
                              @php $subtotal = $product['product_price'] * $product['qty'] @endphp
                              <table>
                                 <tr>
                                    <th><b style="color: red">Item Ke</b></th>
                                    <th>Produk</th>
                                    <th>Kode Produk</th>
                                    <th>Harga Produk</th>
                                    <th>Qty</th>
                                    <th>Sub Total</th>
                                 </tr>
                                 <tr>
                                    <td>{{$keyItem + 1}}</td>
                                    <td>{{$product['product_name']}}</td>
                                    <td>{{$product['product_code']}}</td>
                                    <td>{{$product['product_price']}}</td>
                                    <td>{{$product['qty']}}</td>
                                    <td>Rp {{number_format($subtotal, 0, ",", ".")}}</td>
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