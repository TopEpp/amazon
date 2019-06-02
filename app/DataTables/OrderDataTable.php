<?php

namespace App\DataTables;

use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Services\DataTable;

class OrderDataTable extends DataTable
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

        //search
        // $dataTable->filterColumn('date', function ($query, $keyword) {
        //     $query->whereRaw("DATE_FORMAT(date,'%d/%m/%Y') like ?", ["%$keyword%"]);
        // });
        $dataTable->editColumn('date', function ($model) {
            // return $model->date;
            return Carbon::createFromFormat('Y-m-d h:i:s', $model->date)->format('d/m/Y');
        });

        $dataTable->editColumn('order_status', function ($model) {
            if ($model->order_status == 0) {
                $status = '<span class="badge badge-info">ออเดอร์ใหม่</span>';
            } else {
                $status = '<span class="badge badge-success">ยืนยันออเดอร์</span>';
            }

            return $status;
        })->toJson();

        $dataTable->rawColumns(['order_status', 'action']);

        return $dataTable->addColumn('action', 'orders.datatables_actions');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Order $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Order $model, Request $request)
    {
        $query = $model
            ->join('order_items', 'order_items.order_id', '=', 'orders.id')
            ->join('users', 'users.id', '=', 'orders.user_id')
            ->select('orders.id', 'users.name', 'orders.order_status', 'orders.remark', 'orders.date', DB::raw('sum(order_items.value) as value'))
            ->groupby(['orders.id', 'users.name', 'orders.order_status', 'orders.remark', 'orders.date']);

        if (Auth::user()->type != 1) {
            $query->where('orders.user_id', Auth::user()->id);
        }

        if ($request->has('owner') && $request->owner != '') {
            $query->where('users.name', 'like', '%' . $request->owner . '%');
        }
        if ($request->has('status') && $request->status != '') {
            $query->where('orders.order_status', $request->status);
        }
        if ($request->has('start_date') && $request->start_date != '') {

            $date = [$request->start_date . ' ' . '00:00:00', $request->end_date . ' ' . '00:00:00'];
            $query->whereBetween('orders.date', $date);
        }

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
                'dom' => "<'row'<'table-create '>'<'col align-self-end'>>t<'row'<'col-sm-12 col-md-5'><'col-sm-12 col-md-7'p>>",
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
            'id' => ['title' => 'เลขคำสั่ง', 'name' => 'id', 'data' => 'id', 'class' => 'text-center'],
            'name' => ['title' => 'ชื่อสาขา', 'name' => 'users.name', 'data' => 'name'],
            'value' => ['class' => 'text-right', 'title' => 'จำนวนสินค้า', 'name' => 'value', 'data' => 'value'],
            'date' => ['class' => 'text-center', 'title' => 'วันที่สั่ง', 'name' => 'date', 'data' => 'date'],
            'order_status' => ['title' => 'สถานะ', 'name' => 'order_status', 'data' => 'order_status', 'class' => 'text-center'],
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
        return 'ordersdatatable_' . time();
    }
}
