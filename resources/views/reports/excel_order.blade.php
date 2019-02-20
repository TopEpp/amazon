<table>
    <thead>
    <tr>
        <th>เลขคำสั่ง</th>
        <th>ชื่อผู้สั่ง</th>
        <th>วันที่สั่ง</th>
        <th>จำนวนสินค้า</th>
        <th>ราคารวม</th>
    </tr>
    </thead>
    <tbody>
    @foreach($orders as $key=> $item)
        <tr>
            <td>{!! $item->id !!}</td>
            <td>{{ $item->name }}</td>
            <td >{!! Carbon\Carbon::createFromFormat('Y-m-d h:i:s', $item->date)->format('d/m/Y') !!}</td>
            <td > {!! $item->value !!}</td>
            <td > {!! $item->price !!}</td>
        </tr>
    @endforeach
    </tbody>
</table>
