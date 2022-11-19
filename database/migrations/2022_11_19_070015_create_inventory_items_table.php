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
        Schema::create('inventory_items', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->string('name');
            $table->unsignedBigInteger('brand_id')->nullable()->default(0);
            $table->decimal('unit_price');
            $table->unsignedBigInteger('stock')->nullable();
            $table->unsignedBigInteger('critical_level');
            $table->boolean('is_active')->default(true);
            
            $table->foreign('brand_id')
                ->references('id')
                ->on('brands')
                ->onDelete('SET NULL');

            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('inventory_items');
    }
};
