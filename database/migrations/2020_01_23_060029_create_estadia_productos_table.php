<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEstadiaProductosTable extends Migration
{

    public function up()
    {
        Schema::create('estadia_productos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('estadia');
            $table->integer('cantida');
            $table->string('nombre');
            $table->float('monto');
            $table->string('descripcion');
            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::drop('estadia_productos');
    }
}
