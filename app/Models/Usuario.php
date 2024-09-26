<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    protected $table = 'usuarios';
    protected $primaryKey = 'rut'; 
    public $incrementing = false; // clave primaria no autoincremental

    protected $fillable = [
        'rut', 'nombre', 'apellido', 'password', 'id_rol' 
    ];

    public function ventas()
    {
        return $this->hasMany(Venta::class, 'rut', 'rut'); 
    }

    public function ajustes()
    {
        return $this->hasMany(AjusteStock::class, 'rut', 'rut'); 
    }

    public function ingresos()
    {
        return $this->hasMany(IngresoProducto::class, 'rut', 'rut'); 
    }

    // Relación con el modelo Rol
    public function rol()
    {
        return $this->belongsTo(Rol::class, 'id_rol', 'id_rol'); // Relación muchos a uno con roles
    }

}
