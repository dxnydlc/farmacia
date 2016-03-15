<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('productos', function (Blueprint $table) {
            $table->increments('id_producto');
            $table->string('nombre', 200);
            $table->text('descripcion')->nullable();
            $table->integer('id_categoria')->nullable();
            $table->string('categoria', 200)->nullable();
            $table->integer('id_marca')->nullable();
            $table->string('marca', 200)->nullable();
            $table->integer('id_clase')->nullable();
            $table->string('clase', 200)->nullable();
            $table->string('laboratorio', 200)->nullable();
            $table->integer('id_proveedor')->nullable();
            $table->string('proveedor', 200)->nullable();
            $table->char('destacado', 4);
            #
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
        Schema::drop('productos');
    }
}
