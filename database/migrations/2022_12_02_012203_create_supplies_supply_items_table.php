<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('supplies_supply_items', function (Blueprint $table) {
            $table->foreignId('inventory_item_id')->constrained('inventory_items');
            $table->foreignId('supply_id')->constrained('supplies');
            $table->unsignedBigInteger('quantity');
            $table->decimal('unit_price');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('supply_items');
    }
};
