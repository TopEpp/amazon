<!-- Product Id Field -->
<div class="form-group col-sm-12">
    {!! Form::label('product_id', 'ชื่อสินค้า') !!}
    {!! Form::select('product_id', $product,null, ['class' => 'form-control']) !!}
</div>

<!-- Value Field -->
<div class="form-group col-sm-12">
    {!! Form::label('value', 'จำนวนสินค้า') !!}
    {!! Form::number('value', null, ['class' => 'form-control']) !!}
</div>






<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('บันทึก', ['class' => 'btn btn-submit-custom']) !!}
    <a href="{!! route('stocks.index') !!}" class="btn btn-default">ยกเลิก</a>
</div>
