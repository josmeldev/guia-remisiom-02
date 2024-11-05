@extends('layouts.template')




@section('content')

    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    @if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
    @endif

    @if(session('warning'))
    <div class="alert alert-warning">
        {{ session('warning') }}
    </div>
    @endif


    <div>
        <form action="{{ route('choferes.buscar') }}" method="GET">
            <div class="row">
                <div class="col-md-3 mb-3">
                    <label for="dni">DNI:</label>
                    <input type="text" class="form-control" id="dni" name="dni" placeholder="Buscar por DNI">
                </div>
                <div class="col-md-3 mb-3">
                    <label for="nombre_apellidos">Nombres y Apellidos:</label>
                    <input type="text" class="form-control" id="nombre_apellidos" name="nombre_apellidos" placeholder="Buscar por nombres y apellidos">
                </div>
                <div class="col-md-3 mb-3">
                    <label for="telefono">Teléfono:</label>
                    <input type="text" class="form-control" id="telefono" name="telefono" placeholder="Buscar por teléfono">
                </div>
                <div class="col-md-3 mb-3">
                    <label for="brevete">Brevete:</label>
                    <input type="text" class="form-control" id="brevete" name="brevete" placeholder="Buscar por brevete">
                </div>
            </div>
            <div class="text-center">
                <button class="btn btn-outline-primary" type="submit">
                    <i class="fas fa-filter"></i> Filtrar
                </button>
                <a href="/conductores" class="btn btn-outline-secondary mr-2">
                    <i class="fas fa-undo"></i> Restablecer
                </a>
            </div>
        </form>

    </div>
    <div class="card">
        <div class="card-header">
            <div class="col-md-6">
                <h3 class="card-title">Lista de Conductores</h3>
            </div>

            <div class=" text-right">

                <!-- Botón para abrir la modal -->
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#crearConductorModal" title="Registrar Conductor">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-user-plus" width="20" height="20" viewBox="0 0 24 24" stroke-width="2" stroke="#ffffff" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                        <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" />
                        <path d="M16 19h6" />
                        <path d="M19 16v6" />
                        <path d="M6 21v-2a4 4 0 0 1 4 -4h4" />
                      </svg>
                </button>

                <!-- Modal para registrar conductor -->
                <div class="modal fade" id="crearConductorModal" tabindex="-1" aria-labelledby="crearConductorModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-ms">
                        <div class="modal-content">
                            <div class="modal-header bg-blue ">
                                <h5 class="modal-title " id="crearConductorModalLabel"><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-user-plus" width="32" height="32" viewBox="0 0 24 24" stroke-width="1.5" stroke="#ffffff" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                    <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" />
                                    <path d="M16 19h6" />
                                    <path d="M19 16v6" />
                                    <path d="M6 21v-2a4 4 0 0 1 4 -4h4" />
                                  </svg>
                                    Registrar Conductor
                                </h5>

                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body pl-4 pr-4">
                                <!-- Formulario de registro de conductor -->
                                <form id="crearConductorForm" action="{{ route('conductor.store') }}" method="POST">
                                    @csrf
                                    <!-- Campos para el registro -->
                                    <div class="mb-3 text-left">
                                        <label for="dni" class="form-label">DNI:</label>
                                        <input type="text" class="form-control" id="dni" name="dni" required maxlength="8" minlength="8" oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 11);">
                                    </div>
                                    <div class="mb-3 text-left">
                                        <label for="nombre_apellidos" class="form-label">Nombre y Apellidos:</label>
                                        <input type="text" class="form-control" id="nombre_apellidos" name="nombre_apellidos" required maxlength="100">
                                    </div>
                                    <div class="mb-3 text-left">
                                        <label for="telefono" class="form-label">Teléfono:</label>
                                        <input type="text" class="form-control" id="telefono" name="telefono" required minlength="9" maxlength="9" oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 11);">
                                    </div>
                                    <div class="mb-3 text-left">
                                        <label for="brevete" class="form-label">Número de Brevete:</label>
                                        <input type="text" class="form-control" id="brevete" name="brevete" required minlength="8" maxlength="10">
                                    </div>
                                    <div class="col text-center">
                                        <button type="submit" class="btn btn-primary">
                                            <i><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="28" height="28" color="#ffffff" fill="none">
                                                <path d="M12 22C7.75736 22 5.63604 22 4.31802 20.5355C3 19.0711 3 16.714 3 12C3 7.28596 3 4.92893 4.31802 3.46447C5.63604 2 7.75736 2 12 2C16.2426 2 18.364 2 19.682 3.46447C21 4.92893 21 7.28595 21 12C21 16.714 21 19.0711 19.682 20.5355C18.364 22 16.2426 22 12 22Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                                <path d="M8 2.5V9.82621C8 11.0733 8 11.6969 8.38642 11.9201C9.13473 12.3523 10.5384 10.9103 11.205 10.4761C11.5916 10.2243 11.7849 10.0984 12 10.0984C12.2151 10.0984 12.4084 10.2243 12.795 10.4761C13.4616 10.9103 14.8653 12.3523 15.6136 11.9201C16 11.6969 16 11.0733 16 9.82621V2.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                                </svg>
                                            </i>
                                            Guardar
                                        </button>
                                        <button | type="reset" class="btn btn-secondary" title="Limpiar Campos"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="28" height="28" color="#ffffff" fill="none">
                                            <path d="M4.47461 6.10018L5.31543 18.1768C5.40886 19.3365 6.28178 21.5536 8.51889 21.8022C10.756 22.0507 15.2503 21.9951 16.0699 21.9951C16.8895 21.9951 19.0128 21.4136 19.0128 19.0059C19.0128 16.5756 16.9833 15.9419 15.7077 15.9635H12.0554M12.0554 15.9635C12.0607 15.7494 12.1515 15.5372 12.3278 15.3828L14.487 13.4924M12.0554 15.9635C12.0497 16.1919 12.1412 16.4224 12.33 16.5864L14.487 18.4609M19.4701 5.82422L19.0023 13.4792" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                            <path d="M3 5.49561H21M16.0555 5.49561L15.3729 4.08911C14.9194 3.15481 14.6926 2.68766 14.3015 2.39631C14.2148 2.33168 14.1229 2.2742 14.0268 2.22442C13.5937 2 13.0739 2 12.0343 2C10.9686 2 10.4358 2 9.99549 2.23383C9.89791 2.28565 9.80479 2.34547 9.7171 2.41265C9.32145 2.7158 9.10044 3.20004 8.65842 4.16854L8.05273 5.49561" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg></button>

                                    </div>
                                    <!-- Agrega más campos si es necesario -->

                                </form>
                            </div>

                        </div>
                    </div>
                </div>


            </div>
        </div>

        <div class="card-body p-2">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>DNI</th>
                        <th>Nombres y Apellidos</th>
                        <th>Telefono</th>
                        <th>Brevete</th>
                        <th>Acciones</th>

                    </tr>

                </thead>
                <tbody>
                    @foreach ($choferes as $chofer)
                        <tr>
                            <td>{{ $chofer->id }}</td>
                            <td>{{ $chofer->dni }}</td>
                            <td>{{ $chofer->nombre_apellidos }}</td>
                            <td>{{ $chofer->telefono }}</td>
                            <td>{{ $chofer->brevete }}</td>


                            <td>
                                <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#editModal{{ $chofer->id }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-edit" width="20" height="20" viewBox="0 0 24 24" stroke-width="2" stroke="#ffffff" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                        <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" />
                                        <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" />
                                        <path d="M16 5l3 3" />
                                      </svg>
                                </button>
                                <div class="modal fade" id="editModal{{ $chofer->id }}" tabindex="-1" aria-labelledby="editModalLabel{{ $chofer->id }}" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header bg-primary">
                                                <h5 class="modal-title" id="editModalLabel{{ $chofer->id }}">
                                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="28" height="28" color="#ffffff" fill="none">
                                                        <path d="M16.2141 4.98239L17.6158 3.58063C18.39 2.80646 19.6452 2.80646 20.4194 3.58063C21.1935 4.3548 21.1935 5.60998 20.4194 6.38415L19.0176 7.78591M16.2141 4.98239L10.9802 10.2163C9.93493 11.2616 9.41226 11.7842 9.05637 12.4211C8.70047 13.058 8.3424 14.5619 8 16C9.43809 15.6576 10.942 15.2995 11.5789 14.9436C12.2158 14.5877 12.7384 14.0651 13.7837 13.0198L19.0176 7.78591M16.2141 4.98239L19.0176 7.78591" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                                        <path d="M21 12C21 16.2426 21 18.364 19.682 19.682C18.364 21 16.2426 21 12 21C7.75736 21 5.63604 21 4.31802 19.682C3 18.364 3 16.2426 3 12C3 7.75736 3 5.63604 4.31802 4.31802C5.63604 3 7.75736 3 12 3" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                                                    </svg>
                                                    Editar Conductor
                                                </h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <!-- Formulario para editar la guía de remisión -->
                                                <form id="editForm{{ $chofer->id }}" action="{{ route('conductor.update', $chofer->id) }}" method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <!-- Campos para editar -->
                                                    <div class="form-group row">
                                                        <div class="col-md-6">
                                                            <label for="dni">DNI:</label>
                                                            <input type="text" class="form-control" id="dni" name="dni" value="{{ $chofer->dni }}" required>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label for="nombre_apellidos">Nombres y Apellidos:</label>
                                                            <input type="text" class="form-control" id="nombre_apellidos" name="nombre_apellidos" value="{{ $chofer->nombre_apellidos }}" required>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <div class="col-md-6">
                                                            <label for="telefono">Teléfono:</label>
                                                            <input type="text" class="form-control" id="telefono" name="telefono" value="{{ $chofer->telefono }}" required>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label for="brevete">Brevete:</label>
                                                            <input type="text" class="form-control" id="brevete" name="brevete" value="{{ $chofer->brevete }}">
                                                        </div>
                                                    </div>

                                                    <!-- Agrega aquí más campos para editar si es necesario -->
                                                    <button type="submit" class="btn btn-primary shadow">
                                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="28" height="28" color="#ffffff" fill="none">
                                                            <path d="M12 22C7.75736 22 5.63604 22 4.31802 20.5355C3 19.0711 3 16.714 3 12C3 7.28596 3 4.92893 4.31802 3.46447C5.63604 2 7.75736 2 12 2C16.2426 2 18.364 2 19.682 3.46447C21 4.92893 21 7.28595 21 12C21 16.714 21 19.0711 19.682 20.5355C18.364 22 16.2426 22 12 22Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                                            <path d="M8 2.5V9.82621C8 11.0733 8 11.6969 8.38642 11.9201C9.13473 12.3523 10.5384 10.9103 11.205 10.4761C11.5916 10.2243 11.7849 10.0984 12 10.0984C12.2151 10.0984 12.4084 10.2243 12.795 10.4761C13.4616 10.9103 14.8653 12.3523 15.6136 11.9201C16 11.6969 16 11.0733 16 9.82621V2.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                                        </svg>
                                                        Guardar Cambios
                                                    </button>
                                                </form>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <form action="{{ route('conductor.destroy', $chofer->id) }}" method="POST" style="display: inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-trash-x-filled" width="20" height="20" viewBox="0 0 24 24" stroke-width="2" stroke="#ffffff" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                            <path d="M20 6a1 1 0 0 1 .117 1.993l-.117 .007h-.081l-.919 11a3 3 0 0 1 -2.824 2.995l-.176 .005h-8c-1.598 0 -2.904 -1.249 -2.992 -2.75l-.005 -.167l-.923 -11.083h-.08a1 1 0 0 1 -.117 -1.993l.117 -.007h16zm-9.489 5.14a1 1 0 0 0 -1.218 1.567l1.292 1.293l-1.292 1.293l-.083 .094a1 1 0 0 0 1.497 1.32l1.293 -1.292l1.293 1.292l.094 .083a1 1 0 0 0 1.32 -1.497l-1.292 -1.293l1.292 -1.293l.083 -.094a1 1 0 0 0 -1.497 -1.32l-1.293 1.292l-1.293 -1.292l-.094 -.083z" stroke-width="0" fill="currentColor" />
                                            <path d="M14 2a2 2 0 0 1 2 2a1 1 0 0 1 -1.993 .117l-.007 -.117h-4l-.007 .117a1 1 0 0 1 -1.993 -.117a2 2 0 0 1 1.85 -1.995l.15 -.005h4z" stroke-width="0" fill="currentColor" />
                                          </svg>
                                    </button>
                                </form>
                            </td>
                        </tr>

                    @endforeach

                </tbody>

            </table>

        </div>

    </div>

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <i class="fas fa-car"></i> Asignación de Vehículos
                    </div>
                    <div class="card-body">
                        <form action="{{ route('asignar-vehiculo') }}" method="POST" class="form-inline" id="formAsignarVehiculos">
                            @csrf

                            <div class="row col-md-12 ">
                                <div class="col-md-6 align-content-center">
                                    <label for="chofer_id" class="sr-only">Selecciona un chofer:</label>
                                    <select name="chofer_id" id="chofer_id" class="form-control" style="width: 100%;">
                                        @foreach ($choferes as $chofer)
                                            <option value="{{ $chofer->id }}">{{ $chofer->nombre_apellidos }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="vehiculos" class="sr-only">Selecciona vehículos:</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-search"></i></span>
                                        </div>
                                        <input type="text" id="search" class="form-control " placeholder="Buscar placa...">
                                    </div>
                                    <select name="vehiculos[]" id="vehiculos" class="form-control" multiple style="width: 100%;">
                                        @foreach ($vehiculos as $vehiculo)
                                            <option value="{{ $vehiculo->id }}" class="bg-{{ $vehiculo->color }}">{{ $vehiculo->id }}. {{ $vehiculo->placa }} - {{ $vehiculo->placa1 }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <script>
                                    $(document).ready(function(){
                                        $('#search').on('keyup', function(){
                                            var searchText = $(this).val().toLowerCase();
                                            $('#vehiculos option').each(function(){
                                                var optionText = $(this).text().toLowerCase();
                                                if(optionText.indexOf(searchText) !== -1){
                                                    $(this).show();
                                                } else {
                                                    $(this).hide();
                                                }
                                            });
                                        });
                                    });
                                </script>


                            </div>

                            <div class="col text-center">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-check"></i> Asignar Vehículos
                                </button>
                            </div>


                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<!-- Agrega esto en tu archivo HTML, preferiblemente en la sección head -->

<div class="card">
    <div class="card-header bg-blue">
        Vehiculos y Agricultores
    </div>
    <div class="card-body" style="max-height: 300px; overflow-y: auto; scrollbar-width: thin">
        <div class="mb-3">
            <label for="buscarChofer" class="form-label">Buscar :</label>
            <input type="text" class="form-control" id="buscarChofer" placeholder="Buscar...">
        </div>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Chofer</th>
                    <th>Vehículos</th>
                </tr>
            </thead>
            <tbody>
                @foreach($choferes as $chofer)
                    <tr>
                        <td class="choferNombre">{{ $chofer->nombre_apellidos }}</td>
                        <td class="choferVehiculos">
                            <ol class="lista-vehiculos">
                                @foreach($chofer->vehiculos as $vehiculo)
                                    <li>{{ $vehiculo->placa }}</li>
                                @endforeach
                            </ol>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <script>
          document.getElementById("buscarChofer").addEventListener("input", function() {
    var filtro = this.value.toUpperCase(); // Obtener el valor del campo de búsqueda en mayúsculas
    var filas = document.querySelectorAll("tbody tr"); // Obtener todas las filas de la tabla

    filas.forEach(function(fila) {
        var chofer = fila.querySelector(".choferNombre").textContent.toUpperCase(); // Obtener el nombre del chofer en mayúsculas
        if (chofer.includes(filtro)) { // Verificar si el nombre del chofer contiene el texto de búsqueda
            fila.style.display = ""; // Mostrar la fila si coincide con el filtro
        } else {
            fila.style.display = "none"; // Ocultar la fila si no coincide con el filtro
        }
    });
});




        </script>


        <style>
            .lista-vehiculos {

            padding-left: 10px; /* Elimina el espacio dentro de la lista */
        }
        .choferNombre {

            align-content: center;
        }
        .choferVehiculos {

            max-height: 10px;
            overflow-y: auto;
        }


        .lista-vehiculos li {
            margin-bottom: 0px; /* Espacio entre cada elemento de la lista */
            background-color: #e1eff5; /* Color de fondo para los elementos de la lista */
            padding: 3px; /* Espaciado dentro de cada elemento de la lista */
            border-radius: 5px; /* Bordes redondeados */
        }

        .lista-vehiculos li:nth-child(odd) {
            background-color: #16c2d1; /* Color de fondo alternativo para elementos impares */

        }

        </style>

    </div>
    <div class="card-footer"></div>


</div>













@endsection

@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>

@endsection

@section('css')
<link rel="stylesheet" href="{{ asset('css/styleTables.css') }}">
@endsection
