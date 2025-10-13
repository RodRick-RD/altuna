<div>
    <div class="container card">
        <form wire:submit.prevent="buscar" class="filtros row">
            <div class="col-12 col-md-6 col-md-4 col-lg-3 form-group">
                <label>Fecha Inicio:</label>
                <input type="date" wire:model="fechaInicio" value="<?= date('Y-m-d');  ?>" required>
            </div>
            <div class="col-12 col-md-6 col-md-4 col-lg-3 form-group">
                <label>Fecha Final:</label>
                <input type="date" wire:model="fechaFinal" value="<?= date('Y-m-d');  ?>" required>
            </div>
            <div class="col-12 col-md-6 col-md-4 col-lg-3 form-group">
                <label>Tipo de Venta:</label>
                <select wire:model="tipoDeVenta" required>
                    <option value="todos">todos</option>
                    <option value="pedido">Pedido</option>
                    <option value="vendido">Vendido</option>
                </select>
            </div>
            <div class="col-12 col-md-6 col-md-4 col-lg-3">
                <button type="submit" class="btn-shop-add rounded-pill">Buscar <i class="fa-solid fa-magnifying-glass"></i></button>
            </div>
        </form>
    </div>

    <div class="resultados">
    @if(!empty($resultados))
        <div class="mb-4">
              @php
                  $colores = [
                      'vendido' => 'bg-success',
                      'eliminado' => 'bg-danger text-white',
                      'anulado' => 'bg-danger text-white',
                      'pedido' => 'bg-secondary',
                  ];
              @endphp
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="tabla-ui">
                        <thead class="">
                            <tr>
                                <th>Nro</th>
                                <th>Fecha</th>
                                <th>Estado</th>
                                <th>Total</th>
                                <th>Productos</th>
                                <th>Nota de Venta</th>
                            </tr>
                        </thead>
                        <tbody>
                        @forelse ($resultados as $pedido)
                                <tr>
                                    <td>{{ $pedido->id }}</td>
                                    <td>{{ \Carbon\Carbon::parse($pedido->fecha)->format('d/m/Y H:i:s') }}</td>
                                    <td><span class="badge {{ $colores[$pedido->estado] ?? 'bg-secondary' }}">{{ $pedido->estado }}</span></td>
                                    <td>{{ number_format($pedido->total - $pedido->descuento, 2, '.', ',') }}</td>
                                    <td>
                                        @foreach ($pedido->productos as $producto)
                                            <div>{{ $producto->nombre }} - [{{ $producto->pivot->cantidad }}]</div>
                                        @endforeach
                                    </td>
                                    <td>
                                        @if($pedido->estado=='vendido')
                                            <a href="{{ route('pedido.comprobanteventapdf',$pedido->id)}}"><button class="btn-icon-danger" title="descargar comprobante"><i class="fa-solid fa-file-pdf"></i></button></a>
                                        @else
                                            <span class="text-danger">[no disponible]</span>

                                        @endif
                                    </td>
                                </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center font-weight-bold">No hay resultados</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @endif
</div>
