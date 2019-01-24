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
                    <li class="breadcrumb-item"><a href="#">หน้าหลัก</a></li>
                    <li class="breadcrumb-item active">นำเข้าสินค้า</li>
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
                @foreach ($import as $item)
                    <div class="col-md-3 col-sm-6 col-12">
                        <div class="info-box">
                        <span class="info-box-icon bg-info"><i class="fas fa-truck"></i></span>
            
                        <div class="info-box-content">
                            <span class="info-box-text">{!! $item->name !!}</span>
                            <span class="info-box-number">{!! $item->total !!}</span>
                        </div>
                        <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                @endforeach
               

            </div>
        </div>

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


