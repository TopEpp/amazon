<?php

namespace App\DataTables;

use App\Models\Import;
use Carbon\Carbon;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Services\DataTable;

class ImportDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        $dataTable = new EloquentDataTable($query);

        $dataTable->addColumn('value', function ($model) {

            return $model->item->sum('value');
        });
        $dataTable->editColumn('date', function ($model) {
            // return $model->date;
            return Carbon::createFromFormat('Y-m-d h:i:s', $model->date)->format('d/m/Y');
        });

        return $dataTable->addColumn('action', 'imports.datatables_actions');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Import $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Import $model)
    {
        return $model->newQuery();
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
            ->addAction(['width' => '120px', 'title' => ''])
            ->parameters([
                'dom' => "<'row'<'table-create '>'<'col align-self-end'f>>t<'row'<'col-sm-12 col-md-5'><'col-sm-12 col-md-7'p>>",
                'order' => [[0, 'desc']],
                "bSort" => false,
                'buttons' => [

                ],
                "oLanguage" => [
                    "oPaginate" => [
                        "sFirst" => '<i class="fas fa-angle-double-left"></i>',
                        "sPrevious" => '<i class="fas fa-angle-double-left"></i>',
                        "sNext" => '<i class="fas fa-angle-double-right"></i>',
                        "sLast" => '<i class="fas fa-angle-double-right"></i>',
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
            'number' => ['title' => 'หมายเลขอ้างอิง', 'name' => 'number', 'data' => 'number'],
            'date' => ['title' => 'วันที่นำเข้า', 'name' => 'date', 'data' => 'date'],
            'value' => ['title' => 'จำนวนสินค้า'],
            'remark' => ['title' => 'หมายเหตุ', 'name' => 'remark', 'data' => 'remark'],

        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'importsdatatable_' . time();
    }
}
