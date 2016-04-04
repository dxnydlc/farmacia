<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateParteEntradaDetallesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('parte_entrada_detalle', function (Blueprint $table) {
            $table->increments('id_detalle_pe');
            $table->string('producto', 200)->nullable();
            $table->integer('id_producto')->nullable();
            $table->string('laboratorio', 200)->nullable();
            $table->date('vencimiento')->nullable();
            $table->string('lote', 200)->nullable();
            $table->integer('cantidad')->nullable();
            $table->integer('porcentaje')->nullable();
            $table->integer('fraccion')->nullable();
            $table->text('token')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('parte_entrada_detalle');
    }
}
