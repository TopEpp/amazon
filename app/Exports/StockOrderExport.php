<?php

namespace App\Exports;

use App\Models\Order;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromView;

class StockOrderExport implements FromView
{
    /**
     * @return \Illuminate\Support\Collection
     */

    private $owner;
    private $product;
    private $start;
    private $end;

    public function __construct(string $owner = null, string $product = null, string $start = null, string $end = null)
    {
        $this->owner = $owner;
        $this->product = $product;
        $this->start = $start;
        $this->end = $end;

    }

    public function view(): View
    {
        $query = Order::join('order_items', 'order_items.order_id', '=', 'orders.id')
            ->join('products', 'products.id', '=', 'order_items.product_id')
        // ->join('categorys', 'categorys.id', '=', 'products.categoty_id')
            ->groupBy('order_items.product_id', 'products.name')
            ->select('products.name', DB::raw('sum(order_items.value) as value'));

        //search
        if ($this->owner != '0' || $this->owner != '') {
            $query->where('orders.user_id', $this->owner);
        }
        if ($this->product != '') {
            $query->where('products.name', 'like', '%' . $this->product . '%');
        }

        if ($this->start != '') {

            $date = [$this->start . ' ' . '00:00:00', $this->end . ' ' . '00:00:00'];
            $query->whereBetween('orders.date', $date);
        }

        $data = $query->groupby('order_items.product_id')->get();

        return view('reports.excel_stock_order', [
            'stocks' => $data,
        ]);
    }
}
