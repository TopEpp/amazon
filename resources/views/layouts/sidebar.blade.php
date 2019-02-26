  <!-- Main Sidebar Container -->
<aside   class="main-sidebar sidebar-light-warning elevation-2  " style="background: #004B1B">
    <!-- Brand Logo -->
    <a href="/" class="brand-link">
        <img src="{!! asset('/img/logo.png') !!}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3">
        <span class="brand-text font-weight-light">ระบบจัดการคลังสินค้า</span>
    </a>
    {{-- <a href="#" class="brand-link">
    <div class="mt-3 text-center">
            <img src="/img/logo.png" alt="Logo" class=" img-circle elevation-3"
            style="opacity: .8">
    </div>
    </a> --}}


    <!-- Sidebar -->
    <div class="sidebar" >
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 ">
            <div class="widget-user">
                <!-- Add the bg color to the header using any of the bg-* classes -->
                <div class="widget-user-header bg-info-active">
                    <h5 class="widget-user-username">{!! Auth::user()->name !!}</h5>
                    <!-- <h5 class="widget-user-desc">ผู้ดูแลระบบ</h5> -->
                </div>
                <div class="widget-user-image">
                    <img class="img-circle elevation-2" src="{!! (Auth::user()->image)? asset('uploads/users').'/'.Auth::user()->image: asset('img').'/'.'face.png' !!}" alt="User Avatar">
                </div>
                <div class="card-footer card-info-footer">
                        @if (Auth::user()->type == 1)
                            <div class="float-left">
                                <a href="{!! route('users.edit', Auth::user()->id); !!}" class="d-inline-block text-left"
                                    onclick="">
                                    <i class="fas fa-user fa-lg"></i>
                                    แก้ไขข้อมูล 
                                </a>
                            </div>  
                        @endif
                       
                        <div class="float-right">
                            <a href="{!! url('/logout') !!}" class="d-inline-block text-left"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                ออกจากระบบ
                                <i class="fas fa-sign-out-alt fa-lg"></i>
                            </a>
                            <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        </div>
                    <!-- /.row -->
                </div>
            </div>
        </div>
        

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                    with font-awesome or any other icon font library -->
{{--              
                <li class="nav-item ">
                    <a href="#" class="nav-link active">
                        <i class="nav-icon fa fa-th"></i>
                        <p>
                        Simple Link
                        <span class="right badge badge-danger">New</span>
                        </p>
                    </a>
                </li> --}}

                @include('layouts.menu')
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
