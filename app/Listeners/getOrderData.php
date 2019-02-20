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
        //all price
        $value_all = DB::table('orders')
            ->select(DB::raw('sum(price) as total'))
            ->whereBetween("orders.date", $event->date)
            ->first();

        //product list
        $orders_products = DB::table('products')
            ->join('stocks', 'stocks.product_id', '=', 'products.id')
            ->join('units', 'units.id', '=', 'products.unit_id')
            ->select('products.*', 'stocks.value as value', 'units.name as unit')
            ->whereNull('products.deleted_at')
            ->limit(5)
            ->orderBy('stocks.value', 'asc')
            ->get();

        //chart js
        $order_items = DB::table('order_items')
            ->select('order_id', DB::raw("sum(order_items.value) as total"))
            ->groupBy('order_id');

        $chart_data = DB::table('orders')
            ->join('users', 'users.id', '=', 'orders.user_id')
            ->joinSub($order_items, 'order_items', function ($join) {
                $join->on('orders.id', '=', 'order_items.order_id');
            })
            ->whereBetween("orders.date", $event->date)
            ->select('users.name', DB::raw("sum(orders.price) as price"), 'total')
            ->groupBy('orders.user_id')
            ->get();

        $data['value_all'] = $value_all;
        $data['orders_products'] = $orders_products;
        $data['chart_data'] = $chart_data;

        return $data;
    }
}
