<?php

namespace App\Exports;

use App\Models\OrderItem;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromView;

class StockOrderExport implements FromView
{
    /**
     * @return \Illuminate\Support\Collection
     */

    private $owner;

    public function __construct(string $owner = null)
    {
        $this->owner = $owner;

    }

    public function view(): View
    {
        $query = OrderItem::join('products', 'products.id', '=', 'order_items.product_id')
            ->select('products.name', DB::raw('sum(order_items.value) as value'));

        //search
        if ($this->owner != '') {
            $query->where('products.name', 'like', '%' . $this->owner . '%');
        }

        $data = $query->groupby('order_items.product_id')->get();

        return view('reports.excel_stock_order', [
            'stocks' => $data,
        ]);
    }
}
