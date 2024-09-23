<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    protected $table = 'usuarios';
    protected $primaryKey = 'rut_usuario';
    public $incrementing = false; // clave primaria no autoincremental

    protected $fillable = [
        'rut_usuario', 'nombre_usuario', 'apellido_usuario', 'contrasena_usuario', 'tipo_usuario'
    ];

    public function ventas()
    {
        return $this->hasMany(Venta::class, 'rut_usuario', 'rut_usuario');
    }

    public function ajustes()
    {
        return $this->hasMany(AjusteStock::class, 'rut_usuario', 'rut_usuario');
    }

    public function ingresos()
    {
        return $this->hasMany(IngresoProducto::class, 'rut_usuario', 'rut_usuario');
    }
}

