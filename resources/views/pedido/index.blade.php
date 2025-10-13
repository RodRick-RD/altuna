@extends('layouts.dashboard')

@section('content')

<div class="contanier">
  <h2>PEDIDOS</h2>

  <div class="p-4 overflow-x-auto">
        <h4 class="text-center mb-4">LISTA DE PEDIDOS</h4>
              @if(count($pedidos) > 0)
                @php $n = 1; @endphp

              <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="tabla-ui">
                    <thead class="table-secondary">
                        <tr>
                            <th class="bg-transparent">Nro</th>
                            <th class="bg-transparent">fecha</th>
                            <th class="bg-transparent">estado</th>
                            <th class="bg-transparent">usuario</th>
                            <th class="bg-transparent">comprobante</th>
                            <th class="bg-transparent">Ubicación</th>
                            <th class="bg-transparent">TOTAL</th>
                            <th class="bg-transparent">productos</th>
                            <th class="bg-transparent">opciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pedidos as $pedido)
                            <tr>
                                <td class="bg-transparent">@php echo $n; $n++;  @endphp</td>
                                <td class="bg-transparent">{{ \Carbon\Carbon::parse($pedido->fecha)->format('d/m/Y H:i:s') }}</td>
                                <td class="bg-transparent">{{ $pedido->estado }}</td>
                                <td class="bg-transparent">{{ $pedido->usuario->name }} {{ $pedido->usuario->lastName }}</td>
                                <td class="bg-transparent">
                                    <a href="{{ route('pedido.comprobante', $pedido->comprobante) }}" target="_blank">
                                        Ver comprobante
                                    </a>
                                </td>
                                <td class="bg-transparent">
                                    <button class="btn btn-link" onclick="VerUbicacion('{{ $pedido->id }}');">Ver ubicacion</button>
                                </td>
                                <td>{{ $pedido->total }}</td>
                                <td class="bg-transparent">
                                     @foreach ($pedido->productos as $producto)
                                        <div> <span class="text-danger">[{{ $producto->pivot->cantidad }} unid.] - </span>{{ $producto->nombre }}
                                        </div>
                                    @endforeach
                                </td>
                                <td class="bg-transparent">
                                    <div class="d-flex gap-2">
                                        <a href="{{ route('pedido.confirmar', ['id'=>$pedido->id]) }}">
                                            <button class="btn-icon-1 mr-2" title="validar pedido"><i class="fa-solid fa-check"></i></button>
                                        </a>
                                        <button class="btn-icon-2 mr-2" title="eliminar pedido" onclick="eliminarPedido('{{ $pedido->id }}')"><i class="fa-solid fa-trash-can"></i></button>
                                    </div>
                                </td>                          
                            </tr>
                        @endforeach
                    </tbody>
                </table>
              </div>
            </div>
            @else
                <p class="text-muted text-center">No existen pedidos registrados</p>
            @endif
      </div>

</div>

<div class="modal" tabindex="-1">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      </div>
      
    </div>
  </div>
</div>


<script>
    function VerUbicacion(id){
        $(".modal-title").html("Ubicacion");

        $.ajax({
            url: "/ubicacion/" + id,
            type: "GET",
            success: function(response) {
                $('.modal-body').html(response);
                $(".modal").modal('show');
            },
            error: function(xhr) {
                alert('Error al cargar la ubicación');
            }
        });
    }

    function eliminarPedido(id){
        $(".modal-title").html("Eliminar Pedido");
        $(".modal-body").html("<p>¿ esta seguro de eliminar este pedido ?</p><button class='btn-shop-submit rounded-pill py-2 px-4' onclick='deleteproduct("+id+")'>"+ "eliminar</button>");
        $(".modal").modal("show");
    }
    function deleteproduct(id){
        $.ajax({
            url: "/eliminarpedido/" + id,
            type: "DELETE",
            data: {
                _token: "{{ csrf_token() }}"
            },
            success: function(response) {
                if (response.success) {
                    window.location.href = '/pedido';
                } else {
                    alert(response.message);
                }
            },
            error: function(xhr) {
                alert('Error al eliminar el pedido: ' + xhr.status + '\n' + xhr.responseText);
            }
        });
    }
</script>

@endsection

@section('scriptFinal')

@if(session('success'))
    <script>
        toastr.success("{{ session('success') }}");
    </script>
@endif
@endsection