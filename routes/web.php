<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\MarcaController;
use App\Http\Controllers\IngresoProductoController;
use App\Http\Controllers\VentaController;
use App\Http\Controllers\ProveedorController;
use App\Http\Controllers\AjusteStockController;


// Route::get('/', function () {
//     return view('welcome');
// });


//HOME
Route::get('/',[HomeController::class,'index'])->name('home.index')->middleware('auth');

//AUTH
Route::post('/usuarios/logout',[UsuarioController::class,'logout'])->name('usuario.logout')->middleware('auth');
Route::get('/usuarios/login',[UsuarioController::class,'login'])->name('usuarios.login');
Route::post('/usuarios/autenticar',[UsuarioController::class,'autenticar'])->name('usuarios.autenticar');


//PRODUCTOS
Route::get('/gestionar/productos',[ProductoController::class,'productos']) ->name('productos.gestionar_productos')->middleware('auth');
Route::post('/gestionar/productos',[ProductoController::class,'agregar_productos_post']) ->name('productos.agregar_productos')->middleware('auth');//guardar producto
Route::get('/gestionar/productos/ingresar',[ProductoController::class,'ingresar_producto']) ->name('productos.ingresar_producto')->middleware('auth');//ir a vista de agregar producto
Route::delete('/gestionar/productos/{id}',[ProductoController::class,'eliminar_producto']) ->name('productos.borrar_producto')->middleware('auth');//borrar producto
Route::put('/gestionar/productos/{id}',[ProductoController::class,'editar_producto']) ->name('productos.editar_productos')->middleware('auth');//editar producto 
Route::get('/gestionar/productos/editar/{id}', [ProductoController::class, 'vista_editar_producto'])->name('productos.editar_producto')->middleware('auth');//ir a vista de editar producto
Route::post('/gestionar/productos/{id}',[ProductoController::class,'accesar_producto']) ->name('productos.accesar_productos')->middleware('auth');//accesar producto 
Route::get('/productos', [ProductoController::class, 'buscarProducto'])->name('productos.gestionar_productos');



//CATEGORIAS
Route::get('/gestionar/categorias',[CategoriaController::class,'index']) ->name('categorias.index')->middleware('auth');
Route::post('/gestionar/categorias',[CategoriaController::class,'store']) ->name('categorias.store')->middleware('auth');//
Route::get('/gestionar/categorias/ingresar',[CategoriaController::class,'create']) ->name('categorias.create')->middleware('auth');
Route::delete('/gestionar/categorias/{id}',[CategoriaController::class,'destroy']) ->name('categorias.borrar_categoria')->middleware('auth');
Route::put('/gestionar/categorias/{id}',[CategoriaController::class,'update']) ->name('categorias.update')->middleware('auth');
Route::get('/gestionar/categorias/editar/{id}', [CategoriaController::class, 'edit'])->name('categorias.edit')->middleware('auth');
Route::get('/categorias/buscar', [CategoriaController::class, 'buscarPorNombre'])->name('categorias.buscar_por_nombre');


//MARCAS
Route::get('/gestionar/marcas',[MarcaController::class,'index']) ->name('marcas.index')->middleware('auth');
Route::post('/gestionar/marcas',[MarcaController::class,'store']) ->name('marcas.store')->middleware('auth');//
Route::get('/gestionar/marcas/ingresar',[MarcaController::class,'create']) ->name('marcas.create')->middleware('auth');
Route::delete('/gestionar/marcas/{id}',[MarcaController::class,'destroy']) ->name('marcas.borrar_marca')->middleware('auth');
Route::put('/gestionar/marcas/{id}',[MarcaController::class,'update']) ->name('marcas.update')->middleware('auth');
Route::get('/gestionar/marcas/editar/{id}', [MarcaController::class, 'edit'])->name('marcas.edit')->middleware('auth');
Route::get('/marcas/buscar', [MarcaController::class, 'buscarPorNombre'])->name('marcas.buscar_por_nombre');



//PROVEEDORES
Route::get('/gestionar/proveedores',[ProveedorController::class,'index']) ->name('proveedores.index')->middleware('auth');
Route::post('/gestionar/proveedores',[ProveedorController::class,'store']) ->name('proveedores.store')->middleware('auth');//
Route::get('/gestionar/proveedores/ingresar',[ProveedorController::class,'create']) ->name('proveedores.create')->middleware('auth');
Route::delete('/gestionar/proveedores/{id}',[ProveedorController::class,'destroy']) ->name('proveedores.borrar_proveedor')->middleware('auth');
Route::put('/gestionar/proveedores/{id}',[ProveedorController::class,'update']) ->name('proveedores.update')->middleware('auth');
Route::get('/gestionar/proveedores/editar/{id}', [ProveedorController::class, 'edit'])->name('proveedores.edit')->middleware('auth');
Route::get('/proveedores/buscar', [ProveedorController::class, 'buscarPorNombre'])->name('proveedores.buscar_por_nombre');



//USUARIOS
Route::get('/gestionar/usuarios',[UsuarioController::class,'index']) ->name('usuarios.index')->middleware('auth');
Route::post('/gestionar/usuarios',[UsuarioController::class,'store']) ->name('usuarios.store')->middleware('auth');//guardar producto
Route::get('/gestionar/usuarios/ingresar',[UsuarioController::class,'create']) ->name('usuarios.create')->middleware('auth');//ir a vista de agregar producto
Route::delete('/gestionar/usuarios/{rut}',[UsuarioController::class,'eliminar_usuario']) ->name('usuarios.borrar_usuario')->middleware('auth');//borrar producto
Route::put('/gestionar/usuarios/{rut}',[UsuarioController::class,'update']) ->name('usuarios.update')->middleware('auth');//editar producto 
Route::get('/gestionar/usuarios/editar/{rut}', [UsuarioController::class, 'edit'])->name('usuarios.edit')->middleware('auth');//ir a vista de editar producto
Route::post('/gestionar/usuarios/{rut}',[UsuarioController::class,'accesar_usuario']) ->name('usuarios.accesar_productos')->middleware('auth');//accesar producto 
Route::get('/usuarios/buscar', [UsuarioController::class, 'buscarPorNombre'])->name('usuarios.buscar_por_nombre');


//VENTAS
//Route::get('/ventas',[VentaController::class,'index']) ->name('ventas.index')->middleware('auth');
//Route::get('/ventas/create',[VentaController::class,'create']) ->name('ventas.create')->middleware('auth');
//Route::post('/ventas/eliminar_busqueda', [ProductoController::class, 'eliminarBusqueda'])->name('productos.eliminar_busqueda');
Route::prefix('ventas')->group(function () {
    // Ruta para listar todas las ventas
    Route::get('/listado', [VentaController::class, 'index'])->name('ventas.index');

    // Ruta para mostrar el formulario de creación de una nueva venta
    Route::get('/crear', [VentaController::class, 'create'])->name('ventas.create');

    // Ruta para guardar una nueva venta
    Route::post('/ventas', [VentaController::class, 'store'])->name('ventas.store');

    // Ruta para mostrar los detalles de una venta específica
    Route::get('/{id}', [VentaController::class, 'show'])->name('ventas.show');

    // Ruta para mostrar el formulario de edición de una venta
    Route::get('/{id}/editar', [VentaController::class, 'edit'])->name('ventas.edit');

    // Ruta para actualizar una venta existente
    Route::put('/{id}', [VentaController::class, 'update'])->name('ventas.update');

    // Ruta para eliminar una venta
    Route::delete('/{id}', [VentaController::class, 'destroy'])->name('ventas.destroy');
    Route::get('/ventas/buscar', [VentaController::class, 'buscarPorFecha'])->name('ventas.buscar_por_fecha');

});



//BUSCAR PRODUCTO
Route::get('/productos/buscar', [ProductoController::class, 'buscar'])->name('productos.buscar');


//INGRESOS
// Mostrar el formulario para registrar un ingreso de producto
Route::get('/registro/ingresoproductos', [IngresoProductoController::class, 'mostrarFormulario'])->name('ingreso_productos.formulario')->middleware('auth');
// Guardar un nuevo registro de ingreso de productos
Route::post('/registro/ingresoproductos', [IngresoProductoController::class, 'guardarRegistro'])->name('ingreso_productos.guardar')->middleware('auth');
// Mostrar el listado de registros de ingresos
Route::get('/registro/listadoingresos', [IngresoProductoController::class, 'listarRegistros'])->name('ingreso_productos.listar')->middleware('auth');
Route::get('/ingresos/buscar', [IngresoProductoController::class, 'buscarPorNombreProducto'])
    ->name('ingresos.buscar_por_nombre_producto');



//AJUSTES STOCK
Route::prefix('ajuste-stocks')->group(function () {
    Route::get('/crear', [AjusteStockController::class, 'create'])->name('ajuste_stocks.create');
    Route::post('/guardar', [AjusteStockController::class, 'store'])->name('ajuste_stocks.store');
    Route::get('/', [AjusteStockController::class, 'index'])->name('ajuste_stocks.index');
    Route::get('/ajustes/buscar', [AjusteStockController::class, 'buscarPorNombreProducto'])->name('ajustes.buscar_por_nombre_producto');
});



//DETALLE VENTA
Route::get('ventas/{id_venta}/detalle', [VentaController::class, 'mostrarDetallesVenta'])->name('ventas.detalle');





//REGISTRO VENTAS
Route::get('/registro/ventas',[VentaController::class,'index']) ->name('registro_ventas.index')->middleware('auth');
