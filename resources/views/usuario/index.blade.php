@extends('layouts.dashboard')

@section('content')

<div class="contanier">
  <div class="row px-4">
    <div class="col-12">
        <h2>Usuarios</h2>
    </div>
    <div class="col-12 col-md-6 col-lg-4">
        <input type="text" placeholder="Buscar..." onkeyup="BuscadorTabla(this.value,0);" class="bg-transparent">
    </div>
  </div>

  <div class="p-4 overflow-x-auto">
              @if(count($users) > 0)
                @php $total = 0; @endphp

              <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="tabla-ui">
                    <thead class="table-secondary">
                        <tr>
                            <th class="bg-transparent">Nombres</th>
                            <th class="bg-transparent">apellidos</th>
                            <th class="bg-transparent">rol</th>
                            <th class="bg-transparent">estado</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $item)
                            <tr>
                                <td class="bg-transparent">{{ $item['name'] }}</td>
                                <td class="bg-transparent">{{ $item['lastName'] }}</td>
                                <td class="bg-transparent">{{ $item['role'] }}</td>
                                <td class="bg-transparent">
                                    <label class="switch">
                                        <input type="checkbox" class="toggle-estado" 
                                            data-id="{{ $item['id'] }}" 
                                            {{ $item['estado'] == '1' ? 'checked' : '' }}>
                                        <span class="slider round"></span>
                                    </label>
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
    let estado = $(this).is(':checked') ? 1 : 0;

    $.ajax({
        url: "{{ route('usuario.estado') }}",
        method: 'POST',
        data: {
            id: id,
            estado: estado,
            _token: '{{ csrf_token() }}'
        },
        success: function(response) {
            if(response.success){
                //console.log('Estado cambiado a: ' + response.estado);
                if(response.estado==='activo'){
                    toastr.success("Estado del usuario cambiado a " + response.estado)
                }else{
                    toastr.warning("Estado del usuario cambiado a " + response.estado);
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