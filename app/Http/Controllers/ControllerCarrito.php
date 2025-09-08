<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;

class ControllerCarrito extends Controller
{
    public function agregar(Request $request)
    {
        $productoId = $request->input('id');

        $producto = Producto::find($productoId);

        if (!$producto) {
            return response()->json(['error' => 'Producto no encontrado'], 404);
        }
        $carrito = session()->get('carrito', []);

        $carrito[$productoId] = [
            'id' => $producto->id,
            'nombre' => $producto->nombre,
            'precio' => $producto->precio,
            'cantidad' => ($carrito[$productoId]['cantidad'] ?? 0) + 1
        ];

        session()->put('carrito', $carrito);

        return $this->ver(); // 👈 devolvemos HTML del carrito actualizado
    }

    public function eliminar(Request $request)
    {
        $id = $request->input('id');
        $carrito = session()->get('carrito', []);

        if (isset($carrito[$id])) {
            unset($carrito[$id]);
            session()->put('carrito', $carrito);
        }

        // Retornar la vista actualizada
        return $this->ver(); // misma vista parcial del carrito
    }
    
    public function ver()
    {
        $carrito = session()->get('carrito', []);
        return response()->view('partials.carrito', compact('carrito'));
    }

}
