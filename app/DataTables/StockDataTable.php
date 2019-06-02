<?php

namespace App\DataTables;

use App\Models\Stock;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Services\DataTable;

class StockDataTable extends DataTable
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

        $dataTable->editColumn('product_id', function ($model) {

            return $model->product->name;
        });
        $dataTable->editColumn('categoty_id', function ($model) {

            return $model->product->category->name;
        });

        $dataTable->editColumn('value', function ($model) {

            return $model->imports->sum('value') + $model->value;
        });

        return $dataTable->addColumn('action', 'stocks.datatables_actions');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Stock $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Stock $model)
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
                'dom' => "<'row'<'table-create '><'table-product '><'table-cate'><'table-unit'><'col align-self-end'f>>t<'row'<'col-sm-12 col-md-5'><'col-sm-12 col-md-7'p>>",
                'order' => [[0, 'desc']],
                "bSort" => false,
                'buttons' => [],
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
            'product_id' => ['title' => 'ชื่อสินค้า', 'name' => 'product_id', 'data' => 'product_id'],
            'categoty_id' => ['title' => 'ประเภทสินค้า', 'name' => 'categoty_id', 'data' => 'categoty_id'],
            'value' => ['title' => 'จำนวนสินค้า', 'name' => 'value', 'data' => 'value'],
            // 'user_id' => ['title' => 'เจ้าของ', 'name' => 'user_id', 'data' => 'user_id'],
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'stocksdatatable_' . time();
    }
}
