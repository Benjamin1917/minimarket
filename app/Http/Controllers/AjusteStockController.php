<?php

namespace App\Http\Controllers;
use App\Models\Producto;
use App\Models\AjusteStock;
use Illuminate\Http\Request;
use App\Http\Requests\AjustesRequest;

class AjusteStockController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ajustes = AjusteStock::with('producto')->latest()->get();
        return view('ajuste_stocks.index', compact('ajustes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $productos = Producto::all(); // Para llenar el select de productos
        return view('ajuste_stocks.create', compact('productos'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AjustesRequest $request)
    {
      
        $producto = Producto::findOrFail($request->id_producto);
    
    
        if ($request->cantidad > $producto->cantidad_stock) {
            return redirect()->back()
                ->withErrors(['cantidad' => 'La cantidad a descontar no puede ser mayor que el stock actual.'])
                ->withInput();
        }
    
   
        $producto->cantidad_stock -= $request->cantidad;
        $producto->save();
    
   
        AjusteStock::create([
            'id_producto' => $request->id_producto,
            'rut_usuario' => $request->rut_usuario,
            'fecha' => $request->fecha,
            'cantidad' => $request->cantidad,
            'tipo_ajuste' => $request->tipo_ajuste,
            'motivo' => $request->motivo,
        ]);
    
      
        return redirect()->route('ajuste_stocks.index')->with('success', 'Ajuste registrado correctamente.');
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

    public function buscarPorNombreProducto(Request $request)
    {
        $query = AjusteStock::query();

        if ($request->filled('nombre_producto')) {
            $query->whereHas('producto', function ($query) use ($request) {
                $query->where('nombre_producto', 'like', '%' . $request->nombre_producto . '%');
            });
        }

        $ajustes = $query->get();

        return view('ajuste_stocks.index', compact('ajustes'));
    }

}
