{!! Form::open(['route' => ['categories.destroy', $id], 'method' => 'delete']) !!}
<div class='btn-group'>
    <button type="button" class="btn btn-custom" onclick="location.href='{{ route('categories.edit', $id) }}';">แก้ไข</button>

    {!! Form::button('ลบ', [
        'type' => 'submit',
        'class' => 'btn btn-custom btn-xs',
        'onclick' => "return confirm('Are you sure?')"
    ]) !!}
</div>
{!! Form::close() !!}
