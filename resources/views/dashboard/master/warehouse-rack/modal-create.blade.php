      <div class="modal fade" id="modal-create">
        <div class="modal-dialog modal-lg">
          <form action="{{url('/master/gudang-rak/store')}}" method="post">
            @csrf
            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title">Tambah Data Rack <b>{{$warehouse->name}}</b></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <input type="hidden" name="warehouse_id" value="{{$warehouse->id}}">
                <div class="row">
                  <div class="col-md-12">
                      <label for="rack_id">Pilih Rak</label>
                      <div class="input-group mb-3">
                          <select class="form-control" name="rack_id">
                              <option selected disabled>Pilih Rak</option>
                              @foreach($rack as $rc)
                                  <option value="{{$rc->id}}">{{$rc->name}}</option>
                              @endforeach
                          </select>
                          <div class="input-group-append">
                              <div class="input-group-text">
                                  <span class="fas fa-building"></span>
                              </div>
                          </div>
                      </div>
                  </div>
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