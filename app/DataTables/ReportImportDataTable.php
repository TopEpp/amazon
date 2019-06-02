<?php

namespace App\DataTables;

use App\Models\Import;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Services\DataTable;

class ReportImportDataTable extends DataTable
{

    protected $printPreview = 'imports.report_import';
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        $dataTable = new EloquentDataTable($query);

        //search
        // $dataTable->filterColumn('date', function ($query, $keyword) {
        //     $query->whereRaw("DATE_FORMAT(date,'%d/%m/%Y') like ?", ["%$keyword%"]);
        // });

        $dataTable->editColumn('date', function ($model) {
            // return $model->date;
            return Carbon::createFromFormat('Y-m-d h:i:s', $model->date)->format('d/m/Y');
        });
        $dataTable->editColumn('price', function ($model) {
            return number_format($model->price, 2);
        });
        // $dataTable->editColumn('value', function ($model) {

        //     return $model->item->sum('value');
        // });

        // $dataTable->editColumn('user_id', function ($model) {

        //     return $model->user->name;
        // });

        return $dataTable;
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Units $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Import $model, Request $request)
    {
        $query = $model
            ->join('users', 'users.id', '=', 'imports.user_id')
            ->join('import_items', 'import_items.import_id', '=', 'imports.id')
            ->select('users.name', 'imports.number', 'imports.price', 'imports.remark', 'imports.date', DB::raw('sum(import_items.value) as value'))
            ->groupby(['imports.id', 'users.name', 'imports.number', 'imports.price', 'imports.remark', 'imports.date']);

        //search custom
        if ($request->has('number') && $request->number != '') {
            $query->where('imports.number', 'like', '%' . $request->number . '%');
        }
        if ($request->has('start_date') && $request->start_date != '') {

            $date = [$request->start_date . ' ' . '00:00:00', $request->end_date . ' ' . '00:00:00'];
            $query->whereBetween('imports.date', $date);
        }

        return $this->applyScopes($query);
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->columns($this->getColumns())
            ->minifiedAjax()
        // ->addAction(['width' => '120px', 'title' => ''])
            ->parameters([
                'dom' => "<B>t<'row'<'col-sm-12 col-md-5'><'col-sm-12 col-md-7'p>>",
                'order' => [[0, 'desc']],
                'pageLength' => 50,
                "bSort" => false,
                'buttons' => [

                ],
                "oLanguage" => [
                    "oPaginate" => [
                        "sFirst" => '<i class="icofont-rounded-double-left"></i>',
                        "sPrevious" => '<i class="icofont-rounded-double-left"></i>',
                        "sNext" => '<i class="icofont-rounded-double-right"></i>',
                        "sLast" => '<i class="icofont-rounded-double-right"></i>',
                    ],
                    "sSearch" => '',
                    "sEmptyTable" => 'ไม่พบข้อมูล',
                    "sZeroRecords" => 'ไม่พบข้อมูล',
                    "sProcessing" => "กำลังดำเนินการ...",
                    "sLengthMenu" => "แสดง _MENU_ แถว",
                    "sZeroRecords" => "ไม่พบข้อมูล",
                    // "sInfo"=>      "แสดง _START_ ถึง _END_ จาก _TOTAL_ แถว / รายการทั้งหมด จำนวน _TOTAL_ รายการ (แบ่งออกเป็น _PAGES_ หน้า หน้าละ 50 รายการ)",
                    "sInfo" => "รายการทั้งหมด จำนวน _TOTAL_ รายการ (แบ่งออกเป็น _PAGES_ หน้า หน้าละ 100 รายการ)",
                    // "sInfoEmpty"=> "แสดง 0 ถึง 0 จาก 0 แถว",
                    "sInfoEmpty" => "รายการทั้งหมด จำนวน 0 รายการ (แบ่งออกเป็น _PAGES_ หน้า หน้าละ 100 รายการ)",
                    // "sInfoFiltered": "(กรองข้อมูล _MAX_ ทุกแถว)",
                    "sInfoFiltered" => "",
                    "sInfoPostFix" => "",
                ],
            ]);
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            'number' => ['class' => 'text-center', 'title' => 'หมายเลขอ้างอิง', 'name' => 'imports.number', 'data' => 'number'],
            'date' => ['class' => 'text-center', 'title' => 'วันที่นำเข้า', 'name' => 'imports.date', 'data' => 'date'],
            'value' => ['class' => 'text-right', 'title' => 'จำนวนสินค้า', 'name' => 'import_items.value', 'data' => 'value'],
            'price' => ['class' => 'text-right', 'title' => 'ราคารวม', 'name' => 'import_items.price', 'data' => 'price'],
            'remark' => ['class' => 'text-left', 'title' => 'หมายเหตุ', 'name' => 'imports.remark', 'data' => 'remark'],
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'unitsdatatable_' . time();
    }
}
