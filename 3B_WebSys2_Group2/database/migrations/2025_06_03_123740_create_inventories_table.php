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
        Schema::create('inventories', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->string('month');
            $table->string('year');
            $table->string('item');
            $table->string('unit');
            $table->integer('quantity');
            $table->integer('purchased_supplies');
            $table->integer('supplies_from_lingayen');
            $table->decimal('purchased_total_cost', 12, 2);
            $table->decimal('lingayen_total_cost', 12, 2);
            $table->integer('issued'); 
            $table->integer('inventory_end'); 
            $table->decimal('unit_cost', 12, 2);
            $table->decimal('amount', 12, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inventories');
    }
};
