<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('invoice_id');
            $table->integer('user_id');
            $table->double('ammount');
            $table->double('subtotal');
            $table->integer('payment_status');
            $table->text('order_address');
            $table->string('payment_method');
            $table->double('total_shipping');
            $table->integer('order_status');
            $table->integer('transaction_id');
            $table->integer('vendor_id');
            $table->text('shipping_method');
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
