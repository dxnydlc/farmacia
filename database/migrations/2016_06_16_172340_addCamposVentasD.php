<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCamposVentasD extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('detalle_venta', function (Blueprint $table) {
            $table->string('lote', 200)->null()->after('id_producto');
            $table->string('laboratorio', 200)->null()->after('lote');
            $table->date('vencimiento')->null()->after('laboratorio');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('detalle_venta', function (Blueprint $table) {
            //
        });
    }
}
