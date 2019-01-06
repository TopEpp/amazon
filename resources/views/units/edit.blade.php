@extends('layouts.master')

@section('content')

    <!-- edit model category -->
    <div class="modal" id="unit-edit">
        <div class="modal-dialog">
            <div class="modal-content">
    
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">แก้ไขหน่วยนับ</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
        
                <!-- Modal body -->
                <div class="modal-body">
                        {!! Form::model($unit, ['route' => ['units.update', $unit->id], 'method' => 'patch']) !!}
        
                            @include('units.fields')
        
                        {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(function(){
            $('#unit-edit').modal('show'); 
        });
    </script>
@endsection