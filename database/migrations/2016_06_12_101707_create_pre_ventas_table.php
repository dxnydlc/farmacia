<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePreVentasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pre_venta', function (Blueprint $table) {
            $table->increments('id');
            $table->char('tipo_doc', 4)->nullable();
            $table->integer('serie')->nullable();
            $table->integer('correlativo')->nullable();
            $table->integer('id_cliente')->nullable();
            $table->string('cliente', 200)->nullable();
            $table->date('fecha')->nullable();
            $table->decimal('total', 10, 2)->nullable();
            $table->integer('ruc')->nullable();
            $table->string('razon_social', 200)->nullable();
            $table->string('forma_pago', 200)->nullable();
            $table->decimal('pago_efectivo', 10, 2)->nullable();
            $table->decimal('vuelto', 10, 2)->nullable();
            $table->text('motivo_anular')->nullable();
            $table->text('token')->nullable();
            $table->char('estado', 4)->default('ACT');
            $table->integer('id_user_creado')->nullable();
            $table->string('user_creado', 200)->nullable();
            $table->integer('id_user_anula')->nullable();
            $table->string('user_anula', 200)->nullable();
            $table->integer('id_user_cierra')->nullable();
            $table->string('user_cierra', 200)->nullable();
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
        Schema::drop('pre_venta');
    }
}
