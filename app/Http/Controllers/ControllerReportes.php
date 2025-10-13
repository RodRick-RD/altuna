<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ControllerReportes extends Controller
{
    public function Productos(){
        return view('reporte.producto');
    }
    public function ventasPorFechas(Request $request)
    {
        $fechaInicio = $request->input('fechaInicio');
        $fechaFin = $request->input('fechaFin');

        // Validamos fechas
        if (!$fechaInicio || !$fechaFin) {
            return response()->json(['labels' => [], 'data' => [], 'total' => 0]);
        }

        // Consulta SQL: suma de cantidad * precio por producto entre fechas
        $resultados = DB::table('venta_producto as vp')
            ->join('producto as p', 'vp.producto_id', '=', 'p.id')
            ->join('venta as v', 'vp.venta_id', '=', 'v.id')
            ->select(
                'p.nombre as producto',
                DB::raw('SUM(vp.cantidad) as cantidad_vendida'),
                DB::raw('SUM(vp.cantidad * vp.precio) as total_generado')
            )
            ->whereBetween('v.fecha', [$fechaInicio . ' 00:00:00', $fechaFin . ' 23:59:59'])
            ->where('v.estado', '=', 'vendido') // solo ventas confirmadas
            ->groupBy('p.nombre')
            ->get();

        // Extraemos etiquetas y cantidades
        $labels = $resultados->pluck('producto');
        $data = $resultados->pluck('cantidad_vendida');
        $totalVentas = $resultados->sum('total_generado'); // 💰 total de ingresos

        return response()->json([
            'labels' => $labels,
            'data' => $data,
            'total' => number_format($totalVentas, 2, '.', '')
        ]);
    }
}
