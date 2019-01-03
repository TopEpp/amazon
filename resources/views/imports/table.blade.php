<table class="table table-responsive" id="imports-table">
    <thead>
        <tr>
            <th>User Id</th>
        <th>Product Id</th>
        <th>Value</th>
        <th>Date</th>
        <th>Price</th>
        <th>Remark</th>
        <th>Import Status</th>
            <th colspan="3">Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($imports as $import)
        <tr>
            <td>{!! $import->user_id !!}</td>
            <td>{!! $import->product_id !!}</td>
            <td>{!! $import->value !!}</td>
            <td>{!! $import->date !!}</td>
            <td>{!! $import->price !!}</td>
            <td>{!! $import->remark !!}</td>
            <td>{!! $import->import_status !!}</td>
            <td>
                {!! Form::open(['route' => ['imports.destroy', $import->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('imports.show', [$import->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('imports.edit', [$import->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>