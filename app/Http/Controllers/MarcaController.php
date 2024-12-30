<?php

namespace App\Http\Controllers;
use App\Models\Marca;
use App\Models\Producto;
use Illuminate\Http\Request;
use App\Http\Requests\MarcasRequest;
use App\Http\Requests\EditarMarcasRequest;
class MarcaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $v_marcas = Marca::all();
        return view('marcas.index',  compact('v_marcas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('marcas.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(MarcasRequest $request)
    {
        $v_marcas = new Marca();
        $v_marcas->id_marca = $request->idMarca;
        $v_marcas->nombre_marca = $request->nombreMarca;
        $v_marcas->save();

        return redirect()->route('marcas.index');
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
        $v_marca = Marca::find($id);
        return view('marcas.edit', compact('v_marca'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EditarMarcasRequest $request, $v_marca)
    {
        $v_marca= Marca::find($v_marca);
        $v_marca->nombre_marca = $request->nombreMarca;
        $v_marca->save();

        return redirect()->route('marcas.index')->with('v_marcas', $v_marca);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( $id_marca)
    {
        Producto::where('id_marca', $id_marca)->delete();
        
        $marca = Marca::findOrFail($id_marca);
        $marca->delete();
        
        return redirect()->route('marcas.index')->with('success', 'Categoría y productos eliminados correctamente.');
    }

    public function buscarPorNombre(Request $request)
    {
        $query = Marca::query();

        if ($request->filled('nombre_marca')) {
            $query->where('nombre_marca', 'like', '%' . $request->nombre_marca . '%');
        }

        $v_marcas = $query->get();

        return view('marcas.index', compact('v_marcas'));
    }
}
