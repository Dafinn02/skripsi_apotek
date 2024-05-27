@extends('layouts.app')

@section('custom-css')
<link rel="stylesheet" href="{{url('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{url('plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{url('plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">
<!-- Select2 -->
<link rel="stylesheet" href="{{url('plugins/select2/css/select2.min.css')}}">
<link rel="stylesheet" href="{{url('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
@endsection

@section('custom-js')
<script src="{{url('plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{url('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{url('plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{url('plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
<!-- Select2 -->
<script src="{{url('plugins/select2/js/select2.full.min.js')}}"></script>
<script type="text/javascript">

</script>
<script type="text/javascript">
function hanyaAngka(evt) {
  var charCode = (evt.which) ? evt.which : event.keyCode
    if (charCode > 31 && (charCode < 48 || charCode > 57))

    return false;
  return true;
}

function formatCurrency(input) {
  var numeric = input.value.replace(/\D/g, '');
  var formatted = numeric.replace(/\B(?=(\d{3})+(?!\d))/g, '.');
  input.value = formatted;
}

document.querySelectorAll('input.nominal').forEach(function(input) {
  input.addEventListener('input', function (e) {
      formatCurrency(e.target);
  });
});
</script>
@endsection

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Tutup Shift</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Close Shift</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Silahkan Tutup Shift Anda</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                    <div class="modal-dialog modal-xl">
                      <form action="{{url('/end-shift')}}" method="post">
                        @csrf
                        <div class="modal-content">
                          <br> <br>
                          <p align="center">
                            <strong><b style="color: red">Note</b> : <b>Mohon perhatikan jam sebelum menutup shift!</b></strong>
                          </p>
                          <div class="modal-body">
                            <div class="row">
                              <div class="col-md-3">
                                <label>Nama</label>
                                <input type="text" class="form-control" disabled value="{{Auth::user()->name}}">
                              </div>
                              <div class="col-md-3">
                                <label>Username</label>
                                <input type="text" class="form-control" disabled value="{{Auth::user()->username}}">
                              </div>
                              <div class="col-md-3">
                                <label>Shift</label>
                                <select class="form-control" disabled="" name="shift_id" required>
                                  <option selected disabled value="">Pilih Shift</option>
                                  @foreach($data as $key => $item)
                                    <option value="{{$item->id}}" 
                                            {{$shift->id == $item->id ? 'selected' : ''}}>
                                      {{$item->name}} : {{$item->start_time}} - {{$item->end_time}}
                                    </option>
                                  @endforeach
                                </select>
                              </div>
                            </div>
                            <br>
                            <div class="row">
                              <div class="col-md-6">
                                <label>Cash Di Tangan</label>
                                <input type="text" name="cash_in_hand" class="form-control" onkeypress="return hanyaAngka(event)" placeholder="Contoh : 50000" required readonly value="{{ number_format(Session::get('shift-session-cash-in'), 0, ',', '.') }}">
                              </div>
                              <div class="col-md-6">
                                <label>Cash Di Akhir</label>
                                <input type="text" name="end_cash"  class="form-control nominal" onkeypress="return hanyaAngka(event)" placeholder="Contoh : 50000" required value="{{ number_format(Session::get('shift-session-cash-end'), 0, ',', '.') }}">
                              </div>
                            </div>
                            <div class="row">
                              <div class="col-md-6">
                                <label>Jam Open</label>
                                <input type="text" name="open" readonly value="{{Session::get('shift-session-open')}}" class="form-control" >
                              </div>
                              <div class="col-md-6">
                                <label>Jam Close</label>
                                <input type="text" name="close" readonly value="{{$timeNow}}" class="form-control" >
                              </div>
                            </div>
                            <br> <br>
                            <div class="modal-footer justify-content-between">
                            <a class="btn btn-default" style="cursor: pointer;color: black;" 
                              href="{{url('dashboard')}}">
                              <i class="fas fa-arrow-left"></i>
                              &nbsp;
                                <b>Batal</b> 
                                
                              </a>
                            <button type="submit" class="btn btn-danger">
                              Tutup Shift &nbsp; <i class="fas fa-sign-out-alt"></i>
                            </button>
                          </div>
                        </div>
                      </form>
                      <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->
@endsection