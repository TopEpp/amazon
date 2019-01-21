<?php

namespace App\Listeners;

use App\Events\getDataDashboard;
use Illuminate\Support\Facades\DB;

class getOrderData
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
    public function handle(getDataDashboard $event)
    {
        $data = array();
        $value_all = DB::table('orders')
            ->join('order_items', 'order_items.order_id', '=', 'orders.id')
            ->select(DB::raw('sum(price) as total'))
            ->whereBetween("orders.date", $event->date)
            ->first();
        if (empty($value_all->total)) {
            $value_all->total = 0;
        }

        $orders_products = DB::table('products')
            ->join('stocks', 'stocks.product_id', '=', 'products.id')
            ->join('units', 'units.id', '=', 'products.unit_id')
        // ->join('orders', 'items.order_id', '=', 'orders.id')
            ->select('products.*', 'stocks.value as value', 'units.name as unit')
        // ->groupBy('items.order_id')
        // ->groupBy('stocks.name')
        // ->whereBetween("orders.date", $event->date)
            ->whereNull('products.deleted_at')
            ->limit(5)
            ->orderBy('stocks.value', 'asc')
        // ->orderByDesc('')
            ->get();

        $chart_data = DB::table('orders')
            ->join('order_items', 'order_items.order_id', '=', 'orders.id')
            ->select(
                DB::raw("orders.date as month"),
                DB::raw("sum(order_items.value) as total")
            )
            ->whereBetween("orders.date", $event->date)
            ->groupBy('month')
            ->groupBy('order_items.order_id')
            ->get();

        $data['value_all'] = $value_all;
        $data['orders_products'] = $orders_products;
        $data['chart_data'] = $chart_data;

        return $data;
    }
}
