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
          <h1>Buka Shift</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Start Shift</li>
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
              <h3 class="card-title">Silahkan Buka Shift Anda</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                    <div class="modal-dialog modal-xl">
                     
                        <div class="modal-content">
                          <br> <br>
                          <div class="modal-body">
                            <div class="row">
                              <div class="col-md-12">
                                <p>
                                  Mohon maaf, {{Auth::user()->name}} untuk saat ini anda tidak bisa memulai shift karena salah satu kasir / pegawai bernama 
                                  <b>
                                    {{$data->name}}
                                  </b>
                                  <br>
                                  Masih melakukan shift <b>{{$shift->name}}</b> Jika seharusnya shift 
                                  <b>
                                    {{$data->name}}
                                  </b> sudah berakhir mohon beritahu beliau untuk menutup shift terlebih dahulu
                                </p>
                              </div>
                            </div>
                            <br>
                            <br> <br>
                            <div class="modal-footer justify-content-between">
                              <a class="btn btn-default" style="cursor: pointer;color: black;" 
                               href="{{ url('/logout') }}"
                               onclick="event.preventDefault(); document.getElementById('logout-form').submit();" role="button">
                                <b>Keluar</b> &nbsp;
                                <i class="fas fa-sign-out-alt"></i>
                              </a>
                          </div>
                        </div>
                      
                      <form id="logout-form" action="{{url('/logout')}}" method="GET" class="d-none">
                        @csrf
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