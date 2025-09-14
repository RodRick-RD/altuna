@extends('layouts.dashboard')

@section('content')

<div class="contanier">
  <div class="row px-4">
    <div class="col-12">
        <h2>PRODUCTOS</h2>
    </div>
    <div class="col-12 col-md-6 col-lg-4">
        <input type="text" placeholder="Buscar..." onkeyup="BuscadorTabla(this.value);">
    </div>
  </div>

  <div class="p-4 overflow-x-auto">
              @if(count($productos) > 0)
                @php $total = 0; @endphp

              <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="tabla-ui">
                    <thead class="table-secondary">
                        <tr>
                            <th class="bg-transparent">Nombre</th>
                            <th class="bg-transparent">Descripción</th>
                            <th class="bg-transparent">Datos técnicos</th>
                            <th class="bg-transparent">Stock</th>
                            <th class="bg-transparent">Precio</th>
                            <th class="bg-transparent">Imagen</th>
                            <th class="bg-transparent">estado</th>
                            <th class="bg-transparent">opciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($productos as $producto)
                            <tr>
                                <td class="bg-transparent">{{ $producto->nombre }}</td>
                                <td class="bg-transparent">
                                        <a class="text-primary" data-toggle="collapse" href="#descripcion{{ $producto->id }}" role="button" aria-expanded="false" aria-controls="descripcion{{ $producto->id }}">
                                            Ver descripción...
                                        </a>

                                        <div class="collapse mt-2" id="descripcion{{ $producto->id }}">
                                            <div>
                                                {!! nl2br(e($producto->descripcion)) !!}
                                            </div>
                                        </div>
                                </td>
                                <td class="bg-transparent">
                                    <a class="text-primary" data-toggle="collapse" href="#datostecnicos{{ $producto->id }}" role="button" aria-expanded="false" aria-controls="datostecnicos{{ $producto->id }}">
                                        Ver Datos técnicos...
                                    </a>

                                    <div class="collapse mt-2" id="datostecnicos{{ $producto->id }}">
                                        <div>
                                            {!! nl2br(e($producto->datostecnicos)) !!}
                                        </div>
                                    </div>
                                </td>
                                <td class="bg-transparent">{{ $producto->stock }}</td>
                                <td class="bg-transparent">Bs. {{ $producto->precio }}</td>
                                <td class="bg-transparent">
                                    <div style="width: 50px;">
                                        <img src="/{{ $producto->img }}" class="img-fluid" alt="producto">
                                    </div>
                                </td>
                                <td class="bg-transparent">
                                    <label class="switch">
                                        <input type="checkbox" class="toggle-estado" 
                                            data-id="{{ $producto->id }}" 
                                            {{ $producto->estado == 'activo' ? 'checked' : '' }}>
                                        <span class="slider round"></span>
                                    </label>
                                </td>
                                <td>
                                    <div class="d-flex gap-3">
                                        <a href="{{ route('productos.edit',$product=$producto->id)}}"><button class="btn-icon-1"><i class="fa-solid fa-pen-to-square"></i></button></a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
              </div>
            </div>
            @else
                <p class="text-muted text-center">No existen usuarios registrados</p>
            @endif
      </div>

</div>
<script>
$(document).on('change', '.toggle-estado', function() {
    let id = $(this).data('id');
    let estado = $(this).is(':checked') ? 'activo' : 'inactivo';

    $.ajax({
        url: "{{ route('productos.estado') }}",
        method: 'POST',
        data: {
            id: id,
            estado: estado,
            _token: '{{ csrf_token() }}'
        },
        success: function(response) {
            if(response.success){
                if(response.estado==='activo'){
                    toastr.success("Estado del Producto cambiado a " + response.estado)
                }else{
                    toastr.warning("Estado del Producto cambiado a " + response.estado);
                }
                
            } else {
                toastr.error('Error al cambiar el estado');
            }
        },
        error: function() {
            toastr.error('Error al realizar la operación');
        }
    });
});
</script>

@endsection

@section('scriptFinal')

@if(session('success'))
    <script>
        toastr.success("{{ session('success') }}");
    </script>
@endif
@endsection