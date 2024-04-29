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
                       <h3  class="card-title">
                      <b>Tanggal</b> : 
                      <b style="color: red">
                        {{ \Carbon\Carbon::make($now)->format('d F Y')}}
                      </b>
                      </h3>
                    </div>
                    <div class="col-md-4" style="opacity:  {{Auth::user()->role != 'cashier' ? '0' : ''}};">
                      @if($shift_id == 0)
                      <a href="{{url('penjualan/transaksi')}}?session_trs_shift=true" 
                         class="btn btn-{{$shift_id == 0 ? 'warning' : 'success'}}" >
                        <i class="fas fa-user"></i> &nbsp;
                        Tampilkan Transaksi Yang Ditangani Oleh Saya
                      </a>
                      @else
                      <a href="{{url('penjualan/transaksi')}}" 
                         class="btn btn-{{$shift_id == 0 ? 'warning' : 'success'}}" >
                        <i class="fas fa-user"></i> &nbsp;
                        Tampilkan Semua Transaksi
                      </a>
                      @endif
                    </div>
                    <div class="col-md-4" align="right">
                      <h3  class="card-title" style="float: right;">
                      <b>Total</b> : 
                      <b style="color: red">
                        {{count($data)}} Transaksi
                      </b>
                      </h3>
                    </div>
                      
                  </div>
                  <!-- /.card-header -->
                  <div class="card-body">
                     <table id="example2" class="table table-bordered table-hover">
                        <thead>
                           <tr>
                              <th>Data Pembeli</th>
                              <th>Detail</th>
                           </tr>
                        </thead>
                        @foreach($data as $key => $item)
                        <tr>
                           <td style="line-height: 2">
                              <table>
                                 <tr>
                                    <th>ID Transaksi</th>
                                    <th>:</th>
                                    <td>{{$item['id']}}</td>
                                 </tr>
                                 <tr>
                                    <th>Kasir</th>
                                    <th>:</th>
                                    <td><?php echo $item['kasir']?></td>
                                 </tr>
                                 <tr>
                                    <th>Nama Pembeli</th>
                                    <th>:</th>
                                    <td>{{$item['customer_name']}}</td>
                                 </tr>
                                 <tr>
                                    <th>No. Handphone</th>
                                    <th>:</th>
                                    <td>{{$item['customer_phone']}}</td>
                                 </tr>
                                 <tr>
                                    <th>Tanggal</th>
                                    <th>:</th>
                                    <td>
                                       {{ \Carbon\Carbon::make($item['created_at'])->format('d F Y H:i:s')}}
                                    </td>
                                 </tr>
                                 <tr>
                                    <th>Biaya Layanan</th>
                                    <th>:</th>
                                    <td>Rp {{number_format($item['service_cost'], 0, ",", ".")}}</td>
                                 </tr>
                                 <tr>
                                    <th>Biaya Emblase/Tabung</th>
                                    <th>:</th>
                                    <td>Rp {{number_format($item['emblase_cost'], 0, ",", ".")}}</td>
                                 </tr>
                                 <tr>
                                    <th>Biaya Pengiriman</th>
                                    <th>:</th>
                                    <td>Rp {{number_format($item['shipping_cost'], 0, ",", ".")}}</td>
                                 </tr>
                                 <tr>
                                    <th>Biaya Lainnya</th>
                                    <th>:</th>
                                    <td>Rp {{number_format($item['lainnya'], 0, ",", ".")}}</td>
                                 </tr>
                                 <tr>
                                    <th>Tipe Diskon</th>
                                    <th>:</th>
                                    @if($item['discount_type'] == 'fix_price')
                                    <td>Harga Tetap</td>
                                    @elseif($item['discount_type'] == 'percentage')
                                    <td>Persentase</td>
                                    @else
                                    <td>-</td>
                                    @endif
                                 </tr>
                                 <tr>
                                    <th>Diskon</th>
                                    <th>:</th>
                                    <td>Rp {{number_format($item['discount'], 0, ",", ".")}}</td>
                                 </tr>
                                 <tr>
                                    <th>Grand Total</th>
                                    <th>:</th>
                                    <td>Rp {{number_format($item['grandtotal'], 0, ",", ".")}}</td>
                                 </tr>
                              </table>
                           </td>
                           <td style="line-height: 2">
                              <div class="col-sm-12">
                                 <div class="row">
                                    @foreach($item['item'] as $keyItem => $product)
                                    @php $subtotal = $product['product_price'] * $product['qty'] @endphp
                                    <div class="col-sm-6" style="padding-bottom: 2%">
                                       <table>
                                          <tr>
                                             <th><b style="color: red">Item Ke</b></th>
                                             <th>:</th>
                                             <td>{{$keyItem + 1}}</td>
                                          </tr>
                                          <tr>
                                             <th>Produk</th>
                                             <th>:</th>
                                             <td>{{$product['product_name']}}</td>
                                          </tr>
                                          <tr>
                                             <th>Kode Produk</th>
                                             <th>:</th>
                                             <td>{{$product['product_code']}}</td>
                                          </tr>
                                          <tr>
                                             <th>Harga Produk</th>
                                             <th>:</th>
                                             <td>{{$product['product_price']}}</td>
                                          </tr>
                                          <tr>
                                             <th>Qty</th>
                                             <th>:</th>
                                             <td>{{$product['qty']}}</td>
                                          </tr>
                                          <tr>
                                             <th>Sub Total</th>
                                             <th>:</th>
                                             <td>Rp {{number_format($subtotal, 0, ",", ".")}}</td>
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