{{-- <li class="nav-item ">
    <a class="nav-link {{ Request::is('products*') ? 'active' : '' }}" href="{!! route('products.index') !!}"><i class="fa fa-edit"></i><span>สินค้า</span></a>
</li> --}}

{{-- <li class="nav-item ">
    <a class="nav-link {{ Request::is('categories*') ? 'active' : '' }}" href="{!! route('categories.index') !!}"><i class="fa fa-edit"></i><span>ประเภทสินค้า</span></a>
</li> --}}



@can('isAdmin')
<li class="nav-item ">
    <a class="nav-link {{ (Request::is('/*') || Request::is('dashboard')) ? 'active' : '' }}" href="{!! url('dashboard') !!}"><i class="icofont-home  icofont-2x"></i> <span>หน้าหลัก</span></a>
</li>
@endcan

<li class="nav-item ">
    <a class="nav-link {{ Request::is('orders*') ? 'active' : '' }}" href="{!! route('orders.index') !!}"><i class="icofont-tasks icofont-2x"></i> <span>สั่งสินค้า</span></a>
</li>


@can('isAdmin')
<li class="nav-item ">
    <a class="nav-link {{ Request::is('imports*') ? 'active' : '' }}" href="{!! route('imports.index') !!}"><i class="icofont-edit-alt icofont-2x"></i><span>นำเข้าสินค้า</span></a>
</li>

<li class="nav-item ">
    <a class="nav-link {{ (Request::is('stocks*') || Request::is('categories*') || Request::is('products*') || Request::is('units*')  ) ? 'active' : '' }}" href="{!! route('stocks.index') !!}"><i class="icofont-settings icofont-2x"></i> <span>ตั้งค่า</span></a>
</li>



{{-- 
<li class="nav-item ">
    <a class="nav-link {{ Request::is('units*') ? 'active' : '' }}" href="{!! route('units.index') !!}"><i class="fa fa-edit"></i><span>หน่วยนับ</span></a>
</li> --}}
{{-- <li class="nav-item ">
    <a class="nav-link {{ Request::is('report*') ? 'active' : '' }}" href="#"><i class="fas fa-chart-bar"></i> <span>รายงาน</span></a>
</li> --}}
<li class="nav-item has-treeview {{ Request::is('report*') ? 'menu-open' : '' }} ">
    <a href="#" class="nav-link  {{ Request::is('report*') ? 'active' : '' }}">
        <i class="icofont-spreadsheet  icofont-2x"></i>
      <p>
        รายงาน
        <i class="right icofont-caret-left icofont-rotate-0"></i>
      </p>
    </a>
    <ul class="nav nav-treeview">
      <li class="nav-item">
        <a href="{!! url('/report_order') !!} " class="nav-link {{ Request::is('report_order') ? 'actives' : '' }}">
         
          <p>รายงานการสั่งสินค้า</p>
        </a>
      </li>
      <li class="nav-item">
        <a href="{!! url('/report_import') !!} " class="nav-link {{ Request::is('report_import') ? 'actives' : '' }}">
         
          <p>รายงานการนำเข้าสินค้า</p>
        </a>
      </li>
      <li class="nav-item">
        <a href="{!! url('/report_stock') !!} " class="nav-link {{ Request::is('report_stock') ? 'actives' : '' }}">
         
          <p>รายงานสรุปจำนวนสินค้าในคลัง</p>
        </a>
      </li>
      <li class="nav-item">
        <a href="{!! url('/report_stock_order') !!} " class="nav-link {{ Request::is('report_stock_order') ? 'actives' : '' }}">
         
          <p>รายงานสรุปจำนวนสินค้าที่ใช้</p>
        </a>
      </li>
    </ul>
</li> 


    <li class="nav-item ">
        <a class="nav-link {{ Request::is('users*') ? 'active' : '' }}" href="{!! route('users.index') !!}"><i class="icofont-users-alt-6  icofont-2x"></i> <span>ผู้ใช้งาน</span></a>
    </li>
@endcan


