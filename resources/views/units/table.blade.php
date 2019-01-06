@section('css')
    @include('layouts.datatables_css')
@endsection

{!! $dataTable->table(['width' => '100%','class'=>'table table-custom ']) !!}


<!-- create model category -->
<div class="modal" id="category-create">
    <div class="modal-dialog">
        <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
            <h4 class="modal-title">เพิ่มสินค้า</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">
                {!! Form::open(['route' => 'units.store']) !!}

                @include('units.fields')

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
            $("div.table-create").html('<button type="button" class="btn btn-title-custom" data-toggle="modal" data-target="#category-create">เพิ่มหน่วยนับ</button>');
        });
    </script>
@endsection