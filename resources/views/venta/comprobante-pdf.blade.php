<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title>Nota de Venta - ALTUNA</title>
    <link href="{{ asset('assets/img/icon/logo.jpg') }}" rel="icon">
    <link href="{{ asset('assets/img/icon/logo.jpg') }}" rel="apple-touch-icon">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css')}}">
    <style>
        @page {
            margin: 0;
            size: A4 portrait;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
            color: #333;
            background: #ffffffff;
        }

        .page {
            width: 100dvw;
            min-height: 100vh;
            background: #fff;
            box-sizing: border-box;
            padding: 25px 35px;
            position: relative;
        }

        /* --- RIBBON (Paid) --- */
        .ribbon {
            width: 200px;
            background: #266983;
            color: #fff;
            text-align: center;
            font-weight: bold;
            line-height: 35px;
            position: absolute;
            top: 30px;
            right: -50px;
            transform: rotate(45deg);
            box-shadow: 0 2px 6px rgba(0,0,0,0.2);
            font-size: 14px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        /* --- Header --- */
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 3px solid #266983;
            padding-bottom: 10px;
            margin-bottom: 25px;
        }

        .header img {
            max-height: 70px;
        }

        .empresa {
            /* text-align: right; */
        }

        .empresa h2 {
            margin: 0;
            color: #266983;
            font-size: 22px;
        }

        .empresa small {
            color: #777;
            display: block;
        }

        /* --- Title --- */
        h3.titulo {
            text-align: center;
            margin-bottom: 20px;
            text-transform: uppercase;
            letter-spacing: 2px;
            color: #444;
        }

        /* --- Table --- */
        table {
            margin-top: 2rem;
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 25px;
            font-size: 14px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }

        th {
            background: #f4f4f4;
            text-transform: uppercase;
            font-size: 13px;
            color: #555;
        }

        .badge {
            padding: 4px 8px;
            border-radius: 10px;
            color: #fff;
            font-size: 11px;
        }

        .bg-pendiente { background: #ffc107; }
        .bg-vendido  { background: #28a745; }
        .bg-cancelado { background: #dc3545; }

        /* --- Footer --- */
        .footer {
            text-align: center;
            margin-top: 25px;
            font-size: 12px;
            color: #777;
        }

        @media print {
            body {
                background: #fff;
            }
            .page {
                box-shadow: none;
                padding: 15px;
            }
            .footer {
                position: fixed;
                bottom: 5mm;
                left: 0;
                right: 0;
            }
        }
    </style>
</head>
<body>
    <div class="page">

        <!-- Ribbon -->
        <div class="ribbon">Pagado</div>

        <!-- Cabecera -->
        <div class="header">
            <div>
                <img src="{{ asset('assets/img/profile/logo.png') }}" alt="Logo Empresa">
            </div>
        </div>
        <div class="empresa">
            <h2>Altuna S.R.L.</h2>
            <small>NIT: 12345678</small>
            <small>Tel: +591 777-12345</small>
        </div>

        <h3 class="titulo">Nota de Venta</h3>
        @forelse ($ventas as $pedido)
        <table style="width: 100%; border: none;">
            <tr>
                <td class="border: none;" style="width: 50%;"><b>CLIENTE: </b>{{ $pedido->razon_social }}</td>
                <td class="border: none;" style="width: 50%;"><b>Fecha y Hora: </b>{{ \Carbon\Carbon::parse($pedido->fecha)->format('d/m/Y H:i:s') }}</td>
            </tr>
            <tr>
                <td class="border: none;" style="width: 50%;"><b>NITo C.I. </b>{{ $pedido->nit }}</td>
                <td class="border: none;" style="width: 50%;"></td>
            </tr>
        </table>

        <!-- Tabla -->
        <table>
            @php
                $n=1;
            @endphp
            <thead>
                <tr>
                    <th>Nro</th>
                    <th>Producto</th>
                    <th>Precio unit.</th>
                    <th>cantidad</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                    @foreach ($pedido->productos as $producto)
                        <tr>
                            <td>{{ $n }}</td>
                            @php
                                $n++;
                            @endphp
                            <td>{{ $producto->nombre }}</td>
                            <td>{{ $producto->pivot->precio }}</td>
                            <td>{{ $producto->pivot->cantidad }}</td>
                            <td>{{ number_format($producto->pivot->precio * $producto->pivot->cantidad, 2, '.', ',') }}</td>
                        </tr>
                               
                    @endforeach
                    <tr>
                        <td colspan="4">SubTotal</td>
                        <td>{{ number_format($pedido->total, 2, '.', ',') }}</td>
                    </tr>
                    <tr>
                        <td colspan="4">Descuento</td>
                        <td>{{ number_format($pedido->descuento, 2, '.', ',') }}</td>
                    </tr>
                    <tr>
                        <td colspan="4">TOTAL</td>
                        <td>{{ number_format($pedido->total - $pedido->descuento, 2, '.', ',') }}</td>
                    </tr>
            </tbody>
        </table>
    @empty
        <div style="text-align:center;">No hay resultados</div>
    @endforelse
        <!-- Footer -->
        <div class="footer">
            <p>Gracias por su compra — {{ date('d/m/Y') }}</p>
        </div>
    </div>
</body>
</html>
