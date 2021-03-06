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
                    <li class="breadcrumb-item"><a href="{{ route('imports.index') }}">นำเข้าสินค้า</a></li>
                    <li class="breadcrumb-item active">แก้ไขนำเข้าสินค้า</li>
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
            
            {!! Form::model($import, ['route' => ['imports.update', $import->id], 'method' => 'patch']) !!}

                @include('imports.fields')

            {!! Form::close() !!}
            
        </div>

    </section>
    <!-- /.content -->

@endsection
