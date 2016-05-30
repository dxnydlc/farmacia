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
            $table->increments('id');
            $table->integer('id_proveedor')->nullable();
            $table->string('proveedor', 200)->nullable();
            $table->date('fecha')->nullable();
            $table->text('token')->nullable();
            $table->integer('id_user')->nullable();
            $table->string('user', 200)->nullable();
            $table->string('estado', 200)->nullable();
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
