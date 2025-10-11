<div class="container mt-4">
    <h3>PRODUCTOS</h3>

    @if (session()->has('message'))
        <div class="alert alert-success">{{ session('message') }}</div>
    @endif
     @if (session()->has('delete'))
        <div class="alert alert-danger">{{ session('delete') }}</div>
    @endif

    <button class="btn-shop-submit rounded-pill mb-3" wire:click="crear">Agregar Producto</button>

    <table class="tabla-ui">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Precio</th>
                <th>Stock</th>
                <th>Imagen</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($productos as $producto)
            <tr>
                <td>{{ $producto->nombre }}</td>
                <td>{{ $producto->precio }}</td>
                <td>{{ $producto->stock }}</td>
                <td>
                    @if($producto->img)
                        <img src="{{ asset($producto->img) }}" width="50" height="50">
                    @endif
                </td>
                <td>
                    <button class="btn-icon-1" wire:click="editar({{ $producto->id }})"><i class="fa-solid fa-pen-to-square"></i></button>
                    <button class="btn-icon-2 btn-delete" wire:click="borrar({{ $producto->id }})"><i class="fa-solid fa-trash"></i></button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Modal -->
    @if($modal)
<div class="modal d-block" tabindex="-1">
  <div class="modal-dialog modal-lg"> <!-- modal-lg para un tamaño grande pero responsivo -->
    <div class="modal-content modal-xl">
      <div class="modal-header">
        <h5 class="modal-title">{{ $producto_id ? 'Editar Producto' : 'Nuevo Producto' }}</h5>
        <button type="button" class="close" wire:click="cerrarModal">&times;</button>
      </div>
      <div class="modal-body" style="max-height:70vh; overflow-y:auto;">
        <form enctype="multipart/form-data">
          <div class="form-group">
            <label>Nombre</label>
            <input type="text" class="form-control" wire:model="nombre">
            @error('nombre') <span class="text-danger">{{ $message }}</span>@enderror
          </div>

          <div class="form-group">
            <label>Descripción</label>
            <textarea class="form-control" wire:model="descripcion"></textarea>
          </div>

          <div class="form-group">
            <label>Datos Técnicos</label>
            <textarea class="form-control" wire:model="datostecnicos"></textarea>
          </div>

          <div class="form-group">
            <label>Precio</label>
            <input type="number" class="form-control" wire:model="precio">
          </div>

          <div class="form-group">
            <label>Stock</label>
            <input type="number" class="form-control" wire:model="stock">
          </div>

          <div class="form-group">
            <label>Vendidos</label>
            <input type="number" class="form-control" wire:model="vendidos">
          </div>

          <div class="form-group">
            <label>Descuento</label>
            <input type="number" class="form-control" wire:model="descuento">
          </div>

          <div class="form-group">
            <label>Imagen</label>
            <div class="p-4">
                <div style="width: 100%; max-width: 400px;">
                    @if($img && !is_string($img))
                    <img src="{{ $img->temporaryUrl() }}" class="mt-2 img-fluid">
                    @elseif($producto_id && $producto = \App\Models\Producto::find($producto_id))
                        <img src="{{ asset($producto->img) }}" class="mt-2 img-fluid">
                    @endif
                </div>
            </div>
            <input type="file" class="form-control" wire:model="img">
          </div>

          @if($editarModo)
            <div class="form-group">
                <label>Estado</label>
                <select wire:model="estado">
                    <option value="">-- Seleccionar --</option>
                    <option value="activo">Activo</option>
                    <option value="inactivo">Inactivo</option>
                </select>
                @error('estado') <span class="text-danger">{{ $message }}</span>@enderror
            </div>

            <div class="form-group">
                <label>Tipo</label>
                <select wire:model="tipo">
                    <option value="">-- Seleccionar --</option>
                    <option value="E">E</option>
                    <option value="N">N</option>
                </select>
                @error('tipo') <span class="text-danger">{{ $message }}</span>@enderror
            </div>
        @endif


        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn-shop-submit rounded-pill mb-3" wire:click="guardar">Guardar</button>
      </div>
    </div>
  </div>
</div>
@endif

</div>

