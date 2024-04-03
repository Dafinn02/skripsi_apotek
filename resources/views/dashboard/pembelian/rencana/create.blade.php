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
            <h1>Tambah Data Rencana Pembelian</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Tambah Data Rencana Pembelian</li>
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
                <h3 class="card-title">Tambah Data Rencana Pembelian</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="{{ url('/pembelian/rencana/store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="payment_method">Metode Pembayaran</label>
                                <select name="payment_method" id="payment_method" class="form-control">
                                    <option selected disabled>Pilih Metode Pembayaran</option>
                                    <option value="cash">Cash</option>
                                    <option value="transfer">Transfer</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="payment_due_date">Jatuh Tempo Pembayaran</label>
                                <input type="date" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="information">Informasi Tambahan</label>
                                <textarea class="form-control" rows="3" name="information" id="information"></textarea>
                            </div>
                        </div>
                    </div>

                    <div id="products">
                        <div class="product">
                          <div class="row">
                            <div class="col-md-6">
                              <div class="form-group">
                                  <label for="supplier_id">Supplier</label>
                                  <select name="supplier_id[]" id="supplier" class="form-control">
                                      <option selected disabled>Pilih Supplier</option>
                                      @foreach($suppliers as $supplier)
                                      <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                                      @endforeach
                                  </select>
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="form-group">
                                <label for="supplier_pic[]">Pic Supplier</label>
                                <input type="text" id="supplier_pic" name="supplier_pic[]" class="form-control" required>
                              </div>    
                            </div>
                          </div>

                          <div class="row">
                            <div class="col-md-4">
                              <div class="form-group">
                                  <label for="product_id">Produk</label>
                                  <select name="product_id[]" class="form-control">
                                      <option selected disabled>Pilih Produk</option>
                                      @foreach($product as $produk)
                                      <option value="{{ $produk->id }}">{{ $produk->name }}</option>
                                      @endforeach
                                  </select>
                              </div>
                            </div>
                            <div class="col-md-4">
                              <div class="form-group">
                                  <label for="unit_id">Unit</label>
                                  <select name="unit_id[]" class="form-control">
                                      <option selected disabled>Pilih Unit</option>
                                      @foreach($units as $unit)
                                      <option value="{{ $unit->id }}">{{ $unit->name }}</option>
                                      @endforeach
                                  </select>
                              </div>
                            </div>
                            <div class="col-md-4">
                              <div class="form-group">
                                  <label for="unit_id">Harga</label>
                                  <input type="number" name="price[]" class="form-control" required>
                              </div>
                            </div>
                          </div>

                            <div class="form-group">
                                <label for="qty">Kuantitas</label>
                                <input type="number" name="qty[]" class="form-control" required>
                            </div>
                        </div>
                    </div>
            
                    <div class="form-group">
                        <button type="button" class="btn btn-success" id="addProduct">Tambah Produk</button>
                    </div>
                </div>
            
                <div class="card-footer" align="right">
                    <a href="{{ url('/master/produk') }}" class="btn btn-warning">Batal</a>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
            
@push('scripts')
<script>
    $(document).ready(function() {
        $('#addProduct').on('click', function() {
            var productHtml = $('#products .product:first').clone();
            productHtml.find('input, select').val('');
            $('#products').append(productHtml);
        });
    });

    $(document).ready(function() {
      $('#suppler').on('change', function() {
        var supplierId = $(this).val();
        $.ajax({
          url: '{{ url("/master/supplier/get") }}',
          type: 'GET',
          data: {
            id: supplierId
          },
          success: function(response) {
            $('#supplier_pic').val(response.data.pic);
          }
        });
      });
    });
</script>
@endpush