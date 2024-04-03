        <div class="modal fade" id="modal-pindah-{{$item->id}}">
        <div class="modal-dialog modal-lg">
          <form action="{{url('/warehouse/rack/update/'.$item->id)}}" method="post">
            @csrf
            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title">PindahkanRack <b>{{$item->name}}</b> <b>{{$warehouse->name}}</b></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <div class="row">
                  <div class="col-md-12">
                    <p align="center">Pilih Gudang</p>
                    <div class="input-group mb-3">
                      <input type="hidden" name="name" value="{{$item->name}}">
                      <input type="hidden" name="capacity" value="{{$item->capacity}}">
                      <select name="warehouse_id" id="select2nya{{$item->id}}" class="select2" style="width: 100%; height: 100%">
                        @foreach($warehouses as $key => $witem)
                          <option value="{{$witem->id}}">{{$witem->name}}</option>
                        @endforeach
                      </select>
                    </div>
                  </div>
                </div>
                <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary">Pindah Sekarang</button>
              </div>
            </div>
          </form>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->