<?php

namespace App\Listeners;

use App\Events\getDataDashboardSale;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class getOrderDataSale
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(getDataDashboardSale $event)
    {
        $data = array();

        $money_all = DB::table('orders')
            ->join('items', 'items.order_id', '=', 'orders.id')
            ->join('customers', 'customers.id', '=', 'orders.customer_id')
            ->where('customers.sale_id', Auth::user()->id)
            ->select(DB::raw('sum(prices) as total'))
            ->whereBetween("orders.date", $event->date)
            ->first();

        $orders_max = DB::table('items')
            ->join('stocks', 'stocks.id', '=', 'items.stock_id')
            ->join('orders', 'items.order_id', '=', 'orders.id')
            ->join('customers', 'customers.id', '=', 'orders.customer_id')
            ->where('customers.sale_id', Auth::user()->id)
            ->select('stocks.name', DB::raw('sum(items.quantity) as total'))
            ->groupBy('items.order_id')
            ->groupBy('stocks.name')
            ->whereBetween("orders.date", $event->date)
            ->limit(5)
            ->orderByDesc('total')
            ->get();

        $chart_data = DB::table('orders')
            ->join('items', 'items.order_id', '=', 'orders.id')
            ->join('customers', 'customers.id', '=', 'orders.customer_id')
            ->where('customers.sale_id', Auth::user()->id)
            ->select(
                DB::raw("orders.date as month"),
                DB::raw("sum(items.quantity) as total")
            )
            ->whereBetween("orders.date", $event->date)
            ->groupBy('month')
            ->groupBy('items.order_id')
            ->get();
        $data['money_all'] = $money_all;
        $data['orders_max'] = $orders_max;
        $data['chart_data'] = $chart_data;

        return $data;
    }
}
