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
                            <h5>ยอดสั่งสินค้า</h5>
                            <ul class="nav nav-pills ml-auto p-2 float-right">
                                    <li class="nav-item">
                                        <a class="nav-link changedate {{ (app('request')->input('date') == 'today'|| app('request')->input('date') == '') ? 'active': '' }} " href="" data-date="today" data-toggle="tab">วันนี้</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link changedate {{ (app('request')->input('date') == 'week' ) ? 'active': '' }} " href="" data-date="week" data-toggle="tab">สัปดาห์</a>
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
                                <div class="description-block border-right">
                                    
                                    <h3 class="description-header text-success numeric" style="font-size:24px">{!! !empty($value_all->total)?number_format($value_all->total,2):'0' !!} </h3>
                                    <span class="description-text">จำนวนเงินทั้งหมด (บาท)</span>
                                    </div>
                            </div>
                    <div class="card">
                        <div class="card-body">
                          
                            <h5>สินค้าคงเหลือน้อยที่สุด</h5>
                            @foreach ($products as $item)
                                <div class="progress-group">
                                    {!! $item->name !!}
                                    <span class="float-right"><b>{!! $item->value !!}</b> {!! $item->unit !!}</span>
                                    <div class="progress progress-sm">
                                        <div class="progress-bar bg-warning" style="width: {!! $item->value * 100/100 !!}%"></div>
                                    </div>
                                </div>
                       
                            @endforeach
                                 
                            <!-- /.progress-group -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


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



  



