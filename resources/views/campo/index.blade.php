@extends('layouts.template')
<!-- Aquí puedes agregar tu formulario, tabla u otro contenido -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">



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



    <div class="container">




        <div class="row">
            @foreach($camposLista as $campo)
            <div class="col-md-4 mb-4">
                <div class="campo card" id="campo_{{ $campo->id_campo }}">
                    <div class="card-header bg-primary text-white">
                        <div class="row">
                            <div class="col-9 text-start">
                                <div class="row align-items-center">
                                    <div class="col-auto">
                                        <img src="images/ecologismo.png" alt="Campo" style="width: 30px;height: 30px">
                                    </div>
                                    <div class="col">
                                        <h4>{{ $campo->acopiadora }}</h4>
                                    </div>
                                </div>
                            </div>
                            <div class="col-3  align-content-center algin-items-center text-right" >
                                <div class="badge badge-pill badge-warning " >{{ count(explode(',', $campo->agricultors)) }}</div>
                            </div>
                        </div>


                    </div>
                    <div class="card-body">
                        <p><strong>Ubigeo:</strong> {{ $campo->ubigeo }}</p>
                        <p><strong>Zona:</strong> {{ $campo->zona }}</p>
                        <p><strong>Ingenio:</strong> {{ $campo->ingenio }}</p>
                        <button class="btn btn-link btn-sm toggle-agricultores" type="button">
                            <i class="fas fa-caret-down mr-1"></i> Ver Agricultores
                        </button>
                        <ul class="agricultores hidden list-group mt-3"  style="height: 150px; overflow-y: auto;scrollbar-width: thin;color: blue;border: 2px solid rgb(214, 214, 228)">
                            @foreach(explode(',', $campo->agricultors) as $key => $agricultor)
                            <li class="list-group-item " style="background-color: #d0ddeb;">{{ $key + 1 }}. {{ $agricultor }}</li>
                            @endforeach
                        </ul>


                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <script>
            document.querySelectorAll('.toggle-agricultores').forEach(function(btn) {
                btn.addEventListener('click', function() {
                    var agricultores = btn.parentElement.querySelector('.agricultores');
                    agricultores.classList.toggle('hidden');
                    if (agricultores.classList.contains('hidden')) {
                        btn.innerHTML = '<i class="fas fa-caret-down mr-1"></i> Ver Agricultores';
                    } else {
                        btn.innerHTML = '<i class="fas fa-caret-up mr-1"></i> Ocultar Agricultores';
                    }
                });
            });
        </script>

        <style>
            .hidden {
                display: none;
            }
            .badge {
                font-size: 14px;
                border-radius: 50%;
            }
        </style>





            <div class="col-md-12 mb-2">
                <form action="{{ route('campo.buscar') }}" method="GET" style="width: 100%;">
                    <div class="container p-4" style="box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); min-width: 95%;">
                        <h6 class="block">Filtrar por:</h6>
                        <div class="row mb-2">
                            <div class="col-md-3">
                                <input type="text" class="form-control" name="acopiadora" placeholder="Acopiadora">
                            </div>
                            <div class="col-md-3">
                                <input type="text" class="form-control" name="ubigeo" placeholder="Ubigeo">
                            </div>
                            <div class="col-md-3">
                                <input type="text" class="form-control" name="zona" placeholder="Zona">
                            </div>
                            <div class="col-md-3">
                                <input type="text" class="form-control" name="ingenio" placeholder="Ingenio">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <a href="/campos" class="btn btn-secondary mr-2">
                                    <i class="fas fa-undo"></i> Restablecer
                                </a>
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-filter"></i> Filtrar
                                </button>
                            </div>
                        </div>
                    </div>
                </form>

            </div>

            <div class="card">


                <div class="card-header row">
                    <div class="col align-content-center text-blue">
                        <h3 class="card-title">Lista de Campos</h3>
                    </div>

                    <div class="col text-right">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalPequena" title="Registrar Campo">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="20" height="20" color="#ffffff" fill="none">
                                <path d="M12 8V16M16 12L8 12" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M2.5 12C2.5 7.52166 2.5 5.28249 3.89124 3.89124C5.28249 2.5 7.52166 2.5 12 2.5C16.4783 2.5 18.7175 2.5 20.1088 3.89124C21.5 5.28249 21.5 7.52166 21.5 12C21.5 16.4783 21.5 18.7175 20.1088 20.1088C18.7175 21.5 16.4783 21.5 12 21.5C7.52166 21.5 5.28249 21.5 3.89124 20.1088C2.5 18.7175 2.5 16.4783 2.5 12Z" stroke="currentColor" stroke-width="1.5" />
                            </svg>
                        </button>
                        <div class="modal fade text-left" id="modalPequena">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">

                                    <!-- Encabezado de la modal -->
                                    <div class="modal-header text-center align-items-center bg-green">
                                        <i class="fas fa-tree mr-2"></i> <!-- Utilizo la clase "mr-2" para agregar un poco de espacio a la derecha del ícono -->
                                        <h5 class="modal-title">Registro de Campo</h5>
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>


                                    <!-- Contenido de la modal -->
                                    <div class="modal-body">
                                        <form action="{{ route('campo.store') }}" method="POST" id="formularioRegistroCampo">
                                            @csrf
                                            <div class="row">
                                                <div class=" col-md-6 mb-3">
                                                    <label for="acopiadora" class="form-label">Acopiadora:</label>
                                                    <input type="text" class="form-control" id="acopiadora" name="acopiadora" required maxlength="50">
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label for="ubigeo" class="form-label">Ubigeo:</label>
                                                    <input type="text" class="form-control" id="ubigeo" name="ubigeo" required maxlength="50">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6 mb-3">
                                                    <label for="zona" class="form-label">Zona:</label>
                                                    <input type="text" class="form-control" id="zona" name="zona" required maxlength="50">
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label for="ingenio" class="form-label">Ingenio:</label>
                                                    <input type="text" class="form-control" id="ingenio" name="ingenio" required maxlength="50">
                                                </div>
                                            </div>
                                            <div class="col-md-12 d-flex justify-content-center align-items-center">
                                                <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Registrar Campo</button>
                                            </div>


                                        </form>

                                    </div>

                                    <!-- Pie de la modal -->
                                    <div class="modal-footer bg-white border">

                                    <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="limpiarFormulario()">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-back" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="#ffffff" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                            <path d="M9 11l-4 4l4 4m-4 -4h11a4 4 0 0 0 0 -8h-1" />
                                        </svg>
                                        </button>
                                    </div>
                                    <script>
                                        function limpiarFormulario() {
                                            // Obtenemos el formulario por su ID
                                            var formulario = document.getElementById('formularioRegistroCampo');

                                            // Resetear el formulario
                                            formulario.reset();
                                        }
                                    </script>

                                </div>
                            </div>
                        </div>


                    </div>
                </div>



                <div class="card-body p-2 rounded border" style="Height: 400px;overflow-y:auto; scrollbar-width: thin">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Acopiadora</th>
                                <th>Ubigeo</th>
                                <th>Zona</th>
                                <th>Ingenio</th>
                                <th>Acciones</th>
                            </tr>

                        </thead>
                        <tbody>
                            @foreach ($campos as $campo)
                                <tr>
                                    <td>{{ $campo->id }}</td>
                                    <td>{{ $campo->acopiadora }}</td>
                                    <td>{{ $campo->ubigeo }}</td>
                                    <td>{{ $campo->zona }}</td>
                                    <td>{{ $campo->ingenio }}</td>

                                    <td>
                                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#editModal{{ $campo->id }}">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-edit" width="20" height="20" viewBox="0 0 24 24" stroke-width="2" stroke="#ffffff" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                                <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" />
                                                <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" />
                                                <path d="M16 5l3 3" />
                                            </svg>
                                        </button>
                                        <div class="modal fade" id="editModal{{ $campo->id }}" tabindex="-1" aria-labelledby="editModalLabel{{ $campo->id }}" aria-hidden="true">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header bg-primary">
                                                        <h5 class="modal-title" id="editModalLabel{{ $campo->id }}">Editar Campos</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <!-- Formulario para editar la guía de remisión -->
                                                        <form id="editForm{{ $campo->id }}" action="{{ route('campo.update', $campo->id) }}" method="POST">
                                                            @csrf
                                                            @method('PUT')
                                                            <!-- Campos para editar -->
                                                            <div class="form-group row">
                                                                <div class="col-md-6 ">
                                                                    <label for="acopiadora">Acopiadora:</label>
                                                                    <input type="text" class="form-control" id="acopiadora" name="acopiadora" value="{{ $campo->acopiadora }}" required>

                                                                </div>
                                                                <div class="col-md-6">
                                                                    <label for="ubigeo">Ubigeo: </label>
                                                                    <input type="text" class="form-control" id="ubigeo" name="ubigeo" value="{{ $campo->ubigeo }}" required>

                                                                </div>

                                                            </div>
                                                            <div class="form-group row">
                                                                <div class="col-md-6 ">
                                                                    <label for="zona">Zona:</label>
                                                                    <input type="text" class="form-control" id="zona" name="zona" value="{{ $campo->zona }}" required>

                                                                </div>
                                                                <div class="col-md-6">
                                                                    <label for="ingenio">Ingenio: </label>
                                                                    <input type="text" class="form-control" id="ingenio" name="ingenio" value="{{ $campo->ingenio }}" required>

                                                                </div>

                                                            </div>



                                                            <!-- Agrega aquí más campos para editar -->
                                                            <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <form action="{{ route('campo.destroy', $campo->id) }}" method="POST" style="display: inline-block;">
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

            <!-- Inicio de Tabla para Agricultor con su campo -->


            <div class="card mt-3">
                <div class="card-header text-green">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="32" height="32" color="#63b00e" fill="none">
                        <path d="M2 3C3.86377 3 4.79565 3 5.53073 3.30448C6.51085 3.71046 7.28954 4.48915 7.69552 5.46927C8 6.20435 8 7.13623 8 9C6.13623 9 5.20435 9 4.46927 8.69552C3.48915 8.28954 2.71046 7.51085 2.30448 6.53073C2 5.79565 2 4.86377 2 3Z" stroke="currentColor" stroke-width="1.5" stroke-linejoin="round" />
                        <path d="M12 5C10.7575 5 10.1362 5 9.64618 5.20299C8.99277 5.47364 8.47364 5.99277 8.20299 6.64618C8 7.13623 8 7.75749 8 9C9.24251 9 9.86377 9 10.3538 8.79701C11.0072 8.52636 11.5264 8.00723 11.797 7.35382C12 6.86377 12 6.24251 12 5Z" stroke="currentColor" stroke-width="1.5" stroke-linejoin="round" />
                        <path d="M8 9V14" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                        <path d="M12 14L2 14" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                        <path d="M12 17L2 17" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                        <path d="M12 20L2 20" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                        <path d="M16 18.5034C16 17.2482 17.0532 16.0077 17.7924 15.2917C18.1939 14.9028 18.8061 14.9028 19.2076 15.2917C19.9468 16.0077 21 17.2482 21 18.5034C21 19.7341 20.0533 21 18.5 21C16.9467 21 16 19.7341 16 18.5034Z" stroke="currentColor" stroke-width="1.5" />
                    </svg>
                    <strong> Lista de Agricultores y su Campo</strong>


                </div>

                <div class="card-body" style="height:300px;overflow:auto;scrollbar-width:thin">

                    <!-- Campo de búsqueda -->
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" id="searchInput" placeholder="Buscar...">
                        <div class="input-group-append">
                            <span class="input-group-text">
                                <i class="fas fa-search"></i>
                            </span>
                        </div>
                    </div>

                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>RUC Agricultor</th>
                                <th>Razón Social Agricultor</th>
                                <th>Acopiadora</th>
                                <th>Ubigeo</th>
                                <th>Zona</th>
                                <th>Ingenio</th>
                            </tr>
                        </thead>
                        <tbody id="tableBody">
                            @php $contador = 1 @endphp <!-- Inicializa la variable de contador -->
                            @foreach($camposAgricultor as $campo)
                            <tr>
                                <td>{{ $contador++ }}</td> <!-- Incrementa el contador en cada fila -->
                                <td>{{ $campo->ruc_agricultor }}</td>
                                <td style="max-width: 200px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">{{ $campo->razon_social_agricultor }}</td>
                                <td>{{ $campo->acopiadora }}</td>
                                <td>{{ $campo->ubigeo }}</td>
                                <td>{{ $campo->zona }}</td>
                                <td>{{ $campo->ingenio }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <script>
                        // Función para filtrar la tabla
                        function filterTable() {
                            // Obtener el valor del campo de búsqueda
                            var input, filter, table, tr, td, i, txtValue;
                            input = document.getElementById("searchInput");
                            filter = input.value.toUpperCase();
                            table = document.getElementById("tableBody");
                            tr = table.getElementsByTagName("tr");

                            // Iterar sobre todas las filas
                            for (i = 0; i < tr.length; i++) {
                                var found = false; // Variable para rastrear si se encontró el término de búsqueda en alguna columna

                                // Iterar sobre todas las celdas de la fila actual
                                for (var j = 0; j < tr[i].cells.length; j++) {
                                    td = tr[i].cells[j];
                                    if (td) {
                                        txtValue = td.textContent || td.innerText;
                                        // Si se encuentra el término de búsqueda en alguna celda, mostrar la fila y marcar como encontrada
                                        if (txtValue.toUpperCase().indexOf(filter) > -1) {
                                            tr[i].style.display = "";
                                            found = true;
                                            break; // Terminar la iteración si se encuentra el término de búsqueda en alguna celda
                                        }
                                    }
                                }

                                // Si no se encuentra el término de búsqueda en ninguna celda, ocultar la fila
                                if (!found) {
                                    tr[i].style.display = "none";
                                }
                            }
                        }

                        // Agregar un listener al campo de búsqueda para que filtre la tabla en cada cambio
                        document.getElementById("searchInput").addEventListener("input", filterTable);
                    </script>
                </div>


            </div>

            <!-- Fin del formulario de Agricultor -->







    </div>























@endsection

@section('css')
<link rel="stylesheet" href="{{ asset('css/styleTables.css') }}">

@endsection

@section('js')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

@endsection
