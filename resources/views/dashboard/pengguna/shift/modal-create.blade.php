      <div class="modal fade" id="modal-create">
        <div class="modal-dialog modal-lg">
          <form action="{{url('/pengguna/shift/store')}}" method="post">
            @csrf
            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title">Tambah Data Shift</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <div class="row">
                  <div class="col-md-4">
                    <label>Nama</label>
                    <div class="input-group mb-3">
                      <input type="text" class="form-control" placeholder="Siang" required name="name">
                      <div class="input-group-append">
                        <div class="input-group-text">
                          <span class="fas fa-database"></span>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <label>Mulai</label>
                    <div class="input-group mb-3">
                      <input type="time" class="form-control" placeholder="07:00" required name="start_time">
                      <div class="input-group-append">
                        <div class="input-group-text">
                          <span class="fas fa-clock"></span>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <label>Akhir</label>
                    <div class="input-group mb-3">
                      <input type="time" class="form-control" placeholder="Siang" required name="end_time">
                      <div class="input-group-append">
                        <div class="input-group-text">
                          <span class="fas fa-clock"></span>
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