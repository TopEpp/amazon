<div class="row">
    <div class="col-md-6">
        <!-- Product Id Field -->
        <div class="form-group">
            {!! Form::label('product_id', 'ชื่อสินค้า') !!}
            {!! Form::select('product_id',$product, null, ['class' => 'form-control']) !!}
        </div>
    </div>
    <div class="col-md-6">
        <!-- Value Field -->
        <div class="form-group">
            {!! Form::label('value', 'จำนวน') !!}
            {!! Form::number('value', null, ['class' => 'form-control']) !!}
        </div>

    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <!-- Date Field -->
        <div class="form-group">
            {!! Form::label('date', 'วันที่') !!}
            {!! Form::date('date', null, ['class' => 'form-control']) !!}
        </div>
    </div>
    <div class="col-md-6">
        <!-- Price Field -->
        <div class="form-group ">
            {!! Form::label('price', 'ราคา') !!}
            {!! Form::number('price', null, ['class' => 'form-control']) !!}
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <!-- Import Status Field -->
        <div class="form-group">
            {!! Form::label('import_status', 'สถานะการนำเข้า') !!}
            {!! Form::select('import_status',['1'=>'ไม่ยืนยัน','0'=>'ยืนยัน'], null, ['class' => 'form-control']) !!}
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <!-- Remark Field -->
        <div class="form-group ">
            {!! Form::label('remark', 'หมายเหตุ') !!}
            {!! Form::textarea('remark', null, ['class' => 'form-control']) !!}
        </div>
    </div>
</div>


<div class="row">
    <!-- Submit Field -->
    <div class="form-group col-sm-12">
        {!! Form::submit('บันทึก', ['class' => 'btn btn-primary']) !!}
        <a href="{!! route('imports.index') !!}" class="btn btn-default">ยกเลิก</a>
    </div>
</div>

