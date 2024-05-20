<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Salida extends Model
{
    use HasFactory;

    protected $table = 'salidas';
    protected $primaryKey = 'id_salida';

    protected $fillable = [
        'fecha_salida',
        'duracion_estacionamiento',
        'id_ingreso'
    ];

    public function ingreso()
    {
        return $this->belongsTo(Ingreso::class, 'id_ingreso');
    }
}
