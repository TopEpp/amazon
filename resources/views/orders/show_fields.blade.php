
<div class="row mb-3">
    <div class="col-12 ">
            <div class="progressbar">
                <div class="circle {!! ($order->order_status == 0)? 'done' :'' !!}"> <span class="label">1</span>
                    <span class="title">ออเดอร์ใหม่</span>
                
                </div> <span class="bar active"></span>
                
                <div class="circle {!! ($order->order_status == 1)? 'done' :'' !!}"> <span class="label">2</span>
                    <span class="title">ยืนยันออเดอร์</span>
                
                </div>
            </div>
    </div>
</div>  

<div class="invoice p-3 mb-3 mt-10">
    <div class="row">
        <div class="col-12">
            <h4>
            <i class="fa fa-globe"></i> เลขใบสั่ง:{!! $order->id !!}
            <small class="float-right">วันที่: {!! Carbon\Carbon::createFromFormat('Y-m-d h:i:s', $order->date)->format('d/m/Y') !!}</small>
            </h4>
        </div>
        <!-- /.col -->
    </div>
    <div class="row  invoice-info">
        <div class="col-sm-3 col-6">
            <div class="description-block border-right">
                {{-- <span class="description-percentage text-warning">&nbsp;</span> --}}
            <h5 class="description-header">{!! Carbon\Carbon::createFromFormat('Y-m-d h:i:s', $order->date)->format('d/m/Y') !!}</h5>
            <span class="description-text">วันที่สั่ง</span>
            </div>
            <!-- /.description-block -->
        </div>
        <!-- /.col -->
        <div class="col-sm-3 col-6">
            <div class="description-block border-right">
            {{-- <span class="description-percentage text-warning"><i class="fa fa-caret-left"></i> 0%</span> --}}
            <h5 class="description-header">{!! $order->user->name !!}</h5>
            <span class="description-text">ผู้สั่ง</span>
            </div>
            <!-- /.description-block -->
        </div>
        <!-- /.col -->
        <div class="col-sm-3 col-6">
            <div class="description-block border-right">
            {{-- <span class="description-percentage text-success"><i class="fa fa-caret-up"></i> 20%</span> --}}
            <h5 class="description-header">{!! $order->price !!}</h5>
            <span class="description-text">จำนวนเงิน</span>
            </div>
            <!-- /.description-block -->
        </div>
        <!-- /.col -->
        <div class="col-sm-3 col-6">
            <div class="description-block">
            {{-- <span class="description-percentage text-danger"><i class="fa fa-caret-down"></i> 18%</span> --}}
            <h5 class="description-header">{!! $order->remark !!}</h5>
            <span class="description-text">หมายเหตุ</span>
            </div>
            <!-- /.description-block -->
        </div>
    </div>


    <div class="row">
        <div class="col-12">

                <table class="table table-condensed">
                    <tbody>
                        <tr>
                            <th style="width: 10px">#</th>
                            <th style="width: 200px">รายการ</th>
                            <th style="width: 40px">ราคา/ชิ้น</th>
                            <th style="width: 100px">จำนวน</th>
                            <th style="width: 40px">ราคารวม</th>
                        </tr>
                        @foreach ($order->item as $key => $item)
                            <tr>
                                <td>
                                    {!! $key+1 !!}
                                </td>
                                <td>{!! $item->product->name !!}</td>
                                <td class="text-right">
                                    <span class="badge bg-danger ">{!! $item->product->price !!}</span>
                                    
                                </td>
                                <td class="text-right">
                                    {!! $item->value !!}
                                </td>
                                <td class="text-right">
                                    <span class="badge bg-warning ">{!! (!empty($item->value) ? $item->value *$item->product->price : '0'); !!}</span>
                                
                                </td>
                            </tr>
                        @endforeach
                        <tr>
                            <th colspan="3" class="label-warning text-right" >รวม</th>
                            <td class="label-warning text-right val-total" >{!! (!empty($order->item) ? $order->item->sum('value') : '0'); !!}</td>
                            <td class="label-warning text-right price-total">{!! (!empty($order->item) ? $order->price : '0'); !!}</td>
                            
                        </tr>
                    
                        
                    </tbody>
                </table>
        
    
        </div>
    </div>

    <div class="row no-print">
        <div class="col-12">
            @if (Auth::user()->type == 1)
                <a href="{!! url('pdf_order').'/'.$order->id !!}" target="_blank" class="btn btn-custom"><i class="fa fa-print"></i> Print</a>
            @endif
            
        </div>
    </div>
</div>
