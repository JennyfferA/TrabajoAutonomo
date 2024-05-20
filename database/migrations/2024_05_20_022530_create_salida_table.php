<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalidaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('salidas', function (Blueprint $table) {
            $table->id('id_salida');
            $table->dateTime('fecha_salida');
            $table->integer('duracion_estacionamiento');
            $table->foreignId('id_ingreso')->constrained('ingresos')->onDelete('cascade'); // Clave foránea a la tabla ingresos
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
        Schema::dropIfExists('salidas');
    }
}


