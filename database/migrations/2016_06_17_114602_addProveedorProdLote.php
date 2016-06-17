<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddProveedorProdLote extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('producto_lote', function (Blueprint $table) {
            $table->integer('id_proveedor')->null()->after('producto');
            $table->string('proveedor', 200)->null()->after('id_proveedor');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('producto_lote', function (Blueprint $table) {
            //
        });
    }
}
