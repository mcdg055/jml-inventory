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
        Schema::table('supplies', function (Blueprint $table) {
            $table->string('notes')->nullable();
            $table->unsignedBigInteger('received_by');
            $table->foreign('supplier_id')->references('id')->on('suppliers')->onDelete('NO ACTION');
            $table->foreign('received_by')->references('id')->on('users')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('supplies', function (Blueprint $table) {
            $table->dropConstrainedForeignId('supplier_id');
            $table->dropConstrainedForeignId('received_by');
            $table->dropColumn('notes');
        });
    }
};
