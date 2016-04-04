<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateParteEntradasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('parte_entrada', function (Blueprint $table) {
            $table->increments('id_pe');
            $table->integer('id_producto')->nullable();
            $table->string('Producto', 200)->nullable();
            $table->integer('id_proveedor')->nullable();
            $table->string('Proveedor', 200)->nullable();
            $table->string('Laboratorio', 200)->nullable();
            $table->string('Lote', 200)->nullable();
            $table->date('Vencimiento')->nullable();
            $table->decimal('precio_compra', 10, 2)->nullable();
            $table->decimal('precio_venta', 10, 2)->nullable();
            $table->integer('porcentaje')->nullable();
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
        Schema::drop('parte_entrada');
    }
}
