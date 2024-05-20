<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReservaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservas', function (Blueprint $table) {
            $table->id('id_reserva');
            $table->date('fecha_ini');
            $table->date('fecha_fin');
            $table->boolean('activa');
            $table->foreignId('id_vehiculo')->constrained('vehiculo')->onDelete('cascade'); // Clave foránea a la tabla vehiculos
            $table->foreignId('id_parqueadero')->constrained('espacio')->onDelete('cascade'); // Clave foránea a la tabla espacios
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
        Schema::dropIfExists('reservas');
    }
}

