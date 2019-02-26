
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
            @if (Auth::user()->type != 1)
                <table class="table table-condensed">
                    <tbody>
                        <tr>
                            <th style="width: 10%">#</th>
                            <th style="width: 45%" class="text-center">รายการ</th>
                    
                            <th style="width: 30%" class="text-center">จำนวน</th>
                            <th style="width: 15%" class="text-center">หน่วยนับ</th>
                        
                        </tr>
                        @foreach ($order->item as $key => $item)
                            <tr>
                                <td>
                                    {!! $key+1 !!}
                                </td>
                                <td>{!! $item->product->name !!}</td>
                              
                                <td class="text-right">
                                    {!! $item->value !!}
                                </td>
                                <td class="text-left">
                                    {!! $item->product->unit->name !!}
                                </td>
                               
                            </tr>
                        @endforeach
                        <tr>
                            <th colspan="2" class="label-warning text-center" >รวม</th>
                            <td class="label-warning text-right val-total" >{!! (!empty($order->item) ? $order->item->sum('value') : '0'); !!}</td>
                            <td class="label-warning " ></td>
                        </tr>
                    
                        
                    </tbody>
                </table>
            @else
                <table class="table table-condensed">
                    <tbody>
                        <tr>
                            <th style="width: 10px">#</th>
                            <th style="width: 200px" class="text-center">รายการ</th>
                            <th style="width: 40px" class="text-center">ราคา/ชิ้น</th>
                            <th style="width: 15%" class="text-center">หน่วยนับ</th>
                            <th style="width: 100px" class="text-center">จำนวน</th>
                            <th style="width: 40px" class="text-center">ราคารวม</th>
                        </tr>
                        @foreach ($order->item as $key => $item)
                            <tr>
                                <td>
                                    {!! $key+1 !!}
                                </td>
                                <td>{!! $item->product->name !!}</td>
                                <td class="text-right">
                                    <span class="badge bg-danger ">{!! number_format($item->product->price,2) !!}</span>
                                    
                                </td>
                                <td class="text-center">
                                    {!! $item->product->unit->name !!}
                                </td>
                                <td class="text-right">
                                    {!! $item->value !!}
                                </td>
                                <td class="text-right">
                                    <span class="badge bg-warning ">{!! (!empty($item->value) ? number_format($item->value *$item->product->price,2) : '0'); !!}</span>
                                
                                </td>
                            </tr>
                        @endforeach
                        <tr>
                            <th colspan="4" class="label-warning text-center" >รวม</th>
                            <td class="label-warning text-right val-total" >{!! (!empty($order->item) ? $order->item->sum('value') : '0'); !!}</td>
                            <td class="label-warning text-right price-total">{!! (!empty($order->item) ? number_format($order->price,2) : '0'); !!}</td>
                            
                        </tr>
                    
                        
                    </tbody>
                </table>
            @endif
            
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
