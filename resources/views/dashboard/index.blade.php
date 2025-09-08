@extends('layouts.dashboard')

@section('content')
<div class="grid">
      <!-- metrics -->
      <div class="card col-span-3">
        <a class="nav-item space-between" href="{{ route('venta.pago') }}">
          <div>
            <h3>Mi carrito</h3>
            <div class="metric"><div class="value">{{ $cantidadProductosCarrito }}</div></div>
          </div>
          <div class="icon-wrap h1">
            <!-- money icon -->
            <i class="fa-solid fa-cart-shopping"></i>
          </div>
        </a>
      </div>

      <div class="card col-span-3">
        <a class="nav-item space-between" href="{{ route('venta.pago') }}">
          <div>
            <h3>Mi carrito</h3>
            <div class="metric"><div class="value">{{ $cantidadProductosCarrito }}</div></div>
          </div>
          <div class="icon-wrap h1">
            <!-- money icon -->
            <i class="fa-solid fa-cart-shopping"></i>
          </div>
        </a>
      </div>

</div>

@endsection