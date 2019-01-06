<table class="table table-responsive" id="importItems-table">
    <thead>
        <tr>
            <th>Import Id</th>
        <th>Product Id</th>
        <th>Stock Id</th>
        <th>Value</th>
            <th colspan="3">Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($importItems as $importItem)
        <tr>
            <td>{!! $importItem->import_id !!}</td>
            <td>{!! $importItem->product_id !!}</td>
            <td>{!! $importItem->stock_id !!}</td>
            <td>{!! $importItem->value !!}</td>
            <td>
                {!! Form::open(['route' => ['importItems.destroy', $importItem->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('importItems.show', [$importItem->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('importItems.edit', [$importItem->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>