<?php

namespace App\Http\Controllers;
use App\Models\Producto;
use App\Models\Venta;
use App\Models\DetalleVenta;
use Illuminate\Http\Request;
use App\Http\Requests\VentasRequest;

class VentaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ventas = Venta::with('detalles.producto')->get(); 
        return view('ventas.index', compact('ventas'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $productos = Producto::where('cantidad_stock', '>', 0)->get();
        return view('ventas.create', compact('productos'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(VentasRequest $request)
    {
        // Validar los datos de la venta
        $validated = $request->validate([
            'rut_usuario' => 'required',
            'medio_pago' => 'required',
            'productos' => 'required|array',
            'productos.*.id_producto' => 'required|exists:productos,id_producto',
            'productos.*.cantidad' => 'required|integer|min:1',
        ]);

        // Crear la venta
        $venta = Venta::create([
            'rut_usuario' => $validated['rut_usuario'],
            'total_venta' => 0, // Se calculará más adelante
            'fecha_venta' => now(),
            'medio_pago' => $validated['medio_pago'],
        ]);

        $totalVenta = 0;

        // Procesar los productos
        foreach ($validated['productos'] as $item) {
            $producto = Producto::find($item['id_producto']);

            // Validar stock
            if ($producto->cantidad_stock < $item['cantidad']) {
                return back()->withErrors([
                    'stock' => "No hay suficiente stock para el producto {$producto->nombre_producto}.",
                ]);
            }

            // Crear detalle de venta
            $subtotal = $producto->precio_producto * $item['cantidad'];
            DetalleVenta::create([
                'id_venta' => $venta->id_venta,
                'id_producto' => $producto->id_producto,
                'cantidad' => $item['cantidad'],
                'precio_unitario' => $producto->precio_producto,
                'total' => $subtotal,
            ]);

            // Descontar stock
            $producto->update([
                'cantidad_stock' => $producto->cantidad_stock - $item['cantidad'],
            ]);

            $totalVenta += $subtotal;
        }

        $venta->update([
            'total_venta' => $totalVenta,
        ]);

        return redirect()->route('ventas.index')->with('success', 'Venta realizada con éxito.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $venta = Venta::with('productos')->findOrFail($id); 
        return view('ventas.show', compact('venta'));
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

    public function mostrarDetallesVenta($id_venta)
    {

        $venta = Venta::findOrFail($id_venta);
    
        $detallesVenta = DetalleVenta::where('id_venta', $id_venta)
            ->with('producto') 
            ->get();
    
        return view('ventas.show', compact('venta', 'detallesVenta'));
    }

    public function buscarPorFecha(Request $request)
    {
        // Obtenemos la fecha de la solicitud
        $fechaVenta = $request->input('fecha_venta');

        // Si se pasa una fecha, buscamos las ventas correspondientes a esa fecha
        if ($fechaVenta) {
            $ventas = Venta::whereDate('fecha_venta', $fechaVenta)->get();
        } else {
            // Si no se pasa una fecha, mostramos todas las ventas
            $ventas = Venta::all();
        }

        // Pasamos las ventas obtenidas a la vista
        return view('ventas.index', compact('ventas'));
    }
}
