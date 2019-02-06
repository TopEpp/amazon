<?php

namespace App\Exports;

use App\Models\Order;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromView;

class OrdersExport implements FromView
{
    /**
     * @return \Illuminate\Support\Collection
     */

    private $number;
    private $owner;
    private $start;
    private $end;

    public function __construct(string $number = null, string $owner = null, string $start = null, string $end = null)
    {
        $this->number = $number;
        $this->owner = $owner;
        $this->start = $start;
        $this->end = $end;

    }

    public function view(): View
    {
        $query = Order::join('users', 'users.id', '=', 'orders.user_id')
            ->join('order_items', 'order_items.order_id', '=', 'orders.id')
            ->select('users.name', 'orders.id', 'orders.date', DB::raw('sum(order_items.value) as value'));

        //search
        if ($this->number != '') {
            $query->where('orders.id', $this->number);
        }
        if ($this->owner != '') {
            $query->where('users.name', 'like', '%' . $this->owner . '%');
        }
        if ($this->start != '' && $this->end != '') {
            $date = [$this->start, $this->end];
            $query->whereBetween('orders.date', $date);
        }
        $data = $query->groupby('orders.id')->get();

        return view('reports.excel_order', [
            'orders' => $data,
        ]);
    }
}
