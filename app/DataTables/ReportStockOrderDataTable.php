<?php

namespace App\DataTables;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Services\DataTable;

class ReportStockOrderDataTable extends DataTable
{
    protected $printPreview = 'stocks.report_stock_order';
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        $dataTable = new EloquentDataTable($query);
        return $dataTable->setRowAttr([

            'data-id' => function ($user) {
                return $user->id;
            },

        ])
            ->setRowClass(function ($user) {
                return 'on-click';
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Units $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Order $model, Request $request)
    {
        if ($request->has('owner') && $request->owner != '0') {
            $query = $model

                ->join('order_items', 'order_items.order_id', '=', 'orders.id')
                ->join('products', 'products.id', '=', 'order_items.product_id')
                // ->join('categorys', 'categorys.id', '=', 'products.categoty_id')
                ->groupBy('order_items.product_id')
                ->select('products.name', DB::raw('sum(order_items.value) as value'));
            //search custom
            if ($request->has('product') && $request->product != '') {
                $query->where('products.name', 'like', '%' . $request->product . '%');
            }

            $query->where('orders.user_id', $request->owner);
        } else {
            $query = $model
                ->join('users', 'users.id', '=', 'orders.user_id')
                ->join('order_items', 'order_items.order_id', '=', 'orders.id')
                ->groupBy('orders.user_id')
                ->select('users.id', 'users.name', DB::raw('sum(order_items.value) as value'));
        }

        if ($request->has('start_date') && $request->start_date != '') {

            $date = [$request->start_date . ' ' . '00:00:00', $request->end_date . ' ' . '00:00:00'];
            $query->whereBetween('orders.date', $date);
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
            // 'code' => ['title' => 'รหัสสินค้า', 'name' => 'products.code', 'data' => 'code'],
            'name' => ['class' => 'text-left', 'title' => 'ชื่อ', 'name' => 'products.name', 'data' => 'name'],
            // 'category' => ['title' => 'หมวดหมู่', 'name' => 'categorys.name', 'data' => 'category'],
            'value' => ['class' => 'text-right', 'title' => 'จำนวน', 'name' => 'order_items.value', 'data' => 'value'],
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
