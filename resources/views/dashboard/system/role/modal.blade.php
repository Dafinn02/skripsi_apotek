      <div class="modal fade" id="modal-edit-{{$item->id}}">
        <div class="modal-dialog">
          <form action="{{url('/users/role/update/'.$item->id)}}" method="post">
            @csrf
            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title">Edit Role {{$item->name}}</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <div class="input-group mb-3">
                  <input type="text" class="form-control" placeholder="Name" required name="name" 
                         value="{{$item->name}}">
                  <div class="input-group-append">
                    <div class="input-group-text">
                      <span class="fas fa-user"></span>
                    </div>
                  </div>
                </div>
                <div class="input-group mb-3">
                  <select class="form-control" name="route" required>
                    <option value="" disabled>Pilih Halaman</option>
                    @foreach($path as $pathKey => $pathItem)
                      <option value="{{$pathItem}}" {{$pathItem == $item->route ? 'selected':''}}>
                      {{url('/').'/'.$pathItem}}
                      </option>
                    @endforeach
                  </select>
                  <div class="input-group-append">
                    <div class="input-group-text">
                      <span class="fas fa-lock"></span>
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