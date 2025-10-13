<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>COMPRA EXITOSA</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            background-color: #f6f9fc;
            font-family: Arial, sans-serif;
            color: #333;
        }
        .container {
            max-width: 600px;
            margin: 40px auto;
            background: #ffffff;
            border-radius: 12px;
            box-shadow: 0 4px 16px rgba(0,0,0,0.08);
            padding: 32px;
        }
        .header {
            text-align: center;
            margin-bottom: 24px;
            padding: 3rem;
            background-color: #2E5D3B;
            color: white;
            text-align: center;
        }
        .header img {
            max-width: 120px;
        }
        h2 {
            font-size: 24px;
            color: #6c6c6cff;
            margin-bottom: 12px;
            text-align: center;
        }
        p {
            font-size: 16px;
            line-height: 1.6;
            margin: 12px 0;
        }
        span{
            color: #2E5D3B;
        }
        .btn {
            display: inline-block;
            padding: 14px 24px;
            margin: 20px 0;
            background-color: #06b6d4;
            color: #ffffff !important;
            text-decoration: none;
            font-weight: bold;
            border-radius: 8px;
            font-size: 16px;
        }
        .btn:hover {
            background-color: #0891b2;
        }
        .footer {
            text-align: center;
            font-size: 14px;
            color: #64748b;
            margin-top: 32px;
        }
        @media (max-width: 600px) {
            .container {
                margin: 20px;
                padding: 24px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            ALTUNA
        </div>
        <h2>COMPRA EXITOSA !</h2>
        <p>hola {{ $name }}</p>
        <p>Tu pago ha sido recibido con éxito</p>
        <p>Estamos enviando su compra a la dirección que proporcionaste</p>
        <p>ID COMPRA: <span>{{ $pedidoId }}</span></p> 
        <div class="footer">
            &copy; {{ date('Y') }} ALTUNA S.A. Todos los derechos reservados.
        </div>
    </div>
</body>
</html>

