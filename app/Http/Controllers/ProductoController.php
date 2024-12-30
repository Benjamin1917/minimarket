<?php

namespace App\Http\Controllers;
use App\Models\Producto;
use App\Models\Categoria;
use App\Models\Marca;
use App\Http\Requests\ProductosRequest;
use App\Http\Requests\EditarProductoRequest;

use Illuminate\Http\Request;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function productos(Request $request) {

        $categorias = Categoria::all();
        
 
        if ($request->has('categoria_id') && $request->categoria_id != '') {
            $v_productos = Producto::where('id_categoria', $request->categoria_id)->get();
        } else {
 
            $v_productos = Producto::all();
        }
    
 
        return view('productos.gestionar_productos', compact('v_productos', 'categorias'));
    }
    

    public function agregar_productos_post(ProductosRequest  $request){
        $v_producto = new Producto();
        $v_producto->id_producto = $request->idProducto;
        $v_producto->id_categoria = $request->categoria;
        $v_producto->id_marca = $request->marca;
        $v_producto->nombre_producto = $request->nombreProducto;
        $v_producto->precio_producto = $request->precio;
        $v_producto->cantidad_stock = $request->stock;
        $v_producto->save();

        return redirect()->back()->with('success', 'Producto guardado exitosamente.');
    }

    public function ingresar_producto(){
        $categorias = Categoria::all();
        $marcas = Marca::all();
        return view('productos.ingresar_producto' , compact('categorias','marcas'));
    }


    public function eliminar_producto($id){
        $producto = Producto::where('id_producto','=',$id);
        $producto->delete();

        return redirect()->route('productos.gestionar_productos');
    }

    public function editar_producto(EditarProductoRequest $request, $v_producto){
        $v_producto= Producto::find($v_producto);
        //dd($v_producto);
        $v_producto->id_categoria = $request->editCategoria;
        $v_producto->id_marca = $request->editMarca;
        $v_producto->nombre_producto = $request->editProductName;
        $v_producto->precio_producto = $request->editPrice;
        $v_producto->cantidad_stock = $request->editStock;
        $v_producto->save();
        $v_productos = Producto::all();
        return redirect()->route('productos.gestionar_productos')->with('v_productos', $v_productos);
    }

    public function vista_editar_producto($id){
        //dd($id);
        $v_producto= Producto::find($id);
        //dd($v_producto);
        $categorias = Categoria::all();
        $marcas = Marca::all();
        return view('productos.editar_producto' , compact('v_producto','categorias','marcas'));
    }

    public function buscar(Request $request){
        $productos = Producto::query();

        if ($request->filled('nombre_producto')) {
            $productos->where('nombre_producto', 'like', '%' . $request->nombre_producto . '%');
        }

        if ($request->filled('id_producto')) {
            $productos->where('id_producto', $request->id_producto);
        }

        $productos = $productos->get();

        session()->put('productos_busqueda', $productos);

        return view('ventas.create', ['productos' => $productos]);
    }

    public function eliminarBusqueda(Request $request){
        $id_producto = $request->input('id_producto');

        $productos_acumulados = session()->get('productos_busqueda', []);

        $productos_acumulados = collect($productos_acumulados)->filter(function($producto) use ($id_producto) {
            return $producto->id_producto != $id_producto;
        })->values()->all(); 

        session()->put('productos_busqueda', $productos_acumulados);

        return redirect()->route('productos.buscar');
    }

    public function buscarProducto(Request $request)
    {
    
        $query = Producto::query();
    
 
        if ($request->filled('categoria_id')) {
            $query->where('id_categoria', $request->categoria_id);
        }
    
   
        if ($request->filled('nombre_producto')) {
            $query->where('nombre_producto', 'like', '%' . $request->nombre_producto . '%');
        }
    
      
        if ($request->filled('id_marca')) {
            $query->where('id_marca', $request->id_marca);
        }
    
        $categorias = Categoria::all();
    

        $marcas = Marca::all();
    
  
        $v_productos = $query->get();
    

        return view('productos.gestionar_productos', compact('categorias', 'marcas', 'v_productos'));
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
