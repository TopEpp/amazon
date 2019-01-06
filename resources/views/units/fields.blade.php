<!-- Name Field -->
<div class="form-group col-sm-12">
    {!! Form::label('name', 'ชื่อหน่วยนับ') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('บันทึก', ['class' => 'btn btn-submit-custom']) !!}
    <a href="{!! route('units.index') !!}" class="btn btn-default">ยกเลิก</a>
</div>
