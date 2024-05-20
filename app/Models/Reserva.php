<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reserva extends Model
{
    use HasFactory;

    protected $table = 'reservas';
    protected $primaryKey = 'id_reserva';

    protected $fillable = [
        'fecha_ini',
        'fecha_fin',
        'activa',
        'id_vehiculo',
        'id_parqueadero'
    ];

    public function espacio()
    {
        return $this->belongsTo(Espacio::class, 'id_parqueadero');
    }

    public function vehiculo()
    {
        return $this->belongsTo(Vehiculo::class, 'id_vehiculo');
    }

    public function ingreso()
    {
        return $this->hasMany(Ingreso::class, 'id_reserva');
    }
}
