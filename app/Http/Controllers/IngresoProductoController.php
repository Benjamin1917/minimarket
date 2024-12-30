<?php

namespace App\Http\Controllers;
use App\Models\IngresoProducto;
use App\Models\Producto;
use App\Models\Proveedor;
use Illuminate\Http\Request;

use App\Http\Requests\RegistroProductoRequest;

class IngresoProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function mostrarFormulario(){
        $productos = Producto::all();
        $proveedores = Proveedor::all();

        return view('ingreso_productos.formulario', compact('productos', 'proveedores'));
    }

    public function guardarRegistro(RegistroProductoRequest $request){
        $ingreso = new IngresoProducto();
        $ingreso->id_proveedor = $request->id_proveedor;
        $ingreso->id_producto = $request->id_producto;
        $ingreso->rut_usuario = $request->rut_usuario;
        $ingreso->fecha_ingreso = $request->fecha_ingreso;
        $ingreso->cantidad_ingresada = $request->cantidad_ingresada;
        $ingreso->save();

        $producto = Producto::findOrFail($request->id_producto);
        $producto->cantidad_stock += $request->cantidad_ingresada;
        $producto->save();

        return redirect()->route('productos.gestionar_productos')->with('success', 'Ingreso registrado y stock actualizado exitosamente.');
    }


    public function listarRegistros() {
 
        $ingresos = IngresoProducto::all(); 
    
     
        return view('ingreso_productos.listar', compact('ingresos'));
    }

    public function buscarPorNombreProducto(Request $request)
    {
        $query = IngresoProducto::query();
    
        if ($request->filled('nombre_producto')) {
            $query->whereHas('producto', function ($query) use ($request) {
                $query->where('nombre_producto', 'like', '%' . $request->nombre_producto . '%');
            });
        }
    
        $ingresos = $query->get();
    
        return view('ingreso_productos.listar', compact('ingresos'));
    }
    
    

    
}
