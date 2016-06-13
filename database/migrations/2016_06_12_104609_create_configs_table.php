<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConfigsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('config', function (Blueprint $table) {
            $table->increments('id');
            $table->string('empresa')->nullable();
            $table->string('ruc')->nullable();
            $table->string('direccion')->nullable();
            $table->integer('serie_boleta')->default('1');
            $table->integer('correlativo_boleta')->default('1');
            $table->integer('serie_factura')->default('1');
            $table->integer('correlativo_factura')->default('1');
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
        Schema::drop('config');
    }
}
