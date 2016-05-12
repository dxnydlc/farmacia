<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PreciosDetallePe extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('parte_entrada_detalle', function (Blueprint $table) {
            $table->decimal('compra', 10, 2)->after('cantidad')->nullable();
            $table->decimal('venta', 10, 2)->after('compra')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('parte_entrada_detalle', function (Blueprint $table) {
            //
        });
    }
}
