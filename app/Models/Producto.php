<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $table = 'productos';
    protected $primaryKey = 'id_producto';

    protected $fillable = [
        'id_categoria', 'nombre_producto', 'id_marca', 'precio_producto', 'cantidad_stock'
    ];

    
    public function marca()
    {
        return $this->belongsTo(Marca::class, 'id_marca', 'id_marca');
    }

    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'id_categoria', 'id_categoria');
    }

    public function detalleVentas()
    {
        return $this->hasMany(DetalleVenta::class, 'id_producto', 'id_producto');
    }

    public function ingresos()
    {
        return $this->hasMany(IngresoProducto::class, 'id_producto', 'id_producto');
    }

    public function ajustes()
    {
        return $this->hasMany(AjusteStock::class, 'id_producto', 'id_producto');
    }
    public function ventas()
    {
        return $this->belongsToMany(Venta::class, 'venta_producto', 'id_producto', 'id_venta')
                    ->withPivot('cantidad'); // Tabla intermedia con cantidad
    }

    public function nombreCategoria():string{
        return $this->categoria->categoria;
    }

    public function nombreMarca():string{
        return $this->marca->nombre_marca;
    }

}
