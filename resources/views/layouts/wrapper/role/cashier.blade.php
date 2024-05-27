<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" 
   data-accordion="false">
   @if(Session::get('shift-session-name') != null)
      <li class="nav-item">
         <a href="#" class="nav-link">
            <i class="nav-icon fas fa-cash-register"></i>
            <p>
               Penjualan
               <i class="fas fa-angle-left right"></i>
            </p>
         </a>
         <ul class="nav nav-treeview"
            style="display: block;padding-left: 10%;">
            <li class="nav-item">
               <a href="{{url('/penjualan/kasir-beli')}}" 
                  class="nav-link {{Request::segment(2) == 'kasir-beli' ? 'active' : ''}}">
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

      <li class="nav-item" style="padding-top:80%">
         <p class="nav-link" style="color: white"> 
            <br>Shift : <b>{{Session::get('shift-session-name')}}</b>
            <br>Open : <b>{{Session::get('shift-session-open')}}</b>
            <br>Cash in Hand : <b>Rp {{number_format(Session::get('shift-session-cash-in'), 0, ",", ".")}}</b>
            <br>Temporary Sales : <b>Rp {{number_format(Session::get('shift-session-cash-end'), 0, ",", ".")}}</b>         
            <br>Close : 
            <a class="cls-shift" href="#">
               <b style="color: white;">
                  Close Shift Now <i class="fas fa-sign-out-alt"></i>
               </b>
            </a>
            <form id="closeShiftForm" action="{{ url('close-shift') }}" style="display: none;">
               @csrf
            </form>  
         </p>
      </li>
   @endif
</ul>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
   $(document).ready(function() {
      $('.cls-shift').click(function(e) {
         e.preventDefault();
         const form = $('#closeShiftForm');
         Swal.fire({
            title: 'Apakah Anda Yakin?',
            text: "Menutup Shift Hari Ini!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#dc3545',
            cancelButtonColor: '#adb5bd',
            confirmButtonText: 'Ya, Tutup Shift!'
         }).then((result) => {
            if (result.isConfirmed) {
               form.submit();
            }
         });
      });
   });
</script>