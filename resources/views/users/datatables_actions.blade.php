{!! Form::open(['route' => ['users.destroy', $id], 'method' => 'delete']) !!}
<div class='btn-group'>
    {{-- <a href="{{ route('users.show', $id) }}" class='btn btn-block btn-outline-warning btn-sm'>
        <i class="far fa-edit"></i>href="{{ route('users.edit', $id) }}"
    </a> --}}
    <button type="button" class="btn btn-custom" onclick="location.href='{{ route('users.edit', $id) }}';">แก้ไข</button>
    {!! Form::button('ลบ', [
        'type' => 'submit',
        'class' => 'btn btn-custom',
        'onclick' => "return confirm('ยืนยันการลบ?')"
    ]) !!}
</div>
{!! Form::close() !!}
