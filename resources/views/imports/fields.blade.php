
<div class="row">
    <div class="col-md-6">
        <!-- Import Status Field -->
        <div class="form-group">
            {!! Form::label('number', 'หมายเลขอ้างอิง') !!}
            {!! Form::text('number', null, ['class' => 'form-control']) !!}
        </div>
    <!-- Date Field -->
    
    </div>
    <div class="col-md-6">
        <!-- Import Status Field -->
        <div class="form-group">
                {!! Form::label('date', 'วันที่') !!}
                {!! Form::date('date', (isset($import) && $import->date ? $import->date : date('Y-m-d')), ['class' => 'form-control']) !!}
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

{{-- select product --}}
<div class="row">
    <div class="col-md-12">
        <!-- Remark Field -->
        <div class="card">
                <div class="card-header">
                    <h3 class="card-title">เลือกสินค้า</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body p-0">

                    <div class="list-group">
                        @foreach ($category as  $key => $items)
                            <a href="#" data-toggle="collapse" data-target="#collapseExample{!! $key !!}" aria-expanded="false" aria-controls="collapseExample{!! $key !!}" class="list-group-item list-group-item-action list-group-item-success">{!! $items->name !!}</a>
                                <table class="table table-condensed collapse" id="collapseExample{!! $key !!}">
                                    <tbody>
                                    <tr>
                                        <th class="text-center" style="width: 5%">#</th>
                                        <th class="text-center" style="width: 45%">รายการ</th>
                                        <th class="text-center" style="width: 20%">ราคา</th>
                                        <th class="text-center" style="width: 20%">จำนวน</th>
                                        <th class="text-center" style="width: 10%">หน่วยนับ</th>
                                        {{-- <th style="width: 40px">ราคารวม</th> --}}
                                    </tr>
                                        @foreach ($items->product as $key => $item)
                                        <!-- <input type="hidden" id="amout_{!! $item->id !!}" value="{!! $item->price !!}"> -->
                                        {{-- <input type="hidden" class="sum_all" id="sum_{!! $item->id !!}" value="{!! (!empty($import->value[$item->id]->value) ? $import->value[$item->id]->value *$item->price : '0'); !!}"> --}}
                                            <tr style="cursor:pointer">
                                                <td><div class="form-check">
                                                    <input data-id="{!! $item->id !!}" class="form-check-input select_product" type="checkbox" {!! (!empty($import->value[$item->id]->value) ? 'checked' : ''); !!}>
                                                    </div>
                                                </td>
                                                <td>{!! $item->name !!}</td>
                                                <td class="text-right">
                                                    <!-- <span class="badge bg-danger ">{!! $item->price !!}</span> -->
                                                    <input data-id="{!! $item->id !!}" id="price_{!! $item->id !!}" name="price_product[{!! $item->id !!}]" value="{!! $item->price !!}" class="form-control form-control-sm val-product text-right numeric" type="text" {!! (!empty($import->value[$item->id]->value) ? '' : 'disabled'); !!} >
                                                
                                                </td>
                                                <td>
                                                    <input data-id="{!! $item->id !!}" id="val_{!! $item->id !!}" name="value[{!! $item->id !!}]" value="{!! (!empty($import->value[$item->id]->value) ? $import->value[$item->id]->value : '0'); !!}" class="form-control form-control-sm val-product text-right numberonly" type="text" {!! (!empty($import->value[$item->id]->value) ? '' : 'disabled'); !!}>
                                                </td>
                                                <td class="text-center">
                                                    {!! $item->unit->name !!}
                                                </td>
                                                {{-- <td class="text-right"> --}}
                                                    {{-- <span class="badge bg-warning " id="sum_show_{!! $item->id !!}">{!! (!empty($import->value[$item->id]->value) ? $import->value[$item->id]->value *$item->price : '0'); !!}</span> --}}
                                                    
                                                {{-- </td> --}}
                                            </tr>
                                        @endforeach
                                        <tr>
                                            {{-- <th colspan="2" class="label-warning text-right" >รวม</th>
                                            <td class="label-warning text-right val-total" ></td>
                                            <td class="label-warning text-right val-total" >{!! (!empty($import->item) ? $import->item->sum('value') : '0'); !!}</td>
                                            <td class="label-warning text-right val-total" ></td> --}}
                                            {{-- <td class="label-warning text-right price-total">{!! (!empty($import->item) ? $import->price : '0'); !!}</td> --}}
                                            <input type="hidden" name="price" value="{!! (!empty($import->item) ? $import->price : '1'); !!}">
                                        </tr>
                                    </tbody>
                                </table>
                        @endforeach

                    </div>
                  
                </div>
                <!-- /.card-body -->
                </div>
    </div>
</div>
<hr/>

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
            $('.collapse').collapse({
                toggle: true
            })

            $('.select_product').click(function(){
                if ($(this).is(':checked')){
                    $('#val_'+$(this).data("id")).prop("disabled", false);
                    $('#price_'+$(this).data("id")).prop("disabled", false);
                }else{
                    $('#val_'+$(this).data("id")).prop("disabled", true);
                    $('#price_'+$(this).data("id")).prop("disabled", true);
                }
            });
            
            $('table > tbody > tr').click(function(event){
                   var $target = $(event.target);
                    if(!$target.is('input:checkbox') && !$target.is(':focus'))
                    {
                        $(this).find('input:checkbox').each(function() {
                            if(this.checked){
                                this.checked = false;
                                $('#val_'+$(this).data("id")).prop("disabled", true);
                                $('#price_'+$(this).data("id")).prop("disabled", true);
                            } 
                            else{
                                this.checked = true;
                                $('#val_'+$(this).data("id")).prop("disabled", false);
                                $('#price_'+$(this).data("id")).prop("disabled", false);
                            } 
                        })

                    }

              });
          

           $('input.val-product').keyup(function () {
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

            // $('.sum_all').each(function() {
            //     sum_price += Number($(this).val());
            // });
            $('.price-total').text(sum_price);
            // $("input[name=price]").val(sum_price);
            // alert(sum);
        }
    </script>
@endsection

