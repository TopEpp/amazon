<?php

namespace App\Exports;

use App\Models\Stock;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class StockExport implements FromView
{
    /**
     * @return \Illuminate\Support\Collection
     */

    private $number;
    private $owner;
    private $category;

    public function __construct(string $number = null, string $owner = null, string $category = null)
    {
        $this->number = $number;
        $this->owner = $owner;
        $this->category = $category;
    }

    public function view(): View
    {
        $query = Stock::join('categorys', 'categorys.id', '=', 'stocks.categoty_id')
            ->join('products', 'products.id', '=', 'stocks.product_id')
            ->select('products.name', 'categorys.name as category', 'products.code', 'stocks.value');

        //search
        if ($this->number != '') {
            $query->where('products.code', 'like', '%' . $this->number . '%');
        }
        if ($this->owner != '') {
            $query->where('products.name', 'like', '%' . $this->owner . '%');
        }
        if ($this->category != '' && $this->category != '0') {
            $query->where('categorys.id', $this->category);
        }
        $data = $query->get();

        return view('reports.excel_stock', [
            'stocks' => $data,
        ]);
    }
}
