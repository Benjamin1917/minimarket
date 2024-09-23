<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Proveedor extends Model
{
    protected $table = 'proveedores';

    protected $fillable = [
        'nom_proveedor', 'fono'
    ];

    public function ingresos()
    {
        return $this->hasMany(IngresoProducto::class, 'id_proveedor');
    }
}


