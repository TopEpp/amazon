@section('css')
    @include('layouts.datatables_css')
@endsection

{!! $dataTable->table(['width' => '100%','class'=>'table table-custom ']) !!}

@section('scripts')
    @include('layouts.datatables_js')
    {!! $dataTable->scripts() !!}
    <script>
        $(function(){
            $("div.table-create").html('<button class="btn btn-title-custom pull-right" style="margin-top: -10px;margin-bottom: 5px" onclick="location.href=\'{!! route('users.create') !!}\'">เพิ่มผู้ใช้งาน</button>');
        });
    </script>

@endsection