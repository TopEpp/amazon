<table class="table table-responsive" id="stocks-table">
    <thead>
        <tr>
            <th>Product Id</th>
        <th>Categoty Id</th>
        <th>Value</th>
        <th>User Id</th>
        <th>Order Id</th>
        <th>Import Id</th>
            <th colspan="3">Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($stocks as $stock)
        <tr>
            <td>{!! $stock->product_id !!}</td>
            <td>{!! $stock->categoty_id !!}</td>
            <td>{!! $stock->value !!}</td>
            <td>{!! $stock->user_id !!}</td>
            <td>{!! $stock->order_id !!}</td>
            <td>{!! $stock->import_id !!}</td>
            <td>
                {!! Form::open(['route' => ['stocks.destroy', $stock->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('stocks.show', [$stock->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('stocks.edit', [$stock->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>