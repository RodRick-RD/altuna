<?php

namespace App\Livewire\Ventas;
use App\Models\Pedido;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

use Livewire\Component;

class Lista extends Component
{
    public $fechaInicio;
    public $fechaFinal;
    public $tipoDeVenta = 'pedido';


    public $resultados = [];

    public function buscar()
    {
        $this->validate([
            'fechaInicio' => 'required|date',
            'fechaFinal' => 'required|date|after_or_equal:fechaInicio',
            'tipoDeVenta' => 'required|in:vendido,pedido,todos',
        ]);
        $idUser = Auth::id();

        $inicio = Carbon::parse($this->fechaInicio)->startOfDay();
        $final  = Carbon::parse($this->fechaFinal)->endOfDay();

        if ($this->tipoDeVenta === 'todos') {
            $this->resultados =Pedido::with('productos')
            ->whereBetween('fecha', [$inicio, $final])
            ->orderBy('fecha', 'desc')
            ->limit(10)
            ->get();
        } elseif ($this->tipoDeVenta === 'pedido') {
            $this->resultados =Pedido::with('productos')
            ->whereBetween('fecha', [$inicio, $final])
            ->where('estado','pedido')
            ->orderBy('fecha', 'desc')
            ->limit(10)
            ->get();
        } else {
            $this->resultados =Pedido::with('productos')
            ->whereBetween('fecha', [$inicio, $final])
            ->where('estado','vendido')
            ->orderBy('fecha', 'desc')
            ->limit(10)
            ->get();
        }
    }
    public function render()
    {
        return view('livewire.ventas.lista');
    }
}
