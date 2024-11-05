<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenido a la Aplicación</title>
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Estilos Personalizados -->
    <style>
        body {
            background: linear-gradient(135deg, #f1bc0e, hsl(103, 96%, 49%));
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            color: white;
        }
        .container {
            text-align: center;


        }
        .welcome-img {
            max-width: 300px;
            margin-bottom: 30px;
            border-radius:10px;
        }
        .welcome-message {
            font-size: 24px;
            margin-bottom: 30px;
        }
        .go-to-menu-btn {
            background: linear-gradient(to right, #4CAF50, #2E8B57);
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
            text-decoration: none;
        }
        .go-to-menu-btn:hover {
            background: linear-gradient(to right, #008000, #006400);
        }
    </style>
</head>
<body>
    <div class="container">
        <img src="{{ asset('images/dog.png') }}" alt="Bienvenido" class="welcome-img">
        <p class="welcome-message">¡Bienvenido a nuestra aplicación!</p>
        <a href="{{ route('mostrar.menu') }}" class="btn btn-primary go-to-menu-btn">Ir al Menú Principal</a>
    </div>
</body>
</html>
