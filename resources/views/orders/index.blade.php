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
                    <li class="breadcrumb-item"><a href="#">หน้าหลัก</a></li>
                    <li class="breadcrumb-item active">สั่งสินค้า</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
            
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-info">
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
                    <div class="small-box bg-success">
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
            </div>
        </div>

    </section>
    <!-- /.content -->

@endsection


