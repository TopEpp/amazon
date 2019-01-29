<?php

namespace App\Http\Controllers;

use App\DataTables\ReportImportDataTable;
use App\DataTables\ReportOrderDataTable;
use App\DataTables\ReportStockDataTable;
use App\DataTables\ReportStockOrderDataTable;
use Illuminate\Http\Request;

class ReportController extends Controller
{

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
}
