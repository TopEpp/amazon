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
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">หน้าหลัก</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('stocks.index') }}">คลังสินค้า</a></li>
                    <li class="breadcrumb-item active">สร้างคลังสินค้า</li>
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
            
                {!! Form::open(['route' => 'stocks.store']) !!}

                    @include('stocks.fields')

                {!! Form::close() !!}
            
        </div>

    </section>
    <!-- /.content -->

@endsection
