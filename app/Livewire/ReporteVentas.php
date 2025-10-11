<?php

namespace App\Livewire;

use App\Models\PedidoProducto;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class ReporteVentas extends Component
{
    public $fechaInicio;
    public $fechaFin;

    public $labels = [];       // Para nombres de productos
    public $ventas = [];       // Para total vendido por producto (Donut)
    public $dias = [];         // Para line chart
    public $ventasPorDia = []; // Para line chart

    public function mount()
    {
        $this->fechaInicio = Carbon::now()->startOfMonth()->format('Y-m-d');
        $this->fechaFin = Carbon::now()->endOfMonth()->format('Y-m-d');

    }

    public function buscar()
    {
        $this->generarReporte();
    }

    public function generarReporte()
    {
        // 🔹 Donut: porcentaje de ventas por producto
        $datos = DB::table('venta_producto as vp')
            ->join('venta as v', 'vp.venta_id', '=', 'v.id')
            ->join('producto as p', 'vp.producto_id', '=', 'p.id')
            ->select('p.nombre as producto_nombre', DB::raw('SUM(vp.cantidad) as total_cantidad'))
            ->whereBetween('v.fecha', [$this->fechaInicio, $this->fechaFin])
            ->where('v.estado', 'vendido')
            ->groupBy('vp.producto_id', 'p.nombre')
            ->orderByDesc('total_cantidad')
            ->get();

        $labels = $datos->pluck('producto_nombre')->toArray();
        $ventas = $datos->pluck('total_cantidad')->toArray();

        // 🔹 Line chart: evolución diaria de ventas por producto
        $dias = [];
        $ventasPorDia = [];

        $period = Carbon::parse($this->fechaInicio)->daysUntil(Carbon::parse($this->fechaFin));

        foreach ($period as $dia) {
            $dias[] = $dia->format('Y-m-d');
        }

        foreach ($labels as $producto) {
            $ventasPorDia[$producto] = [];
            foreach ($dias as $dia) {
                $total = DB::table('venta_producto as vp')
                    ->join('venta as v', 'vp.venta_id', '=', 'v.id')
                    ->join('producto as p', 'vp.producto_id', '=', 'p.id')
                    ->where('p.nombre', $producto)
                    ->where('v.estado', 'vendido')
                    ->whereDate('v.fecha', $dia)
                    ->sum('vp.cantidad');
                $ventasPorDia[$producto][] = $total;
            }
        }

        //$this->emitReporte($labels, $ventas, $dias, $ventasPorDia);
    }

    

    public function render()
    {
        return view('livewire.reporte-ventas');
    }
}
