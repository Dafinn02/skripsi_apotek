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
  $(function () {
    $('.select2').select2({
      theme: 'bootstrap4'
    })
  });
</script>
<script type="text/javascript">
  $(function () {
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
  function optionForm(id) {
    document.getElementById(id).submit();
    return false;
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
          <h1>Laporan Shift</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Laporan Shift</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-12">
          <div class="card">
            <div class="card-body">
              <form action="{{url('laporan/report_shift')}}" id="form-option">
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Cari Berdasarkan Kasir</label>
                     <select class="form-control" name="user">
                       <option value="" selected disabled>Pilih  Kasir</option>
                       <option value="">All</option>
                       @foreach($user as $uKey => $uItem)
                        <option value="{{$uItem->id}}" {{$request->user == $uItem->id ? 'selected' : ''}}>
                          {{$uItem->name}}
                        </option>
                       @endforeach
                     </select>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Cari Berdasarkan Shift</label>
                    <select class="form-control" name="shift">
                       <option value="" selected disabled>Pilih Shift</option>
                       <option value="">All</option>
                       @foreach($shift as $sKey => $sItem)
                        <option value="{{$sItem->id}}" {{$request->shift == $sItem->id ? 'selected' : ''}}>
                          {{$sItem->name}} : {{$sItem->start_time}} - {{$sItem->end_time}}
                        </option>
                       @endforeach
                     </select>
                  </div>
                </div>
              </div>
              <br>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Tanggal Start</label>
                    <div class="input-group">
                      <input type="date" name="start_date" class="form-control" placeholder="Cari data..." value="{{$request->start_date}}">
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Tanggal End</label>
                    <div class="input-group">
                      <input type="date" name="end_date" class="form-control" placeholder="Cari data..." value="{{$request->end_date}}">
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-12" align="right">
                <button class="btn btn-primary" type="submit"><i class="fas fa-search"></i> Filter</button>
              </div>
              </form>
            </div>
          </div>
        </div>
      </div>
        <div class="row mb-2 d-flex justify-content-end mr-auto">
        <div class="ml-auto">
          <a href="{{url('laporan/report_shift/export')}}" target="_blank" type="button" class="btn btn-primary">
            <i class="fas fa-download"></i>
            Export
          </a>
        </div>
      </div>

      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Daftar data laporan shift</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
               <table id="example2" class="table table-bordered table-hover">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Kasir</th>
                    <th>Shift</th>
                    <th>Dibuka</th>
                    <th>Ditutup</th>
                    <th>Saldo Awal</th>
                    <th>Saldo Akhir</th>
                  </tr>
                </thead>
                @foreach($data as $key => $item)
                  <tr>  
                    <td>{{$key+1}}</td>
                    <td>{{$item['user_name']}}</td>
                    <td>{{$item['shift_name']}} ( {{$item['start_time']}} - {{$item['end_time']}} ) </td>
                    <td>{{ \Carbon\Carbon::make($item['date_start'])->format('d F Y')}} {{$item['start']}}</td>
                    <td>
                      @if($item['date_end'] == null)
                        -
                      @else
                        {{ \Carbon\Carbon::make($item['date_end'])->format('d F Y')}} {{$item['end']}}
                      @endif
                    </td>
                    <td>Rp {{number_format($item['cash_in_hand'], 0, ",", ".")}}</td>
                    <td>Rp {{number_format($item['end_cash'], 0, ",", ".")}}</td>
                  </tr>
                @endforeach
                <tbody>
                </tbody>
              </table>
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