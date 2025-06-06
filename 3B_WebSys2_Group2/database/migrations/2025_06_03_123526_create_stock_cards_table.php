<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('stock_cards', function (Blueprint $table) {
            $table->id();
            $table->string('item');
            $table->string('description')->nullable();
            $table->string('stock_no');
            $table->date('date');
            $table->string('month');
            $table->string('year');
            $table->string('reference');
            $table->integer('receipt_quantity')->nullable();
            $table->integer('quantity');
            $table->string('office')->nullable();
            $table->integer('balance_quantity')->nullable();
            $table->integer('days_consume')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stock_cards');
    }
};
