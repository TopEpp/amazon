{!! Form::open(['route' => ['products.destroy', $id], 'method' => 'delete']) !!}
<div class='btn-group'>
    <button type="button" class="btn btn-custom" onclick="location.href='{{ route('products.edit', $id) }}';">แก้ไข</button>
    {!! Form::button('ลบ', [
        'type' => 'submit',
        'class' => 'btn btn-custom',
        'onclick' => "return confirm('Are you sure?')"
    ]) !!}
</div>
{!! Form::close() !!}
