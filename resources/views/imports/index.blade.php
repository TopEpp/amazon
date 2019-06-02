@extends('layouts.master')

@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">นำเข้าสินค้า</h1>
                    
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">หน้าหลัก</a></li>
                    <li class="breadcrumb-item active">นำเข้าสินค้า</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->

            <div class="row">
                    <div class="col-md-12">
                        <div class="float-right ml-2">
                            <button data-toggle="collapse" data-target="#search" type="button" class="btn btn-block btn-success"><i class="icofont-search-1"></i></button>
                        </div>
                    </div>
                    <div class="col-md-12">
                            <div class="collapse" id="search" >  
                                <form method="GET" id="search-form" class="form-inline" role="form">
                                    
                                    <div class="col-6 mb-2">
                                        <div class="form-group">
                                            <label for="end_date">หมายเลขอ้างอิง</label>
                                            <input type="text" class="form-control col-md-12" name="number" id="number" value="{{ app('request')->input('number') }}">
                                        </div>
                                    </div>
                                    <div class="col-6 mb-2">
                                        <div class="form-group">
                                            {{-- <label for="end_date">สถานะ</label>
                                            {!! Form::select('status',[''=>'เลือก','1'=>'ยืนยันออเดอร์','0'=>'ออเดอร์ใหม่'], (app('request')->input('status') != '')?app('request')->input('status'):'' , ['class' => 'form-control col-md-12','id'=>"status"]) !!} --}}
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


        <div class="clearfix"></div>
        @include('flash::message')
        <div class="row">
            <div class="col-lg-12">
                
                @include('imports.table')
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

