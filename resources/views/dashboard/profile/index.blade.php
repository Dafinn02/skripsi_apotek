@extends('layouts.app')

@section('custom-css')
<link rel="stylesheet" href="{{url('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{url('plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{url('plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">

<link rel="stylesheet" href="{{url('plugins/select2/css/select2.min.css')}}">
<link rel="stylesheet" href="{{url('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
@endsection

@section('custom-js')
<script src="{{url('plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{url('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{url('plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{url('plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>

<script src="{{url('plugins/select2/js/select2.full.min.js')}}"></script>
<script type="text/javascript">
  $(function () {
    $('.select2').select2({
      theme: 'bootstrap4'
    })
  });

  $(function () {
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
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
<div class="content-wrapper">
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Profile</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Profile</li>
          </ol>
        </div>
      </div>
    </div>
  </section>

  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-6">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Unggah Gambar Profil</h3>
                </div>
                <div class="card-body">
                    <div class="text-center mb-4">
                        <div style="width: 150px; height: 150px; border: 1px solid #ced4da; border-radius: 8px; overflow: hidden; margin: auto;">
                            @if($data->foto != null)
                                <img src="{{ asset('storage/public/uploads/foto/'. $data->foto)}}" alt="Profile Picture" style="width: 100%; height: 100%; object-fit: cover;">
                            @else
                                <img src="{{ asset('dist/img/avatar.png')}}" alt="Profile Picture" style="width: 100%; height: 100%; object-fit: cover;">
                            @endif
                        </div>
                    </div>
                    <form action="{{url('profile/upload-foto')}}" enctype="multipart/form-data" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="profile_image">Pilih Gambar Profil</label>
                            <input type="file" id="profile_image" name="profile_image" class="form-control-file" accept="image/*" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Unggah</button>
                    </form>                    
                </div>
            </div>
        </div>

        <div class="col-md-6">
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Ganti Password</h3>
            </div>
            <div class="card-body">
              <form action="{{url('profile/change-password')}}" method="post">
                @csrf
                <div class="form-group">
                  <label for="username">Username</label>
                  <input type="text" id="username" class="form-control" value="{{ Auth::user()->username }}" disabled>
                </div>
                <div class="form-group">
                  <label for="old_password">Password Lama</label>
                  <input type="password" id="old_password" name="old_password" class="form-control" required>
                </div>
                <div class="form-group">
                  <label for="password">Password Baru</label>
                  <input type="password" id="password" name="password" class="form-control" required>
                  @if($errors->has('password'))
                    <div class="text-danger">{{ $errors->first('password') }}</div>
                  @endif
                </div>
                <div class="form-group">
                  <label for="password_confirmation">Ulangi Password Baru</label>
                  <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" required>
                  @if($errors->has('password'))
                    <div class="text-danger">{{ $errors->first('password') }}</div>
                  @endif
                </div>
                <button type="submit" class="btn btn-primary">Simpan</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
@endsection
