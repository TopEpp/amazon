@section('css')
    @include('layouts.datatables_css')
@endsection

{!! $dataTable->table(['width' => '100%','class'=>'table table-custom ']) !!}

@section('scripts')
    @include('layouts.datatables_js')
    {!! $dataTable->scripts() !!}
    <script>
        $(function(){
            // $("div.table-create").html('<a class="btn btn-title-custom pull-right" style="margin:5px 5px 5px 16px;" href="{!! route('imports.create') !!}">นำเข้าสินค้า</a>');
            $("div.table-create").html('<button type="button" style="margin:5px 5px 5px 16px;" class="btn btn-title-custom pull-right" onclick="location.href=\'{!! route('imports.create') !!}\'">นำเข้าสินค้า</button>');
        });
    </script>
@endsection