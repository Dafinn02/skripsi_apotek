<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Apotek BUMD Sumekar</title>
    <link rel="icon" type="image/x-icon" href="{{url('dist/img/apotek.png')}}">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @include('layouts.custom.custom-css')
      <!-- bootstrap minified css -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">

    <!-- custom stylesheet -->
    <link rel="stylesheet" href="{{url('login_assets/style.css')}}">
  </head>
<body class="hold-transition login-page">
  @yield('content')
  @include('sweetalert::alert')
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/js/all.min.js"></script>
</body>
</html>
