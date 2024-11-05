@extends('layouts.sidebar')

@extends('layouts.header')
<!-- Aquí puedes agregar tu formulario, tabla u otro contenido -->



@section('content')
    <div class="container">
        <h4 style="color: #0003A3 ;font-weight: bold:font-family: 'Poppins', sans-serif">Filtrar Datos Avanzados</h4>
        <form action="{{ route('filtro.avanzado') }}" method="GET" id="filtro-form">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="ruc">RUC de la Guía:</label>
                        <input type="text" name="ruc" id="ruc" class="form-control" placeholder="Ingrese RUC"
                            list="rucList" oninput="mostrarRazonSocial()">
                        <datalist id="rucList">
                            @foreach ($datos as $dato)
                                <option value="{{ $dato->ruc }}">{{ $dato->razon_social }}</option>
                            @endforeach
                        </datalist>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="razon_social">Razón Social:</label>
                        <input type="text" name="razon_social" id="razon_social" class="form-control"
                            placeholder="Escribe la Razón Social" list="razonSocialList">
                        <datalist id="razonSocialList">
                            @foreach ($datos as $dato)
                                <option value="{{ $dato->razon_social }}">{{ $dato->razon_social }}</option>
                            @endforeach
                        </datalist>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="direccion">Dirección:</label>
                        <input type="text" name="direccion" class="form-control" placeholder="Ingrese Dirección">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="nro_guia">Número de Guía:</label>
                        <input type="text" name="nro_guia" class="form-control" placeholder="Ingrese Número de Guía">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="nro_viaje">Número de Viaje:</label>
                        <input type="text" name="nro_viaje" class="form-control" placeholder="Ingrese Número de Viaje">
                    </div>
                </div>
                <div class="col-md-4 mt-4">
                    <div class="form-group pt-2">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-filter"></i> Filtrar
                        </button>

                        <button type="reset" class="btn btn-secondary" id="limpiar-btn">
                            <i class="fas fa-broom"></i> Limpiar
                        </button>

                    </div>

                </div>
                <!-- Agrega más campos de filtro según sea necesario -->
            </div>

        </form>
        <hr style=" border: 0.5px solid blue; box-shadow: 0px 0px 1px rgba(103, 202, 226, 0.5); border-radius: 5px;">


    </div>








    <!-- Modal con checkboxes para mostrar/ocultar columnas -->
    <div class="modal fade" id="columnModal" tabindex="-1" role="dialog" aria-labelledby="columnModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document" style="width: 25%;">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h5 class="modal-title" id="columnModalLabel">Mostrar/Ocultar Columnas</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="columnForm">
                        <div class="form-check">
                            <input class="form-check-input select-all-checkbox" type="checkbox" id="select-all-checkbox"
                                style="cursor: pointer; transform: scale(1.3);margin-right: 0.5rem;">
                            <label class="form-check-label" for="select-all-checkbox"><b style="color:#4b4ef7">Seleccionar
                                    Todos</b></label>
                        </div>
                        @foreach ($columnIds as $columnId)
                            <div class="form-check">
                                <input style="cursor: pointer; font-family: 'Poppins', sans-serif"
                                    class="form-check-input column-checkbox" type="checkbox" value="{{ $columnId }}"
                                    id="{{ $columnId }}" @if (in_array($columnId, $defaultColumns)) checked @endif>
                                <label class="form-check-label"
                                    for="{{ $columnId }}">{{ ucfirst(str_replace('_', ' ', $columnId)) }}</label>
                                <hr class="my-1" style="border-top: 1px solid rgba(0, 0, 0, 0.1);">
                            </div>
                        @endforeach
                    </form>


                </div>

                <div class="modal-footer bg-primary">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        <span aria-hidden="true">&larr;</span> Volver
                    </button>

                    <script src="{{ asset('js/columns.js') }}"></script>
                </div>


            </div>
        </div>
    </div>
    <div class="col">
        <button id="toggleTableBtn" class="btn btn-primary mb-3 " type="button" data-toggle="collapse"
            data-target="#tablaCollapse" aria-expanded="false" aria-controls="tablaCollapse">
            <i class="fas fa-eye"></i> Mostrar Tabla
        </button>
    </div>

    <script src="js/mosOc.js"></script>

    <div class="container card collapse" id="tablaCollapse">


        <div class="card-header  row " style="background-color: #4b4ef7;">
            <div class="col text-center">
                <h2 class="card-title mb-0" style="color:white">Tabla de Filtros Avanzados</h2>
            </div>
            <div class="col-auto">
                <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#columnModal">
                    <i class="fas fa-columns mr-2"></i> Mostrar/Ocultar Columnas
                </button>
            </div>
        </div>



        <div class="card-body">
            <div class="table-responsive">

                <table class="table table-bordered table-hover" id="guia-table" id="tabla-resultados">
                    <thead>
                        <tr>
                            <th id="id">N°</th>
                            <th id="ruc">RUC</th>
                            <th id="razon_social">Razón Social</th>
                            <th id="direccion">Dirección</th>
                            <th id="nro_guia">Número de Guía</th>
                            <th id="nro_viaje">Número de Viaje</th>
                            <th id="adelanto">Adelanto</th>
                            <th id="precio">Precio Unitario</th>
                            <th id="carga_bruta">Carga Bruta</th>
                            <th id="carga_neta">Carga Neta</th>
                            <th id="material_extrano">Material Extraño</th>
                            <th id="km_origen">Km de Origen</th>
                            <th id="km_destino">Km de Destino</th>
                            <th id="fecha_carga">Fecha de Carga</th>
                            <th id="fecha_descarga">Fecha de Descarga</th>
                            <th id="acopiadora">Acopiadora</th>
                            <th id="ubigeo">Ubigeo</th>
                            <th id="zona">Zona</th>
                            <th id="ingenio">Ingenio</th>
                            <th id="unidad_tecnica">Unidad Tecnica</th>
                            <th id="campo">Campo</th>
                            <th id ="transportista">Nombre Transportista</th>
                            <th id="conductor">Datos del Conductor</th>
                            <th id="dni_conductor">DNI Conductor</th>
                            <th id="placa">Placa</th>
                            <th id="codigo_vehiculo">Codigo Vehiculo</th>
                            <th id="numero_ejes">Numero de Ejes</th>
                            <th id="nombre_agricultor">Nombre Agricultor</th>
                            <th id="apellidos_agricultor">Apellidos Agricultor</th>
                            <th id="dni_agricultor">DNI Agricultor</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($datos as $dato)
                            <tr>
                                <td class="id">{{ $loop->iteration }}</td>
                                <td class="ruc">{{ $dato->ruc }}</td>
                                <td class="razon_social">{{ $dato->razon_social }}</td>
                                <td class="direccion">{{ $dato->direccion }}</td>
                                <td class="nro_guia">{{ $dato->nro_guia }}</td>
                                <td class="nro_viaje">{{ $dato->nro_viaje }}</td>
                                <td class="adelanto">{{ $dato->adelanto }}</td>
                                <td class="precio">{{ $dato->precio_unitario }}</td>
                                <td class="carga_bruta">{{ $dato->total_carga_bruta }}</td>
                                <td class="carga_neta">{{ $dato->total_carga_neta }}</td>
                                <td class="material_extrano">{{ $dato->total_material_extrano }}</td>
                                <td class="km_origen">{{ $dato->km_origen }}</td>
                                <td class="km_destino">{{ $dato->km_de_destino }}</td>
                                <td class="fecha_carga">{{ $dato->fecha_carga }}</td>
                                <td class="fecha_descarga">{{ $dato->fecha_de_descarga }}</td>
                                <td class="acopiadora">{{ $dato->acopiadora }}</td>
                                <td class="ubigeo">{{ $dato->ubigeo }}</td>
                                <td class="zona">{{ $dato->zona }}</td>
                                <td class="ingenio">{{ $dato->ingenio }}</td>
                                <td class="unidad_tecnica">{{ $dato->unidad_tecnica }}</td>
                                <td class="campo">{{ $dato->campo }}</td>
                                <td class="transportista">{{ $dato->nombre_transportista }}</td>
                                <td class="conductor">{{ $dato->datos_conductor }}</td>
                                <td class="dni_conductor">{{ $dato->dni_conductor }}</td>
                                <td class="placa">{{ $dato->placa }}</td>
                                <td class="codigo_vehiculo">{{ $dato->codigo_vehiculo }}</td>
                                <td class="numero_ejes">{{ $dato->num_ejes }}</td>
                                <td class="nombre_agricultor">{{ $dato->nombres_agricultor }}</td>
                                <td class="apellidos_agricultor">{{ $dato->apellidos_agricultor }}</td>
                                <td class="dni_agricultor">{{ $dato->dni_agricultor }}</td>

                            </tr>
                            @if ($loop->iteration % 5 == 0)
                    </tbody>
                </table>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered table-hover" id="guia-table" id="tabla-resultados">
                    <thead>
                        <tr>
                            <th id="id">N°</th>
                            <th id="ruc">RUC</th>
                            <th id="razon_social">Razón Social</th>
                            <th id="direccion">Dirección</th>
                            <th id="nro_guia">Número de Guía</th>
                            <th id="nro_viaje">Número de Viaje</th>
                            <th id="adelanto">Adelanto</th>
                            <th id="precio">Precio Unitario</th>
                            <th id="carga_bruta">Carga Bruta</th>
                            <th id="carga_neta">Carga Neta</th>
                            <th id="material_extrano">Material Extraño</th>
                            <th id="km_origen">Km de Origen</th>
                            <th id="km_destino">Km de Destino</th>
                            <th id="fecha_carga">Fecha de Carga</th>
                            <th id="fecha_descarga">Fecha de Descarga</th>
                            <th id="acopiadora">Acopiadora</th>
                            <th id="ubigeo">Ubigeo</th>
                            <th id="zona">Zona</th>
                            <th id="ingenio">Ingenio</th>
                            <th id="unidad_tecnica">Unidad Tecnica</th>
                            <th id="campo">Campo</th>
                            <th id ="transportista">Nombre Transportista</th>
                            <th id="conductor">Datos del Conductor</th>
                            <th id="dni_conductor">DNI Conductor</th>
                            <th id="placa">Placa</th>
                            <th id="codigo_vehiculo">Codigo Vehiculo</th>
                            <th id="numero_ejes">Numero de Ejes</th>
                            <th id="nombre_agricultor">Nombre Agricultor</th>
                            <th id="apellidos_agricultor">Apellidos Agricultor</th>
                            <th id="dni_agricultor">DNI Agricultor</th>
                        </tr>
                    </thead>
                    <tbody>
                        @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-5">
                <div class="small-box bg-indigo category" id="vehiculos">
                    <div class="inner">
                        <h4>Vehículos</h4>
                        <p>Administrar vehículos</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-truck"></i>
                    </div>
                    <a href="#" class="small-box-footer" data-target="#table-vehiculos">Más información <i
                            class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-lg-6 col-md-6">
                <div class="small-box bg-lime category" id="transportistas">
                    <div class="inner">
                        <h4>Transportistas</h4>
                        <p>Administrar transportistas</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-building"></i>
                    </div>
                    <a href="#" class="small-box-footer" data-target="#table-transportistas">Más información <i
                            class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-lg-6 col-md-6">
                <div class="small-box bg-info category" id="carga">
                    <div class="inner">
                        <h4>Cargas</h4>
                        <p>Administrar cargas</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-box"></i>
                    </div>
                    <a href="#" class="small-box-footer" data-target="#table-carga">Más información <i
                            class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-lg-6 col-md-6">
                <div class="small-box bg-warning category" id="pagos">
                    <div class="inner">
                        <h4>Pagos</h4>
                        <p>Administrar pagos</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-money-bill"></i>
                    </div>
                    <a href="#" class="small-box-footer" data-target="#table-pagos">Más información <i
                            class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- Repite lo mismo para otras categorías -->
        </div>

        <!-- Tabla oculta de Vehículos -->
        <div class="row">
            <div class="col-lg-12">
                <div class="table-container" id="table-vehiculos" style="display: none;">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>N°</th>
                                <th>Placa</th>
                                <th>Codigo</th>
                                <th>Numero de Ejes</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($datos as $dato)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $dato->placa }}</td>
                                    <td>{{ $dato->codigo_vehiculo }}</td>
                                    <td>{{ $dato->num_ejes }}</td>
                                </tr>
                            @endforeach
                            <!-- Agrega más filas según sea necesario -->
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="table-container" id="table-transportistas" style="display: none;">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>N°</th>
                                <th>RUC</th>
                                <th>Razon Social</th>
                                <th>Nombres</th>
                                <th>Campo</th>
                                <th>Unidad Tecnica</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($datos as $dato)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $dato->ruc }}</td>
                                    <td>{{ $dato->razon_social }}</td>
                                    <td>{{ $dato->nombre_transportista }}</td>
                                    <td>{{ $dato->campo }}</td>
                                    <td>{{ $dato->unidad_tecnica }}</td>
                                </tr>
                            @endforeach
                            <!-- Agrega más filas según sea necesario -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="table-container" id="table-carga" style="display: none;">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>N°</th>
                                <th>Carga Bruta</th>
                                <th>Carga Neta</th>
                                <th>Material Extraño</th>
                                <th>Km Origen</th>
                                <th>Km Destino</th>
                                <th>Fecha Carga</th>
                                <th>Fecha Descarga</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($datos as $dato)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $dato->total_carga_neta }}</td>
                                    <td>{{ $dato->total_carga_bruta }}</td>
                                    <td>{{ $dato->total_material_extrano }}</td>
                                    <td>{{ $dato->km_origen }}</td>
                                    <td>{{ $dato->km_de_destino }}</td>
                                    <td>{{ $dato->fecha_carga }}</td>
                                    <td>{{ $dato->fecha_de_descarga }}</td>
                                </tr>
                            @endforeach
                            <!-- Agrega más filas según sea necesario -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="table-container" id="table-pagos" style="display: none;">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>N°</th>
                                <th>Conductor</th>
                                <th>Carga Neta</th>
                                <th>Precio Unitario</th>
                                <th>Adelanto</th>
                                <th>Total</th>
                                <th>Fecha de Descarga</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($datos as $dato)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $dato->datos_conductor }}</td>
                                    <td>{{ $dato->total_carga_neta }}</td>
                                    <td>{{ $dato->precio_unitario }}</td>
                                    <td>{{ $dato->adelanto }}</td>
                                    <td>{{ $dato->total_carga_neta * $dato->precio_unitario - $dato->adelanto }}</td>
                                    <td>{{ $dato->fecha_de_descarga }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
        <!-- Repite lo mismo para otras tablas ocultas -->
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const links = document.querySelectorAll('.small-box-footer');

            links.forEach(link => {
                link.addEventListener('click', function(event) {
                    event.preventDefault(); // Evitar que el enlace haga su acción predeterminada

                    const targetId = this.getAttribute('data-target');
                    const targetTable = document.querySelector(targetId);

                    // Mostrar u ocultar la tabla correspondiente
                    if (targetTable.style.display === 'none') {
                        targetTable.style.display = 'block';
                    } else {
                        targetTable.style.display = 'none';
                    }
                });
            });
        });
    </script>
@endsection

@section('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


    <script>
        $(document).ready(function() {
            // Función para enviar la solicitud AJAX al servidor
            function filtrarDatos() {
                // Obtener los valores de los campos de filtro
                var ruc = $('#ruc').val();
                var razonSocial = $('#razon_social').val();
                var direccion = $('#direccion').val();
                var nroGuia = $('#nro_guia').val();
                var nroViaje = $('#nro_viaje').val();

                // Realizar la solicitud AJAX
                $.ajax({
                    type: 'GET',
                    url: '{{ route('filtro.avanzado') }}', // Reemplaza 'ruta.filtrar' con la ruta adecuada en tu aplicación
                    data: {
                        ruc: ruc,
                        razon_social: razonSocial,
                        direccion: direccion,
                        nro_guia: nroGuia,
                        nro_viaje: nroViaje
                    },
                    success: function(response) {
                        // Actualizar el contenido de la tabla con los resultados filtrados
                        $('#guia-table').html(response);
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                    }
                });
            }

            // Asignar la función filtrarDatos al evento click del botón de "Filtrar"
            $('#filtrar-btn').click(function(e) {
                e.preventDefault(); // Prevenir el comportamiento por defecto del formulario
                filtrarDatos();
            });

            // Asignar la función filtrarDatos al evento click del botón de "Limpiar Campos"
            $('#limpiar-btn').click(function() {
                $('#filtro-form')[0].reset(); // Resetea el formulario
                filtrarDatos(); // Llama a la función filtrarDatos después de limpiar
            });


        });
    </script>
@endsection

@section('css')
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css/styleTables.css') }}">
@endsection
