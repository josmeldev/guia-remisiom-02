<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class vehiculo extends Model
{
    use HasFactory;

    protected $fillable = [
        'placa',
        'placa1',
        'dueño',
        'id_transportista',
    ];

    // Definición de la relación con el transportista
    public function transportista()
    {
        return $this->belongsTo(Transportista::class, 'id_transportista');
    }



    public function choferes()
    {
        return $this->belongsToMany(Chofer::class, 'chofer_vehiculos', 'vehiculo_id', 'chofer_id')
                    ->withTimestamps();
    }

    public function conductor()
    {
        return $this->belongsTo(Chofer::class);
    }


}
