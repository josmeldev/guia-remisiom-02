<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class factura extends Model
{
    use HasFactory;

    protected $fillable = [
        'nro_factura',
        'razon_social',
        'ruc',
        'direccion',
        'descripcion_producto',
        'precio_unitario',
        'subtotal',
        'total',
    ];

    public function guia()
    {
        return $this->hasOne(Guia::class);
    }
}
