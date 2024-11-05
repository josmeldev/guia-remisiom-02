<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Moderno</title>
    <link rel="stylesheet" href="styles.css">

    <style>
        /* styles.css */
        body {
    margin: 0;
    font-family: 'Arial', sans-serif;
    background: linear-gradient(to bottom right, #c8f10e, #0eacf1); /* Colores degradados */
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
}


.login-wrapper {
    display: flex;
    justify-content: center;
    align-items: center;
    width: 100%;
    height: 100%;
}

.login-card {
    background: white;
    padding: 2rem;
    border-radius: 15px;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    text-align: center;
    width: 350px;

}

.logo img {
    width: 80px;

}

h2 {

    color: #0c5a05;
    font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif
}

.input-group {
    position: relative;
    margin-bottom: 1.5rem;


}

.input-group input {
    position: relative;
    width: 94%;
    padding: 10px 10px 10px 5px;
    font-size: 16px;
    border: 2px solid rgb(5, 170, 5);
    border-radius: 5px;
    background: #f5f5f5;
    transition: all 0.2s ease;
    color: #0c5a05;
}

.input-group input[type="email"]:focus,input[type="password"]:focus {
    outline-color: #32ce0a;
}


.input-group label {
    position: absolute;
    top: 10px;
    left: 10px;
    font-size: 16px;
    color: #999;
    pointer-events: none;
    transition: all 0.2s ease;

}

.input-group input:focus ~ label,
.input-group input:valid ~ label {
    top: -20px;
    left: 0;
    font-size: 12px;
    color: #32ce0a;
}

.login-button {
    background: #28a745;
    color: white;
    padding: 0.75rem;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    width: 100%;
    font-size: 16px;
    transition: background 0.3s;
}

.login-button:hover {
    background: #218838;
}

.extra-options {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-top: 1rem;
    font-size: 14px;
}

.extra-options a {
    color: #007bff;
    text-decoration: none;
}

.extra-options a:hover {
    text-decoration: underline;
}



    </style>
</head>
<body>
    <div class="login-wrapper">
        <div class="login-card">
            <div class="logo">
                <img src="{{asset("/images/LOGO-TREE.png")}}" alt="Logo de la Empresa">
            </div>
            <form id="loginForm" method="POST" action="{{ route('login') }}">
                @csrf
                <h2>Iniciar Sesión</h2>
                <div class="input-group">
                    <input type="email" id="email" name="email" required>
                    <label for="email">Correo Electrónico</label>
                </div>
                <div class="input-group">
                    <input type="password" id="password" name="password" required>
                    <label for="password">Contraseña</label>
                </div>
                <button type="submit" class="login-button">Ingresar</button>
                <div class="extra-options">
                    <label for="remember_me" class="flex items-center">
                        <x-checkbox id="remember_me" name="remember" />
                        <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                    </label>
                    @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif

                </div>
            </form>
        </div>
    </div>
    <script src="scripts.js"></script>
</body>
</html>
