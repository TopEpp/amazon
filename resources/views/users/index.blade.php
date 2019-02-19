@extends('layouts.master')

@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">บัญชีผู้ใช้งาน</h1>
                    
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">หน้าหลัก</a></li>
                    <li class="breadcrumb-item active">บัญชีผู้ใช้งาน</li>
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
                    @include('users.table')
                    <br/>
                </div>
                <br/>
            </div>
        </div>
    
            

    </section>
    <!-- /.content -->

@endsection

