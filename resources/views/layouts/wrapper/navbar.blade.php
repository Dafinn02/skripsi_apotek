<!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>

    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Navbar Search -->


      <!-- Messages Dropdown Menu -->

      <!-- Notifications Dropdown Menu -->

      <li class="nav-item">
        <a class="nav-link" role="button">
          <b>{{Auth::user()->name}}</b> &nbsp;
          <i class="fas fa-user"></i>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-controlsidebar-slide="true" style="cursor: pointer;color: black;" 
         href="{{ url('/logout') }}"
         onclick="event.preventDefault(); document.getElementById('logout-form').submit();" role="button">
          <b>Keluar</b> &nbsp;
          <i class="fas fa-sign-out-alt"></i>
        </a>
        <form id="logout-form" action="{{url('/logout')}}" method="GET" class="d-none">
        @csrf
      </form>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->