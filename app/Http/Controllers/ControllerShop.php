<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ControllerShop extends Controller
{
    public function index(){

        $productos=Producto::with('categoria')->where('estado', '!=', 3)->get();
        return view('shop',compact('productos'));
    }
    public function validarventa(){
        $carrito = session()->get('carrito', []);
        $user = auth()->user();
        

        $dataUri=null;

        $path = public_path('assets/img/services/QR.jpg');;


        if (file_exists($path)) {

            $imageData = file_get_contents($path);

            $base64Image = base64_encode($imageData);

            $mimeType = 'image/jpg';

            $dataUri = 'data:' . $mimeType . ';base64,' . $base64Image;


        }

        return response()->view('venta.pago', compact('carrito','user','dataUri'));
    }

    public function subirComprobante(Request $request)
    {
        $request->validate([
            'archivo' => 'required|mimes:jpg,jpeg,png,pdf|max:2048',
            'latitud' => 'required|numeric',
            'longitud' => 'required|numeric',
            'razonsocial' => 'string|max:25',
            'nit' => 'string|max:20',
        ]);

        $ruta = $request->file('archivo')->store('comprobantes');

        date_default_timezone_set('America/Caracas');
        $fecha = date("Y-m-d h:i:s");
        $usuario = Auth::user()->id;
        $pedido = new Pedido();
        $pedido->fecha = $fecha;
        $pedido->comprobante = $ruta;
        $pedido->estado = 'pendiente';
        $pedido->user_id =$usuario;
        $pedido->latitud =$request->latitud;
        $pedido->longitud =$request->longitud;
        $pedido->razon_social =$request->razonsocial;
        $pedido->nit =$request->nit;
        $pedido->save();

        $total = 0;
        $carrito = session('carrito', []);
        
        foreach ($carrito as $productoId => $detalle) {
            $subtotal = $detalle['cantidad'] * $detalle['precio'];
            $total += $subtotal;
            $pedido->productos()->attach($productoId, [
                'cantidad' => $detalle['cantidad'],
                'precio' => $detalle['precio']
            ]);


        }

        $pedido->total = $total;
        $pedido->save();
        // 4. Limpiar carrito
        session()->forget('carrito');

        // 5. Avisar
        return back()->with('mensaje', '¡Pedido recibido! Te contactaremos pronto.');
    }

    public function listapedidos(){
        $usuario = Auth::user();

        $pedidos = Pedido::with('productos')
            ->where('user_id', $usuario->id)
            ->orderBy('fecha', 'desc')
            ->get();
        
        return view('client.pedidos', compact('pedidos'));
    }

    
}
