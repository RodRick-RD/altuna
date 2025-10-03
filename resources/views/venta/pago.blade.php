@extends('layouts.dashboard')

@section('content')
<h2 class="mb-4">Mi Carrito</h2>

<div class="container" data-aos="fade-up" data-aos-delay="100">
@if(session('mensaje'))
    <div class="alert alert-success text-center">
        {{ session('mensaje') }}
 
     </div>
     <script>
      localStorage.setItem('carritoCompra', JSON.stringify([]));
     </script>
@else


  <div class="row align-items-center">
    <div class="col-12">

      <div class="p-4 overflow-x-auto">
        <h4 class="text-center mb-4">LISTA DE PRODUCTOS SELECCIONADOS</h4>

        @if(session('stockinsuficiente'))
            <div class="alert alert-danger text-center">
                {{ session('stockinsuficiente') }}
        
            </div>
        @endif

              <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="tabla-ui" id="tabla-carrito">
                      <thead class="table-secondary">
                          <tr>
                              <th>Producto</th>
                              <th>Cantidad</th>
                              <th>Precio Unitario (Bs)</th>
                              <th>Subtotal (Bs)</th>
                          </tr>
                      </thead>
                      <tbody id="carrito-body">
                          <tr>
                            <td colspan="4" class="text-center text-muted">Cargando...</td>
                        </tr>
                      </tbody>
                      <tfoot>
                          <tr class="table-light">
                              <td colspan="3" class="text-right font-weight-bold">Total a pagar:</td>
                              <td class="font-weight-bold" id="total">0.00 Bs</td>
                          </tr>
                      </tfoot>
                  </table>
              </div>
            </div>
      </div>

      
    </div>
    <div class="col-12">
          <div class="p-2">
            <form action="{{ route('shop.subirComprobante') }}" method="POST" enctype="multipart/form-data" class="p-4 form-design">
                @csrf

                <input type="hidden" id="carrito-input" name="carrito">
                @error('carrito')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror

                <div class="card p-4">
                  <h4 class="text-center my-3">Subir Comprobante</h4>
                  @error('mensaje')
                      <div class="text-danger">{{ $mensaje }}</div>
                  @enderror
                  <small class="text-muted text-center">Realiza tu pago a este QR.</small>
                  <div class="p-4 d-flex align-items-center justify-content-center">
                    <div style="width: 100%; max-width: 400px;">
                      <img src="{{ $dataUri }}" class="img-fluid" alt="QR para pago">
                    </div>
                    
                  </div>
                  <div class="mb-3">
                      <input type="file" name="archivo" id="archivo"
                          accept=".pdf, .png, .jpg, .jpeg"
                          class="form-control @error('archivo') is-invalid @enderror" required>

                      @error('archivo')
                          <div class="invalid-feedback">{{ $message }}</div>
                      @enderror
                      <small class="text-muted">Debe subir su comprobante en formato JPG, JPEG, PNG o PDF.</small>
                  </div>
                  <div class="mb-3">
                      <input type="text" name="razonsocial" class="form-control @error('razonsocial') is-invalid @enderror" placeholder="razón social">
                      @error('razonsocial')
                          <div class="invalid-feedback">{{ $message }}</div>
                      @enderror
                  </div>
                  <div class="mb-3">
                      <input type="text" name="nit" class="form-control @error('nit') is-invalid @enderror" placeholder="NIT">
                      @error('nit')
                          <div class="invalid-feedback">{{ $message }}</div>
                      @enderror
                  </div>
                </div>
                <div class="card p-4">
                  <h4 class="text-center my-3">Ubicación para la entrega</h4>
                  
                    <input type="hidden" name="latitud" id="latitud" value="" required>
                    @error('latitud')
                          <div class="text-danger">{{ $message }}</div>
                      @enderror
                  </div>
                  <div>
                    <input type="hidden" name="longitud" id="longitud" value="" required>
                    @error('longitud')
                          <div class="text-danger">{{ $message }}</div>
                      @enderror
                  </div>

                  <div class="col-12">
                    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBrPcgLHdIkpWRKXLYHX4Ou_JbEWBezWuw"></script>
                    <div id="map" style="height: 500px; width: 100%;"></div>

                    <div class="d-flex justify-content-center">
                      <button type="button" class="btn-shop-submit px-4 py-2 rounded-pill my-3" id="saveBtn"><i class="fa-solid fa-location-dot"></i> Guardar Ubicación</button>
                    </div>
                  </div>
                  
                </div>


                <button type="submit" class="rounded-pill submit btn-shop-submit w-100"><i class="fa-solid fa-check"></i> Confirmar compra</button>
              </form>
          </div>
      </div>
    </div>
  </div>

</div>



<script>
  $('.submit').prop('disabled', true);
    let map;
    let marker;
    let selectedLatLng = null;

    function initMap() {
        // Centro inicial del mapa (puedes cambiarlo)
        const initialPosition = { lat: -17.38950, lng: -66.15680 }; // La Paz, Bolivia

        // Crear mapa
        map = new google.maps.Map(document.getElementById("map"), {
            center: initialPosition,
            zoom: 13,
        });

        // Detectar clic en el mapa
        map.addListener("click", (e) => {
            selectedLatLng = e.latLng;

            // Si ya hay un marcador, moverlo
            if (marker) {
                marker.setPosition(selectedLatLng);
            } else {
                marker = new google.maps.Marker({
                    position: selectedLatLng,
                    map: map,
                });
            }
        });

        // Botón para guardar
        document.getElementById("saveBtn").addEventListener("click", () => {
            if (selectedLatLng) {
                const lat = selectedLatLng.lat();
                const lng = selectedLatLng.lng();
                $("#latitud").val(lat);
                $("#longitud").val(lng);

                //alert("Ubicación guardada: " + lat + ", " + lng);
                $('.btn-shop-submit').prop('disabled', false);
            } else {
                alert("Primero selecciona una ubicación en el mapa");
            }
        });
    }

    window.onload = initMap;
</script>



<script>
const GUARDAR_CARRITO = 'carritoCompra';
const productos = @json($productos ?? []); // OJO: si tienes productos en backend

function mostrarCarrito() {
    let carrito = JSON.parse(localStorage.getItem(GUARDAR_CARRITO)) || [];
    let tbody = document.getElementById("carrito-body");
    let total = 0;

    if (carrito.length === 0) {
        tbody.innerHTML = `<tr><td colspan="4" class="text-center text-muted">Carrito vacío</td></tr>`;
        document.getElementById("total").innerText = "0.00 Bs";
        document.getElementById("carrito-input").value = "[]";
        return;
    }

    tbody.innerHTML = "";
    carrito.forEach(item => {
        // ⚠️ Buscar precio/nombre según tu catálogo
        let productoInfo = productos.find(p => p.id === item.id) || {precio: 0, nombre: 'Desconocido'};
        let subtotal = productoInfo.precio * item.cantidad;
        total += subtotal;

        tbody.innerHTML += `
            <tr>
                <td>${productoInfo.nombre}</td>
                <td>${item.cantidad}</td>
                <td>${productoInfo.precio.toFixed(2)}</td>
                <td>${subtotal.toFixed(2)}</td>
            </tr>
        `;
    });

    document.getElementById("total").innerText = total.toFixed(2) + " Bs";

    // Guardar carrito JSON en input oculto para enviar a Laravel
    document.getElementById("carrito-input").value = JSON.stringify(carrito);
}

// Renderizar al cargar página
document.addEventListener("DOMContentLoaded", mostrarCarrito);
</script>


@endif

@endsection