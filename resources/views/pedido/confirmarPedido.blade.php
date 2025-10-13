@extends('layouts.dashboard')

@section('content')
 <div class="container p-3">
    <div class="card">
        <form class="row" method="POST" action="{{ route('pedido.validarpedido') }}">
            @csrf
            @method('PUT')
            <input type="hidden" name="id" value="{{ $pedidoId }}">

            <div class="col-12 d-flex justify-content-between align-items-center">
                <div>
                    <a href="{{ route('pedido.index') }}"><button class="btn-shop-add rounded-pill" type="button"><i class="fa-solid fa-chevron-left"></i> volver</button></a>
                </div>
                <h4 class="text-center mb-4">CONFIRMAR PEDIDO</h4>
                <div></div>
            </div>
            <div class="col-12">
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
                                        <th>en stock</th>
                                        <th>Precio Unitario (Bs)</th>
                                        <th>Subtotal (Bs)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $venta=true;
                                    @endphp
                                    @foreach ($pedido->productos as $producto)
                                        <tr>
                                            <td>{{ $producto->nombre }}</td>
                                            <td>{{ $producto->pivot->cantidad }}</td>
                                            <td>
                                                @if($producto->stock < $producto->pivot->cantidad )
                                                    @php
                                                        $venta=false;
                                                    @endphp
                                                    <p class="text-danger">stock insuficiente [{{ $producto->stock }}]</p>
                                                @else
                                                    <p class="text-success">disponible</p>
                                                @endif
                                            </td>
                                            <td>{{ number_format($producto->pivot->precio, 2, '.', ',') }}</td>
                                            <td>
                                                {{ number_format($producto->pivot->precio * $producto->pivot->cantidad, 2, '.', ',') }}
                                            </td>
                                        </tr>
                                    @endforeach
                                    <tr class="table-light">
                                        <td colspan="4" class="text-right bg-transparent font-weight-bold">Total a pagar:</td>
                                        <td class="bg-transparent font-weight-bold"><span id="precioTotal">{{ number_format($pedido->total, 2) }}</span> Bs</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>


            
            <div class="col-12 col-md-6 col-lg-4 p-2 form-group"  style="background-color: var(--muted2);">
                <label>descuento</label>
                <small class="text-muted"> (guardar con 0 si no existe descuento).</small>
                <input type="number" step="any" min="0" id="descuento" name="descuento" placeholder="Descuento" value="0" required
                    class="@error('descuento') is-invalid @enderror"
                    value="{{ old('descuento', $producto->descuento) }}">
                @error('descuento')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                <small class="text-danger" id="desResp"></small>
            </div>

            @if($venta)
                <button type="submit" class="rounded-pill btn-shop-submit w-100" onclick="disableButton(this)">Validar Pedido</button>
            @endif
        </form>
    </div>
</div>
<script>
$(document).ready(function() {
    const precioTotal = `{{ $pedido->total }}`;

    $('#descuento').on('input', function() {
        const descuentoInput = $(this);
        const descuento = parseFloat(descuentoInput.val());
        const precioFinalDisplay = $('#precioTotal')
        
        if (descuentoInput.val() === '' || isNaN(descuento)) {
            //$("#descuento").val(0);
            precioFinalDisplay.text(precioTotal);
            return;
        }

        if (descuento > precioTotal) {
            $("#descuento").val("");
            precioFinalDisplay.text(precioTotal);
            $("#desResp").html('El descuento no puede ser mayor que el precio total.');
            return;
        }

        if (descuento < 0) {
            precioFinalDisplay.text(precioTotal);
            $("#desResp").html('El descuento no puede ser un número negativo.');
            return;
        }
        const precioFinal = precioTotal - descuento;
        precioFinalDisplay.text(precioFinal.toFixed(2));
    });
});
</script>
<script>
    function disableButton(button) {
        button.disabled = true;
        button.innerHTML = 'Enviando... ';
        button.classList.add('btn-loading');
        button.form.submit();
    }
</script>

@endsection