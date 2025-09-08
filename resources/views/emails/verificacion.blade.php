<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verificación de cuenta</title>
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
        }
        .header img {
            max-width: 120px;
        }
        h2 {
            font-size: 24px;
            color: #0f172a;
            margin-bottom: 12px;
        }
        p {
            font-size: 16px;
            line-height: 1.6;
            margin: 12px 0;
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
            <!-- <img src="https://your-domain.com/logo.png" alt="Natural Tuna Logo"> -->
        </div>
        <h2>Hola {{ $name }}</h2>
        <p>Gracias por registrarte en nuestra plataforma de <strong>NATURAL TUNA</strong>.</p>
        <p>Por favor haz clic en el siguiente enlace para activar tu cuenta:</p>
        <p style="text-align:center;">
            <a href="{{ route('verificar.cuenta', $codigo) }}" class="btn">
                Activar mi cuenta
            </a>
        </p>
        <p>Si no solicitaste esta cuenta, puedes ignorar este mensaje.</p>
        <div class="footer">
            &copy; {{ date('Y') }} NATURAL TUNA. Todos los derechos reservados.
        </div>
    </div>
</body>
</html>

