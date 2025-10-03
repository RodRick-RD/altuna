<div>
    <div class="container mt-4">

        @if(session()->has('message'))
            <div class="alert alert-success">{{ session('message') }}</div>
        @endif

        <!-- Botón Crear -->
        <button wire:click="create" class="btn-shop-submit rounded-pill mb-3">Nuevo Proveedor</button>

        <!-- LISTADO -->
        <div class="table-responsive">

            <table class="tabla-ui">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Email</th>
                        <th>Teléfono</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($proveedores as $prov)
                        <tr>
                            <td>{{ $prov->id }}</td>
                            <td>{{ $prov->nombre }}</td>
                            <td>{{ $prov->email }}</td>
                            <td>{{ $prov->telefono }}</td>
                            <td>
                                <button wire:click="edit({{ $prov->id }})" class="btn-icon-1">Editar</button>
                                <button class="btn-icon-2 btn-delete" data-id="{{ $prov->id }}">Eliminar</button>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="5" class="text-center">No hay proveedores</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- MODAL -->
    <div wire:ignore.self class="modal fade" id="proveedorModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form wire:submit.prevent="{{ $isEdit ? 'update' : 'store' }}" class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ $isEdit ? 'Editar Proveedor' : 'Nuevo Proveedor' }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" wire:click="resetInput">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Nombre</label>
                        <input type="text" wire:model="nombre" class="form-control">
                        @error('nombre') <span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" wire:model="email" class="form-control">
                        @error('email') <span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group">
                        <label>Teléfono</label>
                        <input type="text" wire:model="telefono" class="form-control">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-{{ $isEdit ? 'warning' : 'primary' }}">
                        {{ $isEdit ? 'Actualizar' : 'Guardar' }}
                    </button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" wire:click="resetInput">Cancelar</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        window.addEventListener('open-modal', event => {
            $('#proveedorModal').modal('show');
        });

        window.addEventListener('close-modal', event => {
            $('#proveedorModal').modal('hide');
        });

        $(document).on('click', '.btn-delete', function(){
            let id = $(this).data('id');
            if(confirm("¿Seguro de eliminar este proveedor?")){
                Livewire.emit('deleteProveedor', id);
            }
        });
    </script>
</div>
