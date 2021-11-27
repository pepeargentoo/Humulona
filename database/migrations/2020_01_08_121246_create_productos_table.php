<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductosTable extends Migration
{

    public function up()
    {
        Schema::create('productos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre');
            $table->enum('tipo',['unitario','litros']);
            $table->integer('unidadminima');
            $table->integer('unidadactuales');
            $table->float('preciocompra');
            $table->float('precioventa');
            $table->string('descripcion',500);
            $table->integer('categoria');
            $table->integer('proveedor');
            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::drop('productos');
    }
}
