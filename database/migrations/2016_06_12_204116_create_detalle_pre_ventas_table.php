<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetallePreVentasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalle_pre_venta', function (Blueprint $table) {
            $table->increments('id');
            $table->string('producto', 200)->nullable();
            $table->integer('id_producto')->nullable();
            $table->integer('cantidad')->nullable();
            $table->decimal('precio', 10, 2)->nullable();
            $table->decimal('total', 10, 2)->nullable();
            $table->decimal('descuento', 10, 2)->nullable();
            $table->integer('id_user')->nullable();
            $table->string('usuario', 200)->nullable();
            $table->string('token', 200)->nullable();
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
        Schema::drop('detalle_pre_venta');
    }
}
