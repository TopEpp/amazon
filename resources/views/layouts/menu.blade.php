<li class="{{ Request::is('products*') ? 'active' : '' }}">
    <a href="{!! route('products.index') !!}"><i class="fa fa-edit"></i><span>สินค้า</span></a>
</li>

<li class="{{ Request::is('categories*') ? 'active' : '' }}">
    <a href="{!! route('categories.index') !!}"><i class="fa fa-edit"></i><span>ประเภทสินค้า</span></a>
</li>


<li class="{{ Request::is('stocks*') ? 'active' : '' }}">
    <a href="{!! route('stocks.index') !!}"><i class="fa fa-edit"></i><span>คลังสินค้า</span></a>
</li>

<li class="{{ Request::is('imports*') ? 'active' : '' }}">
    <a href="{!! route('imports.index') !!}"><i class="fa fa-edit"></i><span>นำเข้าสินค้า</span></a>
</li>

<li class="{{ Request::is('orders*') ? 'active' : '' }}">
    <a href="{!! route('orders.index') !!}"><i class="fa fa-edit"></i><span>สั่งสินค้า</span></a>
</li>

<li class="{{ Request::is('users*') ? 'active' : '' }}">
    <a href="{!! route('users.index') !!}"><i class="fa fa-edit"></i><span>ผู้ใช้งาน</span></a>
</li>

<li class="{{ Request::is('units*') ? 'active' : '' }}">
    <a href="{!! route('units.index') !!}"><i class="fa fa-edit"></i><span>หน่วยนับ</span></a>
</li>
