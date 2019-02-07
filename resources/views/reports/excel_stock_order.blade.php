<table>
    <thead>
    <tr>
        <th>ชื่อสินค้า</th>
        <th>จำนวน</th>
    </tr>
    </thead>
    <tbody>
    @foreach($stocks as $key=> $item)
        <tr>
        
            <td>{{ $item->name }}</td>
            <td > {!! $item->value !!}</td>
            
        </tr>
    @endforeach
    </tbody>
</table>
