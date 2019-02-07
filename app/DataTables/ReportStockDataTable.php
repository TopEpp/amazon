<?php

namespace App\DataTables;

use App\Models\Stock;
use Illuminate\Http\Request;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Services\DataTable;

class ReportStockDataTable extends DataTable
{
    protected $printPreview = 'stocks.report_stock';
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

        // $dataTable->editColumn('date', function ($model) {
        //     // return $model->date;
        //     return Carbon::createFromFormat('Y-m-d h:i:s', $model->date)->format('d/m/Y');
        // });
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
    public function query(Stock $model, Request $request)
    {
        $query = $model
            ->join('categorys', 'categorys.id', '=', 'stocks.categoty_id')
            ->join('products', 'products.id', '=', 'stocks.product_id')
            ->select('products.name', 'categorys.name as category', 'products.code', 'stocks.value');

        //search custom
        if ($request->has('number') && $request->number != '') {
            $query->where('products.code', 'like', '%' . $request->number . '%');
        }
        if ($request->has('owner') && $request->owner != '') {
            $query->where('products.name', 'like', '%' . $request->owner . '%');
        }
        if ($request->has('category') && $request->category != '' && $request->category != '0') {
            $query->where('categorys.id', $request->category);
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
            'code' => ['title' => 'รหัสสินค้า', 'name' => 'products.code', 'data' => 'code'],
            'name' => ['title' => 'ชื่อสินค้า', 'name' => 'products.name', 'data' => 'name'],
            'category' => ['title' => 'หมวดหมู่', 'name' => 'categorys.name', 'data' => 'category'],
            'value' => ['title' => 'จำนวนคงเหลือ', 'name' => 'stocks.value', 'data' => 'value'],
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
