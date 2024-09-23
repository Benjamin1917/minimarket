<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IngresoProducto extends Model
{
    protected $table = 'ingreso_productos';

    protected $fillable = [
        'id_proveedor', 'id_producto', 'rut_usuario', 'fecha_ingreso', 'cantidad_ingresada'
    ];

    public function proveedor()
    {
        return $this->belongsTo(Proveedor::class, 'id_proveedor');
    }

    public function producto()
    {
        return $this->belongsTo(Producto::class, 'id_producto');
    }

    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'rut_usuario', 'rut_usuario');
    }
}

