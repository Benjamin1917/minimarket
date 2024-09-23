<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $table = 'productos';

    protected $fillable = [
        'id_categoria', 'nombre_producto', 'marca_producto', 'precio_producto', 'cantidad_stock'
    ];

    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'id_categoria');
    }

    public function detalleVentas()
    {
        return $this->hasMany(DetalleVenta::class, 'id_producto');
    }

    public function ingresos()
    {
        return $this->hasMany(IngresoProducto::class, 'id_producto');
    }

    public function ajustes()
    {
        return $this->hasMany(AjusteStock::class, 'id_producto');
    }
}
