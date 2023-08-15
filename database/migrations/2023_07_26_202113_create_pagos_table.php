<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pagos', function (Blueprint $table) {
            $table->id();
            $table->string('serie');
            $table->string('fecha');
            $table->string('fpago');
            $table->string('hora');
            $table->integer('importe');
            $table->string('cliente');
            $table->unsignedBigInteger('almacen_id');
            $table->unsignedBigInteger('agt_id');
            $table->foreign('almacen_id')->references('id')->on('almacens');
            $table->foreign('agt_id')->references('id')->on('agentes');
            $table->string('sucursal');
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
        Schema::dropIfExists('pagos');
    }
};
