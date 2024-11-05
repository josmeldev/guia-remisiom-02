<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pago extends Model
{
    use HasFactory;

    protected $fillable = [
        'Adelanto',
        'Precio_Unitario',
        'Metodo_Pago',
        'Nro_Operacion',
        'Tipo_Pago',
        'Monto',
        'guia_id'
    ];

    // Relación con el modelo Guia
    public function guia()
    {
        return $this->belongsTo(Guia::class);
    }

    
}
