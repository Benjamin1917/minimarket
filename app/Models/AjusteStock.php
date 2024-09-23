<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AjusteStock extends Model
{
    protected $table = 'ajuste_stock';

    protected $fillable = [
        'id_producto', 'rut_usuario', 'cantidad', 'tipo_ajuste', 'fecha', 'motivo'
    ];

    public function producto()
    {
        return $this->belongsTo(Producto::class, 'id_producto');
    }

    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'rut_usuario', 'rut_usuario');
    }
}
