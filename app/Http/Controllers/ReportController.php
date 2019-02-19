<?php

namespace App\Http\Controllers;

use App\DataTables\ReportImportDataTable;
use App\DataTables\ReportOrderDataTable;
use App\DataTables\ReportStockDataTable;
use App\DataTables\ReportStockOrderDataTable;
use App\Exports\ImportExport;
use App\Exports\OrdersExport;
use App\Exports\StockExport;
use App\Exports\StockOrderExport;
use App\Models\Category;
use App\Models\Import;
use App\Models\Order;
use App\Models\Stock;
use App\Models\User;
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
        $category = Category::All()->pluck('name', 'id');
        $category[0] = 'เลือก';

        return $ReportStockDataTable
            ->render('reports.report_stock', ['category' => $category]);

    }

    public function reportStockOrder(ReportStockOrderDataTable $ReportStockOrderDataTable, Request $request)
    {
        $user = '';
        if ($request->has('owner') && $request->owner != '') {
            $user = User::where('id', $request->owner)->pluck('name')->first();
        }

        $users = User::All()->pluck('name', 'id');
        $users[0] = 'เลือก';

        return $ReportStockOrderDataTable->render('reports.report_stock_order', ['user' => $user, 'users' => $users]);

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

    public function excelOrder(Request $request)
    {
        return Excel::download(new OrdersExport($request->number, $request->owner, $request->start_date, $request->end_date), 'excel_order.xlsx');
    }

    public function printPdfImport(Import $model, Request $request)
    {

        $query = $model
            ->join('users', 'users.id', '=', 'imports.user_id')
            ->join('import_items', 'import_items.import_id', '=', 'imports.id')
            ->select('users.name', 'imports.number', 'imports.price', 'imports.remark', 'imports.date', DB::raw('sum(import_items.value) as value'));

        //search custom
        if ($request->has('number') && $request->number != '') {
            $query->where('imports.number', 'like', '%' . $request->number . '%');
        }

        if ($request->has('start_date') && $request->start_date != '') {

            $date = [$request->start_date, $request->end_date];
            // ->whereBetween('imports.date', [1, 100])
            $query->whereBetween('imports.date', $date);
        }
        $data['items'] = $query->groupby('imports.id')->get();
        $pdf = PDF::loadView('reports.pdf_import', $data);
        $pdf->setPaper('A4', 'portrait');
        return $pdf->stream('pdf_order.pdf', array('Attachment' => 2));
    }

    public function excelImport(Request $request)
    {
        return Excel::download(new ImportExport($request->number, $request->start_date, $request->end_date), 'excel_import.xlsx');
    }

    public function printPdfStock(Stock $model, Request $request)
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

        $data['items'] = $query->groupby('products.code')->get();
        $pdf = PDF::loadView('reports.pdf_stock', $data);
        $pdf->setPaper('A4', 'portrait');
        return $pdf->stream('pdf_stock.pdf', array('Attachment' => 2));
    }

    public function excelStock(Request $request)
    {
        return Excel::download(new StockExport($request->number, $request->owner, $request->category), 'excel_stock.xlsx');
    }

    public function printPdfStockOrder(Order $model, Request $request)
    {
        $query = $model
            ->join('order_items', 'order_items.order_id', '=', 'orders.id')
            ->join('products', 'products.id', '=', 'order_items.product_id')
            // ->join('categorys', 'categorys.id', '=', 'products.categoty_id')
            ->groupBy('order_items.product_id')
            ->select('products.name', DB::raw('sum(order_items.value) as value'));

        //search custom
        if ($request->has('owner') && $request->owner != '') {
            $query->where('orders.user_id', $request->owner);
            $data['owner'] = User::where('id', $request->owner)->pluck('name')->first();
        }
        if ($request->has('product') && $request->product != '') {
            $query->where('products.name', 'like', '%' . $request->product . '%');
        }
        if ($request->has('start_date') && $request->start_date != '') {

            $date = [$request->start_date . ' ' . '00:00:00', $request->end_date . ' ' . '00:00:00'];
            $query->whereBetween('orders.date', $date);
        }

        $data['items'] = $query->groupby('order_items.product_id')->get();
        $pdf = PDF::loadView('reports.pdf_stock_order', $data);
        $pdf->setPaper('A4', 'portrait');
        return $pdf->stream('pdf_stockOrder.pdf', array('Attachment' => 2));
    }

    public function excelStockOrder(Request $request)
    {
        return Excel::download(new StockOrderExport($request->owner, $request->product, $request->start_date, $request->end_date), 'excel_stockOrder.xlsx');
    }
}
