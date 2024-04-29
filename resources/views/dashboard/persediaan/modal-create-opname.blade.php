      <div class="modal fade" id="modal-create">
        <div class="modal-dialog modal-lg">
          <form action="{{url('/persediaan/stock_opname/store')}}" method="post">
            @csrf
            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title">Tambah Data Stock Opname</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <div class="row">
                  <div class="col-md-6">
                    <label>Tipe</label>
                    <select class="form-control" name="type" required>
                      <option value="" disabled selected>Pilih Tipe</option>
                      <option value="addition">Penambahan</option>
                      <option value="subtraction">Pengurangan</option>
                    </select>
                  </div>
                   <div class="col-md-6">
                    <label>Produk</label>
                    <select class="form-control" name="product_id" required>
                      <option value="" disabled selected>Pilih Produk</option>
                      @foreach($products as $pKey => $pItem)
                        <option value="{{$pItem->id}}">{{$pItem->name}} - Stock : {{$pItem->stock}}</option>
                      @endforeach
                    </select>
                  </div>
                </div>
                <br>
                 <div class="row">
                  <div class="col-md-4">
                    <label>Gudang</label>
                    <select class="form-control" name="warehouse_id" required>
                      <option value="" disabled selected>Pilih Gudang</option>
                      @foreach($warehouses as $wKey => $wItem)
                        <option value="{{$wItem->id}}">{{$wItem->name}}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="col-md-4">
                    <label>Rak</label>
                    <select class="form-control" name="rack_id" required>
                      <option value="" disabled selected>Pilih Rak</option>
                      @foreach($racks as $rKey => $rItem)
                        <option value="{{$rItem->id}}">{{$rItem->name}}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="col-md-4">
                    <label>Kuantiti</label>
                   <input type="text" name="qty" class="form-control" placeholder="Contoh : 10" required onkeypress="return hanyaAngka(event)">
                  </div>
                </div>
                <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
              </div>
            </div>
          </form>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->