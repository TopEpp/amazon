<!-- Name Field -->
<div class="form-group col-sm-12">
    {!! Form::label('name', 'ชื่อประเภทสินค้า') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('ยืนยัน', ['class' => 'btn btn-submit-custom']) !!}
    <a href="{!! route('categories.index') !!}" class="btn btn-default">ยกเลิก</a>
</div>
