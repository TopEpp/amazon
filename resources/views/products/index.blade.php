@extends('layouts.master')

@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">คลังสินค้า</h1>
                    
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">หน้าหลัก</a></li>
                    <li class="breadcrumb-item"><a href="#">คลังสินค้า</a></li>
                    <li class="breadcrumb-item active">สินค้า</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
            
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        
            <div class="clearfix"></div>
            @include('flash::message')
            <div class="row">
                <div class="col-lg-12">
                    
                    @include('products.table')
                </div>
            </div>

    </section>
    <!-- /.content -->

@endsection


