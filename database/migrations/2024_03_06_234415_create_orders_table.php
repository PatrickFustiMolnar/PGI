<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    /* CREATE TABLE $tableOrder(
      id INTEGER PRIMARY KEY AUTOINCREMENT,
      payment_amount INTEGER,
      sub_total INTEGER,
      tax INTEGER,
      discount INTEGER,
      service_charge INTEGER,
      total INTEGER,
      payment_method TEXT,
      total_item INTEGER,
      transaction_time TEXT,
      is_sync INTEGER DEFAULT 0
    )
    ''');*/
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('payment_amount');
            $table->integer('sub_total');
            $table->integer('tax');
            $table->integer('discount');
            $table->integer('service_charge');
            $table->integer('total');
            $table->enum('payment_method', ['especes', 'carte'])->default('carte');
            $table->integer('total_item');
            $table->string('transaction_time');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
