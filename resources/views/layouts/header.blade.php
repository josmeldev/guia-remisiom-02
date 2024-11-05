
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Guia de Remision</title>
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
            width: 50px; /* Ancho de la imagen de usuario */
            height: 50px; /* Altura de la imagen de usuario */
            border-radius: 50%; /* Hacer la imagen de usuario circular */
            margin-right: 10px; /* Espaciado a la derecha de la imagen de usuario */
            user-select: none;
        }

        p {
        font-family: Georgia, 'Times New Roman', Times, serif;
        font-size: 13px; /* Tamaño de fuente */
        color: #333; /* Color de texto */
        line-height: 1.6; /* Altura de línea */
        margin-bottom: 13px; /* Margen inferior */
        user-select: none;
    }

    /* Estilo para negritas dentro de párrafos */
    p strong {
        font-weight: bold; /* Negrita */
        user-select: none;

    }

    /* Estilo para el primer párrafo */
    .first-paragraph {
        font-size: 13px; /* Tamaño de fuente */
        user-select: none;
    }

    /* Estilo para el segundo párrafo */
    .second-paragraph {
        font-style: italic; /* Cursiva */
        user-select: none;
    }

    /* Estilo para el efecto de hover */
    p:hover
    {
        background-color: #85b5e9;
        border-radius: 10px;
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
        <div class="user-container position-relative">
            <div class="user text-center" onclick="toggleUserContent()">
                <img src="{{ Auth::user()->profile_photo_path }}" alt="Usuario" class="user-avatar rounded-circle">
            </div>
            
            <form id="logout-form" action="{{ route("logout") }}" method="POST" style="display: none;">
                @csrf
            </form>
            <div id="user-content" class="user-content bg-light border p-3 position-absolute shadow rounded" style="display: none;">
                <div class="text-center  rounded" style="border-radius: 10px 10px 0 0;background-color: #9397ec">
                    <img src="{{ Auth::user()->profile_photo_path }}" alt="Usuario" class="user-avatar rounded-circle" >
                </div>
                <hr style="border: dashed 1px gray;">

                <div class="text-center mt-3  mr-0 ml-0" >
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24" color="#7b80e5" fill="none">
                        <circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="1.5" />
                        <path d="M7.5 17C9.8317 14.5578 14.1432 14.4428 16.5 17M14.4951 9.5C14.4951 10.8807 13.3742 12 11.9915 12C10.6089 12 9.48797 10.8807 9.48797 9.5C9.48797 8.11929 10.6089 7 11.9915 7C13.3742 7 14.4951 8.11929 14.4951 9.5Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                    </svg>
                    <h5 style="font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif">{{ Auth::user()->name }}</h5><br>

                    <p class="first-paragraph"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="16" height="16" color="#7b80e5" fill="none">
                        <path d="M5.97492 16.9866V6.53176C5.97492 5.18708 6.03245 3.6264 7.03977 2.73286C7.86598 1.99997 9.03378 1.99999 10.1399 2H17.4509C18.4773 2 19.5415 2.01838 20.4624 2.47045C20.5366 2.50684 20.6074 2.54483 20.6751 2.58464C22.0418 3.38809 21.9999 5.30216 21.9999 6.88462V17.4169C21.9999 18.4584 21.952 19.528 21.5196 20.476C21.1061 21.3828 20.5403 21.7897 19.496 21.9822M5.97492 16.9866H14.8045C15.2176 16.9866 15.5897 17.2396 15.7348 17.6254C15.8611 17.9615 15.9655 18.2521 16.0576 18.5248C16.381 19.4827 16.6645 20.4938 17.3454 21.2423C17.754 21.6916 18.183 21.92 18.7541 21.9822M5.97492 16.9866H2.96877C2.4162 16.9866 1.95792 17.4343 2.00308 17.9836C2.05046 18.56 2.15239 19.062 2.34264 19.5993C2.67902 20.5493 3.26232 21.5103 4.22224 21.8236C4.57657 21.9393 4.96889 21.9772 5.47414 21.9822H18.7541M19.496 21.9822C19.2221 22.0054 18.9773 22.0065 18.7541 21.9822M19.496 21.9822H18.7541" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M10.4688 7H17.4688" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                        <path d="M10.4688 11H13.9688" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                    </svg> <strong>Rol Actual: </strong> {{ Auth::user()->getRoleNames()->first() }}</p>
                    <p class="second-paragraph" onmouseover="showEmailLink()" onmouseleave="hideEmailLink()">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="16" height="16" color="#7b80e5" fill="none">
                            <path d="M2 5L8.91302 8.92462C11.4387 10.3585 12.5613 10.3585 15.087 8.92462L22 5" stroke="currentColor" stroke-width="1.5" stroke-linejoin="round" />
                            <path d="M10.5 19.5C10.0337 19.4939 9.56682 19.485 9.09883 19.4732C5.95033 19.3941 4.37608 19.3545 3.24496 18.2184C2.11383 17.0823 2.08114 15.5487 2.01577 12.4814C1.99475 11.4951 1.99474 10.5147 2.01576 9.52843C2.08114 6.46113 2.11382 4.92748 3.24495 3.79139C4.37608 2.6553 5.95033 2.61573 9.09882 2.53658C11.0393 2.4878 12.9607 2.48781 14.9012 2.53659C18.0497 2.61574 19.6239 2.65532 20.755 3.79141C21.8862 4.92749 21.9189 6.46114 21.9842 9.52844C21.9939 9.98251 21.9991 10.1965 21.9999 10.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M19 17C19 17.8284 18.3284 18.5 17.5 18.5C16.6716 18.5 16 17.8284 16 17C16 16.1716 16.6716 15.5 17.5 15.5C18.3284 15.5 19 16.1716 19 17ZM19 17V17.5C19 18.3284 19.6716 19 20.5 19C21.3284 19 22 18.3284 22 17.5V17C22 14.5147 19.9853 12.5 17.5 12.5C15.0147 12.5 13 14.5147 13 17C13 19.4853 15.0147 21.5 17.5 21.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                        </svg> 
                        <strong>Email:</strong> {{ Auth::user()->email }}
                    </p>
                </div>
                <hr>
                <div class="text-center ">
                    <a href="{{ route("logout") }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="btn btn-danger">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24" color="#ffffff" fill="none">
                            <path d="M15 17.625C14.9264 19.4769 13.3831 21.0494 11.3156 20.9988C10.8346 20.987 10.2401 20.8194 9.05112 20.484C6.18961 19.6768 3.70555 18.3203 3.10956 15.2815C3 14.723 3 14.0944 3 12.8373L3 11.1627C3 9.90561 3 9.27705 3.10956 8.71846C3.70555 5.67965 6.18961 4.32316 9.05112 3.51603C10.2401 3.18064 10.8346 3.01295 11.3156 3.00119C13.3831 2.95061 14.9264 4.52307 15 6.37501" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                            <path d="M21 12H10M21 12C21 11.2998 19.0057 9.99153 18.5 9.5M21 12C21 12.7002 19.0057 14.0085 18.5 14.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </a>
                </div>
            </div>
        </div>
        
        <script>
            function toggleUserContent() {
                var userContent = document.getElementById("user-content");
                if (userContent.style.display === "none" || userContent.style.display === "") {
                    userContent.style.display = "block";
                } else {
                    userContent.style.display = "none";
                }
            }
            function showEmailLink() {
        var paragraph = document.querySelector('.second-paragraph');
        if (!paragraph.querySelector('a')) {
            var emailLink = document.createElement('a');
            emailLink.href = 'mailto:' + '{{ Auth::user()->email }}';
            emailLink.textContent = 'Enviar correo';
            paragraph.appendChild(emailLink);
        }
    }

    function hideEmailLink() {
        var paragraph = document.querySelector('.second-paragraph');
        var emailLink = paragraph.querySelector('a');
        if (emailLink) {
            paragraph.removeChild(emailLink);
        }
    }


           
       
        </script>
       
    </header>

    @style('css')
    <style>
       

    .user-content {
        top: calc(100% + 5px);
        right: 18%;
        width: 250px;
        z-index: 1000;
        border-radius: 4px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        user-select: none;
    }

    .notify {
        margin-right: 20px;
    }


  
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
            cursor: pointer;
            width: 30px; /* Ancho de la imagen de usuario */
            height: 30px; /* Altura de la imagen de usuario */
            border-radius: 50%; /* Hacer la imagen de usuario circular */
            margin-right: 10px; /* Espaciado a la derecha de la imagen de usuario */
        }

    </style>

    @endstyle

    @section('scripts')
    @script('js')
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function() {
            $('[data-toggle="popover"]').popover();
            $(document).on('click', 'a[href="{{ route("logout") }}"]', function(e) {
                e.preventDefault();
                $('#logout-form').submit();
            });
        });
        
    </script>

    

</body>
</html>
