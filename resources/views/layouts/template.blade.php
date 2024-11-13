<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Guia de Remision</title>


    <link rel="stylesheet" href="{{ asset('css/templante.css') }}">

    <!-- Enlace al archivo CSS de Bootstrap Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.7.2/font/bootstrap-icons.min.css" rel="stylesheet">

    <!-- CSS de Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <!-- Bootstrap JS -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <!-- Enlace al archivo CSS de Bootstrap (opcional si no lo has incluido ya) -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/css/bootstrap.min.css" integrity="sha384-1BmE4kWBq78iYhFldvMJKKTPb8j3R4rVr6z9GdAwpQQXsw8hxFcFLQ/kCF5Fa1IM" crossorigin="anonymous">

    <!-- Enlace al archivo JavaScript de Bootstrap (necesario) -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.min.js" integrity="sha384-ZiXggSEA6Nb0YhKx4Md5RkYq6oCqAq5J0Fv3+6Oq79B/tkzU1qQFpL+94AC6a/2R" crossorigin="anonymous"></script>


    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">


</head>

<body>
    <header class="d-flex align-items-center justify-content-between  ">
        <div class="sidebar-header">

            <a href="/"><img src="{{ asset('/images/logoS.png') }}" alt="Logo Empresa" style="height: 130px; width:130px; border-radius:50%"></a>

        </div>

        <div class="hamburger" onclick="toggleMenu()">
            <div class="line"></div>
            <div class="line"></div>
            <div class="line"></div>
        </div>
        <div class="buscar">
            <input type="text" class="form-control" placeholder="Buscar">
            <button class="btn btn-primary">
                <i class="fas fa-search"></i>
            </button>
        </div>
        <div class="notify">
            <div class="notifications">
                <div class="notification-item" id="notificationIcon">
                    <i class="fas fa-bell"></i>
                    <span class="notification-count" id="notificationCount">{{ $num_notificaciones }}</span> <!-- Número de notificaciones -->
                </div>
                <!-- Popup de notificaciones -->
                <div class="notification-popup" id="notificationPopup">
                    <div class="card-header text-center">
                        <span><b>Notificaciones</b></span>
                    </div>
                    <div class="card-body">
                        @if($agricultores_deben->isNotEmpty())
                        <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseAgricultoresD" aria-expanded="false" aria-controls="collapseAgricultoresD">
                            <i class="fas fa-chevron-down"></i> Agricultores con saldo pendiente
                        </button>
                        <div class="collapse mt-3" id="collapseAgricultoresD">
                            <span><b>Agricultores con saldo pendiente mayor a cero:</b></span>
                            <ul>
                                @foreach ($agricultores_deben as $agricultor)
                                <li>
                                    <span>Hola {{ Auth::user()->name }}, {{ $agricultor->agricultor_nombre }} tiene saldo pendiente.</span>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                        @endif

                        @if($agricultores_no_deben->isNotEmpty())
                        <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseAgricultores" aria-expanded="false" aria-controls="collapseAgricultores">
                            <i class="fas fa-chevron-down"></i> Agricultores Pagados
                        </button>
                        <div class="collapse mt-3" id="collapseAgricultores">
                            <span><b>Agricultores con saldo pendiente igual a cero:</b></span>
                            <ul>
                                @foreach ($agricultores_no_deben as $agricultor)
                                <li>
                                    <span>Hola {{ Auth::user()->name }}, {{ $agricultor->agricultor_nombre }} no tiene saldo pendiente.</span>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                        @endif
                    </div>
                    <footer>
                        <a href="/ver-todas-las-notificaciones">Historial de notificaciones</a>
                    </footer>
                </div>


            </div>


            <div class="notifications">
                <div class="notification-item" id="notificationIcon-l">
                    <i class="fas fa-envelope"></i>
                    <span class="notification-count" id="notificationCount-l">4</span> <!-- Número de notificaciones -->
                </div>

                <div class="notification-popup" id="notificationPopup-l">
                    <div class="card-header text-center">
                        <span><b>Mensajes</b></span>
                    </div>
                    <!-- Contenido de las notificaciones -->
                    <ul id="notificationList-l">
                        <li>Notificación 1 <button class="btn btn-sm btn-danger ml-2" onclick="borrarNotificacion(this)">Borrar</button></li>
                        <li>Notificación 2 <button class="btn btn-sm btn-danger ml-2" onclick="borrarNotificacion(this)">Borrar</button></li>
                        <li>Notificación 3 <button class="btn btn-sm btn-danger ml-2" onclick="borrarNotificacion(this)">Borrar</button></li>
                        <li>Notificación 3 <button class="btn btn-sm btn-danger ml-2" onclick="borrarNotificacion(this)">Borrar</button></li>
                    </ul>
                    <footer>
                        <a href="/ver-todas-las-notificaciones">Mensajes history</a>
                    </footer>
                </div>
            </div>

            <a href="/politicas-de-privacidad" title="Políticas de Privacidad">
                <i class="fas fa-exclamation-circle"></i>
            </a>

        </div>
        <div class="user-container ">
            <div class="user text-center" onclick="toggleUserContent()" id="togglepro">
                <img src="{{ asset(Auth::user()->profile_photo_path) }}" alt="Usuario">
            </div>

            <form id="logout-form" action="{{ route("logout") }}" method="POST" style="display: none;">
                @csrf
            </form>
            <div id="user-content" class="user-content" style="display: none;">
                <div class="user-div">
                    <img src="{{ asset(Auth::user()->profile_photo_path) }}" alt="Usuario">

                </div>
                <hr style="border: dashed 1px white;">

                <div class="div-data">
                    <div class="user-name">
                        <h6 style="font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif">{{ Auth::user()->name }}</h6>
                    </div>
                    <div class="role">
                        <p class="first-paragraph"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24" color="#ffffff" fill="none">
                                <path d="M12 22L10 16H2L4 22H12ZM12 22H16" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M12 13V12.5C12 10.6144 12 9.67157 11.4142 9.08579C10.8284 8.5 9.88562 8.5 8 8.5C6.11438 8.5 5.17157 8.5 4.58579 9.08579C4 9.67157 4 10.6144 4 12.5V13" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M19 13C19 14.1046 18.1046 15 17 15C15.8954 15 15 14.1046 15 13C15 11.8954 15.8954 11 17 11C18.1046 11 19 11.8954 19 13Z" stroke="currentColor" stroke-width="1.5" />
                                <path d="M10 4C10 5.10457 9.10457 6 8 6C6.89543 6 6 5.10457 6 4C6 2.89543 6.89543 2 8 2C9.10457 2 10 2.89543 10 4Z" stroke="currentColor" stroke-width="1.5" />
                                <path d="M14 17.5H20C21.1046 17.5 22 18.3954 22 19.5V20C22 21.1046 21.1046 22 20 22H19" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                            </svg> <strong>Rol Actual: </strong> {{ Auth::user()->getRoleNames()->first() }}</p>
                    </div>
                    <div class="user-email">
                        <p class="second-paragraph" onmouseover="showEmailLink()" onmouseleave="hideEmailLink()">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24" color="#ffffff" fill="none">
                                <path d="M2 5L8.91302 8.92462C11.4387 10.3585 12.5613 10.3585 15.087 8.92462L22 5" stroke="currentColor" stroke-width="1.5" stroke-linejoin="round" />
                                <path d="M10.5 19.5C10.0337 19.4939 9.56682 19.485 9.09883 19.4732C5.95033 19.3941 4.37608 19.3545 3.24496 18.2184C2.11383 17.0823 2.08114 15.5487 2.01577 12.4814C1.99475 11.4951 1.99474 10.5147 2.01576 9.52843C2.08114 6.46113 2.11382 4.92748 3.24495 3.79139C4.37608 2.6553 5.95033 2.61573 9.09882 2.53658C11.0393 2.4878 12.9607 2.48781 14.9012 2.53659C18.0497 2.61574 19.6239 2.65532 20.755 3.79141C21.8862 4.92749 21.9189 6.46114 21.9842 9.52844C21.9939 9.98251 21.9991 10.1965 21.9999 10.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M19 17C19 17.8284 18.3284 18.5 17.5 18.5C16.6716 18.5 16 17.8284 16 17C16 16.1716 16.6716 15.5 17.5 15.5C18.3284 15.5 19 16.1716 19 17ZM19 17V17.5C19 18.3284 19.6716 19 20.5 19C21.3284 19 22 18.3284 22 17.5V17C22 14.5147 19.9853 12.5 17.5 12.5C15.0147 12.5 13 14.5147 13 17C13 19.4853 15.0147 21.5 17.5 21.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                            <strong>Email:</strong>{{ Auth::user()->email }}<br>
                        </p>
                    </div>



                </div>
                <hr>
                <div class="div-logout ">
                    <a href="{{ route("logout") }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="32" height="32" color="#ffffff" fill="none">
                            <path d="M14 3.09502C13.543 3.03241 13.0755 3 12.6 3C7.29807 3 3 7.02944 3 12C3 16.9706 7.29807 21 12.6 21C13.0755 21 13.543 20.9676 14 20.905" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                            <path d="M21 12L11 12M21 12C21 11.2998 19.0057 9.99153 18.5 9.5M21 12C21 12.7002 19.0057 14.0085 18.5 14.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </header>




    <div class="contenido">


        <aside class="sidebar" id="sidebar">

            <ul>
                <li>
                    <a href="/guia-remision" class="sidebar-link div-icon">
                        <i class="bi bi-list-ul"></i>
                        <span class="icon-text"> Guía Remisión</span>
                    </a>
                </li>


                <li>
                    <a href="/pagos" class="sidebar-link div-icon"><i class="bi bi-cash sidebar-icon"></i><span class="icon-text"> Pagos</span></a>
                </li>

                <li>
                    <a href="/transportistas" class="sidebar-link div-icon"><i class="bi bi-truck sidebar-icon"></i><span class="icon-text"> Transportista</span></a>
                </li>
                <li>
                    <a href="/agricultores" class="sidebar-link div-icon"><i class="bi bi-person sidebar-icon"></i><span class="icon-text"> Agricultor</span></a>
                </li>
                <li>
                    <a href="/campos" class="sidebar-link div-icon"><i class="bi bi-tree sidebar-icon"></i><span class="icon-text"> Campo</span></a>
                </li>
                <li>
                    <a href="/info" class="sidebar-link div-icon">
                        <i class="bi bi-house-door sidebar-icon"></i><span class="icon-text"> Dashboard</span>
                    </a>
                </li>



                <li class="dropdown">
                    <a href="#" class="sidebar-link div-icon dropdown-toggle" id="navbarDropdown" role="button" aria-expanded="false" onclick="toggleDropdown()">
                        <i class="bi bi-chevron-down" id="dropdownIcon"></i><span class="icon-text"> Más opciones</span>
                    </a>
                    <ul class="dropdown-submenu " id="dropdownMenu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item sidebar-link div-icon" href="/conductores"><i class="bi bi-person"></i><span class="icon-text"> Conductores</span></a></li>
                        <li><a class="dropdown-item sidebar-link div-icon" href="/cargas"><i class="bi bi-box"></i><span class="icon-text"> Cargas</span></a></li>
                        <li><a class="dropdown-item sidebar-link div-icon" href="/vehiculos"><i class="bi bi-truck"></i><span class="icon-text"> Vehiculos</span></a></li>
                        @role('Administrador')
                        <li><a class="dropdown-item sidebar-link div-icon" href="/usuarios"><i class="bi bi-people"></i><span class="icon-text"> Usuarios</span></a></li>
                        @endrole
                        @role('Administrador')
                        <li>
                            <a class="dropdown-item sidebar-link div-icon" href="/auditorias">
                                <i class="bi bi-journal-text"></i>
                                <span class="icon-text"> Auditorías</span>
                            </a>
                        </li>
                        @endrole
                        <li>
                            <a class="dropdown-item sidebar-link div-icon" href="/facturas">
                                <i class="bi bi-file-earmark-text"></i>
                                <span class="icon-text"> Facturas</span>
                            </a>
                        </li>

                        
                    </ul>

                </li>

                <li>
                    <a href="/ajustes" class="sidebar-link div-icon">
                        <i class="bi bi-gear sidebar-icon"></i><span class="icon-text"> Ajustes</span>
                    </a>
                </li>

            </ul>



        </aside>

        <main class="content">

            <div class="spinner-container" id="loader">
                <i class="fas fa-spinner fa-spin fa-3x"></i>
            </div>

            <div id="errorMessage" class="error-container" style="display: none;">
                <div>Ha ocurrido un problema durante la carga de la página.</div>
                <div>Por favor, inténtalo de nuevo más tarde o haz clic en continuar.</div>
                <button id="continueButton">Continuar</button>
            </div>
            <img src="{{ asset(Auth::user()->profile_photo_path) }}" alt="Usuario" id="exampleImage" style="display: none;">

            <script src="{{ asset('js/spinner.js') }}"></script>





            @yield('content')
            <footer class="footer">
                <div class="container">
                    <div class="row">
                        <!-- About Us Section -->
                        <div class="col-md-4">
                            <h5>About Us</h5>
                            <p class="dedication">We are a company dedicated to providing the best products and services to our customers. Your satisfaction is our priority.</p>
                        </div>
                        <!-- Quick Links Section -->
                        <div class="col-md-4">
                            <h5>Quick Links</h5>
                            <ul class="list-unstyled">
                                <li><a href="#">Home</a></li>
                                <li><a href="#">About</a></li>
                                <li><a href="#">Services</a></li>
                                <li><a href="#">Contact</a></li>
                            </ul>
                        </div>
                        <!-- Contact Us Section -->
                        <div class="col-md-4">
                            <h5>Contact Us</h5>
                            <address>
                                123 Main Street, Anytown, USA<br>
                                Email: info@company.com<br>
                                Phone: (123) 456-7890
                            </address>
                            <div class="social-icons">
                                <a href="#"><i class="fab fa-facebook-f"></i></a>
                                <a href="#"><i class="fab fa-twitter"></i></a>
                                <a href="#"><i class="fab fa-instagram"></i></a>
                                <a href="#"><i class="fab fa-linkedin-in"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col text-center ">
                            <p class="mb-0 rights-r">&copy; 2024 Your Company. All rights reserved.</p>
                        </div>
                    </div>
                </div>
            </footer>


        </main>

        <div class="css">
            @yield('css')
        </div>
        <div class="js">
            @yield('js')
        </div>


    </div>

    <script src="js/templante.js"></script>



</body>

</html>