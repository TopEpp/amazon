{!! Form::open(['route' => ['units.destroy', $id], 'method' => 'delete']) !!}
<div class='btn-group'>
    <button type="button" class="btn btn-custom" onclick="location.href='{{ route('units.edit', $id) }}';">แก้ไข</button>
    {!! Form::button('ลบ', [
        'type' => 'submit',
        'class' => 'btn btn-custom btn-xs',
        'onclick' => "return confirm('ยืนยันการลบ?')"
    ]) !!}
</div>
{!! Form::close() !!}
