<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Proveedor extends Model
{
    protected $table = 'proveedores';
    protected $primaryKey = 'id_proveedor';

    protected $fillable = [
        'nom_proveedor', 'contacto'
    ];

    public function ingresos()
    {
        return $this->hasMany(IngresoProducto::class, 'id_proveedor', 'id_proveedor');
    }
}


