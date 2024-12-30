<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use App\Models\Rol;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\UsuariosRequest;
use App\Http\Requests\EditarUsuariosRequest;


class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $v_usuarios = Usuario::all();
        $roles = Rol::all();
        //dd($v_productos);
        return view('usuarios.index' , compact('v_usuarios','roles'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Rol::all();
        return view('usuarios.create' , compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UsuariosRequest $request)
    {
        $v_usuarios = new Usuario();
        $v_usuarios->rut = $request->rut;
        $v_usuarios->nombre = $request->nombre;
        $v_usuarios->apellido = $request->apellido;
        $v_usuarios->password = Hash::make($request->password);
        $v_usuarios->id_rol = $request->rol;

        $v_usuarios->save();

        return redirect()->route('usuarios.index');
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
    public function edit(string $rut)
    {
        //dd($rut);  
        $v_usuario = Usuario::where('rut', $rut)->first();
    
        if (!$v_usuario) {
            return redirect()->back()->withErrors(['error' => 'El usuario no fue encontrado.']);
        }
    
        $roles = Rol::all();
        return view('usuarios.edit', compact('v_usuario', 'roles'));
    }
    


    /**
     * Update the specified resource in storage.
     */
    public function update(EditarUsuariosRequest $request, $v_usuario)
    {
        
        $v_usuario= Usuario::find($v_usuario);
        $v_usuario->rut = $request->rut;
        $v_usuario->nombre = $request->nombre;
        $v_usuario->apellido = $request->apellido;
        if ($request->filled('password')) {
            $v_usuario->password = Hash::make($request->password);
        }
        $v_usuario->id_rol = $request->rol;
        $v_usuarios= Usuario::all();
        $v_usuario->save();

        if (Auth::user()->rut === $v_usuario->rut) {
            return redirect()->route('usuarios.login')->with('info', 'Tu rol ha cambiado, por favor inicia sesión nuevamente.');
        }

        return redirect()->route('usuarios.index')->with('v_usuarios', $v_usuarios);
    }

    public function eliminar_usuario($rut){
        $usuario = Usuario::where('rut','=',$rut);
        $usuario->delete();

        return redirect()->route('usuarios.index');
    }

    public function buscarPorNombre(Request $request)
    {
        $query = Usuario::query();

        if ($request->filled('nombre')) {
            $query->where('nombre', 'like', '%' . $request->nombre . '%');
        }

        $v_usuarios = $query->get();

        return view('usuarios.index', compact('v_usuarios'));
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

        //muestra página con formulario de login
        public function login()
        {
            return view('usuarios.login');
        }
    
        //revisa credenciales (recibe el rut y password)
        public function autenticar(Request $request)
        {

            $credenciales = $request->only(['rut','password']);
    
            if(Auth::attempt($credenciales))
            {
                //credenciales correctas
                $request->session()->regenerate();
                return redirect()->route('home.index');
            }
            return back()->withErrors('Credenciales incorrectas')->onlyInput('rut');
        }
    
        //cerrar sesión
         public function logout()
         {
             Auth::logout();
             return redirect()->route('usuarios.login');
         }
}
