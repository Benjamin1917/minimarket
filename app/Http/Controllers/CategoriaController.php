<?php

namespace App\Http\Controllers;
use App\Models\Categoria;
use App\Models\Producto;
use Illuminate\Http\Request;
use App\Http\Requests\CategoriasRequest;
use App\Http\Requests\EditarCategoriasRequest;

class CategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $v_categorias = Categoria::all();
        return view('categorias.index',  compact('v_categorias'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('categorias.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoriasRequest $request)
    {
        $v_categorias = new Categoria();
        $v_categorias->id_categoria = $request->idCategoria;
        $v_categorias->categoria = $request->nombreCategoria;
        $v_categorias->save();

        return redirect()->route('categorias.index');
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
    public function edit($id)
    {
        $v_categoria = Categoria::find($id);
        return view('categorias.edit', compact('v_categoria'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EditarCategoriasRequest $request, $v_categoria)
    {
        $v_categoria = Categoria::find($v_categoria);
        $v_categoria->categoria = $request->nombreCategoria;
        $v_categoria->save();

        return redirect()->route('categorias.index')->with('v_categoria', $v_categoria);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id_categoria)
    {
        Producto::where('id_categoria', $id_categoria)->delete();
        
        $categoria = Categoria::findOrFail($id_categoria);
        $categoria->delete();
        
        return redirect()->route('categorias.index')->with('success', 'Categoría y productos eliminados correctamente.');
    }

    public function buscarPorNombre(Request $request)
    {
        $query = Categoria::query();
    
        if ($request->filled('categoria')) {
            $query->where('categoria', 'like', '%' . $request->categoria . '%');
        }
    
        $v_categorias = $query->get();
    
        return view('categorias.index', compact('v_categorias'));
    }
    
}
