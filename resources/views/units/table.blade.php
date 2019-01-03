<table class="table table-responsive" id="units-table">
    <thead>
        <tr>
            <th>Name</th>
            <th colspan="3">Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($units as $unit)
        <tr>
            <td>{!! $unit->name !!}</td>
            <td>
                {!! Form::open(['route' => ['units.destroy', $unit->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('units.show', [$unit->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('units.edit', [$unit->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>