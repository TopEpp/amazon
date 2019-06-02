<?php

namespace App\DataTables;

use App\Models\User;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Services\DataTable;

class UserDataTable extends DataTable
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

        $dataTable->editColumn('status', function ($user) {
            return ($user->status == 1) ? 'ใช้งานปกติ' : 'ระงับการใช้งาน';
        })->toJson();

        $dataTable->editColumn('type', function ($user) {
            return ($user->type == 1) ? 'ผู้ดูแลระบบ' : 'ผู้ใช้ทั่วไป';
        })->toJson();

        //search
        // $dataTable->filterColumn('status', function ($query, $keyword) {
        //     return '21';
        // });

        return $dataTable->addColumn('action', 'users.datatables_actions');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\User $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(User $model)
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
                'dom' => "<'row'<'col-sm-6 table-create'><'col-sm-6'>>t<'row'<'col-sm-12 col-md-5'><'col-sm-12 col-md-7'p>>",
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
            // 'DT_Row_Index' => ['title' => 'ลำดับ', 'class' => 'table_col', 'name' => 'id'],
            'name' => ['class' => 'text-left', 'title' => 'ชื่อ', 'name' => 'name', 'data' => 'name'],
            'phone' => ['class' => 'text-center', 'title' => 'เบอร์โทรศัพท์', 'name' => 'phone', 'data' => 'phone'],
            'type' => ['class' => 'text-left', 'title' => 'สิทธิผู้ใช้งาน', 'name' => 'type', 'data' => 'type'],
            'status' => ['class' => 'text-left', 'title' => 'สถานะ', 'name' => 'status', 'data' => 'status'],

        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'usersdatatable_' . time();
    }
}
