<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEstadiasTable extends Migration
{

    public function up()
    {
        Schema::create('estadias', function (Blueprint $table) {
            $table->increments('id');
            $table->string('mozo');
            $table->string('mesa');
            $table->date('fecha');
            $table->float('monto');
            $table->enum('estado',['libre','ocupada','esperando','finalizado'])->default('libre');
            $table->enum('cocina',['norequerido','pendiente','finalizado'])->default('norequerido');
            $table->string('ticketcomida',1000);
            $table->boolean('comida');
            $table->boolean('bebida');
            $table->string('ticketbebida',1000);
            $table->boolean('facturado')->default(false);
            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::drop('estadias');
    }
}
