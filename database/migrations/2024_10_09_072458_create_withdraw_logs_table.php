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
        Schema::create('withdraw_logs', function (Blueprint $table) {
            $table->id();
            $table->integer('vendor_id');
            $table->double('amount');
            $table->integer('from_acc_no');
            $table->text('notes');
            $table->text('status');
            $table->text('reference');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('withdraw_logs');
    }
};
