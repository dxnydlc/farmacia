<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductoLotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('producto_lote', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_producto')->nullable();
            $table->string('producto', 200)->nullable();
            $table->string('lote', 200)->nullable();
            $table->string('laboratorio', 200)->nullable();
            $table->date('vencimiento')->nullable();
            $table->decimal('precio', 10, 2)->nullable();
            $table->decimal('precio_old', 10, 2)->nullable();
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
        Schema::drop('producto_lote');
    }
}
