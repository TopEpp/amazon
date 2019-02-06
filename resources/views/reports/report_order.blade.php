@extends('layouts.master')

@section('css')
    @include('layouts.datatables_css')
@endsection

@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">รายงานการสั่งสินค้า</h1>
                    
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">หน้าหลัก</a></li>
                    <li class="breadcrumb-item active"><a href="#">รายงาน</a></li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
            <div class="row">
                <div class="col-md-12">
                    <div class="float-right ml-2">
                        <button data-toggle="collapse" data-target="#search" type="button" class="btn btn-block btn-success"><i class="fa fa-search"></i></button>
                    </div>
                    <div class="float-right ml-2">
                        <button  type="button" class="btn btn-block btn-success" id="report_pdf"><i class="fa fa-file-pdf"></i></button>
                    </div>
                    <div class="float-right ml-2">
                        <button  type="button" class="btn btn-block btn-success" id="report_excel"><i class="fa fa-file-excel"></i></button>
                    </div>
                </div>
                <div class="col-md-12">
                        <div class="collapse" id="search" >
                            <div class="row">

                                <form method="GET" id="search-form" class="form-inline" role="form">
                                   
                                    <div class="col-6 mb-2">
                                        <div class="form-group">
                                            <label for="end_date">เลขคำสั่ง</label>
                                            <input type="text" class="form-control col-md-12" name="number" id="number" placeholder="" value="{{ app('request')->input('number') }}">
                                        </div>
                            
                                    </div>
                                    <div class="col-6 mb-2">
                                        <div class="form-group">
                                            <label for="end_date">ชื่อผู้สั่ง</label>
                                            <input type="text" class="form-control col-md-12" name="owner" id="owner" placeholder=""  value="{{ app('request')->input('owner') }}">
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
                
            </div>
            
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="clearfix"></div>
            @include('flash::message')

            <div class="row">
                <div class="col-lg-12">
                    {!! $dataTable->table(['width' => '100%','class'=>'table table-custom ']) !!}
                    <br/>
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->

@endsection


@section('scripts')
    @include('layouts.datatables_js')
    {!! $dataTable->scripts() !!}
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
            $('#report_pdf').click(function(){

                if ($('#start_date').val() != ''  && $('#end_date').val() == '' ){
                    $('#end_date').focus();
                    return false;
                }
                if ($('#start_date').val() == ''  && $('#end_date').val() != '' ){
                    $('#start_date').focus();
                    return false;
                }

                window.open('/print_order_pdf?number='+$('#number').val()+
                '&owner='+$('#owner').val()+
                '&start_date='+$('#start_date').val()+
                '&end_date='+$('#end_date').val()
                ,"_blank");
            });

            $('#report_excel').click(function(){
                
                if ($('#start_date').val() != ''  && $('#end_date').val() == '' ){
                    $('#end_date').focus();
                    return false;
                }
                if ($('#start_date').val() == ''  && $('#end_date').val() != '' ){
                    $('#start_date').focus();
                    return false;
                }

                window.open('/excel_order?number='+$('#number').val()+
                '&owner='+$('#owner').val()+
                '&start_date='+$('#start_date').val()+
                '&end_date='+$('#end_date').val()
                ,"_blank");
            })
           
        })
      
            // DataTable.ext.buttons.print = {
            //     className: 'buttons-print',

            //     text: function (dt) {
            //         return  '<i class="fa fa-print"></i> ' + dt.i18n('buttons.print', 'Print');
            //     },

            //     action: function (e, dt, button, config) {
            //         var url = _buildUrl(dt, 'print');
            //         window.location = url;
            //     }
            // };
    
    </script>
@endsection
