@extends('layouts.master')

@section('content')

    <!-- edit model category -->
    <div class="modal" id="category-edit">
        <div class="modal-dialog">
            <div class="modal-content">
    
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">แก้ไขประเภทสินค้า</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
        
                <!-- Modal body -->
                <div class="modal-body">
                        {!! Form::model($category, ['route' => ['categories.update', $category->id], 'method' => 'patch']) !!}
        
                            @include('categories.fields')
        
                        {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(function(){
            $('#category-edit').modal('show'); 
        });
    </script>
@endsection