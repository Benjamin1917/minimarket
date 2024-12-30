<?php

namespace App\Http\Controllers;
use App\Models\DetalleVenta;
use App\Models\Producto;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $productoMasVendido = DetalleVenta::select(
                'id_producto',
                DB::raw('SUM(cantidad) as cantidad_vendida'),
                DB::raw('SUM(total) as total')
            )
            ->groupBy('id_producto')
            ->orderByDesc('cantidad_vendida')
            ->with('producto') 
            ->first();
    

        $productosCriticos = Producto::where('cantidad_stock', '<', 5)->get();
    
  
        $totalGanado = DetalleVenta::sum('total');
    
  
        return view('home.index', compact('productoMasVendido', 'productosCriticos', 'totalGanado'));
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
}
