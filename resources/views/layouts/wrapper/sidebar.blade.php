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
        <div class="image">
          <img src="{{url('dist/img/user2-160x160.jpg')}}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">{{Auth::user()->name}}</a>
        </div>
      </div>

      <!-- SidebarSearch Form -->

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
         @foreach(Session::get('resultMenu') as $menuKey => $menu)
            @if($menu['visible'])
              @if(count($menu['item']) <= 0)
                <li class="nav-item">
                  <a href="{{url('/').'/'.$menu['route']}}" class="nav-link">
                    <i class="{{$menu['icon']}}"></i>
                    <p> &nbsp;
                      {{$menu['name']}}
                    </p>
                  </a>
                </li>
              @else
                <li class="nav-item">
                 <a href="{{url('/').'/'.$menu['route']}}" class="nav-link">
                    <i class="{{$menu['icon']}}"></i>
                    <p>&nbsp;
                        {{$menu['name']}}
                      <i class="right fas fa-angle-left"></i>
                    </p>
                  </a>
                  <ul class="nav nav-treeview">
                    @foreach($menu['item'] as $itemKey => $item)
                      @if($item['visible'])
                        @if(count($item['child']) <= 0)
                          <li class="nav-item">
                            <a href="{{url('/').'/'.$item['route']}}" class="nav-link">
                              <i class="far fa-circle nav-icon"></i>
                              <p>{{$item['name']}}</p>
                            </a>
                          </li>
                        @else
                          <li class="nav-item">
                            <a href="#" class="nav-link">
                              <i class="far fa-circle nav-icon"></i>
                              <p> &nbsp;
                                {{$item['name']}}
                                <i class="right fas fa-angle-left"></i>
                              </p>
                            </a>
                            <ul class="nav nav-treeview">
                              @foreach($item['child'] as $childKey => $child)
                                @if($child['visible'])
                                  <li class="nav-item">
                                    <a href="{{url('/').'/'.$child['route']}}" class="nav-link">
                                      <i class="far fa-dot-circle nav-icon"></i>
                                      <p>{{$child['name']}}</p>
                                    </a>
                                  </li>
                                @endif
                              @endforeach
                            </ul>
                          </li>
                        @endif
                      @endif
                    @endforeach
                  </ul>
                </li>
              @endif
            @endif
         @endforeach
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>