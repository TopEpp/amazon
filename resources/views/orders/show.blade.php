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
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">หน้าหลัก</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('orders.index') }}">สั่งสินค้า</a></li>
                        <li class="breadcrumb-item active">{!! $order->id !!}</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
                
            </div><!-- /.container-fluid -->
            
        </section>

    <section class="content">
            <div class="container-fluid">
                {{-- <a href="{!! route('orders.index') !!}" class="btn btn-default">กลับ</a>   --}}
                @include('orders.show_fields')
                
        
                
            </div>
    
        </section>

@endsection
