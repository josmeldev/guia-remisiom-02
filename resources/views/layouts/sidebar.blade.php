<!-- resources/views/layouts/sidebar.blade.php -->
<head>
    <!-- ... -->
    <!-- CSS de Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <!-- ... -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/3.1.0/css/adminlte.min.css" rel="stylesheet">
    <!-- Bootstrap CSS -->
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

<!-- Font Awesome -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

<!-- AdminLTE CSS -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/3.1.0/css/adminlte.min.css" rel="stylesheet">

<!-- jQuery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<!-- Bootstrap JS -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<!-- AdminLTE JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/3.1.0/js/adminlte.min.js"></script>

</head>




    <div id="sidebar" class="sidebar overflow-auto">
        <div class="sidebar-header">
            <a href="/"><img src="{{ asset('images/contabilidad.png') }}" alt="Logo Empresa"></a>

        </div>
        <hr>
        <ul class="list-unstyled components">
            <li>
                <a href="/guia-remision" class="sidebar-link">
                    <div class="div-icon">
                        <i class="fas fa-file-alt sidebar-icon"></i>
                    </div>
                    <div class="text-sidebar">
                        <span class="d-none d-md-inline">Guía Remisión</span>
                    </div>


                </a>
            </li>
            <li>
                <a href="/pagos" class="sidebar-link">
                    <div class="div-icon">
                        <i class="fas fa-money-check-alt sidebar-icon"></i>
                    </div>
                    <div class="text-sidebar">
                        <span class="d-none d-md-inline">Pagos</span>
                    </div>
                </a>
            </li>
            <li>
                <a href="/campos" class="sidebar-link">
                    <div class="div-icon">
                        <i class="fas fa-tractor sidebar-icon"></i>
                    </div>
                    <div class="text-sidebar">
                        <span class="d-none d-md-inline">Campos</span>
                    </div>
                </a>
            </li>
            <li>
                <a href="/conductores" class="sidebar-link">
                    <div class="div-icon">
                        <i class="fas fa-user-tie sidebar-icon"></i>
                    </div>
                    <div class="text-sidebar">
                        <span class="d-none d-md-inline">Conductores</span>
                    </div>
                </a>
            </li>
            <li>
                <a href="/cargas" class="sidebar-link">
                    <div class="div-icon">
                        <i class="fas fa-boxes sidebar-icon"></i>
                    </div>
                    <div class="text-sidebar">
                        <span class="d-none d-md-inline">Cargas</span>
                    </div>
                </a>
            </li>
            <li class="submenu-parent">
                <a href="#" class="sidebar-link mas-opciones">
                    <div class="div-icon">
                        <i class="fas fa-chevron-down sidebar-icon"></i>
                    </div>
                    <div class="text-sidebar">
                        <span class="d-none d-md-inline">Más opciones</span>
                    </div>
                </a>
                <ul class="submenu list-unstyled">
                    <li class="pl-1">
                        <a href="/transportistas" class="sidebar-link">
                            <div class="div-icon">
                                <i class="fas fa-truck sidebar-icon"></i>
                            </div>
                            <div class="text-sidebar">
                                <span class="d-none d-md-inline">Transportista</span>
                            </div>
                        </a>
                    </li>
                    <li class="pl-1">
                        <a href="/agricultores" class="sidebar-link">
                            <div class="div-icon">
                                <i class="fas fa-seedling sidebar-icon"></i>
                            </div>
                            <div class="text-sidebar">
                                <span class="d-none d-md-inline">Agricultor</span>
                            </div>
                        </a>
                    </li>
                    <li class="pl-1">
                        <a href="/vehiculos" class="sidebar-link">
                            <div class="div-icon">
                                <i class="fas fa-truck-moving sidebar-icon"></i>
                            </div>
                            <div class="text-sidebar">
                                <span class="d-none d-md-inline" >Vehiculos</span>
                            </div>
                        </a>
                    </li>
                    <li class="pl-1">
                        <a href="/usuarios" class="sidebar-link">
                            <div class="div-icon">
                                <i class="fas fa-users sidebar-icon"></i>
                            </div>
                            <div class="text-sidebar">
                                <span class="d-none d-md-inline" >Usuarios</span>
                            </div>
                        </a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="#" class="sidebar-link ajustes-link">
                    <div class="div-icon">
                        <i class="fas fa-cogs sidebar-icon"></i>
                    </div>
                    <div class="text-sidebar">
                        <span class="d-none d-md-inline">Ajustes</span>
                    </div>
                </a>
            </li>
        </ul>
    </div>


    <div class="sidebar-content">
        @yield('content')
    </div>

    <div class="estilos-css">
        @yield('css')
    </div>
    <div class="js">
        @yield('js')
    </div>

<style>


    hr {
        border: solid 1px white;
        box-shadow: 0px 0px 1px rgba(103, 202, 226, 0.5);
    }

    img {
    width: 100%; /* Cambiado para que la imagen sea completamente responsiva */
    height: auto; /* Agregado para mantener la proporción de la imagen */
    max-width: 90px; /* Agregado para limitar el ancho máximo de la imagen */
    margin: 0 auto; /* Agregado para centrar la imagen */

    }

    .sidebar-link:hover {
        background-color: #00355F;
        color: white;
        width: 100%;
        border-radius: 5px;

    }

    .sidebar-link.active {
    background-color: #00355F;
    color: white;
    width: 100%;
    border-radius: 5px;
    margin: 2px 0 2px 0;

    }


    .sidebar {
    height: 100vh;
    width: 200px;
    min-width: 50px;
    position: fixed;
    top: 0;
    left: 0;
    background-color: #00A0CE; /* Color de fondo del sidebar */
    transition: width 0.3s ease;
}
.sidebar.collapsed {
    width: 80px; /* Ancho reducido del sidebar */
}

/* Estilos del sidebar en pantallas pequeñas */
@media (max-width: 767.98px) {
    .sidebar {
        width: 80px;

    }

    .list-unstyled.components {
        padding-top: 20px; /* Añadido para espacio entre la imagen del encabezado y los enlaces */
    }


    .sidebar-link {
        padding: 10px 20px; /* Ajuste del relleno original */
    }
    li{
        margin-top: 15px;
    }
    .sidebar-content{
        padding:2px;
        margin-left: 10%;
        margin-right: 3%;
    }

}

/* Estilos del contenido del sidebar */
.sidebar-content {
    padding-top: 20px; /* Agregado para crear un espacio entre la imagen del encabezado y el contenido del sidebar */
}


    .sidebar-header {
        padding: 20px;
        text-align: center;
    }

    .sidebar-title {
        color: white;
        margin-bottom: 0;
    }

    .list-unstyled {
        padding-left: 0;
        list-style: none;
    }

    .sidebar-link {
        display: flex;
        align-items: center; /* Alinear verticalmente */
        padding: 10px 10px;
        color: white; /* Color del texto del enlace */
        transition: all 0.3s ease;
        width: 100%;
    }

    .sidebar a{
        text-decoration: none;
    }

    .sidebar-icon {

        font-size:20px; /* Tamaño de fuente de los iconos */
    }
    .sidebar ul {
    padding: 0;
}
.sidebar ul li {
    list-style-type: none;

}

.sidebar ul li a {

    text-decoration: none;
    display: flex;
    align-items: center;
}

    .sidebar-text {
        font-size: 18px; /* Tamaño de fuente del texto */
        color: white; /* Cambiar el color del texto */
    }
    .sidebar-content {
        margin-right: 1%;
        margin-left: 16%;
        width: 83%;
        padding: 0.5%;
    }
    .submenu {
        max-height: 0;
        overflow: hidden;

        opacity: 0;
        transition: max-height 0.5s ease-in-out, opacity 2s ease-in-out;
    }

    .hide-text {
    visibility: hidden; /* Ocultar el texto sin cambiar el layout */
}



.sidebar.collapsed #hamburger-icon {
    margin-left: 250px; /* Ajuste para que esté al lado del sidebar colapsado */
}

    .submenu.active {
        max-height: 300px; /* Ajusta el valor según la altura máxima del submenú */
        opacity: 1;
    }
    .rotate {
        transition: transform 0.5s;
    }
    .rotate.up {
        transform: rotate(-180deg);
    }

    .div-icon {
    display: flex;
    justify-content: center;
    padding: 0 5px 0 5px;
    align-items: center;
    width: 50px; /* Ajuste para ocupar todo el ancho del contenedor */
    height: 40px; /* Ajuste para la altura del contenedor */
}

    .text-sidebar{
        width: 100%;
        height: 40px;
        align-content: center;
        padding: 8px 0 0 0;
    }

    span{
        font-family: Verdana, Geneva, Tahoma, sans-serif
    }

    .sidebar a.active {
    color: rgb(150, 207, 18); /* Color morado */

}
.sidebar .submenu-parent.active > a {
    color: rgb(10, 20, 163); /* Color morado */
    font-family: Verdana, Geneva, Tahoma, sans-serif;
}
</style>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        var masOpciones = document.querySelector('.sidebar-link.mas-opciones');
        var submenu = document.querySelector('.submenu');
        var icono = document.querySelector('.sidebar-link.mas-opciones .sidebar-icon');

        masOpciones.addEventListener('click', function(event) {
            event.preventDefault();
            submenu.classList.toggle('active');
            if (submenu.classList.contains('active')) {
                icono.classList.remove('fa-chevron-down');
                icono.classList.add('fa-chevron-up');
            } else {
                icono.classList.remove('fa-chevron-up');
                icono.classList.add('fa-chevron-down');
            }
        });
    });
</script>



<script>
    $(document).ready(function() {
    // Obtiene la URL actual
    var currentLocation = window.location.href;

    // Itera sobre los enlaces del sidebar
    $('.sidebar a').each(function() {
        // Verifica si la URL del enlace coincide con la URL actual
        if (currentLocation.includes($(this).attr('href'))) {
            // Agrega la clase 'active' al enlace correspondiente
            $(this).addClass('active');
        }
    });
});
</script>
<script>
    $(document).ready(function() {
    // Manejo de clics en "Más opciones"
    $('.submenu-parent > a').click(function(event) {
        event.preventDefault(); // Evitar que se navegue a la página principal del submenu
        $('.submenu-parent').removeClass('active'); // Eliminar la clase activa de todos los elementos del submenu
        $(this).parent().addClass('active'); // Agregar la clase activa al elemento clickeado
    });

    // Manejo de clics en los enlaces del submenu
    $('.submenu a').click(function() {
        $('.submenu a').removeClass('active'); // Eliminar la clase activa de todos los enlaces del submenu
        $(this).addClass('active'); // Agregar la clase activa al enlace clickeado
    });
});
</script>





