<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Usuario extends Authenticatable
{
    protected $table = 'usuarios';
    protected $primaryKey = 'rut'; 
    public $incrementing = false; 

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
    
    public function esAdministrador():bool
    {
        return $this->rol->nombre_rol=='Administrador';
    }

    public function nombreRol():string{
        return $this->rol->nombre_rol;
    }

}
