      <div class="modal fade" id="modal-create">
        <div class="modal-dialog modal-lg">
          <form action="{{url('/supplier/store')}}" method="post">
            @csrf
            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title">Tambah Data Supplier</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <div class="row">
                  <div class="col-md-6">
                    <div class="input-group mb-3">
                      <input type="text" class="form-control" placeholder="PT.ABCD" required name="name">
                      <div class="input-group-append">
                        <div class="input-group-text">
                          <span class="fas fa-building"></span>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="input-group mb-3">
                      <input type="number" class="form-control" placeholder="0858155xxxxxx" required name="phone">
                      <div class="input-group-append">
                        <div class="input-group-text">
                          <span class="fas fa-phone"></span>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <div class="input-group mb-3">
                      <input type="text" class="form-control" placeholder="suppllier@gmail.com" required name="email">
                      <div class="input-group-append">
                        <div class="input-group-text">
                          <span class="fas fa-envelope"></span>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="input-group mb-3">
                      <input type="text" class="form-control" placeholder="Bapak Ahmad Dani" required name="pic">
                      <div class="input-group-append">
                        <div class="input-group-text">
                          <span class="fas fa-user"></span>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <textarea class="form-control" placeholder="Jl. Soekarno Hatta No.9 · (0341) 404424" name="address" rows="6"></textarea>
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