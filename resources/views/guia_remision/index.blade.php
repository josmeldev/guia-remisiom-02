@extends('layouts.template')


<link rel="stylesheet" href="{{ asset('css/guia.css') }}">


@section('content')

<nav aria-label="breadcrumb" style="line-height: 0; padding-top: 0; padding-bottom: 0; ">
    <ol class="breadcrumb small" style="font-size: 1rem;">
        {{ Breadcrumbs::render('guia-remision.index') }}
    </ol>
</nav>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif



    <div class="row">

        <div class="col-md-3 mb-1">
            <div class="card  text-white " id="info-guia">
                <div class="card-body">
                    <div class="col">
                        <h6 class="card-title">Total de Guias Emitidas </h6>
                    </div>

                    <div class="row">
                        <div class="col text-center">
                            <i class="fas fa-list-alt fa-2x text-white"></i>
                        </div>

                        <div class="col text-center">
                            <span class="badge badge-primary"
                                style="font-size: 20px; border-radius: 10px;">{{ $totalGuias }}</span>
                        </div>
                    </div>


                </div>

            </div>

            <div class="card  text-white mt-1" id="info-emi">
                <div class="card-body">
                    <div class="col ">
                        <h6 class="card-title">Guias por semana </h6>
                    </div>

                    <div class="row">
                        <div class="col text-center">
                            <i class="fas fa-list-alt fa-2x text-white"></i>
                        </div>

                        <div class="col text-center">
                            <span class="badge badge-primary"
                                style="font-size: 20px; border-radius: 10px;">{{ $totalGuias }}</span>
                        </div>
                    </div>


                </div>

            </div>
        </div>

        <!-- Guias por Estado -->
        <div class="col-md-6 mb-1">
            <div class="card shadow">
                <div class="card-header text-center bg-info">
                    <h5 class="card-title text-white">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-list-check" width="28" height="28" viewBox="0 0 24 24" stroke-width="1.5" stroke="#ffffff" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                            <path d="M3.5 5.5l1.5 1.5l2.5 -2.5" />
                            <path d="M3.5 11.5l1.5 1.5l2.5 -2.5" />
                            <path d="M3.5 17.5l1.5 1.5l2.5 -2.5" />
                            <path d="M11 6l9 0" />
                            <path d="M11 12l9 0" />
                            <path d="M11 18l9 0" />
                          </svg>
                        Guias por Estado</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <ul class="list-group mt-0">
                                @foreach ($guiasPorEstado as $estado => $cantidad)
                                    @if ($estado === 'Guía Facturada' || $estado === 'Guía por Facturar')
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            {{ $estado }}
                                            <span
                                                class="badge badge-{{ $estado === 'Guía Facturada' ? 'success' : 'info' }} badge-pill">{{ $cantidad }}</span>
                                        </li>
                                    @endif
                                @endforeach
                            </ul>
                        </div>
                        <div class="col-md-6">
                            <ul class="list-group mt-0">
                                @foreach ($guiasPorEstado as $estado => $cantidad)
                                    @if ($estado === 'Factura Cancelada' || $estado === 'Factura por Cancelar')
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            {{ $estado }}
                                            <span
                                                class="badge badge-{{ $estado === 'Factura Cancelada' ? 'danger' : 'warning' }} badge-pill">{{ $cantidad }}</span>
                                        </li>
                                    @endif
                                @endforeach
                            </ul>
                        </div>
                    </div>

                </div>
            </div>
        </div>



        <div class="col-md-3 mb-1">

            <div class="card" id="info-other">
                <div class="card-body">
                    <div class="col">
                        <h6 class="card-title text-white">1° Guia Emitida</h6>
                    </div>

                    <div class="col text-center">
                        <div class="agricultor-info">
                            @foreach($guiasPorAgricultor as $index => $agricultor)
                                @if ($index == 0)
                                    <p class="agricultor-name">{{ $agricultor->agricultor }}</p>

                                @endif
                            @endforeach
                        </div>
                    </div>


                </div>
            </div>



            <div class="card  mt-1" id="info-today">
                <div class="card-body">
                    <div class="col">
                        <h6 class="card-title">Guias Emitidas (Hoy)</h6>
                    </div>
                    <div class="row">
                        <div class="col text-center">
                            <i class="fas fa-calendar-day fa-2x "></i>

                        </div>
                        <div class="col text-center">
                            <span class="badge badge-primary"
                                style="font-size: 20px; border-radius: 10px;">{{ $guiasHoy }}</span>

                        </div>
                    </div>


                </div>
            </div>
        </div>



    </div>

    <hr style="border-top: 2px solid rgb(255, 255, 255);">

    <div class="container">


        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="filtro"><i class="fas fa-filter"></i> Filtrar por:</label>
                    <select class="form-control" id="filtro">
                        <option value="texto">Texto</option>
                        <option value="fecha">Fecha</option>
                    </select>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group" id="contenedorFecha" style="display: none;">
                    <label for="fecha"><i class="far fa-calendar-alt"></i> Fecha:</label>
                    <input type="date" class="form-control" id="fecha">
                </div>
                <div class="form-group" id="contenedorTexto">
                    <label for="texto"><i class="fas fa-search"></i> Texto:</label>
                    <div class="input-group">
                        <input type="text" class="form-control" id="texto"
                            placeholder="Ingrese el valor de filtrado">
                        <div class="input-group-append">
                            <button class="btn btn-outline-success" type="button"><i class="fas fa-search"></i></button>
                        </div>
                    </div>
                </div>

            </div>
            <div class="col-md-4 d-flex align-items-end mb-3">
                <button type="button" class="btn btn-secondary" onclick="limpiarCampos()">
                    <i class="fas fa-times-circle mr-1"></i> Limpiar Campos
                </button>
            </div>
        </div>
        <script src="js/filtros.js"></script>

        <hr>


        <div class="row">
            <div class="col-md-6">
                <h5>Guias de Remision</h5>
            </div>

            <div class="col-md-6 text-right">
                <button type="button" class="btn btn-danger" onclick="borrarSeleccionadosOtodo()"
                    title=" Borrar Seleccionados">
                    <i class="fas fa-trash-alt"></i>
                </button>

                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalRegistrarGuia"
                    title="Registrar Guía de Remisión">
                    <i class="fas fa-plus-circle"></i> <!-- Solo el icono -->
                </button>

                <div class="modal fade " id="modalRegistrarGuia" tabindex="-1" aria-labelledby="modalRegistrarGuiaLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header bg-success text-white">
                                <h5 class="modal-title" id="modalRegistrarGuiaLabel">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="32" height="32" color="#ffffff" fill="none">
                                        <path d="M12.5294 2C16.5225 2 18.519 2 19.7595 3.17157C21 4.34315 21 6.22876 21 10V14C21 17.7712 21 19.6569 19.7595 20.8284C18.519 22 16.5225 22 12.5294 22H11.4706C7.47751 22 5.48098 22 4.24049 20.8284C3 19.6569 3 17.7712 3 14L3 10C3 6.22876 3 4.34315 4.24049 3.17157C5.48098 2 7.47752 2 11.4706 2L12.5294 2Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                                        <path d="M8 7H16" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                                        <path d="M8 12H16" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                                        <path d="M8 17H12" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                                    </svg>
                                    Registrar Guía de Remisión</h5>




                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">


                                <div class="progress mt-0">
                                    <div class="progress-bar bg-success" role="progressbar" style="width: 0%;" id="myProgressBar"></div>
                                  </div>

                                  <!-- Mensaje de éxito (inicialmente oculto) -->
                                  <div class="alert alert-success mt-2 d-none text-center" id="successMessage" role="alert">
                                    ¡Formulario completado correctamente!
                                  </div>

                                  <hr>

                                  <form id="myForm" action="{{ route('guia_remision.store') }}" method="POST">
                                    @csrf

                                    <!-- Sección 1 -->
                                    <div class="section" id="section1">
                                        <div class="card mb-4">
                                            <div class="card-header d-flex align-items-center bg-success text-white">
                                                <h5><i class="fas fa-user"></i> Información del Remitente (Agricultor)</h5>
                                            </div>
                                            <div class="card-body">
                                                <div class="d-flex mb-3">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text bg-success " id="icons-form"><i
                                                                    class="fas fa-calendar-alt"></i></span>
                                                        </div>
                                                        <input type="date" class="form-control" id="fecha_emision"
                                                            name="fecha_emision" placeholder="Fecha de Emisión">
                                                    </div>
                                                    <script src="js/days.js"></script>

                                                    <div class="mr-4"></div>

                                                    <div class="input-group">
                                                        <select class="form-control" id="rucInput" name="ruc_agricultor">
                                                            @foreach ($agricultores as $agricultor)
                                                                <option value="{{ $agricultor->ruc }}" {{ $loop->first ? 'selected' : '' }}>
                                                                    {{ $agricultor->ruc }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                        <div class="input-group-append">
                                                            <button type="button" id="consultarBtn" class="btn btn-success" data-token="{{ env('RUC_API_TOKEN') }}">
                                                                <i class="fas fa-search"></i> Consultar
                                                            </button>
                                                        </div>
                                                    </div>

                                                </div>

                                                <div class="d-flex mb-3">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text bg-success" id="icons-form"><i
                                                                    class="fas fa-building"></i></span>
                                                        </div>
                                                        <input type="text" id="razonSocialInput" class="form-control"
                                                            name="razon_social_remitente"
                                                            placeholder="Razón Social del Remitente">
                                                    </div>

                                                    <div class="mr-4"></div>

                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text bg-success" id="icons-form"><i
                                                                    class="fas fa-map-marker-alt"></i></span>
                                                        </div>
                                                        <input type="text" class="form-control" id="direccionInput"
                                                            name="direccion_remitente"
                                                            placeholder="Dirección del Remitente">
                                                    </div>

                                                </div>

                                            </div>
                                        </div>
                                        <div class="text-center">
                                            <button type="button" class="btn btn-warning next-btn" title="next">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-badge-right-filled" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="#ffffff" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                                    <path d="M7 6l-.112 .006a1 1 0 0 0 -.669 1.619l3.501 4.375l-3.5 4.375a1 1 0 0 0 .78 1.625h6a1 1 0 0 0 .78 -.375l4 -5a1 1 0 0 0 0 -1.25l-4 -5a1 1 0 0 0 -.78 -.375h-6z" stroke-width="0" fill="currentColor" />
                                                  </svg>
                                            </button>
                                        </div>


                                    </div>

                                    <!-- Sección 2 -->
                                    <div class="section d-none" id="section2">
                                        <div class="card mb-4">
                                            <div class="card-header d-flex align-items-center bg-success text-white">
                                                <h5><i class="fas fa-truck"></i> Información del Transportista</h5>
                                            </div>
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <div class="input-group">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text bg-success" id="icons-form"><i class="fas fa-id-card"></i></span>
                                                                </div>
                                                                <select class="form-control" id="rucRemTransport" name="ruc_transportista">
                                                                    <option value="" disabled>Seleccione el RUC del Transportista</option>
                                                                    @foreach ($transportistas as $transportista)
                                                                        <option value="{{ $transportista->RUC }}" {{ $loop->last ? 'selected' : '' }}>{{ $transportista->RUC }}</option>
                                                                    @endforeach
                                                                </select>
                                                                <div class="input-group-append">
                                                                    <button type="button" id="consultarBtnRemTransport" class="btn btn-success"
                                                                        data-token="{{ env('RUC_API_TOKEN') }}">
                                                                        <i class="fas fa-search"></i> Consultar
                                                                    </button>
                                                                </div>
                                                            </div>


                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <div class="input-group">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text bg-success" id="icons-form"><i
                                                                            class="fas fa-user"></i></span>
                                                                </div>
                                                                <input type="text" class="form-control"
                                                                id="razonSocialRemTransport"
                                                                    name="razon_social_transportista"
                                                                    placeholder="Razón Social del Transportista">
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="mb-3">
                                                            <div class="input-group">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text bg-success" id="icons-form"><i
                                                                            class="fas fa-map-marker-alt"></i></span>
                                                                </div>
                                                                <input type="text" class="form-control"
                                                                    id="direccionRemTransport" name="direccion_transportista"
                                                                    placeholder="Dirección del Transportista">
                                                            </div>

                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="text-center">
                                            <button type="button" class="btn btn-success prev-btn" title="prev">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-badge-left" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="#ffffff" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                                    <path d="M11 17h6l-4 -5l4 -5h-6l-4 5z" />
                                                  </svg>
                                            </button>
                                            <button type="button" class="btn btn-warning next-btn" title="next">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-badge-right-filled" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="#ffffff" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                                    <path d="M7 6l-.112 .006a1 1 0 0 0 -.669 1.619l3.501 4.375l-3.5 4.375a1 1 0 0 0 .78 1.625h6a1 1 0 0 0 .78 -.375l4 -5a1 1 0 0 0 0 -1.25l-4 -5a1 1 0 0 0 -.78 -.375h-6z" stroke-width="0" fill="currentColor" />
                                                  </svg>
                                            </button>
                                        </div>


                                    </div>

                                    <!-- Sección 3 -->
                                    <div class="section d-none" id="section3">
                                      <!-- Información de la Guía de Remisión -->
                                        <div class="card mb-4">
                                            <div class="card-header d-flex align-items-center bg-success text-white ">
                                                <h5 class="mb-0"><i class="fas fa-clipboard-list mr-2"></i> Información
                                                    de la Guía de Remisión</h5>
                                            </div>
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <div class="input-group">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text bg-success" id="icons-form"><i
                                                                            class="fas fa-ticket-alt"></i></span>
                                                                </div>
                                                                <input type="text" class="form-control"
                                                                    id="nro_ticket" name="nro_ticket"
                                                                    placeholder="Número de Ticket" required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <div class="input-group">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text bg-success" id="icons-form"><i
                                                                            class="far fa-calendar-alt"></i></span>
                                                                </div>
                                                                <input type="date" class="form-control"
                                                                    id="fecha_partida" name="fecha_partida"
                                                                    placeholder="Fecha de Partida" required>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <div class="input-group">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text bg-success" id="icons-form"><i
                                                                            class="fas fa-map-marker-alt"></i></span>
                                                                </div>
                                                                <input type="text" class="form-control"
                                                                    id="punto_partida" name="punto_partida"
                                                                    placeholder="Punto de Partida" required>
                                                            </div>
                                                        </div>

                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <div class="input-group">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text bg-success" id="icons-form"><i
                                                                            class="fas fa-map-marker-alt"></i></span>
                                                                </div>
                                                                <input type="text" class="form-control"
                                                                    id="punto_llegada" name="punto_llegada"
                                                                    placeholder="Punto de Llegada" required>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <div class="input-group">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text bg-success" id="icons-form"><i
                                                                            class="fas fa-box"></i></span>
                                                                </div>
                                                                <input type="text" class="form-control" id="producto"
                                                                    name="producto" placeholder="Producto Transportado"
                                                                    required>
                                                            </div>
                                                        </div>

                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <div class="input-group">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text bg-success" id="icons-form"><i
                                                                            class="fas fa-weight-hanging"></i></span>
                                                                </div>
                                                                <select name="carga_id" id="carga_id" class="form-control">
                                                                    <option value="" >Seleccionar Peso Bruto</option>
                                                                    @foreach($cargas->reverse() as $carga)
                                                                        <option value="{{ $carga->id }}" {{ $loop->first ? 'selected' : '' }}>
                                                                            {{ $carga->id }} - {{ $carga->total_carga_bruta }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">

                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <div class="input-group">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text bg-success" id="icons-form"><i
                                                                            class="fas fa-check-circle"></i></span>
                                                                </div>
                                                                <select class="form-control" id="estado"
                                                                    name="estado" required>
                                                                    <option value="">Seleccionar Estado</option>
                                                                    <option value="guia_facturada">Guía Facturada</option>
                                                                    <option value="guia_por_facturar">Guía por Facturar
                                                                    </option>
                                                                    <option value="factura_cancelada">Factura Cancelada
                                                                    </option>
                                                                    <option value="factura_por_cancelar">Factura por
                                                                        Cancelar</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <input type="hidden" name="agricultor_id" value="{{ $agricultorId }}">
                                        <input type="hidden" name="transportista_id" value="{{ $transportistaId }}">

                                        <div class="text-center">
                                            <button type="button" class="btn btn-success prev-btn" title="prev">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-badge-left" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="#ffffff" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                                    <path d="M11 17h6l-4 -5l4 -5h-6l-4 5z" />
                                                  </svg>
                                            </button>

                                            <button type="reset" class="btn btn-secondary" id="resetBtn" title="reset">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24" color="#ffffff" fill="none">
                                                    <path d="M17.5 17.5L22 22" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                                    <path d="M20 11C20 6.02944 15.9706 2 11 2C6.02944 2 2 6.02944 2 11C2 15.9706 6.02944 20 11 20C15.9706 20 20 15.9706 20 11Z" stroke="currentColor" stroke-width="1.5" stroke-linejoin="round" />
                                                    <path d="M8 14L14 8M8 8L14 14" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                                </svg>
                                            </button>

                                            <button type="submit" class="btn btn-info" title="submit">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24" color="#ffffff" fill="none">
                                                    <path d="M12 5L12 15M12 5C11.2998 5 9.99153 6.9943 9.5 7.5M12 5C12.7002 5 14.0085 6.9943 14.5 7.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                                    <path d="M5 19H19.0001" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                                </svg>
                                            </button>


                                        </div>


                                    </div>
                                  </form>

                                  <script src="{{ asset('js/c.js') }}"></script>




                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>



        <div id="tables-wrapper" class="tables-wrapper">


            @foreach ($guias->chunk(4) as $chunk)
                <table class="table table-striped" id="tablaGuias">
                    <thead >
                        <tr >
                            <th><input type="checkbox" id="selectAllCheckbox" onchange="selectAll()"
                                    style="cursor: pointer;"></th>
                            <th>ID</th>
                            <th>Fecha Emision</th>
                            <th>N° Guia</th>
                            <th>N° de Ticket</th>
                            <th>Fecha de Partida</th>
                            <th>Punto Partida</th>
                            <th>Punto Llegada</th>
                            <th>Producto</th>

                            <th>Estado</th>
                            <th>Acciones</th> <!-- Nueva columna para las acciones CRUD -->
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($chunk as $guia)
                            <tr>
                                <td><input type="checkbox" class="deleteCheckbox" value="{{ $guia->id }}"
                                        style="cursor: pointer;"></td>
                                <td>{{ $guia->id }}</td>
                                <td>{{ $guia->fecha_emision }}</td>
                                <td>{{ $guia->nro_guia }}</td>
                                <td>{{ $guia->nro_ticket }}</td>
                                <td>{{ $guia->fecha_partida }}</td>
                                <td>{{ $guia->punto_partida }}</td>
                                <td>{{ $guia->punto_llegada }}</td>
                                <td>{{ $guia->producto }}</td>

                                <td>{{ ucwords(str_replace('_', ' ', $guia->estado)) }}</td>

                                <td>

                                    <button type="button" class="btn btn-primary btn-sm mb-1" data-toggle="modal"
                                        data-target="#editModal{{ $guia->id }}" title="Editar">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-edit"
                                            width="20" height="20" viewBox="0 0 24 24" stroke-width="1.5"
                                            stroke="#2c3e50" fill="none" stroke-linecap="round"
                                            stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" />
                                            <path
                                                d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" />
                                            <path d="M16 5l3 3" />
                                        </svg>
                                    </button>

                                    <!-- Modal para editar la guía de remisión -->
                                    <div class="modal fade" id="editModal{{ $guia->id }}" tabindex="-1"
                                        aria-labelledby="editModalLabel{{ $guia->id }}" aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header bg-primary">
                                                    <h5 class="modal-title" id="editModalLabel{{ $guia->id }}">Editar
                                                        Guía de Remisión</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <!-- Formulario para editar la guía de remisión -->
                                                    <form id="editForm{{ $guia->id }}"
                                                        action="{{ route('guias.update', $guia->id) }}" method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <!-- Campos para editar -->
                                                        <div class="form-group row">
                                                            <div class="col-md-6">
                                                                <label for="fecha_emision">Fecha de Emisión</label>
                                                                <input type="date" class="form-control"
                                                                    id="fecha_emision" name="fecha_emision"
                                                                    value="{{ $guia->fecha_emision }}" required>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label for="nro_guia">N° de Guía de Remisión</label>
                                                                <input type="text" class="form-control" id="nro_guia"
                                                                    name="nro_guia" value="{{ $guia->nro_guia }}"
                                                                    required>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <div class="col-md-6">
                                                                <label for="nro_ticket">N° de Ticket</label>
                                                                <input type="text" class="form-control"
                                                                    id="nro_ticket" name="nro_ticket"
                                                                    value="{{ $guia->nro_ticket }}" required>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label for="fecha_partida">Fecha de Partida</label>
                                                                <input type="date" class="form-control"
                                                                    id="fecha_partida" name="fecha_partida"
                                                                    value="{{ $guia->fecha_partida }}" required>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <div class="col-md-6">
                                                                <label for="punto_partida">Punto de Partida</label>
                                                                <input type="text" class="form-control"
                                                                    id="punto_partida" name="punto_partida"
                                                                    value="{{ $guia->punto_partida }}" required>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label for="punto_llegada">Punto de Llegada</label>
                                                                <input type="text" class="form-control"
                                                                    id="punto_llegada" name="punto_llegada"
                                                                    value="{{ $guia->punto_llegada }}" required>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <div class="col-md-6">
                                                                <label for="producto">Producto</label>
                                                                <input type="text" class="form-control" id="producto"
                                                                    name="producto" value="{{ $guia->producto }}"
                                                                    required>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label for="peso_bruto">Peso Bruto</label>
                                                                <input type="text" class="form-control"
                                                                    id="peso_bruto" name="peso_bruto"
                                                                    value="{{ $guia->peso_bruto }}" required>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <div class="col-md-6">
                                                                <label for="estado">Estado</label>
                                                                <select class="form-control" id="estado"
                                                                    name="estado" required>
                                                                    <option value="">Seleccionar Estado</option>
                                                                    <option value="guia_facturada"
                                                                        {{ $guia->estado == 'guia_facturada' ? 'selected' : '' }}>
                                                                        Guía Facturada</option>
                                                                    <option value="guia_por_facturar"
                                                                        {{ $guia->estado == 'guia_por_facturar' ? 'selected' : '' }}>
                                                                        Guía por Facturar</option>
                                                                    <option value="factura_cancelada"
                                                                        {{ $guia->estado == 'factura_cancelada' ? 'selected' : '' }}>
                                                                        Factura Cancelada</option>
                                                                    <option value="factura_por_cancelar"
                                                                        {{ $guia->estado == 'factura_por_cancelar' ? 'selected' : '' }}>
                                                                        Factura por Cancelar</option>
                                                                </select>
                                                            </div>

                                                            <div class="col-md-6">
                                                                <label for="ruc_agricultor">RUC del Agricultor</label>
                                                                <select class="form-control" id="ruc_agricultor"
                                                                    name="ruc_agricultor" required>
                                                                    <option value="">Seleccionar RUC del Agricultor
                                                                    </option>
                                                                    @foreach ($agricultores as $agricultor)
                                                                        <option value="{{ $agricultor->ruc }}"
                                                                            {{ $guia->agricultor->ruc == $agricultor->ruc ? 'selected' : '' }}>
                                                                            {{ $agricultor->ruc }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <div class="col-md-6">
                                                                <label for="ruc_transportista">RUC del
                                                                    Transportista</label>
                                                                <select class="form-control" id="ruc_transportista"
                                                                    name="ruc_transportista" required>
                                                                    <option value="">Seleccionar RUC del
                                                                        Transportista</option>
                                                                    @foreach ($transportistas as $transportista)
                                                                        <option value="{{ $transportista->RUC }}"
                                                                            {{ $guia->transportista->RUC == $transportista->RUC ? 'selected' : '' }}>
                                                                            {{ $transportista->RUC }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="text-center mb-0">
                                                            <button type="submit" class="btn btn-primary"> Guardar
                                                                Cambios <i class="fas fa-save"></i></button>

                                                        </div>

                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <button type="button" class="btn btn-success btn-sm mb-1"  onclick="togglePanel('{{ $guia->id }}')" title="Más opciones" >
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-file-dots" width="20" height="20" viewBox="0 0 24 24" stroke-width="1.5" stroke="#ffffff" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                            <path d="M14 3v4a1 1 0 0 0 1 1h4" />
                                            <path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z" />
                                            <path d="M9 14v.01" />
                                            <path d="M12 14v.01" />
                                            <path d="M15 14v.01" />
                                          </svg>

                                      </button>

                                      <div id="panel{{ $guia->id }}" class="panel">

                                        <h6>Opciones</h6>
                                        <hr style="border: solid 1px; color:white">

                                        <a href="{{ route('guias.download', $guia->id) }}" class="btn btn-danger"> PDF
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="16" height="16" color="#ffffff" fill="none">
                                                <path d="M7 18V15.5M7 15.5V14C7 13.5286 7 13.2929 7.15377 13.1464C7.30754 13 7.55503 13 8.05 13H8.75C9.47487 13 10.0625 13.5596 10.0625 14.25C10.0625 14.9404 9.47487 15.5 8.75 15.5H7ZM21 13H19.6875C18.8625 13 18.4501 13 18.1938 13.2441C17.9375 13.4882 17.9375 13.881 17.9375 14.6667V15.5M17.9375 18V15.5M17.9375 15.5H20.125M15.75 15.5C15.75 16.8807 14.5747 18 13.125 18C12.7979 18 12.6343 18 12.5125 17.933C12.2208 17.7726 12.25 17.448 12.25 17.1667V13.8333C12.25 13.552 12.2208 13.2274 12.5125 13.067C12.6343 13 12.7979 13 13.125 13C14.5747 13 15.75 14.1193 15.75 15.5Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                                <path d="M15 22H10.7273C7.46607 22 5.83546 22 4.70307 21.2022C4.37862 20.9736 4.09058 20.7025 3.8477 20.3971C3 19.3313 3 17.7966 3 14.7273V12.1818C3 9.21865 3 7.73706 3.46894 6.55375C4.22281 4.65142 5.81714 3.15088 7.83836 2.44135C9.09563 2 10.6698 2 13.8182 2C15.6173 2 16.5168 2 17.2352 2.2522C18.3902 2.65765 19.3012 3.5151 19.732 4.60214C20 5.27832 20 6.12494 20 7.81818V10" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                                <path d="M3 12C3 10.1591 4.49238 8.66667 6.33333 8.66667C6.99912 8.66667 7.78404 8.78333 8.43137 8.60988C9.00652 8.45576 9.45576 8.00652 9.60988 7.43136C9.78333 6.78404 9.66667 5.99912 9.66667 5.33333C9.66667 3.49238 11.1591 2 13 2" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                            </svg>
                                        </a>
                                        <button class="btn btn-info" onclick="printGuia({{ $guia->id }})">Imprimir
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="16" height="16" color="#ffffff" fill="none">
                                                <path d="M7.35396 18C5.23084 18 4.16928 18 3.41349 17.5468C2.91953 17.2506 2.52158 16.8271 2.26475 16.3242C1.87179 15.5547 1.97742 14.5373 2.18868 12.5025C2.36503 10.8039 2.45321 9.95455 2.88684 9.33081C3.17153 8.92129 3.55659 8.58564 4.00797 8.35353C4.69548 8 5.58164 8 7.35396 8H16.646C18.4184 8 19.3045 8 19.992 8.35353C20.4434 8.58564 20.8285 8.92129 21.1132 9.33081C21.5468 9.95455 21.635 10.8039 21.8113 12.5025C22.0226 14.5373 22.1282 15.5547 21.7352 16.3242C21.4784 16.8271 21.0805 17.2506 20.5865 17.5468C19.8307 18 18.7692 18 16.646 18" stroke="currentColor" stroke-width="1.5" />
                                                <path d="M17 8V6C17 4.11438 17 3.17157 16.4142 2.58579C15.8284 2 14.8856 2 13 2H11C9.11438 2 8.17157 2 7.58579 2.58579C7 3.17157 7 4.11438 7 6V8" stroke="currentColor" stroke-width="1.5" stroke-linejoin="round" />
                                                <path d="M13.9887 16L10.0113 16C9.32602 16 8.98337 16 8.69183 16.1089C8.30311 16.254 7.97026 16.536 7.7462 16.9099C7.57815 17.1904 7.49505 17.5511 7.32884 18.2724C7.06913 19.3995 6.93928 19.963 7.02759 20.4149C7.14535 21.0174 7.51237 21.5274 8.02252 21.7974C8.40513 22 8.94052 22 10.0113 22L13.9887 22C15.0595 22 15.5949 22 15.9775 21.7974C16.4876 21.5274 16.8547 21.0174 16.9724 20.4149C17.0607 19.963 16.9309 19.3995 16.6712 18.2724C16.505 17.5511 16.4218 17.1904 16.2538 16.9099C16.0297 16.536 15.6969 16.254 15.3082 16.1089C15.0166 16 14.674 16 13.9887 16Z" stroke="currentColor" stroke-width="1.5" stroke-linejoin="round" />
                                                <path d="M18 12H18.009" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                            </svg>
                                        </button>
                                      </div>

                                    <script>
                                        function printGuia(guiaId) {
                                            // Hacer una solicitud AJAX para obtener la guía de remisión
                                            fetch(`/guias/${guiaId}/print`)
                                                .then(response => response.text())
                                                .then(html => {
                                                    // Crear una nueva ventana para la impresión
                                                    let printWindow = window.open('', '', 'height=600,width=800');
                                                    printWindow.document.write(html);
                                                    printWindow.document.close();
                                                    printWindow.print();
                                                })
                                                .catch(error => {
                                                    console.error('Error al imprimir la guía:', error);
                                                });
                                        }
                                    </script>



                                    <form action="{{ route('guias.destroy', $guia->id) }}" method="POST"
                                        style="display: inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" title="Borrar">
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                class="icon icon-tabler icon-tabler-trash-x-filled" width="20"
                                                height="20" viewBox="0 0 24 24" stroke-width="1.5" stroke="#2c3e50"
                                                fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                <path
                                                    d="M20 6a1 1 0 0 1 .117 1.993l-.117 .007h-.081l-.919 11a3 3 0 0 1 -2.824 2.995l-.176 .005h-8c-1.598 0 -2.904 -1.249 -2.992 -2.75l-.005 -.167l-.923 -11.083h-.08a1 1 0 0 1 -.117 -1.993l.117 -.007h16zm-9.489 5.14a1 1 0 0 0 -1.218 1.567l1.292 1.293l-1.292 1.293l-.083 .094a1 1 0 0 0 1.497 1.32l1.293 -1.292l1.293 1.292l.094 .083a1 1 0 0 0 1.32 -1.497l-1.292 -1.293l1.292 -1.293l.083 -.094a1 1 0 0 0 -1.497 -1.32l-1.293 1.292l-1.293 -1.292l-.094 -.083z"
                                                    stroke-width="0" fill="currentColor" />
                                                <path
                                                    d="M14 2a2 2 0 0 1 2 2a1 1 0 0 1 -1.993 .117l-.007 -.117h-4l-.007 .117a1 1 0 0 1 -1.993 -.117a2 2 0 0 1 1.85 -1.995l.15 -.005h4z"
                                                    stroke-width="0" fill="currentColor" />
                                            </svg>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endforeach
            <script>
                // Función para seleccionar todas las casillas de verificación
                function selectAll() {
                    var checkboxes = document.querySelectorAll('.deleteCheckbox');
                    checkboxes.forEach(function(checkbox) {
                        checkbox.checked = document.getElementById('selectAllCheckbox').checked;
                    });
                }

                // Función para borrar elementos seleccionados o todo
                function borrarSeleccionadosOtodo() {
                    var guiasSeleccionadas = document.querySelectorAll('.deleteCheckbox:checked');
                    if (guiasSeleccionadas.length === 0) {
                        alert('Debes seleccionar al menos una guía de remisión para borrar.');
                    } else {
                        if (confirm('¿Estás seguro de que quieres borrar las guías de remisión seleccionadas?')) {
                            var guiaIds = [];
                            guiasSeleccionadas.forEach(function(guia) {
                                guiaIds.push(guia.value);
                            });
                            // Crear un formulario dinámico para enviar la solicitud DELETE
                            var form = document.createElement('form');
                            form.method = 'POST';
                            form.action = '{{ route('guia_remision.borrar_seleccionados') }}';
                            form.innerHTML = '<input type="hidden" name="_method" value="DELETE">' +
                                '<input type="hidden" name="_token" value="{{ csrf_token() }}">' +
                                '<input type="hidden" name="guia_ids" value="' + guiaIds.join(',') + '">';
                            document.body.appendChild(form);
                            // Enviar el formulario una vez creado
                            form.submit();
                        }
                    }
                }
            </script>







        </div>

        <div class="navigation">
            <button id="prev-btn" onclick="prevTable()">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-big-right-filled"
                    width="16" height="16" viewBox="0 0 24 24" stroke-width="1.5" stroke="#ffffff"
                    fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path
                        d="M12.089 3.634a2 2 0 0 0 -1.089 1.78l-.001 2.586h-6.999a2 2 0 0 0 -2 2v4l.005 .15a2 2 0 0 0 1.995 1.85l6.999 -.001l.001 2.587a2 2 0 0 0 3.414 1.414l6.586 -6.586a2 2 0 0 0 0 -2.828l-6.586 -6.586a2 2 0 0 0 -2.18 -.434l-.145 .068z"
                        stroke-width="0" fill="currentColor" />
                </svg>
            </button>
            <div id="table-numbers" class="table-numbers"></div>
            <button id="next-btn" onclick="prevTable()">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-big-right-filled"
                    width="16" height="16" viewBox="0 0 24 24" stroke-width="1.5" stroke="#ffffff"
                    fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path
                        d="M12.089 3.634a2 2 0 0 0 -1.089 1.78l-.001 2.586h-6.999a2 2 0 0 0 -2 2v4l.005 .15a2 2 0 0 0 1.995 1.85l6.999 -.001l.001 2.587a2 2 0 0 0 3.414 1.414l6.586 -6.586a2 2 0 0 0 0 -2.828l-6.586 -6.586a2 2 0 0 0 -2.18 -.434l-.145 .068z"
                        stroke-width="0" fill="currentColor" />
                </svg>
            </button>
        </div>





    </div>






    <script>
        // Función para mostrar u ocultar el panel
        function togglePanel(id) {
          var panel = document.getElementById("panel" + id);
          panel.style.display = panel.style.display === "block" ? "none" : "block";

          // Ocultar el panel cuando el cursor está fuera de él
          panel.addEventListener("mouseleave", function() {
            this.style.display = "none";
          });
        }
      </script>



    <script src="js/prevNex.js"></script>
    <script src="{{ asset('js/api.js') }}"></script>
@endSection


@section('css')
    <link rel="stylesheet" href="{{ asset('css/styleTables.css') }}">
    <link rel="stylesheet" href="css/mult.css">
@endSection
