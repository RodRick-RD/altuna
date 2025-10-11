<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ChatbotController;
use App\Http\Controllers\ControllerCarrito;
use App\Http\Controllers\ControllerContacto;
use App\Http\Controllers\ControllerPedido;
use App\Http\Controllers\ControllerProducto;
use App\Http\Controllers\ControllerProveedor;
use App\Http\Controllers\ControllerReportes;
use App\Http\Controllers\ControllerShop;
use App\Http\Controllers\ControllerUser;
use App\Http\Controllers\ControllerVenta;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/',[ControllerShop::class,'index'])->name('shop.index');
Route::post('/enviar-mensaje', [ControllerContacto::class, 'enviar'])->name('enviar.mensaje');

Route::post('/carrito/agregar', [ControllerCarrito::class, 'agregar'])->name('carrito.agregar');
Route::get('/carrito/ver', [ControllerCarrito::class, 'ver'])->name('carrito.ver');
Route::post('/carrito/eliminar', [ControllerCarrito::class, 'eliminar'])->name('carrito.eliminar');

Route::view('/chat', 'chat');
Route::post('/chat/send', [ChatbotController::class, 'sendMessage']);


Route::get('register', [ControllerUser::class, 'create'])->name('users.create');
Route::post('register', [ControllerUser::class, 'store'])->name('users.store');

Route::get('/verificar/{codigo}', [ControllerUser::class, 'verificarCuenta'])->name('verificar.cuenta');


Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.submit');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [ControllerUser::class, 'dashboard'])->name('dashboard.index');
    Route::get('/validar-venta', [ControllerShop::class, 'validarventa'])->name('venta.pago');
    Route::post('/subir-comprobante', [ControllerShop::class, 'subirComprobante'])->name('shop.subirComprobante');
    Route::get('/lista-pedidos', [ControllerShop::class, 'listapedidos'])->name('pedido.lista');
    Route::get('/comprobante-de-venta/{id}/pdf', [ControllerPedido::class, 'exportPDFventa'])->name('pedido.comprobanteventapdf');
    Route::get('/mis-datos', [ControllerUser::class, 'edit'])->name('client.edit');


    Route::put('/client-actualizar', [ControllerUser::class, 'update'])->name('client.update');
});

Route::middleware(['auth','role:administrador'])->group(function () {
    Route::get('/usuarios', [ControllerUser::class, 'index'])->name('usuario.index');
    Route::post('/usuario/estado', [ControllerUser::class, 'cambiarEstado'])->name('usuario.estado');

    Route::get('/productos', function () {
        return view('producto.index'); // Vista donde se insertará Livewire
    });
    //Route::resource('/productos', ControllerProducto::class);
    //Route::post('/productos/estado', [ControllerProducto::class, 'cambiarEstado'])->name('productos.estado');

    Route::get('/pedido', [ControllerPedido::class, 'index'])->name('pedido.index');
    Route::get('/comprobante/{file}', [ControllerPedido::class, 'verComprobante'])->name('pedido.comprobante');
    Route::get('/ubicacion/{id}', [ControllerPedido::class, 'ubicacion'])->name('ubicacion');
    Route::get('/pedido/{id}/confirmar', [ControllerPedido::class, 'confirmar'])->name('pedido.confirmar');
    Route::put('/pedido/validar-pedido', [ControllerPedido::class, 'validarPedido'])->name('pedido.validarpedido');
    
    
    Route::get('/ventas', [ControllerVenta::class, 'index'])->name('ventas.index');


    Route::get('/proveedores', [ControllerProveedor::class,'index'])->name('proveedores.index');

    Route::get('/reporte-ventas', [ControllerReportes::class,'productos'])->name('reporte.ventas');

});

