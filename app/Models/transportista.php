<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class transportista extends Model
{
    use HasFactory;

    protected $fillable = [
        'codigo_mtc',
        'telefono',
        'RUC',
        'razon_social',
        'direccion',
        //'zona',
        'correo_electronico',
    ];

    // Relación con vehículos
    public function vehiculos()
    {
        return $this->hasMany(Vehiculo::class, 'id_transportista');
    }

        public function vehiculo()
    {
        return $this->hasOne(Vehiculo::class,'id_transportista');
    }

}
