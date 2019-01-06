<!-- Import Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('import_id', 'Import Id:') !!}
    {!! Form::number('import_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Product Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('product_id', 'Product Id:') !!}
    {!! Form::number('product_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Stock Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('stock_id', 'Stock Id:') !!}
    {!! Form::number('stock_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Value Field -->
<div class="form-group col-sm-6">
    {!! Form::label('value', 'Value:') !!}
    {!! Form::number('value', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('importItems.index') !!}" class="btn btn-default">Cancel</a>
</div>
