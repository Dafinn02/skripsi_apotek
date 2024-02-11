      <div class="modal fade" id="modal-edit-{{$item->id}}">
        <div class="modal-dialog modal-lg">
          <form action="{{url('/product/category/update/'.$item->id)}}" method="post">
            @csrf
            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title">Edit Data Kategori</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <div class="row">
                  <div class="col-md-12">
                    <div class="input-group mb-3">
                      <input type="text" class="form-control" placeholder="Obat Keras" required name="name" value="{{$item->name}}">
                      <div class="input-group-append">
                        <div class="input-group-text">
                          <span class="fas fa-file-medical-alt"></span>
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