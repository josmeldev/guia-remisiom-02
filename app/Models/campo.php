<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class campo extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre_campo',
        'ubigeo',
        'zona',
        'unidad_tecnica',
    ];
   


}
