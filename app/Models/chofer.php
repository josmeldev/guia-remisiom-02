<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class chofer extends Model
{
    use HasFactory;
    protected $table = 'chofers';
    protected $fillable = [
        'dni',
        'nombre_apellidos',
        'telefono',
        'brevete',
    ];

    

    public function vehiculos()
    {
        return $this->belongsToMany(Vehiculo::class, 'chofer_vehiculos', 'chofer_id', 'vehiculo_id')
                    ->withTimestamps();
    }
}
