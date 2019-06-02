<?php

namespace App\DataTables;

use App\Models\Product;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Services\DataTable;

class ProductDataTable extends DataTable
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

        // $dataTable->editColumn('category_id', function ($model) {

        //     return $model->category->name;
        // });

        // $dataTable->editColumn('unit_id', function ($model) {

        //     return $model->unit->name;
        // });

        // $dataTable->addColumn('value', function ($model) {
        //     return (!empty($model->stock->value)) ? $model->stock->value : '0';
        // });

        return $dataTable->addColumn('action', 'products.datatables_actions');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Product $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Product $model)
    {
        $query = $model
            ->join('categorys', 'categorys.id', '=', 'products.category_id')
            ->join('units', 'units.id', '=', 'products.unit_id')
            ->join('stocks', 'stocks.product_id', '=', 'products.id')
            ->select('products.id', 'stocks.value', 'units.name as unit', 'categorys.name as categorys', 'products.name as product')
            ->groupby(['products.id', 'stocks.value', 'units.name', 'categorys.name', 'products.name']);

        return $this->applyScopes($query);
        // return $model->newQuery();
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
                'dom' => "<'row'<'table-product'><'table-unit'><'table-cate'><'col align-self-end'f>>t<'row'<'col-sm-12 col-md-5'><'col-sm-12 col-md-7'p>>",
                'order' => [[0, 'desc']],
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
            'product' => ['title' => 'ชื่อสินค้า', 'name' => 'products.name', 'data' => 'product'],
            'category' => ['title' => 'ประเภทสินค้า', 'name' => 'categorys.name', 'data' => 'categorys'],
            'value' => ['class' => 'text-right', 'title' => 'จำนวน', 'name' => 'stocks.value', 'data' => 'value'],
            'unit' => ['title' => 'หน่วยนับ', 'name' => 'units.name', 'data' => 'unit'],
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'productsdatatable_' . time();
    }
}
