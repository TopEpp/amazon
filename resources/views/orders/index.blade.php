@extends('layouts.master')

@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">สั่งสินค้า</h1>
                    
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ (Auth::user()->type != 1) ? route('orders.index') : route('dashboard') }}">หน้าหลัก</a></li>
                    <li class="breadcrumb-item active">สั่งสินค้า</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
            <div class="row">
                <div class="col-md-12">
                    <div class="float-right ml-2">
                        <button data-toggle="collapse" data-target="#search" type="button" class="btn btn-block btn-success"><i class="fa fa-search"></i></button>
                    </div>
                </div>
                <div class="col-md-12">
                        <div class="collapse" id="search" >  
                            <form method="GET" id="search-form" class="form-inline" role="form">
                                
                                <div class="col-6 mb-2">
                                    <div class="form-group">
                                        <label for="end_date">ชื่อสาขา</label>
                                        <input type="text" class="form-control col-md-12" name="owner" id="owner" value="{{ app('request')->input('owner') }}">
                                    </div>
                                </div>
                                <div class="col-6 mb-2">
                                    <div class="form-group">
                                        <label for="end_date">สถานะ</label>
                                        {!! Form::select('status',[''=>'เลือก','1'=>'ยืนยันออเดอร์','0'=>'ออเดอร์ใหม่'], (app('request')->input('status') != '')?app('request')->input('status'):'' , ['class' => 'form-control col-md-12','id'=>"status"]) !!}
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="start_date">วันที่เริ่มต้น</label>
                                        <input type="date" class="form-control col-md-12" name="start_date" id="start_date" placeholder=""  value="{{ app('request')->input('start_date') }}">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="end_date">วันที่สิ้นสุด</label>
                                        <input type="date" class="form-control col-md-12" name="end_date" id="end_date" placeholder=""  value="{{ app('request')->input('end_date') }}">
                                    </div>
                                </div>

                                <div class="col-12 mt-2">
                                        <button id="submit" class="btn btn-submit-custom float-right">ค้นหา</button>
                                </div>
                                
                            </form>
                        </div>
                </div>
                
            </div>
            
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-info" onclick="window.location.href = '{!! url('/orders?status=0') !!}'" style="cursor: pointer">
                        <div class="inner">
                            <h3>{!! $orders['new'] !!}</h3>
            
                            <p>ออเดอร์ใหม่</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-asterisk"></i>
                        </div>
                        
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-success" onclick="window.location.href = '{!! url('/orders?status=1') !!}'" style="cursor: pointer">
                    <div class="inner">
                        <h3>{!! $orders['receive'] !!}</h3>
        
                        <p>ยืนยันออเดอร์</p>
                    </div>
                    <div class="icon">
                            <i class="fas fa-atom"></i>
                    </div>
                    
                    </div>
                </div>
                <!-- ./col -->

            </div>
        </div>

        <div class="clearfix"></div>
        @include('flash::message')
        <div class="row">
            <div class="col-lg-12">
                
                @include('orders.table')
                <br/>
            </div>
        </div>

    </section>
    <!-- /.content -->

@endsection


@section('scripts')
    <script>
        $(function(){

            $('#submit').click(function(){
                if ($('#start_date').val() != ''  && $('#end_date').val() == '' ){
                    $('#end_date').focus();
                    return false;
                }
                if ($('#start_date').val() == ''  && $('#end_date').val() != '' ){
                    $('#start_date').focus();
                    return false;
                }
                $('#submit').submit();
            });

        })

    </script>
@endsection


