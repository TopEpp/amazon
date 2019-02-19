<div class="row">
    <!-- Name Field -->
    <div class="form-group col-md-6">
        {!! Form::label('code', 'รหัสสินค้า') !!}
        {!! Form::text('code', null, ['class' => 'form-control']) !!}
    </div>

    <!-- Name Field -->
    <div class="form-group col-md-6">
        {!! Form::label('name', 'ชื่อสินค้า') !!}
        {!! Form::text('name', null, ['class' => 'form-control']) !!}
    </div>
</div>
<div class="row">
    <!-- Category Id Field -->
    <div class="form-group col-sm-12">
        {!! Form::label('category_id', 'ประเภทสินค้า') !!}
        {!! Form::select('category_id',$category, null, ['class' => 'form-control']) !!}
    </div>
</div>

<div class="row">
    <!-- Price Field -->
    <div class="form-group col-sm-12">
        {!! Form::label('price', 'ราคา') !!}
        {!! Form::text('price', null, ['class' => 'form-control numeric']) !!}
    </div>
</div>

<div class="row">
    <!-- Unit Id Field -->
    <div class="form-group col-sm-12">
        {!! Form::label('unit_id', 'หน่วยนับ') !!}
        {!! Form::select('unit_id',$unit, null, ['class' => 'form-control']) !!}
    </div>
</div>

<input type="hidden" name="stock_id" value="{!! (!empty($product->stock)) ? $product->stock->id:'' !!}">


<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('บันทึก', ['class' => 'btn btn-submit-custom']) !!}
    <a href="{!! route('stocks.index') !!}" class="btn btn-default">ยกเลิก</a>
</div>
