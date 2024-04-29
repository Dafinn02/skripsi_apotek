      <div class="modal fade" id="modal-order-{{$item['id']}}">
        <div class="modal-dialog modal-lg">
          <form action="{{url('/pembelian/rencana/up-to-order/'.$item['id'])}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title">Order Pesanan Pembelian </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <div class="row">
                  <div class="col-md-6">
                    <div class="input-group mb-3">
                      <b>Total Item</b> : {{count($item['item'])}}
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="input-group mb-3">
                      <b>Grand Total</b> : Rp {{number_format($item['grandtotal'], 0, ",", ".")}}
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <div class="input-group mb-3">
                      <b>Kode Pesanan</b> : {{$item['number_letter']}}
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="input-group mb-3">
                      <b>PIC</b> : {{$item['user_name']}}
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <label>Bukti Transfer</label>
                    <input type="file" class="form-control" name="proof" required>
                  </div>
                </div>
                <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary">Pesan &nbsp; <i class="fas fa-arrow-right"></i></button>
              </div>
            </div>
          </form>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->
