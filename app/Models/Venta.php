<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    protected $table = 'ventas';
    protected $primaryKey = 'id_venta';
    public $incrementing = true;

    protected $fillable = [
        'rut_usuario', 'total_venta', 'fecha_venta', 'medio_pago'
    ];

    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'rut_usuario', 'rut');
    }

    public function detalleVentas()
    {
        return $this->hasMany(DetalleVenta::class, 'id_venta' ,'id_venta');
    }
    public function productos()
    {
        return $this->belongsToMany(Producto::class, 'venta_producto', 'id_venta', 'id_producto')
                    ->withPivot('cantidad'); // Tabla intermedia con cantidad
    }
    public function detalles()
    {
        return $this->hasMany(DetalleVenta::class, 'id_venta');
    }
}

