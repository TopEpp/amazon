@extends('layouts.master')
@section('content')
หน้าหลัก
    {{-- <section class="content-header">
        <h1 class="pull-left" style="color:#263d90;font-weight: bold;">ภาพรวมทั้งหมด</h1>
        <h1 class="pull-right">
          
            <div id="type_btn" class="btn-group btn-group-toggle btn-select-order" data-toggle="buttons">
            <label class="btn btn-white btn-sm  {{ (app('request')->input('date') == 'today') ? 'active': '' }} ">
                <input type="radio" name="type_date" id="type_date1" autocomplete="off" value="today" > วันที่
                </label>
                <label class="btn btn-white btn-sm {{ (app('request')->input('date') == 'week' || app('request')->input('date') == '') ? 'active': '' }}">
                  <input type="radio" name="type_date" id="type_date2" autocomplete="off" value="week" > สัปดาห์
                </label>
                <label class="btn btn-white btn-sm {{ (app('request')->input('date') == 'month') ? 'active': '' }} " >
                  <input type="radio" name="type_date" id="type_date3" autocomplete="off" value="month" > เดือน
                </label>
                <label class="btn btn-white btn-sm {{ (app('request')->input('date') == 'year') ? 'active': '' }} ">
                    <input type="radio" name="type_date" id="type_date4" autocomplete="off" value="year" > ปี
                </label>
            </div>
        </h1>
    </section> --}}


    {{-- select type  dates  --}}
    {{-- <script type="text/javascript">
        setTimeout(function(){ 
            $('#type_btn .btn').change(function(){
                var type = $("#type_btn input[type='radio']:checked").val();
                window.location.href = "{{url('/dashboard')}}?date="+type;
            });

         }, 500);
        
    </script>
    <br/>
    <div class="content">
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-sm-8">
                <div class="panel">
                    <div class="container-fluid ">
                        <h4 style="color:#263d90"><i class="fa fa-bar-chart"></i> ยอดการสั่งซื้อ</h4>
                        <hr>
                        <center>
                        <div style="width:100%;">
                                {!! $chartjs->render() !!}
                        </div>
                        </center>
                      
                    </div>
                       

                </div>
            </div>
            <div class="col-sm-4">
                    <div class="panel">
                        <div class="container-fluid ">
                            <h4 style="color:#263d90"><i class="fa fa-money"></i> ยอดขายและสินค้าขายดี</h4>
                            <hr>

                            <h1 style="color:tomato"><i class="fa fa-dollar"></i> {{ number_format($money->total) }}</h1>
                            <p>ยอดขายรวม วันที่ ( {!! App\MyDate::date_format($dates[0][0]) .' - '. App\MyDate::date_format($dates[0][1]) !!})</p>

                            
                            <table style="width:100%;" id="datatable_money" class="table no-footer">
                                <tr>
                                    <th>ชื่อสินค้า</th>
                                    <th>ยอดขาย</th>
                                </tr>
                               @foreach ($total as $item)
                                   <tr>
                                    <td class=" table_col">{{ $item->name}}</td>
                                    <td>{{ $item->total}} ชิ้น</td>
                                   </tr>
                               @endforeach

                            </table> 
                        
                               
                        </div>
                    </div>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="panel">
            <div class="box-body">
                <h4 style="color:#263d90"><i class="fa fa-file-text-o" style="font-size:25px"></i> รายการสั่งซื้อทั้งหมด</h4>
                <hr>
                @include('orders.table')
            </div>
        </div>
    </div> --}}


@endsection


  



