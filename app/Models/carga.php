<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class carga extends Model
{
    use HasFactory;

    protected $fillable = [
        'chofer_id',
        'total_carga_bruta',
        'total_material_extrano',
        'tara',
        'nro_ticket',
        'km_origen',
        'km_de_destino',
        'fecha_carga',
        'fecha_de_descarga',
        'RUC_Agricultor',
        'campo_id'
    ];

    public function agricultor()
    {
        return $this->belongsTo(Agricultor::class, 'RUC_Agricultor');
    }

    public function campo()
    {
        return $this->belongsTo(Campo::class);
    }

    public function guiaDeRemision()
    {
        return $this->hasOne(Guia::class);
    }

    public function chofer()
    {
        return $this->belongsTo(Chofer::class);
    }

    
}
