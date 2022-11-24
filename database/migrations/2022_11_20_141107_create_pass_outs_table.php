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
        Schema::create('pass_outs', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string("short_description");
            $table->longText('notes')->nullable();
            $table->tinyInteger('status')->default(0);

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
        Schema::dropIfExists('pass_outs');
    }
};
