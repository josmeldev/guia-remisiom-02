<?php

namespace App\Models;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class agricultor extends Model
{
    use HasFactory;
    use HasFactory, Notifiable;
    protected $fillable = [
        'ruc',
        'razon_social',
        'direccion',
        'representante',

    ];

    // Definir la relación con el modelo GuiaRemision
    public function guias()
    {
        return $this->hasMany(Guia::class);
    }
    public function pagos()
    {
        return $this->hasMany(Pago::class);
    }

    public function calcularPagoPendiente()
    {
        // Aquí deberías implementar la lógica para calcular los pagos pendientes para este agricultor
    }
}