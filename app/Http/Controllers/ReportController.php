<?php

namespace App\Http\Controllers;

use App\DataTables\ReportOrderDataTable;
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

    public function reportImport()
    {
        return view('reports.report_import');
    }

    public function reportStock()
    {
        return view('reports.report_stock');
    }

    public function reportStockOrder()
    {
        return view('reports.report_stock_order');
    }
}
