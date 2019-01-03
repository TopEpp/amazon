<table class="table table-responsive" id="orders-table">
    <thead>
        <tr>
            <th>User Id</th>
        <th>Product Id</th>
        <th>Value</th>
        <th>Date</th>
        <th>Price</th>
        <th>Remark</th>
        <th>Order Status</th>
            <th colspan="3">Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($orders as $order)
        <tr>
            <td>{!! $order->user_id !!}</td>
            <td>{!! $order->product_id !!}</td>
            <td>{!! $order->value !!}</td>
            <td>{!! $order->date !!}</td>
            <td>{!! $order->price !!}</td>
            <td>{!! $order->remark !!}</td>
            <td>{!! $order->order_status !!}</td>
            <td>
                {!! Form::open(['route' => ['orders.destroy', $order->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('orders.show', [$order->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('orders.edit', [$order->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>