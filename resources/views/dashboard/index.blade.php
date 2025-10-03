@extends('layouts.dashboard')

@section('content')
<div class="grid">
      <!-- metrics -->
      <div class="card col-span-3">
        <a class="nav-item space-between" href="/#catalogo">
          <div>
            <h3>Comprar</h3>
            <div class="metric"><div class="value">Ir a productos</div></div>
          </div>
          <div class="icon-wrap h1">
            <!-- money icon -->
            <i class="fa-solid fa-cart-plus"></i>
          </div>
        </a>
      </div>

      <div class="card col-span-3">
        <a class="nav-item space-between" href="{{ route('venta.pago') }}">
          <div>
            <h3>Mi carrito</h3>
            <div class="metric"><div class="value" id="cantidadCarritoDashboard">0</div></div>
          </div>
          <div class="icon-wrap h1">
            <!-- money icon -->
            <i class="fa-solid fa-cart-shopping"></i>
          </div>
        </a>
      </div>

</div>

<script>
  document.addEventListener("DOMContentLoaded", function() {
      const GUARDAR_CARRITO = 'carritoCompra';
      let carrito = JSON.parse(localStorage.getItem(GUARDAR_CARRITO)) || [];
      let cantidadProductos = carrito.reduce((acc, item) => acc + item.cantidad, 0);
      document.getElementById("cantidadCarritoDashboard").textContent = cantidadProductos;
  });
</script>


@endsection