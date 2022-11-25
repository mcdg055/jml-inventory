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
        Schema::create('pass_out_items', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->softDeletes();
            $table->unsignedBigInteger('item_id');
            $table->unsignedBigInteger('pass_out_id');
            $table->unsignedBigInteger('quantity');
            $table->decimal('subtotal');

            $table->foreign('item_id')
                ->references('id')
                ->on('inventory_items')
                ->restrictOnDelete();

            $table->foreign('pass_out_id')
                ->references('id')
                ->on('pass_outs')
                ->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pass_out_items');
    }
};
