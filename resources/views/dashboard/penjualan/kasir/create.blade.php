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
   @if($message=Session::get('success'))
        // window.open(
        //   "{{url('penjualan/kasir-cetak/')}}"+"/"+"{{Session::get('trs-id')}}",
        //   //"_blank" // <- This is what makes it open in a new window.
        // );
        window.open("{{url('penjualan/kasir-cetak/')}}"+"/"+"{{Session::get('trs-id')}}", '_blank', 'location=yes,height=570,width=620,scrollbars=yes,status=yes');
    @endif
</script>

<script>
  var productCount = 0;
   function checkProductCount() {
            if(productCount <= 0) 
            {
              $('#btn_jual').hide()
            }
    }
    window.onload = checkProductCount;
  // JavaScript
  var productCount = 0;

  function removeProductOne(id)
  {
    $('#'+id).remove();
    productCount--;
    if(productCount <= 0) 
    {
      $('#btn_jual').hide();
    }else{
      $('#btn_jual').show();
    }
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
                    <div class="col-md-3">
                      <div class="form-group">
                          <label for="product_name[]">Produk <span style="color: red">*</span></label>
                          <select name="product_name[]" id="product" class="form-control product-select" required>
                              <option selected disabled value="">Pilih Produk</option>
                              @foreach($arr as $key => $value)
                              <option value="{{$value->name}}">
                                {{$value->name}} - Stock : {{$value->stock}}
                                </option>
                              @endforeach
                          </select>
                          <input type="hidden" name="product_id[]" id="product_id">
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group">
                        <label for="product_code[]">Kode Produk</label>
                        <input type="text" id="product_code" name="product_code[]" class="form-control" readonly required>
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group">
                          <label for="product_price">Harga Produk <span style="color: red">*</span></label>
                          <input type="text" onkeypress="return hanyaAngka(event)" required id="product_price" name="product_price[]" class="form-control" required>
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group">
                          <label for="qty">Kuantitas <span style="color: red">*</span></label>
                          <input type="text" onkeypress="return hanyaAngka(event)" required name="qty[]" class="form-control" required>
                      </div>
                    </div>
                  </div>
                </div>
              </div>`;
    $('#products').append(item);
    if(productCount > 0) 
    {
      $('#btn_jual').show();
    }
  }

  
  $(document).ready(function() {
    // Simpan data produk dalam bentuk objek JavaScript
    var products = @json($arr);

    // Fungsi untuk mendapatkan kode produk berdasarkan nama produk
    function getProductCode(productName,data) {
        for (var key in products) {
            if (products.hasOwnProperty(key)) {
              //console.log(products);
                if (products[key]['name'] === productName) {
                    return products[key][data];
                }
            }
        }
        return ''; // Kembalikan string kosong jika tidak ada kode ditemukan
    }

    // Tambahkan event listener untuk elemen dropdown produk yang sudah ada
    $('#product').change(function() {
        var selectedProductName = $(this).val();
        var selectedProductCode = getProductCode(selectedProductName,'code');
        $('#product_code').val(selectedProductCode);

        var selectedProductPrice = getProductCode(selectedProductName,'price');
        $('#product_price').val(selectedProductPrice);

        var selectedProductId = getProductCode(selectedProductName,'id');
        $('#product_id').val(selectedProductId);
    });

    // Tambahkan event listener untuk elemen dropdown produk baru
    $(document).on('change', '[name="product_name[]"]', function() {
        var selectedProductName = $(this).val();

        var productCodeInput = $(this).closest('.product').find('[name="product_code[]"]');
        var selectedProductCode = getProductCode(selectedProductName,'code');
        productCodeInput.val(selectedProductCode);

        var productPriceInput = $(this).closest('.product').find('[name="product_price[]"]');
        var selectedProductPrice = getProductCode(selectedProductName,'price');
        productPriceInput.val(selectedProductPrice);

        var productIdInput = $(this).closest('.product').find('[name="product_id[]"]');
        var selectedProductId = getProductCode(selectedProductName,'id');
        productIdInput.val(selectedProductId);
    });

});

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
            <h1>Tambah Data Pembelian Kasir</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Tambah Data Pembelian Kasir</li>
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
                <h3 class="card-title">Tambah Data Pembelian Kasir</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="{{ url('/penjualan/kasir-beli/store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                          <div class="form-group">
                            <label for="nama_pembeli">Nama Pembeli <span style="color: red">*</span></label>
                            <input type="text" id="nama_pembeli" name="customer_name" class="form-control" placeholder="Contoh : Sumanto Abdillah" required>
                          </div>    
                        </div>
                        <div class="col-md-4">
                          <div class="form-group">
                            <label for="customer_phone">No. Handphone </label>
                            <input type="text" id="customer_phone" name="customer_phone" class="form-control" placeholder="Contoh : 085608014xxx" onkeypress="return hanyaAngka(event)">
                          </div>    
                        </div>
                        <div class="col-md-4">
                          <div class="form-group">
                              <label for="date">Tanggal</label>
                              <input type="date" class="form-control" name="date" readonly value="{{$now}}">
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="form-group">
                              <label for="service_cost">Biaya Layanan</label>
                              <input type="text" id="service_cost" name="service_cost" class="form-control nominal" placeholder="Contoh : 6000"  onkeypress="return hanyaAngka(event)">
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="form-group">
                              <label for="emblase_cost">Biaya Emblase/Tabung</label>
                              <input type="text" id="emblase_cost" name="emblase_cost" class="form-control nominal" placeholder="Contoh : 5000"  onkeypress="return hanyaAngka(event)">
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="form-group">
                              <label for="shipping_cost">Biaya Pengiriman</label>
                              <input type="text" id="shipping_cost" name="shipping_cost" class="form-control nominal" placeholder="Contoh : 7000" onkeypress="return hanyaAngka(event)">
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="form-group">
                              <label for="lainnya">Biaya Lainnya</label>
                              <input type="text" id="lainnya" name="lainnya" class="form-control nominal" placeholder="Contoh : 9000"
                                     onkeypress="return hanyaAngka(event)">
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="form-group">
                              <label for="discount_type">Tipe Diskon</label>
                              <select name="discount_type" class="form-control" required>
                                  <option selected disabled>Pilih Tipe Diskon</option>
                                  <option value="">Tidak Ada</option>
                                  <option value="fix_price">Harga Tetap</option>  
                                  <option value="percentage">Persentase</option>
                              </select>
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="form-group">
                              <label for="discount">Diskon</label>
                              <input type="text" id="discount" name="discount" class="form-control nominal" placeholder="Contoh : 6000" 
                                     onkeypress="return hanyaAngka(event)">
                          </div>
                        </div>
                    </div>

                    <div id="products">
                      <div class="product">
                        <hr>
                        <div class="product-header" align="center">
                          <button type="button" class="btn btn-success" id="addProduct" onclick="addProductOne()"> 
                          <i class="fas fa-plus"></i> &nbsp; Tambah Produk
                        </button>
                        </div>
                        <hr>
                        {{-- <div class="mt-3">
                          <div class="row">
                            <div class="col-md-3">
                              <div class="form-group">
                                  <label for="product_name[]">Produk <span style="color: red">*</span></label>
                                  <select name="product_name[]" id="product" class="form-control" required>
                                      <option selected disabled value="">Pilih Produk</option>
                                      @foreach($arr as $key => $value)
                                      <option value="{{$value->name}}">
                                        {{$value->name}} - Stock : {{$value->stock}}
                                      </option>
                                      @endforeach
                                  </select>
                                  <input type="hidden" name="product_id[]" id="product_id">
                              </div>
                            </div>
                            <div class="col-md-3">
                              <div class="form-group">
                                <label for="product_code[]">Kode Produk</label>
                                <input type="text" id="product_code" name="product_code[]" class="form-control" readonly>
                              </div>
                            </div>
                            <div class="col-md-3">
                              <div class="form-group">
                                  <label for="product_price">Harga Produk <span style="color: red">*</span></label>
                                  <input type="text" onkeypress="return hanyaAngka(event)" required id="product_price" name="product_price[]" class="form-control nominal" required>
                              </div>
                            </div>
                            <div class="col-md-3">
                              <div class="form-group">
                                  <label for="qty">Kuantitas <span style="color: red">*</span></label>
                                  <input type="text" onkeypress="return hanyaAngka(event)" required name="qty[]" class="form-control" required>
                              </div>
                            </div>
                          </div>
                        </div> --}}
                      </div>
                    </div>
                  </div>

                <div class="card-footer" align="right">
                  <a href="{{ url('/penjualan/kasir-beli') }}" class="btn btn-warning">Batal</a>
                  &nbsp;&nbsp;
                  @if(Auth::user()->role != 'head_office')
                    <button type="submit" class="btn btn-primary" id="btn_jual">
                      Simpan
                    </button>
                  @endif
                </div>

            </form>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
@endsection
