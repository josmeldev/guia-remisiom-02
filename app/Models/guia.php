<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class guia extends Model
{
    use HasFactory;

    protected $fillable = [
        'fecha_emision',
        'nro_ticket',
        'fecha_partida',
        'punto_partida',
        'punto_llegada',
        'producto',
        'factura_id',
        'estado',
        'agricultor_id',
        'transportista_id',
        'carga_id'
    ];

    public function agricultor()
    {
        return $this->belongsTo(Agricultor::class);
    }

    public function transportista()
    {
        return $this->belongsTo(Transportista::class);
    }

    public function carga()
    {
        return $this->belongsTo(Carga::class);
    }

    public function factura()
    {
        return $this->belongsTo(Factura::class);
    }
    public function vehiculo()
    {
        return $this->belongsTo(Vehiculo::class);
    }



}




