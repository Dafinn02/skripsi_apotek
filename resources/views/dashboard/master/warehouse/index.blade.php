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
          <h1>Daftar Gudang</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Gudang</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row mb-2 d-flex justify-content-end mr-auto">
        <div class="ml-auto">
          @if(Auth::user()->role != 'head_office')
          <a style="cursor: pointer;" type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-create">
            <i class="fas fa-plus"></i>
            Tambah Data
          </a>
          @endif
        </div>
      </div>
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Daftar data gudang</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example2" class="table table-bordered table-hover">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Rack</th>
                    <th>Action</th>
                  </tr>
                </thead>
                @foreach($data as $key => $item)
                @include('dashboard.master.warehouse.modal-edit')
                  <tr>
                    <td>{{$key+1}}</td>
                    <td>{{$item->name}}</td>
                    <td>
                      @if(Auth::user()->role != 'head_office')
                      <a style="color: black;" class="btn btn-danger btn-sm"
                         href="{{url('/master/gudang-rak/'.$item->id)}}">
                        Kelola Data Rack <i class="fas fa-warehouse"></i>
                      </a> 
                      @endif
                    </td>
                    <td>
                      @if(Auth::user()->role != 'head_office')
                      <a class="btn btn-info btn-sm" 
                         data-toggle="modal" data-target="#modal-edit-{{$item->id}}">
                         <i class="fas fa-pencil-alt">
                        </i>
                        Edit
                      </a>
                      &nbsp;
                      <a class="btn btn-danger btn-sm ondelete"
                         href="{{url('/master/gudang/delete/'.$item->id)}}">
                        <i class="fas fa-trash"></i>
                        Delete
                      </a>  
                      @endif
                    </td>
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
    @include('dashboard.master.warehouse.modal-create')
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->
@endsection