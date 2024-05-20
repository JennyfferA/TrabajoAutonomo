<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ingreso extends Model
{
    use HasFactory;

    protected $table = 'ingreso';

    protected $fillable = [
        'fecha_ingreso',
        'duracion_estacionamiento',
        'id_reserva'
    ];

    public function reserva()
    {
        return $this->belongsTo(Reserva::class, 'id_reserva');
    }

    public function salidas()
    {
        return $this->hasMany(Salida::class, 'id_ingreso');
    }
}
