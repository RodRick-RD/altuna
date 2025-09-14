<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

        $pedido->descuento = $request->descuento;
        $pedido->estado = "vendido";
        $pedido->save();


        return redirect('/pedido')->with('success', 'PEDIDO agregado a VENTAS correctamente.');
    }

     public function exportPDFventa(string $id) 
    { 
        $idUser = Auth::id();
        $ventas=Pedido::with('productos')
            ->where('user_id', $idUser)
            ->where('id', $id)
            ->get();
        $pdf = Pdf::loadView('venta.comprobante-pdf', compact('ventas')); 
        return $pdf->download('nota-de-venta.pdf'); 
    } 
}
