<table>
    <thead>
    <tr>
        <th>รหัสสินค้า</th>
        <th>ชื่อสินค้า</th>
        <th>หมวดหมู่</th>
        <th>จำนวนคงเหลือ</th>
    </tr>
    </thead>
    <tbody>
    @foreach($stocks as $key=> $item)
        <tr>
            <td >{!! $item->code !!}</td>
            <td > {!! $item->name !!}</td>
            <td >{!! $item->category !!}</td>
            <td > {!! $item->value !!}</td>
        </tr>
    @endforeach
    </tbody>
</table>
