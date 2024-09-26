<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{
    use HasFactory;

    protected $table = 'roles'; // Nombre de la tabla en la base de datos

    protected $primaryKey = 'id_rol'; // Clave primaria

    protected $fillable = ['nombre']; // Campos que se pueden llenar

    // Relación con usuarios
    public function usuarios()
    {
        return $this->hasMany(Usuario::class, 'id_rol', 'id_rol'); // Relación uno a muchos
    }
}
