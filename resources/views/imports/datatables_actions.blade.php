{!! Form::open(['route' => ['imports.destroy', $id], 'method' => 'delete']) !!}
<div class='btn-group'>

    {{-- <button type="button" class="btn btn-custom" onclick="location.href='{{ route('imports.show', $id) }}';">ดู</button> --}}
    <button type="button" class="btn btn-custom" onclick="location.href='{{ route('imports.edit', $id) }}';">แก้ไข</button>
    {!! Form::button('ลบ', [
        'type' => 'submit',
        'class' => 'btn btn-custom btn-xs',
        'onclick' => "return confirm('Are you sure?')"
    ]) !!}
</div>
{!! Form::close() !!}
