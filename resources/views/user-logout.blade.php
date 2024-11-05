<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Has Cerrado Sesión</title>
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/logout.css') }}">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background: linear-gradient(135deg, #a8e063, #56ab2f);
            color: white;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .logout-card {
            background: rgba(255, 255, 255, 0.9);
            border-radius: 10px;
            padding: 30px;
            max-width: 400px;
            text-align: center;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }
        .logout-card h2 {
            color: #333;
        }
        .logout-card p {
            color: #666;
        }
        .logout-button {
            background: #56ab2f;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            transition: background 0.3s;
        }
        .logout-button:hover {
            background: #4a9228;
        }
    </style>
</head>
<body>
    <div class="logout-card">
        <h2>Has Cerrado Sesión</h2>
        <p>Gracias por usar nuestros servicios. Esperamos verte pronto.</p>
        <a href="{{ route('login') }}" class="logout-button">Iniciar Sesión de Nuevo</a>
    </div>
</body>
</html>
