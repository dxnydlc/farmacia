<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKardexesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kardex', function (Blueprint $table) {
            $table->increments('id');
            $table->char('movimiento', 1)->nullable();
            $table->date('fecha')->nullable();
            $table->integer('id_producto')->nullable();
            $table->string('producto', 200)->nullable();
            $table->integer('id_persona')->nullable();
            $table->string('persona', 200)->nullable();
            $table->char('documento', 4)->nullable();
            $table->string('numero_doc', 100)->nullable();
            #Entrada
            $table->integer('cantidad_e')->nullable();
            $table->float('precio_e')->nullable();
            $table->float('valor_e')->nullable();
            #Salida
            $table->integer('cantidad_s')->nullable();
            $table->float('precio_s')->nullable();
            $table->float('valor_s')->nullable();
            #Saldos
            $table->integer('cantidad_f')->nullable();
            $table->float('precio_f')->nullable();
            $table->float('valor_f')->nullable();
            #
            $table->integer('id_user')->nullable();
            $table->string('usuario', 200)->nullable();
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
        Schema::drop('kardex');
    }
}
