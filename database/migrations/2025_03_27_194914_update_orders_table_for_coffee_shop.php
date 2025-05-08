<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateOrdersTableForCoffeeShop extends Migration
{
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            // Ajouter status
            $table->enum('status', ['pending', 'preparing', 'ready', 'served'])->default('pending')->after('order_type');
            // Ajouter id_customer
            $table->unsignedBigInteger('id_customer')->nullable()->after('id');
            $table->foreign('id_customer')->references('id')->on('customers')->onDelete('set null');
            // Modifier order_type pour inclure takeaway
            $table->enum('order_type', ['dinein', 'reservation', 'takeaway'])->nullable()->change();
        });
    }

    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn('status');
            $table->dropForeign(['id_customer']);
            $table->dropColumn('id_customer');
            $table->enum('order_type', ['dinein', 'reservation'])->nullable()->change();
        });
    }
}