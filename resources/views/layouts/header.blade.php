
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-FZMNJ1bZHRJGox+2ZOI9bqzPCZfpePi8CnpORoHPhHOnlED1EqG74GZsXzGxVq58tzv4iymfAmJFZqtv7XKy4A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Tus estilos personalizados -->
    <style>
        /* Estilos para el header */
        header {
            background-color: #f8f9fa; /* Color de fondo del header */
            height: 60px; /* Altura del header */
            padding: 0 20px; /* Espaciado interno del header */
            display: flex; /* Utilizar flexbox */
            align-items: center; /* Alinear elementos verticalmente */
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); /* Sombra del header */
        }

        /* Estilos para el campo de búsqueda */
        .buscar input {
            flex: 1; /* El input ocupará todo el espacio disponible */
            padding: 8px 15px; /* Espaciado interno del input */
            border: 1px solid #ced4da; /* Borde del input */
            border-radius: 4px; /* Radio de borde del input */
            margin-right: 10px; /* Espaciado a la derecha del input */
        }

        /* Estilos para el botón de búsqueda */
        .buscar button {
            background-color: #007bff; /* Color de fondo del botón de búsqueda */
            color: #fff; /* Color del texto del botón de búsqueda */
            border: none; /* Quitar borde del botón de búsqueda */
            padding: 8px 15px; /* Espaciado interno del botón de búsqueda */
            border-radius: 4px; /* Radio de borde del botón de búsqueda */
            cursor: pointer; /* Cambiar cursor al pasar por encima del botón de búsqueda */
        }

        /* Estilos para los iconos en el header */
        .notify i, .user i {
            font-size: 24px; /* Tamaño de fuente de los iconos de notificación y usuario */
            margin-right: 10px; /* Espaciado a la derecha de los iconos de notificación y usuario */
            cursor: pointer; /* Cambiar cursor al pasar por encima de los iconos de notificación y usuario */
        }

        .user img {
            width: 30px; /* Ancho de la imagen de usuario */
            height: 30px; /* Altura de la imagen de usuario */
            border-radius: 50%; /* Hacer la imagen de usuario circular */
            margin-right: 10px; /* Espaciado a la derecha de la imagen de usuario */
        }
    </style>
</head>
<body>
    <header class="d-flex" style="padding-left: 200px;">
        <div class="amburgesa">
            <i class="fas fa-bars"></i>
        </div>
        <div class="buscar">
            <input type="text">
            <button>
                <i class="fas fa-search"></i>
            </button>
        </div>
        <div class="notify">
            <i class="fas fa-bell"></i>
            <i class="fas fa-envelope"></i>
            <i class="fas fa-exclamation-circle"></i>
        </div>
        <div class="user">
            <img src="tu_imagen.jpg" alt="Usuario">
        </div>
    </header>

    @style('css')
    <style>
        header {
            background-color: #f8f9fa; /* Color de fondo del header */
            height: 60px; /* Altura del header */
            padding: 0 20px; /* Espaciado interno del header */
            align-items: center; /* Alinear elementos verticalmente */
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); /* Sombra del header */
        }

        .amburgesa{
            margin-left: 2%;
        }

        .buscar {
            flex: 1; /* Ocupa el espacio restante */
            display: flex; /* Utilizar flexbox */
            align-items: center; /* Alinear elementos verticalmente */
        }

        .buscar input {
            width: 200px; /* Ancho del campo de búsqueda */
            padding: 8px; /* Espaciado interno del campo de búsqueda */
            border: 1px solid #ced4da; /* Borde del campo de búsqueda */
            border-radius: 4px; /* Radio de borde del campo de búsqueda */
            margin-right: 10px; /* Espaciado a la derecha del campo de búsqueda */
            margin-left: 20px
        }

        .buscar button {
            background-color: #007bff; /* Color de fondo del botón de búsqueda */
            color: #fff; /* Color del texto del botón de búsqueda */
            border: none; /* Quitar borde del botón de búsqueda */
            padding: 8px 15px; /* Espaciado interno del botón de búsqueda */
            border-radius: 4px; /* Radio de borde del botón de búsqueda */
            cursor: pointer; /* Cambiar cursor al pasar por encima del botón de búsqueda */
        }

        .notify, .user {
            display: flex; /* Utilizar flexbox */
            align-items: center; /* Alinear elementos verticalmente */
            margin-left: 20px; /* Espaciado a la izquierda de los elementos de notificación y usuario */
        }

        .notify i, .user i {
            font-size: 24px; /* Tamaño de fuente de los iconos de notificación y usuario */
            margin-right: 10px; /* Espaciado a la derecha de los iconos de notificación y usuario */
            cursor: pointer; /* Cambiar cursor al pasar por encima de los iconos de notificación y usuario */
        }

        .user img {
            width: 30px; /* Ancho de la imagen de usuario */
            height: 30px; /* Altura de la imagen de usuario */
            border-radius: 50%; /* Hacer la imagen de usuario circular */
            margin-right: 10px; /* Espaciado a la derecha de la imagen de usuario */
        }

    </style>

</body>
</html>
