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


<div id="sidebar" class="sidebar">
    <div class="sidebar-header">
        <h3 class="sidebar-title">SISTEMA DE REGISTRO</h3>
    </div>
    <ul class="list-unstyled components">
        <li>
            <a href="#" class="sidebar-link">
                <i class="fas fa-file-alt sidebar-icon"></i>
                <p>Guia de Remision</p>
            </a>
        </li>
        <li>
            <a href="#" class="sidebar-link">
                <i class="fas fa-money-check-alt sidebar-icon"></i>
                <p>Pagos</p>
            </a>
        </li>
        <li>
            <a href="#" class="sidebar-link">
                <i class="fas fa-tractor sidebar-icon"></i>
                <p>Campo</p>
            </a>
        </li>
        <li>
            <a href="#" class="sidebar-link">
                <i class="fas fa-user-tie sidebar-icon"></i>
                <p>Conductor</p>
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
    .sidebar-link:hover {
        background-color: #00355F;
        color: white;
    }

    .sidebar-link.active {
        background-color: #00355F;
        color: white;
    }

    .sidebar {
        width: 200px;
        height: 100%;
        position: fixed;
        top: 0;
        left: 0;
        background-color: #00A0CE; /* Color de fondo del sidebar */
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
        padding: 10px 20px;
        color: white; /* Color del texto del enlace */
        transition: all 0.3s ease;
        width: 100%;
    }

    .sidebar a{
        text-decoration: none;
    }

    .sidebar-icon {
        margin-right: 10px;
        font-size: 24px; /* Tamaño de fuente de los iconos */
    }

    .sidebar-text {
        font-size: 18px; /* Tamaño de fuente del texto */
        color: white; /* Cambiar el color del texto */
    }
    .sidebar-content {
        margin-left: 15%; /* Ancho del sidebar */
    }

</style>
