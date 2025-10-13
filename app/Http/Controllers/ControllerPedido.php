<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class ControllerPedido extends Controller
{
    public function index(){
        $pedidos=Pedido::where('estado','pedido')->orderBy('fecha','DESC')->with(['usuario', 'productos'])->get();
        return view('pedido.index',compact('pedidos'));
    }

    public function verComprobante($file){
        $path = storage_path('app/comprobantes/' . $file);

        if (!file_exists($path)) {
            abort(404);
        }

        // Detectar MIME automáticamente (para PDF, JPG, PNG, etc.)
        return response()->file($path);
    }

    public function ubicacion(Request $request, $id = null)
    {
        $pedidoId = $id ?? $request->id;

        $pedido = Pedido::find($pedidoId);

        if (!$pedido) {
            return response()->json(['error' => 'Pedido no encontrado'], 404);
        }

        return view('pedido.ubicacion', compact('pedido'));
    }

    public function confirmar(Request $request, $id = null)
    {
        $pedidoId = $id ?? $request->id;

        $pedido = Pedido::where('estado','pedido')->with(['usuario', 'productos'])->find($pedidoId);

        if (!$pedido) {
            return response()->json(['error' => 'Pedido no encontrado'], 404);
        }

        return view('pedido.confirmarPedido', compact('pedido','pedidoId'));
    }
    public function validarPedido(Request $request)
    {
        $id = $request->id;
        $pedido = Pedido::findOrFail($id);

        $request->validate([
            'descuento' => "required|numeric|min:0|max:$pedido->total",
        ]);

        foreach ($pedido->productos as $producto) {
            if ($producto->stock < $producto->pivot->cantidad) {
                return redirect()->back()->with('error', "Stock insuficiente para el producto {$producto->nombre}.");
            }
        }

        foreach ($pedido->productos as $producto) {
            $producto->stock -= $producto->pivot->cantidad;
            $producto->save();
        }

        $pedido->descuento = $request->descuento;
        $pedido->estado = "vendido";
        $pedido->save();

        //return redirect('/pedido')->with('success', 'PEDIDO agregado a VENTAS correctamente.');

        $idUser = Auth::id();
        $ventas=null;
        if(Auth::user()->role!='cliente'){
            $pedido=Pedido::with('productos')->findOrFail($pedido->id);

        }else{
            $pedido=Pedido::with('productos')->where('user_id', $idUser)->findOrFail($pedido->id);
        }

        $iduser=$pedido->user_id;
        $cliente=User::findOrFail($iduser);

        $data = [
            'email' => $cliente->email,
            'name' => $cliente->name,
            'pedidoId' => $id,
        ];

        // Enviar correo de verificación
        Mail::send('emails.validacion-venta', $data, function ($message) use ($data) {
            $message->to($data['email'], $data['name'])
                    ->subject('Compra exitosa - Su pedido ha sido procesado');
        });


        
        return view('venta.imprimir-comprobante', compact('pedido'));; 
    }

     public function exportPDFventa(string $id) 
    { 
        $idUser = Auth::id();
        $ventas=null;
        if(Auth::user()->role!='cliente'){
            $ventas=Pedido::with('productos')
            ->where('id', $id)
            ->get();

        }else{
            $ventas=Pedido::with('productos')
            ->where('user_id', $idUser)
            ->where('id', $id)
            ->get();
        }
        
        $pdf = Pdf::loadView('venta.comprobante-pdf', compact('ventas')); 
        return $pdf->download('nota-de-venta.pdf'); 
    } 

    public function eliminarpedido(string $id) 
    { 
        $producto = Pedido::find($id);
        if (!$producto) {
            return response()->json(['success' => false, 'message' => 'Producto no encontrado']);
        }
        $producto->estado = 'eiminado';
        $producto->save();
        return response()->json(['success' => true, 'estado' => $producto->estado]);
    } 
}
