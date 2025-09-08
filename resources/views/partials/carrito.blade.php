@if(count($carrito) > 0)
    @foreach($carrito as $item)
      <li class="list-group-item d-flex justify-content-between">
        {{ $item['nombre'] }} x{{ $item['cantidad'] }}
        <span>{{ $item['precio'] * $item['cantidad'] }} Bs</span>
        <button class="btn btn-danger btn-sm btn-eliminar" data-id="{{ $item['id'] }}">
          <i class="fa-solid fa-trash-can"></i>
        </button>
      </li>
    @endforeach
    <a href="{{ route('venta.pago')}}" class="p-2 d-flex justify-content-center">
        <button class="btn btn-warning rounded-pill"><i class="fa-solid fa-check"></i> realizar pedido</button>
    </a>
@else
  <p class="text-muted text-center">Carrito vacío</p>
@endif