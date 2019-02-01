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
