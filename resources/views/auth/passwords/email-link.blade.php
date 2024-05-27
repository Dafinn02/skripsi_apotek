<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">

  <title>Apotek BUMD Sumekar</title>

  <!-- bootstrap minified css -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">

  <!-- custom stylesheet -->
  <link rel="stylesheet" href="{{url('login_assets/style.css')}}">
</head>
<body>
<div class="container d-flex align-items-center min-vh-100">
  <div class="row justify-content-center">

    <!-- start image column -->
    <div class="col-md-6">
      <img src="{{url('login_assets/img/12.jpg')}}" alt="image" class="img-fluid">
    </div><!-- end of image column -->

    <!-- start form column -->
    <div class="col-md-6">
        <div class="card mt-4">
          <div class="card-body">
            <div class="align-items-center text-center justify-content-center">
              <p><img  class="form_header" src="{{url('login_assets/img/logo-sumekar-2.png')}}" alt="Apotek Sumekar"></p>
            </div>
            <div class="align-items-center text-center justify-content-center">
              @if($message=Session::get('error'))
            <div class="alert alert-danger" role="alert">
                <div class="alert-text">{{ucwords($message)}}</div>
            </div>
            @endif
                <form action="/reset-password" method="post">
                  @csrf
                    <input type="hidden" name="token" value="{{ $token }}">
                    Masukkan password baru Anda.<br><br>
                    <div class="input-group input-group-lg mb-4 mx-auto">
                    <span class="input-group-text"><i class="fa fa-envelope"></i></span>
                    <input type="text" class="form-control form-control-lg" placeholder="Email" name="email" value="{{$email}}" required autofocus>
                    </div>
                    <div class="input-group input-group-lg mb-4 mx-auto">
                    <span class="input-group-text" id="basic-addon1"><i class="fa fa-lock"></i></span>
                    <input type="password" class="form-control form-control-lg" placeholder="Password" name="password" required>
                    </div>
                    <div class="input-group input-group-lg mb-4 mx-auto">
                    <span class="input-group-text" id="basic-addon1"><i class="fa fa-lock"></i></span>
                    <input type="password" class="form-control form-control-lg" placeholder="Ulangi Password" name="ulangi_password" required>
                    </div>
                    <div class="d-grid my-4">
                  <button type="submit" class="btn btn-lg btn-primary">Simpan</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div><!-- end of form column -->

  </div><!-- end of row -->
</div><!-- end of container -->

<!-- script files -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/js/all.min.js"></script>
<!-- end of script files -->
</body>
</html>

