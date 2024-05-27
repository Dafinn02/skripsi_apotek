<div class="modal fade" id="modal-edit-{{$item->id}}">
  <div class="modal-dialog modal-lg">
    <form action="{{url('/pengguna/kasir/update/'.$item->id)}}" method="post">
      @csrf
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Edit Data Kasir</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <input type="hidden" name="user_id" value="{{$item->user_id}}">
          <div class="form-group">
              <label class="form-label">Nomor Kasir</label>
              <div class="input-group mb-3">
                  <input type="number" class="form-control" placeholder="Masukkan Number" required name="number" value="{{$item->number}}">                      
              </div>
          </div>
          <div class="form-group">
              <label class="form-label">Nama</label>
              <div class="input-group mb-3">
                  <input type="text" class="form-control" placeholder="Masukkan Nama Kasir" required name="name" value="{{$item->name}}">                      
              </div>
          </div>
          <div class="form-group">
              <label class="form-label">Alamat</label>
              <div class="input-group mb-3">
                  <input type="text" class="form-control" placeholder="Masukkan Alamat" required name="address" value="{{$item->address}}">                      
              </div>
          </div>
          <div class="form-group">
            <label class="form-label">Email</label>
            <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="Masukkan Email" required name="email" value="{{$item->email}}">                      
            </div>
        </div>
          <div class="form-group">
              <label class="form-label">No. Telepon</label>
              <div class="input-group mb-3">
                  <input type="text" class="form-control" placeholder="Masukkan No. Telepon" required name="phone" value="{{$item->phone}}">                      
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