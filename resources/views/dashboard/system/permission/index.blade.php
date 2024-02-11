@extends('layouts.app')
@section('custom-css')

@endsection
@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Permission</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Sistem</a></li>
              <li class="breadcrumb-item active">Permission</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                @if($roleName != null)
                  <h3 class="card-title">Daftar data permission sistem role {{$roleName}} <br> <b>Berikan Centang Jika Ingin Diberi Akses dan Hilangkan Centang Jika Tidak Ingin Diberi Hak Akses</b></h3>
                @else
                  <h3 class="card-title">Silahkan Pilih Role Terlebih Dahulu untuk melihat permission</h3>
                @endif
                <br><br>
                <form id="get-permission" action="{{url('users/permission')}}">
                <div class="row">
                  <div class="col-md-10">
                     <select class="form-control" name="role_id" required on>
                      <option selected disabled value="">Pilih Role</option>
                        @foreach($role as $roleKey => $roleItem)
                          <option value="{{$roleItem->id}}" {{$roleItem->id == $request->role_id ? 'selected':''}}>
                            {{$roleItem->name}}
                          </option>
                        @endforeach
                    </select>
                  </div>
                  <div class="col-md-2">
                    <button class="btn btn-primary" type="submit">Lihat Permission</button>
                  </div>
                </div>
                </form>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                @if($roleName != null)
                <form id="update-permission"  method="POST" action="{{url('users/permission/update/'.$request->role_id)}}">
                  @csrf
                <div class="col-lg-12" align="right">
                  <input type="hidden" name="role_id" value="{{$request->role_id}}">
                    <button class="btn btn-warning" type="submit">Update Permission</button>
                </div>
                  <ul class="nav nav-pills nav-sidebar flex-column"  data-accordion="false">
                   @foreach($data as $menuKey => $menu)
                        @if(count($menu['item']) <= 0)
                          <li class="nav-item">
                            <a class="nav-link">
                              <i class="{{$menu['icon']}}"></i>
                              <p> &nbsp;
                                {{$menu['name']}}  &nbsp;&nbsp;
                                <input type="checkbox" 
                                       name="role_menu[{{$menuKey}}]" 
                                       {{$menu['visible'] ? 'checked' : ''}}>
                              </p>
                            </a>
                          </li>
                        @else
                          <li class="nav-item menu-is-opening menu-open">
                           <a  class="nav-link ">
                              <i class="{{$menu['icon']}}"></i>
                              <p>&nbsp;
                                  {{$menu['name']}}
                                <i class="right fas fa-angle-left"></i>
                              </p>
                            </a>
                            <ul class="nav nav-treeview" style="display: block;">
                              @foreach($menu['item'] as $itemKey => $item)
                                    <li class="nav-item">
                                      <a  class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>
                                          {{$item['name']}} &nbsp;&nbsp;  
                                          @if(count($item['child']) <= 0)
                                            @if($menu['visible'])
                                            <input type="checkbox" 
                                                   name="role_menu[{{$menuKey}}][{{$itemKey}}]" 
                                                   {{$item['visible'] ? 'checked' : ''}}>
                                            @else
                                            <input type="checkbox" 
                                                   name="role_menu[{{$menuKey}}][{{$itemKey}}]">
                                            @endif
                                          @endif
                                        </p>
                                      </a>
                                       <ul class="nav nav-treeview" style="display: block;">
                                        @foreach($item['child'] as $childKey => $child)
                                            <li class="nav-item">
                                              <a  class="nav-link">
                                                <i class="far fa-dot-circle nav-icon"></i>
                                                <p>
                                                {{$child['name']}}&nbsp;&nbsp;
                                                @if($item['visible'])
                                                <input type="checkbox" 
                                                       name="role_menu[{{$menuKey}}][{{$itemKey}}][{{$childKey}}]" 
                                                       {{$child['visible'] ? 'checked' : ''}}>
                                                @else
                                                <input type="checkbox" 
                                                       name="role_menu[{{$menuKey}}][{{$itemKey}}][{{$childKey}}]" 
                                                       >
                                                @endif
                                                </p>
                                              </a>
                                            </li>
                                        @endforeach
                                      </ul>
                                    </li>
                              @endforeach
                            </ul>
                          </li>
                        @endif
                   @endforeach
                  </ul>
                </form>
                @endif
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
</div>
@endsection
@section('custom-js')
@endsection