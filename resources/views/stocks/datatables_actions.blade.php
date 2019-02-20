{!! Form::open(['route' => ['stocks.destroy', $id], 'method' => 'delete']) !!}
<div class='btn-group'>
  
    <button type="button" class="btn btn-custom" onclick="location.href='{{ route('stocks.edit', $id) }}';">แก้ไข</button>
    {!! Form::button('ลบ', [
        'type' => 'submit',
        'class' => 'btn btn-custom',
        'onclick' => "return confirm('ยืนยันการลบ?')"
    ]) !!}
</div>
{!! Form::close() !!}
