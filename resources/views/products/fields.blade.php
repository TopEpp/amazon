<!-- Category Id Field -->
<div class="form-group col-sm-12">
    {!! Form::label('category_id', 'ประเภทสินค้า') !!}
    {!! Form::select('category_id',$category, null, ['class' => 'form-control']) !!}
</div>

<!-- Name Field -->
<div class="form-group col-sm-12">
    {!! Form::label('name', 'ชื่อสินค้า') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<!-- Price Field -->
<div class="form-group col-sm-12">
    {!! Form::label('price', 'ราคา') !!}
    {!! Form::number('price', null, ['class' => 'form-control']) !!}
</div>

<!-- Unit Id Field -->
<div class="form-group col-sm-12">
    {!! Form::label('unit_id', 'หน่วยนับ') !!}
    {!! Form::select('unit_id',$unit, null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('บันทึก', ['class' => 'btn btn-submit-custom']) !!}
    <a href="{!! route('products.index') !!}" class="btn btn-default">ยกเลิก</a>
</div>
