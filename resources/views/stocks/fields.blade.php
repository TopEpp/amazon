<!-- Product Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('product_id', 'Product Id:') !!}
    {!! Form::number('product_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Categoty Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('categoty_id', 'Categoty Id:') !!}
    {!! Form::number('categoty_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Value Field -->
<div class="form-group col-sm-6">
    {!! Form::label('value', 'Value:') !!}
    {!! Form::number('value', null, ['class' => 'form-control']) !!}
</div>

<!-- User Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('user_id', 'User Id:') !!}
    {!! Form::number('user_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Order Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('order_id', 'Order Id:') !!}
    {!! Form::number('order_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Import Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('import_id', 'Import Id:') !!}
    {!! Form::number('import_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('stocks.index') !!}" class="btn btn-default">Cancel</a>
</div>
