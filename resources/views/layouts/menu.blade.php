{{-- <li class="nav-item ">
    <a class="nav-link {{ Request::is('products*') ? 'active' : '' }}" href="{!! route('products.index') !!}"><i class="fa fa-edit"></i><span>สินค้า</span></a>
</li> --}}

{{-- <li class="nav-item ">
    <a class="nav-link {{ Request::is('categories*') ? 'active' : '' }}" href="{!! route('categories.index') !!}"><i class="fa fa-edit"></i><span>ประเภทสินค้า</span></a>
</li> --}}



@can('isAdmin')
<li class="nav-item ">
    <a class="nav-link {{ (Request::is('/*') || Request::is('dashboard')) ? 'active' : '' }}" href="/dashboard"><i class="fas fa-home"></i> <span>หน้าหลัก</span></a>
</li>
@endcan

<li class="nav-item ">
    <a class="nav-link {{ Request::is('orders*') ? 'active' : '' }}" href="{!! route('orders.index') !!}"><i class="fas fa-tasks"></i> <span>สั่งสินค้า</span></a>
</li>


@can('isAdmin')
<li class="nav-item ">
    <a class="nav-link {{ Request::is('imports*') ? 'active' : '' }}" href="{!! route('imports.index') !!}"><i class="fa fa-edit"></i><span>นำเข้าสินค้า</span></a>
</li>

<li class="nav-item ">
    <a class="nav-link {{ (Request::is('stocks*') || Request::is('categories*') || Request::is('products*') || Request::is('units*')  ) ? 'active' : '' }}" href="{!! route('stocks.index') !!}"><i class="fas fa-store"></i> <span>ตั้งค่า</span></a>
</li>



{{-- 
<li class="nav-item ">
    <a class="nav-link {{ Request::is('units*') ? 'active' : '' }}" href="{!! route('units.index') !!}"><i class="fa fa-edit"></i><span>หน่วยนับ</span></a>
</li> --}}
<li class="nav-item ">
    <a class="nav-link {{ Request::is('report*') ? 'active' : '' }}" href="#"><i class="fas fa-chart-bar"></i> <span>รายงาน</span></a>
</li> 


    <li class="nav-item ">
        <a class="nav-link {{ Request::is('users*') ? 'active' : '' }}" href="{!! route('users.index') !!}"><i class="fas fa-users-cog"></i> <span>ผู้ใช้งาน</span></a>
    </li>
@endcan


