{{-- <li class="nav-item ">
    <a class="nav-link {{ Request::is('products*') ? 'active' : '' }}" href="{!! route('products.index') !!}"><i class="fa fa-edit"></i><span>สินค้า</span></a>
</li> --}}

{{-- <li class="nav-item ">
    <a class="nav-link {{ Request::is('categories*') ? 'active' : '' }}" href="{!! route('categories.index') !!}"><i class="fa fa-edit"></i><span>ประเภทสินค้า</span></a>
</li> --}}

<li class="nav-item ">
    <a class="nav-link {{ Request::is('home*') ? 'active' : '' }}" href="{!! route('home.index') !!}"><i class="fas fa-home"></i> <span>หน้าหลัก</span></a>
</li>

<li class="nav-item ">
    <a class="nav-link {{ Request::is('orders*') ? 'active' : '' }}" href="{!! route('orders.index') !!}"><i class="fas fa-tasks"></i> <span>สั่งสินค้า</span></a>
</li>

<li class="nav-item ">
    <a class="nav-link {{ Request::is('stocks*') ? 'active' : '' }}" href="{!! route('stocks.index') !!}"><i class="fas fa-store"></i> <span>คลังสินค้า</span></a>
</li>

{{-- <li class="nav-item ">
    <a class="nav-link {{ Request::is('imports*') ? 'active' : '' }}" href="{!! route('imports.index') !!}"><i class="fa fa-edit"></i><span>นำเข้าสินค้า</span></a>
</li> --}}


{{-- 
<li class="nav-item ">
    <a class="nav-link {{ Request::is('units*') ? 'active' : '' }}" href="{!! route('units.index') !!}"><i class="fa fa-edit"></i><span>หน่วยนับ</span></a>
</li> --}}
<li class="nav-item ">
    <a class="nav-link {{ Request::is('report*') ? 'active' : '' }}" href="{!! route('units.index') !!}"><i class="fas fa-chart-bar"></i> <span>รายงาน</span></a>
</li> 


<li class="nav-item ">
    <a class="nav-link {{ Request::is('users*') ? 'active' : '' }}" href="{!! route('users.index') !!}"><i class="fas fa-users-cog"></i> <span>ผู้ใช้งาน</span></a>
</li>

