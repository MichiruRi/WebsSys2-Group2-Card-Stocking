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
        Schema::create('rsmi', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->string('month');
            $table->string('year');
            $table->string('fund_cluster')->nullable();
            $table->string('RIS_no')->nullable();
            $table->string('office')->nullable();
            $table->string('center_code')->nullable();
            $table->string('stock_no')->nullable();
            $table->string('item');
            $table->string('unit');
            $table->integer('quantity_issued');
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
        Schema::dropIfExists('rsmi');
    }
};
