<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Usuario;

class Vehiculo extends Model
{
    use HasFactory;
    protected $table = 'Vehiculo';
    protected $fillable = [
        'usuario_id',
        'placa',
        'marca',
        'modelo',
    ];
    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'usuario_id');
    }
}
