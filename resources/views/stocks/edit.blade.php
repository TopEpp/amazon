@extends('layouts.master')

@section('content')

    <!-- edit model category -->
    <div class="modal" id="stocks-edit">
        <div class="modal-dialog">
            <div class="modal-content">
    
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">แก้ไขคลังสินค้า</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
        
                <!-- Modal body -->
                <div class="modal-body">
                        {!! Form::model($stock, ['route' => ['stocks.update', $stock->id], 'method' => 'patch']) !!}
        
                            @include('stocks.fields')
        
                        {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(function(){
            $('#stocks-edit').modal('show'); 
        });
    </script>
@endsection