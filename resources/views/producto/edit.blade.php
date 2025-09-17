@extends('layouts.dashboard')

@section('content')
 <div class="container p-3">
    <div class="card">
        <form class="row" method="POST" action="{{ route('productos.update',['producto' => $producto->id]) }}">
            @csrf
            @method('PUT')

            <div class="col-12 d-flex justify-content-between align-items-center">
                <div>
                    <a href="{{ route('productos.index') }}"><button class="btn-shop-add rounded-pill" type="button"><i class="fa-solid fa-chevron-left"></i> volver</button></a>
                </div>
                <h4 class="text-center mb-4">Actualizar datos del producto</h4>
                <div></div>
            </div>

            <div class="col-12 form-group">
                <label>Nombre del producto</label>
                <input type="text" style="text-transform: uppercase;" name="nombre" placeholder="Nombre" required
                    class="form-control @error('name') is-invalid @enderror"
                    value="{{ old('nombre', $producto->nombre) }}">
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-12 col-md-6 form-group">
                <label>Descripcion</label>
                <textarea name="descripcion" placeholder="Descripcion"
                    class="form-control @error('descripcion') is-invalid @enderror">{{ old('descripcion', $producto->descripcion) }}</textarea>
                @error('descripcion')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-12 col-md-6 form-group">
                <label>Datos técnicos</label>
                <textarea name="datostecnicos" placeholder="Datos técnicos"
                    class="form-control @error('datostecnicos') is-invalid @enderror">{{ old('datostecnicos', $producto->datostecnicos) }}</textarea>
                @error('datostecnicos')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-12 col-md-6 col-lg-4 form-group">
                <label>Precio</label>
                <input type="number" min="0" step="any" name="precio" placeholder="Precio" required
                    class="@error('precio') is-invalid @enderror"
                    value="{{ old('precio', $producto->precio) }}">
                @error('precio')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-12 col-md-6 col-lg-4 form-group">
                <label>Precio de descuento</label>
                <small class="text-muted"> (guardar con 0 si no existe descuento).</small>
                <input type="number" step="any" min="0" name="descuento" placeholder="Descuento" required
                    class="@error('descuento') is-invalid @enderror"
                    value="{{ old('descuento', $producto->descuento) }}">
                @error('descuento')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-12 col-md-6 col-lg-4 form-group">
                <label>tipo de producto</label>
                <select name="tipo" id="tipo">
                    <option value="N" selected>Nuevo</option>
                    <option value="E">Regular</option>

                </select>
                <script>
                    var selectElement = $("#tipo");
                    var tipo = "{{ $producto->tipo }}";
                    selectElement.val(tipo);
                    if (selectElement.val() !== tipo) {
                        selectElement.val(""); 
                    }
                </script>
            </div>
            <div class="col-12 col-md-6 col-lg-4 form-group">
                <label>Stock</label>
                <input type="number" min="0" name="stock" placeholder="Stock" required
                    class="@error('stock') is-invalid @enderror"
                    value="{{ old('stock', $producto->stock) }}">
                @error('stock')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            


            <button type="submit" class="rounded-pill btn-shop-submit w-100">Actualizar datos</button>
        </form>
    </div>
</div>


@endsection