@extends('layouts.master')

@section('content')

    <!-- edit model category -->
    <div class="modal" id="products-edit">
        <div class="modal-dialog">
            <div class="modal-content">
    
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">แก้ไขสินค้า</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
        
                <!-- Modal body -->
                <div class="modal-body">
                        {!! Form::model($product, ['route' => ['products.update', $product->id], 'method' => 'patch']) !!}
        
                            @include('products.fields')
        
                        {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(function(){
            $('#products-edit').modal('show'); 
        });
    </script>
@endsection