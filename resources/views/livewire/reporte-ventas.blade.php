<div>
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
        </div>
    </div>
    <div class="card card-success">
        <div class="card-header">
        <h3 class="card-title">Stacked Bar Chart</h3>

        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse">
            <i class="fas fa-minus"></i>
            </button>
            <button type="button" class="btn btn-tool" data-card-widget="remove">
            <i class="fas fa-times"></i>
            </button>
        </div>
        </div>
        <div class="card-body">
        <div class="chart">
            <canvas id="stackedBarChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
        </div>
        </div>
    <!-- /.card-body -->
    </div>
    <div class="container">
        <div wire:ignore>
            <canvas id="mySalesChart"></canvas>
        </div>

        <button wire:click="updateChartData" class="btn">
            Cargar Nuevos Datos
        </button>
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

<script></script>
@endpush
