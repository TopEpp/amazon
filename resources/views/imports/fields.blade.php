{{-- <div class="row">
    <div class="col-md-6">
        <!-- Product Id Field -->
        <div class="form-group">
            {!! Form::label('product_id', 'ชื่อสินค้า') !!}
            {!! Form::select('product_id',$product, null, ['class' => 'form-control']) !!}
        </div>
    </div>
    <div class="col-md-6">
        <!-- Value Field -->
        <div class="form-group">ห
            {!! Form::label('value', 'จำนวน') !!}
            {!! Form::number('value', null, ['class' => 'form-control']) !!}
        </div>

    </div>
</div> --}}
<div class="row">
    <div class="col-md-6">
        <!-- Date Field -->
        <div class="form-group">
            {!! Form::label('date', 'วันที่') !!}
            {!! Form::date('date', null, ['class' => 'form-control']) !!}
        </div>
    </div>
    <div class="col-md-6">
        <!-- Import Status Field -->
        <div class="form-group">
            {!! Form::label('import_status', 'สถานะการนำเข้า') !!}
            {!! Form::select('import_status',['1'=>'ไม่ยืนยัน','0'=>'ยืนยัน'], null, ['class' => 'form-control']) !!}
        </div>
       
    </div>
</div>
<div class="row">
    <div class="col-md-6">
       <!-- Price Field -->
       <div class="form-group ">
            {!! Form::label('price', 'ราคา') !!}
            {!! Form::number('price', null, ['class' => 'form-control']) !!}
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <!-- Remark Field -->
        <div class="form-group ">
            {!! Form::label('remark', 'หมายเหตุ') !!}
            {!! Form::textarea('remark', null, ['class' => 'form-control', 'rows' => 2, 'cols' => 40]) !!}
        </div>
    </div>
</div>


<div class="row">
        <div class="col-md-12">
            <!-- Remark Field -->
            <div class="card">
                    <div class="card-header">
                      <h3 class="card-title">เลือกสินค้า</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body p-0">
                      <table class="table table-condensed">
                        <tbody>
                        <tr>
                          <th style="width: 10px">#</th>
                          <th style="width: 200px">รายการ</th>
                          <th style="width: 40px">ราคา/ชิ้น</th>
                          <th style="width: 100px">จำนวน</th>
                          <th style="width: 40px">ราคารวม</th>
                        </tr>
                        @foreach ($product as $key => $item)
                            <tr>
                                <td><div class="form-check">
                                    <input data-id="{!! $item->id !!}" class="form-check-input select_product" type="checkbox">
                                    </div>
                                </td>
                                <td>{!! $item->name !!}</td>
                                <td class="text-right">
                                    <span class="badge bg-danger ">{!! $item->price !!}</span>
                                    <input type="hidden" id="amout_{!! $item->id !!}" value="{!! $item->price !!}">
                                </td>
                                <td>
                                    <input data-id="{!! $item->id !!}" id="val_{!! $item->id !!}" name="value[{!! $item->id !!}]" class="form-control form-control-sm val-product" type="text" disabled>
                                </td>
                                <td class="text-right">
                                    <span class="badge bg-warning " id="sum_show_{!! $item->id !!}"></span>
                                    <input type="hidden" class="sum_all" id="sum_{!! $item->id !!}" value="">
                                </td>
                            </tr>
                        @endforeach
                        <tr>
                            <th colspan="3" class="label-warning text-right" >รวม</th>
                            <td class="label-warning text-right val-total" ></td>
                            <td class="label-warning text-right price-total"></td>
                            <input type="hidden" name="price" value="">
                        </tr>
                    
                      
                      </tbody></table>
                    </div>
                    <!-- /.card-body -->
                  </div>
        </div>
    </div>

<div class="row">
    <!-- Submit Field -->
    <div class="form-group col-sm-12">
        {!! Form::submit('บันทึก', ['class' => 'btn btn-submit-custom']) !!}
        <a href="{!! route('imports.index') !!}" class="btn btn-default">ยกเลิก</a>
    </div>
</div>

@section('scripts')
   
    <script>
        $(function(){
           $('.select_product').click(function(){
           
                if ($(this).is(':checked')){
                    $('#val_'+$(this).data("id")).prop("disabled", false);
                    // alert($(this).data("id"));
                }else{
                    $('#val_'+$(this).data("id")).prop("disabled", true);
                }
               
           });

           $('input.val-product').blur(function() {
                let sum = $(this).val() * $('#amout_'+$(this).data("id")).val();
                $('#sum_show_'+$(this).data("id")).text(sum);
                $('#sum_'+$(this).data("id")).val(sum);

                updateTotalProduct();
            })


        });

        function updateTotalProduct() {
            let sum_val = 0;
            let sum_price = 0;
            $('.val-product').each(function() {
                sum_val += Number($(this).val());
            });
            $('.val-total').text(sum_val);

            $('.sum_all').each(function() {
                sum_price += Number($(this).val());
            });
            $('.price-total').text(sum_price);
            $("input[name=price]").val(sum_price);
            // alert(sum);
        }
    </script>
@endsection

