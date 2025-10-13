@extends('layouts.dashboard')

@section('content')

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Reporte de Ventas por Producto</h3>
        </div>
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-md-4">
                    <label>Fecha Inicio</label>
                    <input type="date" id="fechaInicio" class="form-control" value="{{ date('Y-m-d') }}">
                </div>
                <div class="col-md-4">
                    <label>Fecha Final</label>
                    <input type="date" id="fechaFin" class="form-control" value="{{ date('Y-m-d') }}">
                </div>
                <div class="col-md-4 d-flex align-items-end">
                    <button onclick="buscar()" class="btn-shop-submit rounded-pill m-0">
                        <i class="fas fa-search"></i> Buscar
                    </button>
                </div>
            </div>
        </div>
    </div>



    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-6">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Cantidad de productos vendidos</h3>

              </div>
              <div class="card-body">
                <canvas id="donutChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
              </div>
            </div>
          </div>

          <div class="col-md-6">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">TOTAL INGRESOS POR VENTAS</h3>
              </div>
              <div class="card-body">
                <p class="h1 font-weight-bold text-center text-success"><span id="totalVentas">0</span> bs.</p>
              </div>
            </div>
          </div>
         
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <script>
  let donutChart; // Variable global para poder actualizar el gráfico

$(function () {
    const ctx = $('#donutChart').get(0).getContext('2d');

    // Inicializamos el gráfico vacío
    donutChart = new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: [],
            datasets: [{
                data: [],
                backgroundColor: ['#f56954', '#3749c0ff', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de'],
            }]
        },
        options: {
            maintainAspectRatio: false,
            responsive: true,
        }
    });
});

// 🔍 Función al presionar el botón Buscar
function buscar() {
    const fechaInicio = $('#fechaInicio').val();
    const fechaFin = $('#fechaFin').val();

    if (!fechaInicio || !fechaFin) {
        alert('Por favor, seleccione ambas fechas.');
        return;
    }

    $.ajax({
        url: "{{ route('reporte.ventas.fechas') }}",
        type: 'GET',
        data: {
            fechaInicio: fechaInicio,
            fechaFin: fechaFin
        },
        success: function(response) {
            if (response.labels && response.data) {
                // Actualizamos los datos del gráfico
                donutChart.data.labels = response.labels;
                donutChart.data.datasets[0].data = response.data;
                donutChart.update();

                // Actualizamos el total de ventas
                $('#totalVentas').text(response.total);
            } else {
                alert('No se encontraron datos en el rango seleccionado.');
            }
        },
        error: function(xhr) {
            console.error(xhr.responseText);
            alert('Error al obtener los datos del reporte.');
        }
    });
}
</script>
@endsection