@extends('layouts.app')

@section('custom-css')
<!-- Select2 -->
<link rel="stylesheet" href="{{url('plugins/select2/css/select2.min.css')}}">
<link rel="stylesheet" href="{{url('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
<style type="text/css">
  /* CSS */
.product-header {
    /*display: flex;
    justify-content: space-between;  Letakkan judul di kiri dan tombol di kanan 
    align-items: center;      */     /* Vertically align elements */
}

/*.btn-remove {
    margin-left: auto;  Posisikan tombol di sebelah kanan 
}*/
</style>
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

<script>
  // JavaScript
  var productCount = 1;

  function removeProductOne(id)
  {
    $('#'+id).remove();
    productCount--;
  }
  function addProductOne()
  {
    productCount++;
    var item = `<div class="product" id="product-item-`+productCount+`">
                        <hr>
                        <div class="product-header" align="center">
                          <button type="button" class="btn btn-sm btn-danger" 
                          onclick="removeProductOne('product-item-`+productCount+`')">
                            &nbsp; <i class="fa fa-trash"></i> Hapus Produk
                          </button>
                        </div>
                        <hr>
                        <div class="mt-3">
                          <div class="row">
                            <div class="col-md-4">
                              <div class="form-group">
                                  <label for="supplier_id">Supplier</label>
                                  <select name="supplier_id[]" id="supplier" class="form-control" required>
                                      <option selected disabled value="">Pilih Supplier</option>
                                      @foreach($suppliers as $supplier)
                                      <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                                      @endforeach
                                  </select>
                              </div>
                            </div>
                            <div class="col-md-4">
                              <div class="form-group">
                                <label for="supplier_pic[]">Pic Supplier</label>
                                <input type="text" id="supplier_pic" name="supplier_pic[]" class="form-control" required>
                              </div>    
                            </div>
                            <div class="col-md-4">
                              <div class="form-group">
                                  <label for="qty">Kuantitas</label>
                                  <input type="number" name="qty[]" class="form-control" required>
                              </div>
                            </div>
                          </div>

                          <div class="row">
                            <div class="col-md-4">
                              <div class="form-group">
                                  <label for="product_id">Produk</label>
                                  <select name="product_id[]" class="form-control" required>
                                      <option selected disabled value="">Pilih Produk</option>
                                      @foreach($product as $produk)
                                      <option value="{{ $produk->id }}">{{ $produk->name }}</option>
                                      @endforeach
                                  </select>
                              </div>
                            </div>
                            <div class="col-md-4">
                              <div class="form-group">
                                  <label for="unit_id">Unit</label>
                                  <select name="unit_id[]" class="form-control" required>
                                      <option selected disabled value="">Pilih Unit</option>
                                      @foreach($units as $unit)
                                      <option value="{{ $unit->id }}">{{ $unit->name }}</option>
                                      @endforeach
                                  </select>
                              </div>
                            </div>
                            <div class="col-md-4">
                              <div class="form-group">
                                  <label for="unit_id">Harga Satuan</label>
                                  <input type="text" name="price[]" class="form-control nominal" onkeypress="return hanyaAngka(event)" required>
                              </div>
                            </div>
                          </div>
                        </div>
                </div>`;
    $('#products').append(item);

    var newPriceInput = $(`#product-item-${productCount} input[name='price[]']`);
    newPriceInput.on('input', function (e) {
        formatCurrency(e.target);
    });
  }

function hanyaAngka(evt) {
  var charCode = (evt.which) ? evt.which : event.keyCode
    if (charCode > 31 && (charCode < 48 || charCode > 57))

    return false;
  return true;
}

function formatCurrency(input) {
  var numeric = input.value.replace(/\D/g, '');
  var formatted = numeric.replace(/\B(?=(\d{3})+(?!\d))/g, '.');
  input.value = formatted;
}

document.querySelectorAll('input.nominal').forEach(function(input) {
  input.addEventListener('input', function (e) {
      formatCurrency(e.target);
  });
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
                                <select name="payment_method" id="payment_method" class="form-control" required>
                                    <option selected disabled value="">Pilih Metode Pembayaran</option>
                                    <option value="cash">Cash</option>
                                    <option value="transfer">Transfer</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="payment_due_date">Jatuh Tempo Pembayaran</label>
                                <input type="date" class="form-control" required name="payment_due_date">
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
                      <div class="product" id="product-item-1">
                        <hr>
                        <div class="product-header" align="center">
                          <button type="button" class="btn btn-success" id="addProduct" onclick="addProductOne()"> 
                          <i class="fas fa-plus"></i> &nbsp; Tambah Produk
                        </button>
                        </div>
                        <hr>
                        <div class="mt-3">
                          <div class="row">
                            <div class="col-md-4">
                              <div class="form-group">
                                  <label for="supplier_id">Supplier</label>
                                  <select name="supplier_id[]" id="supplier" class="form-control" required>
                                      <option selected disabled value="">Pilih Supplier</option>
                                      @foreach($suppliers as $supplier)
                                      <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                                      @endforeach
                                  </select>
                              </div>
                            </div>
                            <div class="col-md-4">
                              <div class="form-group">
                                <label for="supplier_pic[]">Pic Supplier</label>
                                <input type="text" id="supplier_pic" name="supplier_pic[]" class="form-control" required>
                              </div>    
                            </div>
                            <div class="col-md-4">
                              <div class="form-group">
                                  <label for="qty">Kuantitas</label>
                                  <input type="number" name="qty[]" class="form-control" required>
                              </div>
                            </div>
                          </div>

                          <div class="row">
                            <div class="col-md-4">
                              <div class="form-group">
                                  <label for="product_id">Produk</label>
                                  <select name="product_id[]" class="form-control" required>
                                      <option selected disabled value="">Pilih Produk</option>
                                      @foreach($product as $produk)
                                      <option value="{{ $produk->id }}">{{ $produk->name }}</option>
                                      @endforeach
                                  </select>
                              </div>
                            </div>
                            <div class="col-md-4">
                              <div class="form-group">
                                  <label for="unit_id">Unit</label>
                                  <select name="unit_id[]" class="form-control" required>
                                      <option selected disabled value="">Pilih Unit</option>
                                      @foreach($units as $unit)
                                      <option value="{{ $unit->id }}">{{ $unit->name }}</option>
                                      @endforeach
                                  </select>
                              </div>
                            </div>
                            <div class="col-md-4">
                              <div class="form-group">
                                  <label for="unit_id">Harga Satuan</label>
                                  <input type="text" name="price[]" class="form-control nominal" onkeypress="return hanyaAngka(event)" required>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                <div class="card-footer" align="right">
                  <a href="{{ url('/pembelian/rencana') }}" class="btn btn-warning">Batal</a>
                  &nbsp;&nbsp;
                  <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
@endsection
