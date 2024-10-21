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
        Schema::create('shipping_couriers', function (Blueprint $table) {
            $table->id();
            $table->integer('vendor_id');
            $table->text('couriers');
            $table->timestamps();
            $table->boolean('is_COD_enabled')->default(false);
            $table->boolean('is_local_deliveries')->default(false);
            $table->float('base_cost')->nullable();
            $table->float('cost_per_km')->nullable();
            $table->decimal('lon', 11, 8)->nullable();
            $table->decimal('lat', 10, 8)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shipping_couriers');
    }
};
