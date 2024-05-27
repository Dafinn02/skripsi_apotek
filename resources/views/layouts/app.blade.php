<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Apotek Sumekar | {{ucwords(strtolower(Request::segment(1)))}} {{ucwords(strtolower(Request::segment(2)))}}</title>
  <link rel="icon" type="image/x-icon" href="{{url('dist/img/apotek.png')}}">
  @include('layouts.custom.custom-css')
  @yield('custom-css')

</head>
<body class="hold-transition sidebar-mini layout-fixed">

<div class="wrapper">
  @php $role = Auth::user()->role @endphp
  @php $foto = Auth::user()->foto @endphp
  <!-- Navbar -->
  @include('layouts.wrapper.navbar')
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  @include('layouts.wrapper.sidebar')

  <!-- Content Wrapper. Contains page content -->
  @yield('content')

  <!-- /.content-wrapper -->
  @include('layouts.wrapper.footer')

</div>
<!-- ./wrapper -->
</body>

@include('layouts.custom.custom-js')
@yield('custom-js')
    <script>
        // Array untuk nama bulan dalam bahasa Indonesia
        const months = [
            'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 
            'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
        ];

        // Fungsi untuk memperbarui waktu dan tanggal
        function updateTime() {
            const now = new Date(); // Waktu saat ini
            
            // Dapatkan komponen tanggal
            const year = now.getFullYear(); // Tahun
            const month = months[now.getMonth()]; // Nama bulan
            const day = now.getDate(); // Hari dalam bulan
            
            // Dapatkan komponen waktu
            const hours = now.getHours().toString().padStart(2, '0'); // Jam (24 jam)
            const minutes = now.getMinutes().toString().padStart(2, '0'); // Menit
            const seconds = now.getSeconds().toString().padStart(2, '0'); // Detik
            
            // Format tanggal dalam gaya Indonesia
            const dateString = `${day} ${month} ${year}`; // Misalnya, "26 April 2024"
            const timeString = `${hours}:${minutes}:${seconds}`; // Waktu dalam format HH:MM:SS
            
            // Gabungan tanggal dan waktu
            const fullString = `${dateString} ${timeString}`; // Misalnya, "26 April 2024 14:30:15"
            
            // Perbarui elemen HTML dengan waktu dan tanggal saat ini
            document.getElementById('clock').innerText = fullString;
        }

        // Memperbarui waktu dan tanggal setiap detik
        setInterval(updateTime, 1000);

        // Panggil fungsi pertama kali untuk menampilkan waktu dan tanggal segera
        updateTime();
    </script>
</html>
