<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    protected $table = 'ventas';

    protected $fillable = [
        'rut_usuario', 'total_venta', 'fecha_venta', 'medio_pago'
    ];

    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'rut_usuario', 'rut');
    }

    public function detalleVentas()
    {
        return $this->hasMany(DetalleVenta::class, 'id_venta');
    }
}

