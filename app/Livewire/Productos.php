<?php

namespace App\Livewire;
use Livewire\WithFileUploads;
use App\Models\Producto;
use Livewire\Component;
use Illuminate\Support\Str;

class Productos extends Component
{
    use WithFileUploads;

    public $editarModo = false; 

    public $productos, $nombre, $descripcion, $datostecnicos, $stock, $vendidos, $precio, $descuento, $img, $estado, $tipo, $producto_id;
    public $modal = false;

    protected $rules = [
        'nombre' => 'required|string|max:255',
        'descripcion' => 'nullable|string',
        'datostecnicos' => 'nullable|string',
        'stock' => 'required|integer|min:0',
        'vendidos' => 'nullable|integer|min:0',
        'precio' => 'required|numeric|min:0',
        'descuento' => 'nullable|numeric|min:0',
        'img' => 'nullable|image|max:1024', // 1MB
        'estado' => 'required|string|max:20',
        'tipo' => 'nullable|string|max:50',
    ];

    public function render()
    {
        $this->productos = Producto::all();
        return view('livewire.productos');
    }

    public function crear()
    {
        $this->limpiarCampos();
        $this->editarModo = false;

        $this->estado = 'activo';
        $this->tipo = 'N';
        
        
        $this->abrirModal();
    }

    public function abrirModal()
    {
        $this->modal = true;
    }

    public function cerrarModal()
    {
        $this->modal = false;
    }

    public function limpiarCampos()
    {
        $this->nombre = '';
        $this->descripcion = '';
        $this->datostecnicos = '';
        $this->stock = 0;
        $this->vendidos = 0;
        $this->precio = 0;
        $this->descuento = 0;
        $this->img = null;
        $this->estado = 'activo';
        $this->tipo = 'E';
        $this->producto_id = null;
    }

    public function guardar()
    {
         $this->validate();

        if ($this->img && !is_string($this->img)) {
                // Genera un nombre único para la imagen
                $nombreArchivo = time() . '.' . $this->img->getClientOriginalExtension();

                // Guarda la imagen en storage/app/public/productos
                $ruta = $this->img->storeAs('productos', $nombreArchivo, 'public');

                // Guardamos la ruta para la DB (accesible desde Blade con asset())
                $this->img = 'storage/' . $ruta;
            } else {
                // Si es actualización y no se subió nueva imagen, mantener la anterior
                if ($this->producto_id) {
                    $this->img = Producto::find($this->producto_id)->img;
                }
        }

        // 👇 Aquí debuggeamos lo que se va a guardar
        if ($this->producto_id) {
            Producto::where('id', $this->producto_id)->update([
                'nombre' => $this->nombre,
                'precio' => $this->precio,
                'stock' => $this->stock,
                'descuento' => $this->descuento,
                'img' => $this->img,
                'estado' => $this->estado ?? 'activo',
                'tipo' => $this->tipo ?? 'N',
            ]);
        } else {
            Producto::create([
                'nombre' => $this->nombre,
                'precio' => $this->precio,
                'stock' => $this->stock,
                'img' => $this->img,
                'descuento' => $this->descuento,
                'estado' => $this->estado ?? 'activo',
                'tipo' => $this->tipo ?? 'N',
            ]);
        }

        session()->flash('message', $this->producto_id ? 'Producto actualizado.' : 'Producto creado.');

        $this->cerrarModal();
        $this->limpiarCampos();
    }

    public function editar($id)
    {
        $producto = Producto::findOrFail($id);
        $this->producto_id = $id;
        $this->nombre = $producto->nombre;
        $this->descripcion = $producto->descripcion;
        $this->datostecnicos = $producto->datostecnicos;
        $this->stock = $producto->stock;
        $this->vendidos = $producto->vendidos;
        $this->precio = $producto->precio;
        $this->descuento = $producto->descuento;
        $this->img = null;
        $this->estado = $producto->estado;
        $this->tipo = $producto->tipo;

        $this->editarModo = true;
        $this->abrirModal();
    }

    public function borrar($id)
    {
        Producto::find($id)->delete();
        session()->flash('delete', 'Producto eliminado.');
    }
}
