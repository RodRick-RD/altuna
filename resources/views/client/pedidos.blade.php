@extends('layouts.dashboard')

@section('content')
<h2 class="mb-4">Mis Compras</h2>

    @foreach ($pedidos as $pedido)
        <div class="mb-4">
            <div class="p-3">
              @php
                  $colores = [
                      'vendido' => 'bg-success',
                      'en proceso' => 'bg-light text-dark',
                      'pendiente' => 'bg-secondary',
                  ];
              @endphp
                <strong>solicitud #{{ $pedido->id }}</strong> |
                Estado: <span class="badge {{ $colores[$pedido->estado] ?? 'bg-secondary' }}">{{ $pedido->estado }}</span> |
                Fecha: {{ \Carbon\Carbon::parse($pedido->fecha)->format('d/m/Y H:i:s') }}
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="tabla-ui">
                        <thead class="">
                            <tr>
                                <th>Producto</th>
                                <th>Cantidad</th>
                                <th>Precio Unitario (Bs)</th>
                                <th>Subtotal (Bs)</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pedido->productos as $producto)
                                <tr>
                                    <td>{{ $producto->nombre }}</td>
                                    <td>{{ $producto->pivot->cantidad }}</td>
                                    <td>{{ number_format($producto->pivot->precio, 2, '.', ',') }}</td>
                                    <td>
                                        {{ number_format($producto->pivot->precio * $producto->pivot->cantidad, 2, '.', ',') }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @endforeach

@endsection