<div class="card">
    <div class="card-header">
        <h3 class="card-title">Reporte de Ventas por Producto</h3>
    </div>
    <div class="card-body">
        <div class="row mb-3">
            <div class="col-md-4">
                <label>Fecha Inicio</label>
                <input type="date" wire:model="fechaInicio" class="form-control">
            </div>
            <div class="col-md-4">
                <label>Fecha Final</label>
                <input type="date" wire:model="fechaFin" class="form-control">
            </div>
            <div class="col-md-4 d-flex align-items-end">
                <button wire:click="buscar" class="btn-shop-submit rounded-pill m-0">
                    <i class="fas fa-search"></i> Buscar
                </button>
            </div>
        </div>

        <canvas id="graficoVentas" height="100"></canvas>
    </div>
</div>

@push('js')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('livewire:load', function () {
        let ctx = document.getElementById('graficoVentas').getContext('2d');
        let chart;

        Livewire.on('refreshChart', data => {
        // data.labels, data.cantidades, data.ventas
        myChart.data.labels = data.labels;
        myChart.data.datasets[0].data = data.cantidades;
        myChart.data.datasets[1].data = data.ventas;
        myChart.update();
    });
    });
</script>
@endpush
