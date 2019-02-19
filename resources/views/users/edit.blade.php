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
                    <li class="breadcrumb-item"><a href="{{ route('users.index') }}">บัญชีผู้ใช้งาน</a></li>
                    <li class="breadcrumb-item active">แก้ไขบัญชีผู้ใช้งาน</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
            
        </div><!-- /.container-fluid -->
    </section>
 
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            @include('adminlte-templates::common.errors')
            
            {!! Form::model($user, ['route' => ['users.update', $user->id], 'method' => 'patch','enctype'=>"multipart/form-data"]) !!}

                    @include('users.fields')

                {!! Form::close() !!}
            
        </div>

    </section>
    <!-- /.content -->

   
@endsection