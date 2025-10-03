<?php

namespace App\Livewire;

use App\Models\Proveedor;
use Livewire\Component;

class Proveedores extends Component
{
    public $proveedores, $nombre, $email, $telefono, $proveedor_id;
    public $isEdit = false;

    protected $rules = [
        'nombre'   => 'required|string|min:3',
        'email'    => 'required|email|unique:proveedor,email',
        'telefono' => 'nullable|string',
    ];

    protected $listeners = ['deleteProveedor' => 'delete'];

    public function render()
    {
        $this->proveedores = Proveedor::all();
        return view('livewire.proveedores');
    }

    public function resetInput()
    {
        $this->nombre = '';
        $this->email = '';
        $this->telefono = '';
        $this->proveedor_id = null;
        $this->isEdit = false;
    }

    public function create()
    {
        $this->resetInput();
        $this->dispatch('open-modal');
    }

    public function store()
    {
        $this->validate();
        Proveedor::create([
            'nombre'   => $this->nombre,
            'email'    => $this->email,
            'telefono' => $this->telefono,
        ]);
        session()->flash('message', 'Proveedor creado con éxito.');
        $this->resetInput();
        $this->dispatch('close-modal');
    }

    public function edit($id)
    {
        $prov = Proveedor::findOrFail($id);
        $this->proveedor_id = $prov->id;
        $this->nombre = $prov->nombre;
        $this->email = $prov->email;
        $this->telefono = $prov->telefono;
        $this->isEdit = true;

        $this->dispatch('open-modal');
    }

    public function update()
    {
        $this->validate([
            'nombre'   => 'required|string|min:3',
            'email'    => 'required|email|unique:proveedor,email,' . $this->proveedor_id,
            'telefono' => 'nullable|string',
        ]);

        if ($this->proveedor_id) {
            $prov = Proveedor::find($this->proveedor_id);
            $prov->update([
                'nombre'   => $this->nombre,
                'email'    => $this->email,
                'telefono' => $this->telefono,
            ]);
            session()->flash('message', 'Proveedor actualizado con éxito.');
            $this->resetInput();
            $this->dispatch('close-modal');
        }
    }

    public function delete($id)
    {
        Proveedor::find($id)->delete();
        session()->flash('message', 'Proveedor eliminado.');
    }
}
