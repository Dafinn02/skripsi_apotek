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
  updateRemoveButtons();
  var productCount = {{$item->count()}} + 1; // Mengatur jumlah produk berdasarkan jumlah produk yang ada ditambah satu

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
                                  <select name="supplier_id[]" id="supplier" class="form-control">
                                      <option selected disabled>Pilih Supplier</option>
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
                                  <label for="unit_id">Harga Satuan</label>
                                  <input type="number" name="price[]" class="form-control" required>
                              </div>
                            </div>
                          </div>
                        </div>
                </div>`;
    $('#products').append(item);
  }
</script>
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
            <h1>Edit Data Produk</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Edit Data Produk</li>
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
                <h3 class="card-title">Edit Data Produk</h3>
              </div>
              <!-- /.card-header -->
              <form action="{{ url('/pembelian/rencana/update/'.$data->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="payment_method">Metode Pembayaran</label>
                                <select name="payment_method" id="payment_method" class="form-control">
                                    <option selected disabled>Pilih Metode Pembayaran</option>
                                    <option value="cash" {{$data->payment_method == 'cash' ? 'selected' : ''}}>Cash</option>
                                    <option value="transfer" {{$data->payment_method == 'transfer' ? 'selected' : ''}}>Transfer</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                              <label for="payment_due_date">Jatuh Tempo Pembayaran</label>
                              <input type="date" class="form-control" id="payment_due_date" name="payment_due_date" value="{{ date('Y-m-d', strtotime($data->payment_due_date)) }}">
                          </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="information">Informasi Tambahan</label>
                                <textarea class="form-control" rows="3" name="information" id="information">{{$data->information}}</textarea>
                            </div>
                        </div>
                    </div>

                   <!--  <div class="form-group mt-2" align="right">
                      <button type="button" class="btn btn-success" id="addProduct"> <i class="fas fa-plus"></i> &nbsp; Tambah Produk</button>
                    </div> -->
                    <div id="products">
                    @foreach($item as $key => $it)
                      
                        <div class="product">
                          <hr>
                          <div class="product-header" align="center">
                            @if($key > 0)
                             <button type="button" class="btn btn-sm btn-danger" 
                              onclick="removeProductOne('product-item-{{$key}}')">
                                &nbsp; <i class="fa fa-trash"></i> Hapus Produk
                              </button>
                              @else
                              <button type="button" class="btn btn-success" id="addProduct" onclick="addProductOne()"> 
                                <i class="fas fa-plus"></i> &nbsp; Tambah Produk
                              </button>
                              @endif
                          </div>
                          <hr>
                          <div class="mt-3">
                            <div class="row">
                              <div class="col-md-4">
                                <div class="form-group">
                                  <label for="supplier_id">Supplier</label>
                                  <select name="supplier_id[]" id="supplier" class="form-control">
                                      <option selected disabled>Pilih Supplier</option>
                                      @foreach($suppliers as $sKey => $sItem)
                                        <option value="{{$sItem->id}}" {{$sItem->id == $it->supplier_id ? 'selected':''}}>
                                          {{$sItem->name}}
                                        </option>
                                      @endforeach
                                  </select>
                              </div>
                              </div>
                              <div class="col-md-4">
                                <div class="form-group">
                                  <label for="supplier_pic[]">Pic Supplier</label>
                                  <input type="text" id="supplier_pic" name="supplier_pic[]" class="form-control" value="{{$it->supplier_pic}}" required>
                                </div>    
                              </div>
                              <div class="col-md-4">
                                <div class="form-group">
                                    <label for="qty">Kuantitas</label>
                                    <input type="number" name="qty[]" class="form-control" value="{{$it->qty}}" required>
                                </div>
                              </div>
                            </div>

                            <div class="row">
                              <div class="col-md-4">
                                <div class="form-group">
                                  <label for="product_id">Produk</label>
                                    <select name="product_id[]" class="form-control">
                                        <option selected disabled>Pilih Produk</option>
                                        @foreach($product as $pKey => $pItem)
                                          <option value="{{$pItem->id}}" {{$pItem->id == $it->product_id ? 'selected':''}}>
                                            {{$pItem->name}}
                                          </option>
                                        @endforeach
                                    </select>
                                </div>
                              </div>
                              <div class="col-md-4">
                                <div class="form-group">
                                  <label for="unit_id">Unit</label>
                                  <select name="unit_id[]" class="form-control">
                                      <option selected disabled>Pilih Unit</option>
                                      @foreach($units as $ukey => $uItem)
                                      <option value="{{$uItem->id}}" {{$uItem->id == $it->unit_id ? 'selected':''}}>
                                        {{$uItem->name}}
                                      </option>
                                      @endforeach
                                  </select>
                                </div>
                              </div>
                              <div class="col-md-4">
                                <div class="form-group">
                                    <label for="unit_id">Harga Satuan</label>
                                    <input type="number" name="price[]" class="form-control" value="{{$it->price}}" required>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                   
                    @endforeach
                       </div>
                </div>

                <div class="card-footer" align="right">
                    <a href="{{ url('/pembelian/rencana') }}" class="btn btn-warning">Batal</a>
                    &nbsp;&nbsp;
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
              </form>
           
            <!-- /.card -->
          </div>
        </div>
      </div>
    </section>
  </div>
@endsection