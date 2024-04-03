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
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" 
            data-accordion="false">
         @if(Auth::user()->role == 'admin')
          <li class="nav-item">
            <a href="{{url('dashboard')}}" 
               class="nav-link {{Request::segment(1) == 'dashboard' ? 'active' : ''}}">
              <i class="fas fa-home"></i>
              <p> &nbsp;
                Dashboard
              </p>
            </a>
          </li>
          @endif
          @if(Auth::user()->role == 'kasir' || Auth::user()->role == 'admin')
          <li class="nav-header">----------PENJUALAN----------</li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-bookmark"></i>
              <p>
                Penjualan
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview"
                style="display: {{Request::segment(2) == 'penjualan' ? 'block' : ''}};padding-left: 10%;">
              <li class="nav-item">
                <a href="{{url('/penjualan/kasir')}}" 
                   class="nav-link {{Request::segment(2) == 'kasir' ? 'active' : ''}}">
                  <i class="fas fa-money-bill-wave-alt"></i>
                  <p> &nbsp;
                    Kasir
                  </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{url('penjualan/transaksi')}}" 
                   class="nav-link {{Request::segment(2) == 'transaksi' ? 'active' : ''}}">
                  <i class="fas fa-exchange-alt"></i>
                  <p> &nbsp;
                    Transaksi
                  </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{url('penjualan/pelanggan')}}" 
                   class="nav-link {{Request::segment(2) == 'pelanggan' ? 'active' : ''}}">
                  <i class="fas fa-users"></i>
                  <p> &nbsp;
                    Pelanggan
                  </p>
                </a>
              </li>
            </ul>
          </li>
          @endif
          @if(Auth::user()->role == 'admin')
          <li class="nav-header">----------PEMBELIAN----------</li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-money-check"></i>
              <p>
                Pembelian
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>  
            <ul class="nav nav-treeview"
                style="display: {{Request::segment(1) == 'pembelian' ? 'block' : ''}};padding-left: 10%;">
              <li class="nav-item">
                <a href="{{url('/pembelian/supplier')}}" 
                   class="nav-link {{Request::segment(2) == 'supplier' ? 'active' : ''}}">
                  <i class="fas fa-truck"></i>
                  <p> &nbsp;
                    Supplier
                  </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{url('/pembelian/rencana')}}" 
                   class="nav-link {{Request::segment(2) == 'rencana' ? 'active' : ''}}">
                  <i class="fas fa-tasks"></i>
                  <p> &nbsp;
                    Rencana
                  </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{url('/pembelian/pesanan')}}" 
                   class="nav-link {{Request::segment(2) == 'pesanan' ? 'active' : ''}}">
                  <i class="fas fa-hand-holding-usd"></i>
                  <p> &nbsp;
                    Pesanan
                  </p>
                </a>
              </li>
           </ul>
          </li>
          @endif
          @if(Auth::user()->role == 'admin')
          <li class="nav-header">----------PERSEDIAAN----------</li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-check"></i>
              <p>
                Persediaan
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview"
                style="display: {{Request::segment(1) == 'persediaan' ? 'block' : ''}};padding-left: 10%;">
              <li class="nav-item">
              <a href="{{url('persediaan/stock_masuk')}}" 
                 class="nav-link {{Request::segment(2) == 'stock_masuk' ? 'active' : ''}}">
                <i class="fas fa-arrow-right"></i>
                <p> &nbsp;
                  Stock Masuk
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{url('persediaan/stock_keluar')}}" 
                 class="nav-link {{Request::segment(2) == 'stock_keluar' ? 'active' : ''}}">
                <i class="fas fa-arrow-left"></i>
                <p> &nbsp;
                  Stock Keluar
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{url('persediaan/stock_opname')}}" 
                 class="nav-link {{Request::segment(2) == 'stock_opname' ? 'active' : ''}}">
                <i class="fas fa-hand-holding-usd"></i>
                <p> &nbsp;
                  Stock Opname
                </p>
              </a>
            </li>
           </ul>
          </li>
          @endif
          @if(Auth::user()->role == 'admin')
          <li class="nav-header">------------MASTER-------------</li>
          <li class="nav-item ">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-database"></i>
              <p>
                Produk
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview" 
                style="display: {{Request::segment(2) == 'produk' ? 'block' : ''}};padding-left: 10%;">
              <li class="nav-item"> 
                <a href="{{url('/master/produk/kategori')}}" 
                   class="nav-link {{Request::segment(3) == 'kategori' ? 'active' : ''}}">
                  <i class="fas fa-chalkboard"></i>
                  <p>&nbsp;Kategori</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{url('/master/produk/unit')}}" 
                   class="nav-link {{Request::segment(3) == 'unit' ? 'active' : ''}}">
                  <i class="fas fa-chalkboard"></i>
                  <p>&nbsp;Unit</p>
                </a>
              </li>
              <li class="nav-item">
                @if(Request::segment(2) == 'produk' && Request::segment(3) == null)
                <a href="{{url('/master/produk')}}" 
                   class="nav-link active">
                @else
                <a href="{{url('/master/produk')}}" 
                   class="nav-link">
                @endif
                  <i class="fas fa-file-contract"></i>
                  <p>&nbsp;Data</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-warehouse"></i>
              <p>
                Gudang
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview" 
                style="display: {{(Request::segment(2) == 'gudang' ? 'block' : Request::segment(2) == 'rak') ? 'block' : ''}};padding-left: 10%;">
              <li class="nav-item">
                <a href="{{url('/master/rak')}}" 
                class="nav-link {{Request::segment(2) == 'rak' ? 'active' : ''}}">
                  <i class="fas fa-building"></i>
                  <p>&nbsp;Rak</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{url('/master/gudang')}}" 
                class="nav-link {{Request::segment(2) == 'gudang' ? 'active' : ''}}">
                  <i class="fas fa-building"></i>
                  <p>&nbsp;Data</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-user"></i>
              <p>
                Pengguna
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview" 
                style="display: {{Request::segment(1) == 'pengguna' ? 'block' : ''}};padding-left: 10%;">
              <li class="nav-item">
                <a href="{{url('/pengguna/kasir')}}" 
                   class="nav-link {{Request::segment(2) == 'kasir' ? 'active' : ''}}">
                  <i class="fas fa-users"></i>
                  <p> &nbsp;
                    Kasir
                  </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{url('pengguna/shift')}}" 
                   class="nav-link {{Request::segment(2) == 'shift' ? 'active' : ''}}">
                  <i class="fas fa-clock"></i>
                  <p>&nbsp;Shift</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{url('pengguna/log')}}" 
                   class="nav-link {{Request::segment(2) == 'log' ? 'active' : ''}}">
                  <i class="fas fa-user-clock"></i>
                  <p>&nbsp;Log</p>
                </a>
              </li>
            </ul>
          </li>
          @endif
          @if(Auth::user()->role == 'admin')
          <li class="nav-header">----------LAPORAN----------</li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-file-export"></i>
              <p>
                Laporan
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview"
                style="display: {{Request::segment(1) == 'laporan' ? 'block' : ''}};padding-left: 10%;">
              <li class="nav-item">
              <a href="{{url('laporan/report_pernjualan')}}" 
                 class="nav-link {{Request::segment(2) == 'report_pernjualan' ? 'active' : ''}}">
                <i class="fas fa-bookmark"></i>
                <p> &nbsp;
                  Penjualan
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{url('laporan/report_pembelian')}}" 
                 class="nav-link {{Request::segment(2) == 'report_pembelian' ? 'active' : ''}}">
                <i class="fas fa-money-check"></i>
                <p> &nbsp;
                  Pembelian
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{url('laporan/report_persediaan')}}" 
                 class="nav-link {{Request::segment(2) == 'report_persediaan' ? 'active' : ''}}">
                <i class="fas fas fa-check"></i>
                <p> &nbsp;
                  Persediaan
                </p>
              </a>
            </li>
           </ul>
          </li>
          @endif
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>