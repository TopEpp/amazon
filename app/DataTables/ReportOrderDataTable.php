<?php

namespace App\DataTables;

use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Services\DataTable;

class ReportOrderDataTable extends DataTable
{

    protected $printPreview = 'orders.report_order';

    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        $dataTable = new EloquentDataTable($query);

        // //search
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
    public function query(Order $model, Request $request)
    {

        $query = $model
            ->join('users', 'users.id', '=', 'orders.user_id')
            ->join('order_items', 'order_items.order_id', '=', 'orders.id')
            ->select('users.name', 'orders.id', 'orders.price', 'orders.date', DB::raw('sum(order_items.value) as value'))
            ->groupby(['orders.id', 'users.name', 'orders.id', 'orders.price', 'orders.date']);

        //search custom
        if ($request->has('number') && $request->number != '') {
            $query->where('orders.id', $request->number);
        }
        if ($request->has('owner') && $request->owner != '') {
            $query->where('users.name', 'like', '%' . $request->owner . '%');
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
        $attributes = [
            'data' => 'function(d) {
                d.start_date = $("#start_date").val();
                d.end_date = $("#end_date").val();
            }',
        ];

        return $this->builder()
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->ajax($attributes)
        // ->addAction(['width' => '120px', 'title' => ''])
            ->parameters([
                'dom' => "<B>t<'row'<'col-sm-12 col-md-5'><'col-sm-12 col-md-7'p>>",
                'order' => [[0, 'desc']],
                'buttons' => [
                    // ['extend' => 'export', 'className' => 'btn btn-default btn-sm no-corner'],

                ],
                'pageLength' => 50,
                "bSort" => false,
                // 'buttons' => ['postExcel', 'postCsv', 'postPdf'],
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
            'id' => ['class' => 'text-center', 'title' => 'เลขคำสั่ง', 'name' => 'orders.id', 'data' => 'id'],
            'name' => ['class' => 'text-left', 'title' => 'ชื่อผู้สั่ง', 'name' => 'users.name', 'data' => 'name'],
            'date' => ['class' => 'text-center', 'title' => 'วันที่สั่ง', 'name' => 'orders.date', 'data' => 'date'],
            'value' => ['class' => 'text-right', 'title' => 'จำนวนสินค้า', 'name' => 'order_items.value', 'data' => 'value'],
            'price' => ['class' => 'text-right', 'title' => 'ราคารวม', 'name' => 'order_items.price', 'data' => 'price'],
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
