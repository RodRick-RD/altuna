<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;

class ControllerProducto extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $productos=Producto::all();
        return view('producto.index',compact('productos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
        $producto=Producto::findOrFail($id);
        return view('producto.edit',compact('producto'));
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
            $producto = Producto::findOrFail($id);

            $request->validate([
                'nombre' => 'required|string|max:30',
                'descripcion' => 'string|max:65000',
                'datostecnicos' => 'string|max:65000',
                'descuento' => 'required|numeric',
                'precio' => 'required|numeric',
                'tipo' => 'required|string|max:1',
            ]);

            $producto->nombre = $request->nombre;
            $producto->descripcion = $request->descripcion;
            $producto->datostecnicos = $request->datostecnicos;
            $producto->precio = $request->precio;
            $producto->descuento = $request->descuento;
            $producto->tipo = $request->tipo;
            
            $producto->save();

            return redirect('/productos')->with('success', 'Datos actualizados correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function cambiarEstado(Request $request)
    {
        $producto = Producto::find($request->id);
        if (!$producto) {
            return response()->json(['success' => false, 'message' => 'Producto no encontrado']);
        }
        $producto->estado = $request->estado == 'activo' ? 'activo' : 'inactivo';
        $producto->save();
        return response()->json(['success' => true, 'estado' => $producto->estado]);
    }
}
