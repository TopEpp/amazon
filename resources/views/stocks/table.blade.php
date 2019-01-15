@section('css')
    @include('layouts.datatables_css')
@endsection

{!! $dataTable->table(['width' => '100%','class'=>'table table-custom ']) !!}


<!-- create model category -->
<div class="modal" id="stocks-create">
    <div class="modal-dialog">
        <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
            <h4 class="modal-title">เพิ่มคลังสินค้า</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">
                {!! Form::open(['route' => 'stocks.store']) !!}

                @include('stocks.fields')

            {!! Form::close() !!}
        </div>

        <!-- Modal footer -->
        {{-- <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div> --}}

        </div>
    </div>
</div>

@section('scripts')
    @include('layouts.datatables_js')
    {!! $dataTable->scripts() !!}
    <script>
        $(function(){
            $("div.table-create").html('<button type="button"style="margin:5px 5px 5px 16px" class="btn btn-title-custom" data-toggle="modal" data-target="#stocks-create">เพิ่มคลังสินค้า</button>');
            $("div.table-product").html('<button class="btn btn-title-custom pull-right" style="margin: 5px" onclick="location.href=\'{!! route('categories.index') !!}\'">ประเภทสินค้า</button>');
            $("div.table-cate").html('<button class="btn btn-title-custom pull-right" style="margin: 5px" onclick="location.href=\'{!! route('products.index') !!}\'">สินค้า</button>');
            $("div.table-unit").html('<button class="btn btn-title-custom pull-right" style="margin: 5px" onclick="location.href=\'{!! route('units.index') !!}\'">หน่วยนับ</button>');
           
        });
    </script>
@endsection