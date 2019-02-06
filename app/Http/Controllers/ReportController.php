<?php

namespace App\Http\Controllers;

use App\DataTables\ReportImportDataTable;
use App\DataTables\ReportOrderDataTable;
use App\DataTables\ReportStockDataTable;
use App\DataTables\ReportStockOrderDataTable;
use App\Exports\OrdersExport;
use App\Models\Order;
use Excel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDF;

class ReportController extends Controller
{
    private $orderRepository;

    public function __construct(Request $request)
    {
        $this->middleware('auth');

    }

    public function reportOrder(ReportOrderDataTable $ReportOrderDataTable)
    {
        return $ReportOrderDataTable->render('reports.report_order');
    }

    public function reportImport(ReportImportDataTable $ReportImportDataTable)
    {
        return $ReportImportDataTable->render('reports.report_import');

    }

    public function reportStock(ReportStockDataTable $ReportStockDataTable)
    {
        return $ReportStockDataTable->render('reports.report_stock');

    }

    public function reportStockOrder(ReportStockOrderDataTable $ReportStockOrderDataTable)
    {
        return $ReportStockOrderDataTable->render('reports.report_stock_order');

    }

    public function printPdfOrder(Order $model, Request $request)
    {

        $query = $model
            ->join('users', 'users.id', '=', 'orders.user_id')
            ->join('order_items', 'order_items.order_id', '=', 'orders.id')
            ->select('users.name', 'orders.id', 'orders.date', DB::raw('sum(order_items.value) as value'));

        //search custom
        if ($request->has('number') && $request->number != '') {
            $query->where('orders.id', $request->number);
        }
        if ($request->has('owner') && $request->owner != '') {
            $query->where('users.name', 'like', '%' . $request->owner . '%');
        }
        if ($request->has('start_date') && $request->start_date != '') {

            $date = [$request->start_date, $request->end_date];
            // ->whereBetween('orders.date', [1, 100])
            $query->whereBetween('orders.date', $date);
        }
        $data['items'] = $query->groupby('orders.id')->get();

        $pdf = PDF::loadView('reports.pdf_order', $data);
        $pdf->setPaper('A4', 'portrait');
        return $pdf->stream('pdf_order.pdf', array('Attachment' => 2));
    }

    public function excelOrder(Order $model, Request $request)
    {
        return Excel::download(new OrdersExport($request->number, $request->owner, $request->start_date, $request->end_date), 'excel_order.xlsx');
    }
}
