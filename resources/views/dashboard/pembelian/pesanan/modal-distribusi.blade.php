<div class="modal fade" id="modal-distribusi-{{$product['id']}}">
  <div class="modal-dialog modal-lg">
    <form action="{{url('/pembelian/pesanan/up-distribusi/'.$product['id'])}}" method="post"
      enctype="multipart/form-data">
      @csrf
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Distribusi Item Ke Gudang</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="row py-1 col-12">
            <div class="col-6 col-md-3">
              <div class="col-12">
                <Span><strong> Supplier </strong></Span>
              </div>
              <div class="col-12">
                <Span><strong> Produk </strong></Span>
              </div>
              <div class="col-12">
                <Span><strong> Qty </strong></Span>
              </div>
            </div>
            <div class="col-6 col-md-3">
              <div class="col-12">
                <span> <b> : </b> {{$product['supplier_name']}} </span>
              </div>
              <div class="col-12">
                <span> <b> : </b> {{$product['product_name']}} </span>
              </div>
              <div class="col-12">
                <span> <b> : </b> {{$product['qty']}} {{$product['unit_name']}} </span>
              </div>
            </div>

            @if($product['distribution'] == 0)
            <input type="hidden" name="qty" value="{{$product['qty']}}">
            <input type="hidden" name="purchase_order_item_id" value="{{$product['id']}}">
            <input type="hidden" name="product_id" value="{{$product['product_id']}}">
            <input type="hidden" name="purchase_order_id" value="{{$product['purchase_order_id']}}">
            <div class="row" style="padding-bottom: 2%">
              <div class="col-md-4">
                <label>Gudang</label>
                <select class="form-control" required name="warehouse_id">
                  <option value="" selected disabled="">Pilih Gudang</option>
                  @foreach($gudang as $gKey => $gItem)
                  <option value="{{$gItem->id}}">{{$gItem->name}}</option>
                  @endforeach
                </select>
              </div>
              <div class="col-md-4">
                <label>Rak</label>
                <select class="form-control" name="rack_id" required>
                  <option value="" selected disabled="">Pilih Rak</option>
                  @foreach($rak as $rKey => $rItem)
                  <option value="{{$rItem->id}}">{{$rItem->name}}</option>
                  @endforeach
                </select>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="date">Kadaluarsa</label>
                  <input type="date" class="form-control" name="kadaluarsa">
                </div>
              </div>
            </div>
            @else
            <div class="col-6 col-md-3">
              <div class="col-12">
                <Span><strong> Gudang </strong></Span>
              </div>
              <div class="col-12">
                <Span><strong> Rak </strong></Span>
              </div>
              <div class="col-12">
                <Span><strong> Tanggal Distribusi </strong></Span>
              </div>
            </div>
            <div class="col-6 col-md-3">
              <div class="col-12">
                <span> <b> : </b> {{$product['gudang']}} </span>
              </div>
              <div class="col-12">
                <span> <b> : </b> {{$product['rak']}} </span>
              </div>
              <div class="col-12">
                <span> <b> : </b> {{$product['distribution_date']}} </span>
              </div>
            </div>
          </div>
          @endif
          <div class="modal-footer justify-content-between">
            @if($product['distribution'] == 0)
            <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-primary">Distribusikan &nbsp; <i
                class="fas fa-arrow-right"></i></button>
            @else
            <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
            @endif
          </div>
        </div>
    </form>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->