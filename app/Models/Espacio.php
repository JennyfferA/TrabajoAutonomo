<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Espacio extends Model
{
    use HasFactory;

    protected $table = 'espacios';
    protected $primaryKey = 'id_parqueadero';

    protected $fillable = [
        'numero_parqueadero',
        'disponible'
    ];

    public function reservas()
    {
        return $this->hasMany(Reserva::class, 'id_parqueadero');
    }
}
