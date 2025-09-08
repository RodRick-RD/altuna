<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ChatbotController;
use App\Http\Controllers\ControllerCarrito;
use App\Http\Controllers\ControllerContacto;
use App\Http\Controllers\ControllerShop;
use App\Http\Controllers\ControllerUser;
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
    Route::get('/mis-datos', [ControllerUser::class, 'edit'])->name('client.edit');

    Route::put('/client-actualizar', [ControllerUser::class, 'update'])->name('client.update');
});

