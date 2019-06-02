<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateForeignKeys extends Migration
{

    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->foreign('category_id')->references('id')->on('categorys')
                ->onDelete('restrict')
                ->onUpdate('restrict');
        });
        Schema::table('products', function (Blueprint $table) {
            $table->foreign('unit_id')->references('id')->on('units')
                ->onDelete('restrict')
                ->onUpdate('restrict');
        });
        Schema::table('stocks', function (Blueprint $table) {
            $table->foreign('product_id')->references('id')->on('products')
                ->onDelete('restrict')
                ->onUpdate('restrict');
        });
        Schema::table('stocks', function (Blueprint $table) {
            $table->foreign('categoty_id')->references('id')->on('categorys')
                ->onDelete('restrict')
                ->onUpdate('restrict');
        });
        Schema::table('stocks', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')
                ->onDelete('restrict')
                ->onUpdate('restrict');
        });

        Schema::table('orders', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')
                ->onDelete('restrict')
                ->onUpdate('restrict');
        });
        Schema::table('imports', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')
                ->onDelete('restrict')
                ->onUpdate('restrict');
        });
        Schema::table('order_items', function (Blueprint $table) {
            $table->foreign('order_id')->references('id')->on('orders')
                ->onDelete('restrict')
                ->onUpdate('restrict');
        });
        Schema::table('order_items', function (Blueprint $table) {
            $table->foreign('product_id')->references('id')->on('products')
                ->onDelete('restrict')
                ->onUpdate('restrict');
        });
        Schema::table('order_items', function (Blueprint $table) {
            $table->foreign('stock_id')->references('id')->on('stocks')
                ->onDelete('restrict')
                ->onUpdate('restrict');
        });
        Schema::table('import_items', function (Blueprint $table) {
            $table->foreign('import_id')->references('id')->on('imports')
                ->onDelete('restrict')
                ->onUpdate('restrict');
        });
        Schema::table('import_items', function (Blueprint $table) {
            $table->foreign('product_id')->references('id')->on('products')
                ->onDelete('restrict')
                ->onUpdate('restrict');
        });
        Schema::table('import_items', function (Blueprint $table) {
            $table->foreign('stock_id')->references('id')->on('stocks')
                ->onDelete('restrict')
                ->onUpdate('restrict');
        });
    }

    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropForeign('products_category_id_foreign');
        });
        Schema::table('products', function (Blueprint $table) {
            $table->dropForeign('products_unit_id_foreign');
        });
        Schema::table('stocks', function (Blueprint $table) {
            $table->dropForeign('stocks_product_id_foreign');
        });
        Schema::table('stocks', function (Blueprint $table) {
            $table->dropForeign('stocks_categoty_id_foreign');
        });
        Schema::table('stocks', function (Blueprint $table) {
            $table->dropForeign('stocks_user_id_foreign');
        });
        Schema::table('stocks', function (Blueprint $table) {
            $table->dropForeign('stocks_order_id_foreign');
        });
        Schema::table('stocks', function (Blueprint $table) {
            $table->dropForeign('stocks_import_id_foreign');
        });
        Schema::table('orders', function (Blueprint $table) {
            $table->dropForeign('orders_user_id_foreign');
        });
        Schema::table('imports', function (Blueprint $table) {
            $table->dropForeign('imports_user_id_foreign');
        });
        Schema::table('order_items', function (Blueprint $table) {
            $table->dropForeign('order_items_order_id_foreign');
        });
        Schema::table('order_items', function (Blueprint $table) {
            $table->dropForeign('order_items_product_id_foreign');
        });
        Schema::table('order_items', function (Blueprint $table) {
            $table->dropForeign('order_items_stock_id_foreign');
        });
        Schema::table('import_items', function (Blueprint $table) {
            $table->dropForeign('import_items_import_id_foreign');
        });
        Schema::table('import_items', function (Blueprint $table) {
            $table->dropForeign('import_items_product_id_foreign');
        });
        Schema::table('import_items', function (Blueprint $table) {
            $table->dropForeign('import_items_stock_id_foreign');
        });
    }
}
