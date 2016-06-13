<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('logs', function (Blueprint $table) {
            $table->increments('id');
            $table->char('tipo', 4)->nullable();
            $table->char('tipo_doc', 4)->nullable();
            $table->string('key')->nullable();
            $table->string('evento')->nullable();
            $table->string('contenido')->nullable();
            $table->string('resultado')->nullable();
            $table->string('fecha')->nullable();
            $table->integer('id_user')->nullable();
            $table->string('usuario')->nullable();
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
        Schema::drop('logs');
    }
}
