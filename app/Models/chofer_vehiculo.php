<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class chofer_vehiculo extends Model
{
    use HasFactory;
    public function chofer_vehiculo()
{
    return $this->hasOne(Vehiculo::class,'id');
}
}



