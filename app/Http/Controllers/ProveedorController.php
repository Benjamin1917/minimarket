<?php

namespace App\Http\Controllers;
use App\Models\Proveedor;
use Illuminate\Http\Request;
use App\Http\Requests\ProveedoresRequest;
use App\Http\Requests\EditarProveedoresRequest;

class ProveedorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $v_proveedores = Proveedor::all();
        return view('proveedores.index',  compact('v_proveedores'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('proveedores.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProveedoresRequest $request)
    {
        $v_proveedores = new Proveedor();
        $v_proveedores->id_proveedor = $request->idProveedor;
        $v_proveedores->nom_proveedor = $request->nombreProveedor;
        $v_proveedores->contacto = $request->contactoProveedor;
        $v_proveedores->save();

        return redirect()->route('proveedores.index');
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
        $v_proveedor = Proveedor::find($id);
        return view('proveedores.edit', compact('v_proveedor'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EditarProveedoresRequest $request, $v_proveedores)
    {
        $v_proveedores = Proveedor::find($v_proveedores);
        $v_proveedores->nom_proveedor = $request->nombreProveedor;
        $v_proveedores->contacto = $request->contactoProveedor;
        $v_proveedores->save();

        return redirect()->route('proveedores.index')->with('v_proveedores', $v_proveedores);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $v_proveedores = Proveedor::where('id_proveedor','=',$id);
        $v_proveedores->delete();

        return redirect()->route('proveedores.index');
    }

    public function buscarPorNombre(Request $request)
    {
        $query = Proveedor::query();

        if ($request->filled('nom_proveedor')) {
            $query->where('nom_proveedor', 'like', '%' . $request->nom_proveedor . '%');
        }

        $v_proveedores = $query->get();

        return view('proveedores.index', compact('v_proveedores'));
    }


}
