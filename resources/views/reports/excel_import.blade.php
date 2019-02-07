<table>
    <thead>
    <tr>
        <th>หมายเลขอ้างอิง</th>
        <th>วันที่นำเข้า</th>
        <th>จำนวนสินค้า</th>
        <th>หมายเหตุ</th>
    </tr>
    </thead>
    <tbody>
    @foreach($imports as $key=> $item)
        <tr>
            <td>{!! $item->number !!}</td>
            <td >{!! Carbon\Carbon::createFromFormat('Y-m-d h:i:s', $item->date)->format('d/m/Y') !!}</td>
            <td>{{ $item->value }}</td>
            <td > {!! $item->remark !!}</td>
            
        </tr>
    @endforeach
    </tbody>
</table>
