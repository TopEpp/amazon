@extends('layouts.master')

@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">แก้ไขคำสั่งซื้อ</h1>
                    
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">หน้าหลัก</a></li>
                    <li class="breadcrumb-item"><a href="#">สั่งสินค้า</a></li>
                    <li class="breadcrumb-item active">แก้ไขคำสั่งซื้อ</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
            
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            @include('adminlte-templates::common.errors')
            
            {!! Form::model($order, ['route' => ['orders.update', $order->id], 'method' => 'patch']) !!}

                @include('orders.fields')

            {!! Form::close() !!}
            
        </div>

    </section>
    <!-- /.content -->

@endsection
