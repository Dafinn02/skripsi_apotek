<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="{{url('dist/img/apotek.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" 
      style="opacity: .8;background-color: white;">
      <span class="brand-text font-weight-light">PD SUMEKAR</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image" style="opacity: 0">
          User :
        </div>
        <div class="info">
          <a href="#" class="d-block">
            <b>{{Auth::user()->name}}</b>
            
          </a>
        </div>
      </div>

      <!-- SidebarSearch Form -->

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        @include('layouts.wrapper.role.'.$role)
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>