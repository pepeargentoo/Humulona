<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProveedorsTable extends Migration
{

    public function up()
    {
        Schema::create('proveedors', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre');
            $table->string('razonsocial');
            $table->string('email');
            $table->string('direccion');
            $table->string('telefono');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::drop('proveedors');
    }
}
