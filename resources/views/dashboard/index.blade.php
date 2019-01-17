@extends('layouts.master')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">หน้าหลัก</h1>
                    
                </div><!-- /.col -->
                
            </div><!-- /.row -->
            
        </div><!-- /.container-fluid -->
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-8 col-sm-8 col-8">
                              <!-- Custom tabs (Charts with tabs)-->
                    <div class="card">

                        <div class="card-body">
                            <h5>การสั่งสินค้า</h5>
                            <ul class="nav nav-pills ml-auto p-2 float-right">
                                    <li class="nav-item">
                                        <a class="nav-link changedate {{ (app('request')->input('date') == 'today') ? 'active': '' }} " href="" data-date="today" data-toggle="tab">วันนี้</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link changedate {{ (app('request')->input('date') == 'week' || app('request')->input('date') == '') ? 'active': '' }} " href="" data-date="week" data-toggle="tab">สัปดาห์</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link changedate {{ (app('request')->input('date') == 'month') ? 'active': '' }} " href="" data-date="month" data-toggle="tab">เดือน</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link changedate {{ (app('request')->input('date') == 'year') ? 'active': '' }} " href="" data-date="year" data-toggle="tab">ปี</a>
                                    </li>
                                   
                                </ul>
                            <div class="tab-content p-0">
                                
                                    {!! $chartjs->render() !!}
                            
                            </div><!-- /.card-body -->
                        </div>
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                          
                            <h5>สินค้าคงเหลือน้อยที่สุด</h5>
                            
                            <div class="progress-group">
                            1
                            <span class="float-right"><b>50</b>/200</span>
                            <div class="progress progress-sm">
                                <div class="progress-bar bg-warning" style="width: 8%"></div>
                            </div>
                            </div>
                            <!-- /.progress-group -->
        
                            <div class="progress-group">
                            2
                            <span class="float-right"><b>200</b>/400</span>
                            <div class="progress progress-sm">
                                <div class="progress-bar bg-warning" style="width: 10%"></div>
                            </div>
                            </div>
        
                            <!-- /.progress-group -->
                            <div class="progress-group">
                            <span class="progress-text">3</span>
                            <span class="float-right"><b>480</b>/800</span>
                            <div class="progress progress-sm">
                                <div class="progress-bar bg-warning" style="width: 30%"></div>
                            </div>
                            </div>
        
                            <!-- /.progress-group -->
                            <div class="progress-group">
                            4
                            <span class="float-right"><b>250</b>/500</span>
                            <div class="progress progress-sm">
                                <div class="progress-bar bg-warning" style="width: 40%"></div>
                            </div>
                            </div>
                            <!-- /.progress-group -->
                             <!-- /.progress-group -->
                             <div class="progress-group">
                                5
                                <span class="float-right"><b>100</b>/400</span>
                                <div class="progress progress-sm">
                                    <div class="progress-bar bg-warning" style="width: 50%"></div>
                                </div>
                            </div>
                                <!-- /.progress-group -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
<!-- /.content-header -->
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

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.js"></script>
<script type="text/javascript">
    $(function(){
        $('.changedate').click(function(){

            var date = $(this).data('date');
            
            window.location.href = "{{url('/dashboard')}}?date="+date;
        });
    })

    
</script>
@endsection



  



