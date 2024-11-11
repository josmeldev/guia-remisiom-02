@extends('layouts.template')






@section('content')

<link rel="stylesheet" href="{{ asset('css/menu.css') }}">

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

    <nav>
        <h5 class="styled-heading mb-3">Formularios para la Guía de Remisión</h5>

    </nav>




    <div class="card ">

        <div class="card-header bg-success text-white text-center ">


            <h5 class="ms-2">
                <i>
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="28" height="28" color="#ffffff" fill="none">
                        <path d="M11.0215 6.78662V19.7866" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                        <path d="M11 19.5C10.7777 19.5 10.3235 19.2579 9.41526 18.7738C8.4921 18.2818 7.2167 17.7922 5.5825 17.4849C3.74929 17.1401 2.83268 16.9678 2.41634 16.4588C2 15.9499 2 15.1347 2 13.5044V7.09655C2 5.31353 2 4.42202 2.6487 3.87302C3.29741 3.32401 4.05911 3.46725 5.5825 3.75372C8.58958 4.3192 10.3818 5.50205 11 6.18114C11.6182 5.50205 13.4104 4.3192 16.4175 3.75372C17.9409 3.46725 18.7026 3.32401 19.3513 3.87302C20 4.42202 20 5.31353 20 7.09655V10" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M20.8638 12.9393L21.5589 13.6317C22.147 14.2174 22.147 15.1672 21.5589 15.7529L17.9171 19.4485C17.6306 19.7338 17.2642 19.9262 16.8659 20.0003L14.6088 20.4883C14.2524 20.5653 13.9351 20.2502 14.0114 19.895L14.4919 17.6598C14.5663 17.2631 14.7594 16.8981 15.0459 16.6128L18.734 12.9393C19.3222 12.3536 20.2757 12.3536 20.8638 12.9393Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </i>
                Registro de Guía de Remisión
            </h5>

        </div>
        <div class="row col-md-12 mt-1">


            <button type="button" class="btn btn-success ml-auto" data-toggle="modal" data-target="#exampleModal"
                title="Registro de RUCs de Transportistas">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-table-plus" width="20"
                    height="20" viewBox="0 0 24 24" stroke-width="1.5" stroke="#000000" fill="none"
                    stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path d="M12.5 21h-7.5a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v7.5" />
                    <path d="M3 10h18" />
                    <path d="M10 3v18" />
                    <path d="M16 19h6" />
                    <path d="M19 16v6" />
                </svg>
            </button>
            
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h6 class="modal-title" id="exampleModalLabel">RUC de Transportistas Registrados</h6>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="table-responsive" style="max-height: 300px; overflow-y: auto;">
                                <table>
                                    <thead>
                                        <tr>
                                            <th>N°</th>
                                            <th>RUC</th>
                                            <th>Razón Social</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($transportistas->reverse() as $transportista)
                                            <!-- Invertir el orden -->
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td class="ruc-transportista">{{ $transportista->RUC }}</td>
                                                <td>{{ $transportista->razon_social }}</td>
                                                <td>
                                                    <button class="btn btn-info boton-copiar">
                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                            class="icon icon-tabler icon-tabler-copy" width="20"
                                                            height="20" viewBox="0 0 24 24" stroke-width="1.5"
                                                            stroke="#ffffff" fill="none" stroke-linecap="round"
                                                            stroke-linejoin="round">
                                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                            <path
                                                                d="M7 7m0 2.667a2.667 2.667 0 0 1 2.667 -2.667h8.666a2.667 2.667 0 0 1 2.667 2.667v8.666a2.667 2.667 0 0 1 -2.667 2.667h-8.666a2.667 2.667 0 0 1 -2.667 -2.667z" />
                                                            <path
                                                                d="M4.012 16.737a2.005 2.005 0 0 1 -1.012 -1.737v-10c0 -1.1 .9 -2 2 -2h10c.75 0 1.158 .385 1.5 1" />
                                                        </svg>
                                                    </button>
                                                    <a href="/transportistas" class="btn btn-info">
                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                            class="icon icon-tabler icon-tabler-circle-arrow-up-filled"
                                                            width="20" height="20" viewBox="0 0 24 24"
                                                            stroke-width="1.5" stroke="#ffffff" fill="none"
                                                            stroke-linecap="round" stroke-linejoin="round">
                                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                            <path
                                                                d="M17 3.34a10 10 0 1 1 -14.995 8.984l-.005 -.324l.005 -.324a10 10 0 0 1 14.995 -8.336zm-4.98 3.66l-.163 .01l-.086 .016l-.142 .045l-.113 .054l-.07 .043l-.095 .071l-.058 .054l-4 4l-.083 .094a1 1 0 0 0 1.497 1.32l2.293 -2.293v5.586l.007 .117a1 1 0 0 0 1.993 -.117v-5.585l2.293 2.292l.094 .083a1 1 0 0 0 1.32 -1.497l-4 -4l-.082 -.073l-.089 -.064l-.113 -.062l-.081 -.034l-.113 -.034l-.112 -.02l-.098 -.006z"
                                                                stroke-width="0" fill="currentColor" />
                                                        </svg>
                                                    </a>
                                                    <button class="btn btn-info" data-id="{{ $transportista->id }}"  onclick="consultarRUCTransportistaDesdeTD(this)">
                                                Seleccionar
                                            </button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>

                                </table>
                                <div id="copiadoMensajeTransportista">¡RUC copiado!</div>

                            </div>



                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal" id="cerrarModalTransportista">Cancelar</button>

                        </div>
                    </div>
                </div>
            </div>

            <div class="mr-2">

            </div>

            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#ModalRucAgricultor"
                title="Registro de RUCs de Agricultores">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-table-plus" width="20"
                    height="20" viewBox="0 0 24 24" stroke-width="1.5" stroke="#ffffff" fill="none"
                    stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path d="M12.5 21h-7.5a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v7.5" />
                    <path d="M3 10h18" />
                    <path d="M10 3v18" />
                    <path d="M16 19h6" />
                    <path d="M19 16v6" />
                </svg>
            </button>

            <div class="modal fade" id="ModalRucAgricultor" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h6 class="modal-title" id="exampleModalLabel">RUC de agricultores registrados</h6>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body" style="overflow-y: scroll;max-height: 200px;scrollbar-width: thin;border: 1px solid #ccc;">
                            <table>
                                <thead>
                                    <tr>
                                        <th>N°</th>
                                        <th>RUC</th>
                                        <th>Razón Social</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($agricultores->reverse() as $agricultor)
                                        <!-- Invertir el orden -->
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td class="ruc-agricultor">{{ $agricultor->ruc }}</td>
                                            <td>{{ $agricultor->razon_social }}</td>
                                            <td>
                                                <button class="btn btn-info boton-copiar">
                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                        class="icon icon-tabler icon-tabler-copy" width="20"
                                                        height="20" viewBox="0 0 24 24" stroke-width="1.5"
                                                        stroke="#ffffff" fill="none" stroke-linecap="round"
                                                        stroke-linejoin="round">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                        <path
                                                            d="M7 7m0 2.667a2.667 2.667 0 0 1 2.667 -2.667h8.666a2.667 2.667 0 0 1 2.667 2.667v8.666a2.667 2.667 0 0 1 -2.667 2.667h-8.666a2.667 2.667 0 0 1 -2.667 -2.667z" />
                                                        <path
                                                            d="M4.012 16.737a2.005 2.005 0 0 1 -1.012 -1.737v-10c0 -1.1 .9 -2 2 -2h10c.75 0 1.158 .385 1.5 1" />
                                                    </svg>
                                                </button>
                                                <a href="/agricultores" class="btn btn-info">
                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                        class="icon icon-tabler icon-tabler-circle-arrow-up-filled"
                                                        width="20" height="20" viewBox="0 0 24 24"
                                                        stroke-width="1.5" stroke="#ffffff" fill="none"
                                                        stroke-linecap="round" stroke-linejoin="round">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                        <path
                                                            d="M17 3.34a10 10 0 1 1 -14.995 8.984l-.005 -.324l.005 -.324a10 10 0 0 1 14.995 -8.336zm-4.98 3.66l-.163 .01l-.086 .016l-.142 .045l-.113 .054l-.07 .043l-.095 .071l-.058 .054l-4 4l-.083 .094a1 1 0 0 0 1.497 1.32l2.293 -2.293v5.586l.007 .117a1 1 0 0 0 1.993 -.117v-5.585l2.293 2.292l.094 .083a1 1 0 0 0 1.32 -1.497l-4 -4l-.082 -.073l-.089 -.064l-.113 -.062l-.081 -.034l-.113 -.034l-.112 -.02l-.098 -.006z"
                                                            stroke-width="0" fill="currentColor" />
                                                    </svg>
                                                </a>
                                                <button class="btn btn-info" data-id="{{ $agricultor->id }}"  onclick="consultarRUCAgricultorDesdeTD(this)">
                                                Seleccionar
                                            </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>

                            </table>
                            <div id="copiadoMensajeAgricultor">¡RUC copiado!</div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal" id="cerrarModalAgricultor">Cancelar</button>

                        </div>
                    </div>
                    <script src="js/copy.js"></script>
                </div>
            </div>

        </div>


        <div class="card-body">



            <ul id="progress-bar">
                <li class="progress-item" id="progress1"></li>
                <li class="progress-item" id="progress2"></li>
                <li class="progress-item" id="progress3"></li>
            </ul>

            <form action="{{ route('guia_remision.store') }}" method="POST" id="guiaRemisionForm">
                @csrf


                <!-- Información del Remitente (Agricultor) -->
                <div class="card section active-section" id="remitenteSection" >
                    <div class="card-header bg-success text-center text-white">
                        <h5><i class="fas fa-user"></i> Guia de Remision Remitente</h5>
                    </div>
                    <div class="card-body">
                        <div class="d-flex mb-3">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="icons-form"><i class="fas fa-calendar-alt"></i></span>
                                </div>
                                <input type="date" class="form-control" id="fecha_emision" name="fecha_emision" value="{{ date('Y-m-d') }}"
                                    placeholder="Fecha de Emisión">
                            </div>

                            <div class="mr-4"></div>

                            <div class="input-group">
                                <input type="text" class="form-control pr-2" id="rucInput" name="ruc_agricultor"
                                       placeholder="RUC" minlength="11" maxlength="11"
                                       list="listaRUCs" oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 11);">
                                <datalist id="listaRUCs">
                                    @foreach ($agricultores as $agricultor)
                                        <option value="{{ $agricultor->ruc }}" {{ $loop->first ? 'selected' : '' }}>
                                    @endforeach
                                </datalist>
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
                                    <span class="input-group-text" id="icons-form"><i class="fas fa-building"></i></span>
                                </div>
                                <input type="text" id="razonSocialInput" class="form-control"
                                    name="razon_social_remitente" placeholder="Razón Social del Remitente">
                            </div>

                            <div class="mr-4"></div>

                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="icons-form"><i class="fas fa-map-marker-alt"></i></span>
                                </div>
                                <input type="text" class="form-control" id="direccionInput" name="direccion_remitente"
                                    placeholder="Dirección del Remitente">
                            </div>

                        </div>

                    </div>

                    <div class="text-center mb-3">
                        <button type="button" class="btn btn-success" onclick="nextSection()">
                            <i class="fas fa-arrow-right" ></i></button>
                    </div>
                </div>


                <!-- Información del Transportista -->
                <div class="card mb-4 hidden section" id="destinatarioSection">
                    <div class="card-header text-center bg-success text-white">
                        <h5><i class="fas fa-truck" ></i> Guia de Remision Transportista</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text " id="icons-form"><i class="fas fa-id-card"></i></span>
                                        </div>
                                        <input type="text" class="form-control pr-2" id="rucRemTransport"
                                            name="ruc_transportista" placeholder="RUC del Transportista" minlength="11" maxlength="11"
                                            list="listaRUCsTransportista" oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 11);">
                                        <datalist id="listaRUCsTransportista">
                                            @foreach ($transportistas as $transportista)
                                                <option value="{{ $transportista->ruc }}" {{ $loop->first ? 'selected' : '' }}>
                                            @endforeach
                                        </datalist>
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
                                            <span class="input-group-text" id="icons-form"><i class="fas fa-user"></i></span>
                                        </div>
                                        <input type="text" class="form-control" id="razonSocialRemTransport"
                                            name="razon_social_transportista" placeholder="Razón Social del Transportista">
                                    </div>
                                </div>


                            </div>
                        </div>
                        <div class="row">

                            <div class="col-md-12">
                                <div class="mb-3">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="icons-form"><i class="fas fa-map-marker-alt"></i></span>
                                        </div>
                                        <input type="text" class="form-control" id="direccionRemTransport"
                                            name="direccion_transportista" placeholder="Dirección del Transportista">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="icons-form"><i class="fas fa-map-marker-alt"></i></span>
                                        </div>
                                        <input type="text" class="form-control" id="nro_factura"
                                            name="nro_factura" placeholder="Numero de Factura">
                                    </div>
                                </div>

                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="icons-form"><i class="far fa-calendar-alt"></i></span>
                                        </div>
                                        <input type="date" class="form-control" id="fecha_partida" name="fecha_partida"
                                            placeholder="Fecha de Partida" required>
                                    </div>
                                </div>
                            </div>

                            <script>
                                document.addEventListener("DOMContentLoaded", function() {
                                    // Obtener la fecha actual en formato ISO (YYYY-MM-DD)
                                    var today = new Date().toISOString().split('T')[0];

                                    // Establecer el valor de la fecha actual en el campo de entrada de fecha
                                    document.getElementById('fecha_partida').value = today;
                                });
                            </script>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="icons-form"><i class="fas fa-ticket-alt"></i></span>
                                        </div>
                                        <input type="text" class="form-control" id="nro_ticket" name="nro_ticket"
                                            placeholder="Número de Ticket" required oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 10);">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="icons-form"><i class="fas fa-map-marker-alt"></i></span>
                                        </div>
                                        <input type="text" class="form-control" id="punto_partida" name="punto_partida"
                                            placeholder="Punto de Partida" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="icons-form"><i class="fas fa-map-marker-alt"></i></span>
                                        </div>
                                        <input type="text" class="form-control" id="punto_llegada" name="punto_llegada"
                                            placeholder="Punto de Llegada" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="icons-form"><i class="fas fa-box"></i></span>
                                        </div>
                                        <input type="text" class="form-control" id="producto" name="producto"
                                            placeholder="Producto Transportado" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="icons-form"><i class="fas fa-weight-hanging"></i></span>
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


                            <div class="col-md-6">
                                <div class="mb-3">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="icons-form"><i class="fas fa-check-circle"></i></span>
                                        </div>
                                        <select class="form-control" id="estado" name="estado" required>
                                            <option value="">Seleccionar Estado</option>
                                            <option value="guia_facturada">Guía Facturada</option>
                                            <option value="guia_por_facturar">Guía por Facturar</option>
                                            <option value="factura_cancelada">Factura Cancelada</option>
                                            <option value="factura_por_cancelar">Factura por Cancelar</option>
                                        </select>
                                    </div>
                                </div>
                            </div>



                        </div>
                    </div>

                    <div class="text-center mb-3">
                        <button type="button" class="btn btn-secondary" onclick="prevSection()">
                            <i class="fas fa-arrow-left"></i></button>
                        <button type="button" class="btn btn-success" onclick="nextSection()">
                            <i class="fas fa-arrow-right"></i></button>
                    </div>
                </div>








                <input type="hidden" name="agricultor_id" value="{{ $agricultorId }}">
                <input type="hidden" name="transportista_id" value="{{ $transportistaId }}">


                <div class="text-center mb-3 hidden section" id="envioSection">
                    <div id="mensajeError" style="display: none; color: orange;font-size: 20px; background-color:rgb(222, 243, 129); " class="mt-5 mb-5  rounded ">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="32" height="32" color="#f5a623" fill="none">
                            <path d="M5.32171 9.6829C7.73539 5.41196 8.94222 3.27648 10.5983 2.72678C11.5093 2.42437 12.4907 2.42437 13.4017 2.72678C15.0578 3.27648 16.2646 5.41196 18.6783 9.6829C21.092 13.9538 22.2988 16.0893 21.9368 17.8293C21.7376 18.7866 21.2469 19.6548 20.535 20.3097C19.241 21.5 16.8274 21.5 12 21.5C7.17265 21.5 4.75897 21.5 3.46496 20.3097C2.75308 19.6548 2.26239 18.7866 2.06322 17.8293C1.70119 16.0893 2.90803 13.9538 5.32171 9.6829Z" stroke="currentColor" stroke-width="1.5" />
                            <path d="M11.992 16H12.001" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M12 13L12 8.99997" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        ¡Tienes que llenar todos los campos para enviar el formulario!</div>
                    <div id="mensajeExito" class="mensaje-exito  mt-5 mb-5  rounded" style="display: none; color: green; font-weight: bold; font-size: 20px; background-color: rgb(165, 247, 126);" >

                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="32" height="32" color="#6cc604" fill="none">
                            <path d="M17 3.33782C15.5291 2.48697 13.8214 2 12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22C17.5228 22 22 17.5228 22 12C22 11.3151 21.9311 10.6462 21.8 10" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                            <path d="M8 12.5C8 12.5 9.5 12.5 11.5 16C11.5 16 17.0588 6.83333 22 5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        ¡Haz culminado exitosamente el registro!
                    </div>





                    <button type="button" class="btn btn-secondary" onclick="prevSection()">
                        <i class="fas fa-arrow-left"></i>
                    </button>

                    <button type="submit" class="btn btn-success"> GUARDAR <i class="fas fa-save"></i></button>
                    <button type="reset" class="btn btn-secondary" id="limpiar-btn">
                        <i class="fas fa-broom"></i> Limpiar
                    </button>
                </div>


            </form>

            <script>

            </script>

        </div>


        <script src="js/guia.js"></script>

    </div>



    <hr style="border-color: green;">

    <!-- Tabs-->
    <div class="container mt-5">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
          <li class="nav-item " role="presentation">
            <button class="nav-link active bg-success text-white" id="tab1-tab" data-bs-toggle="tab" data-bs-target="#tab1" type="button" role="tab" aria-controls="tab1" aria-selected="true" >TRANSPORTISTA - VEHICULO - CONDUCTOR</button>
          </li>
          <li class="nav-item ml-1" role="presentation">
            <button class="nav-link bg-success text-white" id="tab2-tab" data-bs-toggle="tab" data-bs-target="#tab2" type="button" role="tab" aria-controls="tab2" aria-selected="false">AGRICULTOR - CARGA - CAMPO</button>
          </li>
          <li class="nav-item ml-1" role="presentation">
            <button class="nav-link bg-success text-white" id="tab3-tab" data-bs-toggle="tab" data-bs-target="#tab3" type="button" role="tab" aria-controls="tab3" aria-selected="false">PAGOS</button>
          </li>
        </ul>
        <div class="tab-content" id="myTabContent">
          <div class="tab-pane fade show active p-3" id="tab1" role="tabpanel" aria-labelledby="tab1-tab">

            <div class="row">

                <div class="col-md-6  p-2" style="border-right:solid 1px green">

                    <div class="card ">
                        <div class="card-header bg-success text-white d-flex align-items-center text-center">
                            <i class="fas fa-building mr-2"></i>
                            <h5 class="mb-0">Registro de Transportista</h5>
                        </div>
                        <div class="card-body">
                            <form action="/transportista" method="POST">
                                @csrf <!-- Agrega el token CSRF -->

                                <div class="form-group row">
                                    <div class="col">
                                        <input type="text" class="form-control mt-2" id="rucDos" name="RUC" placeholder=" "
                                               data-token="{{ env('RUC_API_TOKEN') }}" maxlength="11"
                                               oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 11);"
                                               title="Por favor, ingrese un RUC válido de 11 dígitos." required>
                                        <label for="ruc" class="form-control-label">RUC:</label>
                                    </div>


                                </div>
                                <div class="form-group row">
                                    <div class="col">
                                        <input type="text" class="form-control mt-2" id="razonSocialDos"
                                            name="razon_social" placeholder=" " required>
                                        <label for="razonSocial" class="form-control-label">Razon Social:</label>
                                    </div>

                                </div>
                                <div class="form-group row">
                                    <div class="col">
                                        <input type="text" class="form-control mt-2" id="direccionDos"
                                            name="direccion" placeholder=" " required>
                                        <label for="direccion" class="form-control-label">Dirección:</label>
                                    </div>


                                </div>
                                
                                <div class="form-group row">
                                    <div class="col">
                                        <input type="text" class="form-control mt-2" id="telefono" name="telefono"
                                            placeholder=" " maxlength="30" required>
                                        <label for="telefono" class="form-control-label">Telefono:</label>
                                    </div>

                                </div>

                                
                                <div class="form-group row">
                                    <!--
                                    <div class="col">
                                        <input type="text" class="form-control mt-2" id="zona" name="zona"
                                            placeholder=" " maxlength="50" required>
                                        <label for="zona" class="form-control-label">Zona:</label>
                                    </div>-->
                                    
                                    <div class="col">
                                        <input type="text" class="form-control mt-2" id="unidadTecnica"
                                            name="codigo_mtc" placeholder=" " maxlength="20" required>
                                        <label for="unidadTecnica" class="form-control-label">Código MTC:</label>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col">
                                        <input type="email" class="form-control mt-2" id="correoElectronico"
                                               name="correo_electronico" placeholder=" " maxlength="255"
                                                required>
                                        <label for="correoElectronico" class="form-control-label">Correo Electrónico:</label>
                                    </div>
                                </div>






                                <div class="form-group row">
                                    <div class="col-12 d-flex justify-content-center">
                                        <button type="submit" class="btn btn-success mt-2  mr-3">
                                            <i class="fas fa-save"></i> Guardar
                                        </button>
                                        <button type="reset" class="btn btn-secondary mt-2" id="limpiar-btn">
                                            <i class="fas fa-broom"></i> Limpiar
                                        </button>

                                    </div>

                                </div>
                            </form>

                        </div>

                    </div>

                </div>



                <div class="col-md-6  p-2">

                    <div class="card ">
                        <div class="card-header bg-success text-white d-flex align-items-center">
                            <i class="fas fa-truck mr-2"></i>
                            <h5 class="mb-0">Registro de Vehículo</h5>
                        </div>


                        <div class="card-body">
                            <form action="{{ route('vehiculo.store') }}" method="POST">
                                @csrf <!-- Agrega el token CSRF -->

                                <div class="form-group row">
                                    <div class="col">
                                        <input type="text" name="placa" class="form-control mt-2" id="placa"
                                            placeholder=" " required maxlength="7" minlength="7">
                                        <label for="placa" class="form-control-label">Placa Principal:</label>
                                    </div>
                                    <div class="col">
                                        <input type="text" name="placa1" class="form-control mt-2" id="placa1"
                                            placeholder=" " maxlength="7" minlength="7">
                                        <label for="placa1" class="form-control-label">Placa Carreta:</label>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col">
                                        <input type="text" name="dueño" class="form-control mt-2" id="dueño"
                                            placeholder=" " required maxlength="250">
                                        <label for="dueño" class="form-control-label">Dueño:</label>
                                    </div>

                                </div>

                                <div class="col">
                                    <div class="form-group row">
                                        <label for="id_transportista">Transportista:</label>
                                        <select name="id_transportista" id="id_transportista" class="form-control mt-2" required style="font-size:14px; overflow:auto">
                                            <option value="">Seleccionar ID</option>
                                            @foreach ($transportistas->reverse() as $transportista)
                                                <option value="{{ $transportista->id }}" {{ $loop->first ? 'selected' : '' }}>
                                                    {{ $transportista->id }} - {{ $transportista->razon_social }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                </div>

                                <div class="form-group row">
                                    <div class="col text-center">
                                        <button type="submit" class="btn btn-success mt-3">
                                            <i class="fas fa-save"></i> Guardar
                                        </button>
                                        <button type="reset" class="btn btn-secondary mt-3" id="limpiar-btn">
                                            <i class="fas fa-broom"></i> Limpiar
                                        </button>
                                    </div>
                                </div>
                            </form>

                        </div>

                    </div>

                </div>
            </div>

            <hr style="border-color: green;">


            <div class="row">
                <div class="col-md-12 p-2">

                    <button class="btn btn-info mb-3" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample" title="Registrar Conductor">
                        <span><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-device-floppy" width="20" height="20" viewBox="0 0 24 24" stroke-width="1.5" stroke="#ffffff" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                            <path d="M6 4h10l4 4v10a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2" />
                            <path d="M12 14m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                            <path d="M14 4l0 4l-6 0l0 -4" />
                          </svg></span>
                        Registrar Conductor
                      </button>
                      <div class="collapse mb-3" id="collapseExample">
                        <div class="card ">
                            <div class="card-header bg-success text-white d-flex align-items-center">
                                <i class="fas fa-id-card mr-2"></i>
                                <h5 class="mb-0">Registro de Conductor</h5>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('conductor.store') }}" method="POST">
                                    @csrf

                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <input type="text" class="form-control mt-2" id="dni" name="dni" placeholder=" " minlength="8" maxlength="8" required oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 8);">
                                            <label for="dni" class="form-control-label">DNI:</label>
                                        </div>

                                        <div class="form-group col-md-6">
                                            <input type="text" class="form-control mt-2" id="nombre_apellidos" name="nombre_apellidos" placeholder=" " maxlength="60" required >
                                            <label for="nombre_apellidos" class="form-control-label">Nombre y Apellidos:</label>
                                        </div>
                                    </div>

                                    <div class="form-row ">
                                        <div class="form-group col-md-6">
                                            <input type="text" class="form-control mt-2" id="telefono" name="telefono" placeholder=" " minlength="9" maxlength="9" required oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 9);">
                                            <label for="telefono" class="form-control-label">Teléfono:</label>
                                        </div>

                                        <div class="form-group col-md-6">
                                            <input type="text" class="form-control mt-2" id="brevete" name="brevete" placeholder=" " maxlength="9" required minlength="9">
                                            <label for="brevete" class="form-control-label">Brevete:</label>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col text-center">
                                            <button type="submit" class="btn btn-success mt-3">
                                                <i class="fas fa-save"></i> Guardar
                                            </button>
                                            <button type="reset" class="btn btn-secondary mt-3" id="limpiar-btn">
                                                <i class="fas fa-broom"></i> Limpiar
                                            </button>
                                        </div>
                                    </div>
                                </form>
                                <script>
                                    // Función para realizar la solicitud a la API y completar el campo "Nombre y Apellidos"
                                    function completarNombreApellidos() {
                                        // Obtener el valor del campo de DNI
                                        var dni = document.getElementById('dni').value;

                                        // Realizar la solicitud a la API solo si se ha ingresado un DNI
                                        if (dni.trim() !== '') {
                                            fetch('https://dniruc.apisperu.com/api/v1/dni/' + dni + '?token=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJlbWFpbCI6ImFuZ2VsLmlnbGVzaWFzQHRlY3N1cC5lZHUucGUifQ.1fb2rVCJsMs18E2rWBHXqtCC2j2NYXrG_BkU9LUDLss')
                                                .then(response => {
                                                    if (!response.ok) {
                                                        throw new Error('No se pudieron obtener los datos del DNI proporcionado.');
                                                    }
                                                    return response.json();
                                                })
                                                .then(data => {
                                                    // Completar el campo "Nombre y Apellidos" con los datos obtenidos
                                                    document.getElementById('nombre_apellidos').value = data.nombres + ' ' + data.apellidoPaterno + ' ' + data.apellidoMaterno;
                                                })
                                                .catch(error => {
                                                    console.error('Error:', error);
                                                    // Manejar el error si la solicitud falla
                                                    alert(error.message);
                                                });
                                        }
                                    }

                                    // Evento para llamar a la función cuando se cambia el valor del campo de DNI
                                    document.getElementById('dni').addEventListener('change', completarNombreApellidos);
                                </script>


                            </div>

                        </div>
                      </div>






                </div>



            </div>
            <hr style="border-color: green;">
          </div>




          <div class="tab-pane fade" id="tab2" role="tabpanel" aria-labelledby="tab2-tab">
           <div class="row">
            <div class="col-md-6 p-3 mt-3" style="border-right:solid 1px green">
                <div class="card">
                    <div class="card-header bg-success text-white d-flex align-items-center">
                        <i class="fas fa-tractor mr-2"></i>
                        <h5 class="mb-0">Registro de Agricultor</h5>
                    </div>
                    <div class="card-body" id="agricultor-form">
                        <form action="{{ route('agricultor.store') }}" method="POST" class="form-horizontal">
                            @csrf
                            <div class="form-group">
                                <input type="text" class="form-control mt-2" id="rucAgricultor" name="ruc"
                                    placeholder=" " maxlength="11" data-token="{{ env('RUC_API_TOKEN') }}" oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 11);" >
                                <label for="rucAgricultor" class="form-control-label">RUC:</label>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control mt-2" id="razonSocialAgricultor"
                                    name="razon_social" placeholder=" " maxlength="255" required>
                                <label for="razonSocialAgricultor" class="form-control-label">Razón Social:</label>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control mt-2" id="direccionAgricultor"
                                    name="direccion" placeholder=" " maxlength="255" required>
                                <label for="direccion" class="form-control-label">Dirección:</label>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control mt-2" id="representante" name="representante"
                                    placeholder=" " maxlength="50" required>
                                <label for="representante" class="form-control-label">Representante:</label>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control mt-2" id="dni" name="dni" placeholder=" " maxlength="8" oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 8);">
                                <label for="dni" class="form-control-label">DNI:</label>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control mt-2" id="numero_cuenta" name="numero_cuenta"
                                    placeholder=" " maxlength="20" required>
                                <label for="numero_cuenta" class="form-control-label">Número de Cuenta:</label>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control mt-2" id="banco" name="banco" placeholder=" "
                                    maxlength="50" >
                                <label for="banco" class="form-control-label">Banco:</label>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control mt-2" id="cci" name="cci" placeholder=" "
                                    maxlength="20" required>
                                <label for="cci" class="form-control-label">CCI:</label>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control mt-2" id="correo_electronico" name="correo_electronico"
                                    placeholder=" " maxlength="255" required>
                                <label for="correo_electronico" class="form-control-label">Correo Electrónico:</label>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control mt-2" id="telefono" name="telefono" placeholder=" "
                                    maxlength="9" oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 9);">
                                <label for="telefono" class="form-control-label">Teléfono:</label>
                            </div>
                            

                            <div class="form-group row">
                                <div class="col-12 d-flex justify-content-center">
                                    <button type="submit" class="btn btn-success mt-3 mr-3">
                                        <i class="fas fa-save"></i> Guardar
                                    </button>
                                    <button type="reset" class="btn btn-secondary mt-3" id="limpiar-btn">
                                        <i class="fas fa-broom"></i> Limpiar
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>

                </div>

            </div>

            <div class="col-md-6 p-3 mt-3">
                <div class="card">
                    <div class="card-header bg-success text-white">
                        <h5>Registro de Campo</h5>
                    </div>
                    <div class="card-body" id="campo-form">
                        <form action="{{ route('campo.store') }}" method="POST" class="form-horizontal">
                            @csrf
                            <div class="form-group row">
                                <div class="col-md-6 mb-3">
                                    <input type="text" class="form-control mt-2" id="nombre_campo" name="nombre_campo" placeholder="" maxlength="35" required>
                                    <label for="nombre_campo" class="form-control-label">Nombre del Campo</label>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <input type="text" class="form-control mt-2" id="ubigeo" name="ubigeo" placeholder="" maxlength="35" required>
                                    <label for="ubigeo" class="form-control-label">Ubigeo:</label>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-6 mb-3">
                                    <input type="text" class="form-control mt-2" id="zona" name="zona" placeholder="" maxlength="30" required>
                                    <label for="zona" class="form-control-label">Zona:</label>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <input type="text" class="form-control mt-2" id="unidad_tecnica" name="unidad_tecnica" placeholder="" maxlength="30" required>
                                    <label for="unidad_tecnica" class="form-control-label">Unidad Técnica:</label>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col text-center">
                                    <button type="submit" class="btn btn-primary mt-3">
                                        <i class="fas fa-save"></i> Guardar
                                    </button>
                                    <button type="reset" class="btn btn-secondary mt-3" id="limpiar-btn">
                                        <i class="fas fa-broom"></i> Limpiar
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>



            </div>

           </div>
           <hr style="border-color: green;">
           <div class="row">
            <div class="col-md-12 p-3">
                <div class="card">
                    <div class="card-header bg-success text-white d-flex align-items-center">
                        <i class="fas fa-truck-loading mr-2"></i>
                        <h5 class="mb-0">Registro de Carga</h5>
                    </div>
                    <div class="card-body " id="carga-form">
                        <form action="{{ route('carga.store') }}" method="POST">
                            @csrf
                            <div class="form-group row">
                                <div class="col">
                                    <select class="form-control mt-2" id="chofer_id" name="chofer_id" required>
                                        <option value="" selected disabled >Seleccionar</option>
                                        <!-- Aquí se cargarán las opciones de los conductores -->
                                        @foreach ($conductores->reverse() as $conductor)
                                            <option value="{{ $conductor->id }}" {{ $loop->first ? 'selected' : '' }}>
                                                {{ $conductor->id }} - {{ $conductor->nombre_apellidos }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <label for="chofer_id" class="form-control-label">Conductor:</label>
                                </div>

                                <div class="col">
                                    <input type="number" class="form-control mt-2" id="total_carga_bruta" name="total_carga_bruta" placeholder=" " required>
                                    <label for="total_carga_bruta" class="form-control-label">Carga Bruta:</label>
                                    <span id="cargaBrutaError" class="text-danger"></span>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col">
                                    <input type="number" class="form-control mt-2" id="total_material_extrano" name="total_material_extrano" placeholder=" " required>
                                    <label for="total_material_extrano" class="form-control-label">Material Extraño:</label>
                                    <span id="materialExtranoError" class="text-danger"></span>
                                </div>
                                <div class="col">
                                    <input type="number" class="form-control mt-2" id="tara" name="tara" placeholder=" " required>
                                    <label for="tara" class="form-control-label">Tara:</label>
                                    <span id="taraError" class="text-danger"></span>
                                </div>
                            </div>

                            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                            <script>
                                document.getElementById('total_material_extrano').addEventListener('change', function() {
                                    var cargaBruta = parseFloat(document.getElementById('total_carga_bruta').value);
                                    var materialExtraño = parseFloat(this.value);

                                    if (materialExtraño > cargaBruta) {
                                        this.value = '';
                                        showAlert('error', 'El material extraño no puede ser mayor que la carga bruta.');
                                    }
                                });



                                function showAlert(type, message) {
                                    Swal.fire({
                                        icon: type,
                                        title: '¡Alerta!',
                                        text: message,
                                        timer: 5000, // 5 segundos
                                        timerProgressBar: true,
                                        toast: true,
                                        position: 'bottom-end',
                                        showConfirmButton: false
                                    });
                                }
                            </script>




                            <div class="form-group row">
                                <div class="col">
                                    <input type="text" class="form-control mt-2" id="nro_ticket" name="nro_ticket" placeholder=" " required maxlength="20">
                                    <label for="nro_ticket" class="form-control-label">Número de Ticket:</label>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col mt-2">
                                    <select class="form-control mt-2" id="RUC_Agricultor" name="RUC_Agricultor" required >
                                        <option value="" selected disabled >Seleccionar</option>
                                        <!-- Aquí se cargarán las opciones de los agricultores -->
                                        @foreach ($agricultores->reverse() as $agricultor)
                                            @php
                                                $razon_social = strlen($agricultor->razon_social) > 100 ? substr($agricultor->razon_social, 0, 100) . '...' : $agricultor->razon_social;
                                            @endphp
                                            <option value="{{ $agricultor->id }}" {{ $loop->first ? 'selected' : '' }}>
                                                {{ $agricultor->ruc }} - {{ $razon_social }}
                                            </option>
                                        @endforeach
                                    </select>

                                    <label for="RUC_Agricultor" class="form-control-label">RUC Agricultor:</label>
                                </div>

                                <div class="col mt-2">
                                    <select class="form-control mt-2" id="campo_id" name="campo_id" required>
                                        <option value="" selected disabled>Seleccionar</option>
                                        <!-- Aquí se cargarán las opciones de los campos -->
                                        @foreach ($campos->reverse() as $campo)
                                            <option value="{{ $campo->id }}" {{ $loop->first ? 'selected' : '' }}>
                                                {{ $campo->id }} - {{ $campo->nombre_campo }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <label for="campo_id" class="form-control-label">Campo:</label>
                                </div>

                            </div>

                            <div class="form-group row">
                                <div class="col">
                                    <input type="number" class="form-control mt-2" id="km_origen" name="km_origen" placeholder=" " required>
                                    <label for="km_origen" class="form-control-label">Km Origen:</label>
                                </div>
                                <div class="col">
                                    <input type="number" class="form-control mt-2" id="km_de_destino" name="km_de_destino" placeholder=" " required>
                                    <label for="km_de_destino" class="form-control-label">Km de Destino:</label>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col">
                                    <label for="fecha_carga" class="col col-form-label" style="color:green">Fecha Carga:</label>
                                    <input type="date" class="form-control " id="fecha_carga" name="fecha_carga" required>
                                </div>
                                <div class="col">
                                    <label for="fecha_de_descarga" class="col col-form-label" style="color:green">Fecha de Descarga:</label>
                                    <input type="date" class="form-control" id="fecha_de_descarga" name="fecha_de_descarga" required>
                                    <span id="fechaError" class="error text-danger"></span>
                                </div>
                            </div>

                            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                            <script>
                                document.getElementById('fecha_de_descarga').addEventListener('change', function() {
                                    var fechaCarga = new Date(document.getElementById('fecha_carga').value);
                                    var fechaDescarga = new Date(this.value);

                                    if (fechaDescarga < fechaCarga) {
                                        showAlert('error', 'La fecha de descarga no puede ser anterior a la fecha de carga.');
                                        this.value = ''; // Limpiar el campo de fecha de descarga
                                    }
                                });

                                function showAlert(type, message) {
                                    Swal.fire({
                                        icon: type,
                                        title: '¡Alerta!',
                                        text: message,
                                        timer: 5000, // 5 segundos
                                        timerProgressBar: true,
                                        toast: true,
                                        position: 'bottom-end',
                                        showConfirmButton: false
                                    });
                                }
                            </script>


                            <div class="text-center mb-3">
                                <button type="submit" class="btn btn-success mt-3">
                                    <i class="fas fa-save"></i> Guardar
                                </button>
                                <button type="reset" class="btn btn-secondary mt-3" id="limpiar-btn">
                                    <i class="fas fa-broom"></i> Limpiar
                                </button>
                            </div>
                        </form>


                    </div>

                </div>

            </div>
            <div class="col-md-6 p-3">

            </div>
           </div>
          </div>


          <div class="tab-pane fade" id="tab3" role="tabpanel" aria-labelledby="tab3-tab">


                    <div class="card mt-3 mb-3">
                        <div class="card-header text-white bg-success">
                            <h5>Registro de Pagos</h5>
                        </div>

                        <div class="card-body " id="agricultor-form">
                            <form action="{{ route('pagos.store') }}" method="POST" class="form-horizontal">
                                @csrf

                                <div class="form-group row">
                                    <div class="col">
                                        <input type="number" name="Adelanto" class="form-control mt-2 @error('Adelanto') is-invalid @enderror" id="adelanto" placeholder=" " value="0">
                                        <label for="Adelanto" class="form-control-label">Adelanto:</label>
                                        @error('Adelanto')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col">
                                        <input type="number" class="form-control mt-2 @error('Precio_Unitario') is-invalid @enderror" id="precio_unitario" name="Precio_Unitario" placeholder=" " value="0">
                                        <label for="Precio_Unitario" class="form-control-label">Precio Unitario:</label>
                                        @error('Precio_Unitario')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">

                                    <div class="col">

                                        <select name="guia_id" id="guia_id" class="form-control mt-2">
                                            <option value="">Seleccionar Guía</option>
                                            @foreach ($guiasP->reverse() as $guia)
                                                <option value="{{ $guia->id }}" {{ $loop->first ? 'selected' : '' }}>{{ $guia->id }}</option>
                                            @endforeach
                                        </select>


                                        <label for="guia_id" class="form-control-label">Guia ID:</label>
                                    </div>
                                    <div class="col">
                                        <select name="Metodo_Pago" class="form-control mt-2 " id="metodo_pago" onchange="mostrarCamposAdicionales()">
                                            <option value="">Seleccionar método de pago</option>
                                            <option value="Efectivo">Efectivo</option>
                                            <option value="Transferencias bancarias">Transferencia bancaria</option>
                                            <option value="Tarjetas de débito">Tarjeta de débito </option>
                                            <option value="Pagos electrónicos">Pagos electrónicos</option>
                                        </select>
                                        <label for="Metodo_Pago" class="form-control-label">Método de Pago:</label>

                                    </div>

                                </div>

                                <!-- Agrega los campos adicionales según tu esquema de base de datos -->
                                <div class="form-group row">

                                    <div class="col-md-6 mt-2" id="tipoPagoElectronico" style="display: none;">

                                        <select id="tipoPago" name="Tipo_Pago" class="form-control mt-2 ">
                                            <option value="">Seleccionar tipo de pago electrónico</option>
                                            <option value="Yape">Yape</option>
                                            <option value="Tunki">Tunki</option>
                                            <option value="BIM">BIM</option>
                                            <!-- Agrega aquí otras opciones si es necesario -->
                                        </select>
                                        <label for="Tipo_Pago" class="form-control-label">Tipo de Pago Electrónico:</label>

                                    </div>

                                    <script src="{{asset("js/pago.js")}}"></script>




                                </div>

                                <div class="form-group row">

                                    <div class="col-md-6" id="campoNumeroOperacion" style="display: none;">
                                        <input type="text" class="form-control mt-2" id="numeroOperacion" name="Nro_Operacion" placeholder=" " maxlength="30">
                                        <label for="Nro_Operacion" class="form-control-label">Número de Operación:</label>

                                    </div>
                                    <div class="col-md-6" id="campoMonto" style="display: none;" >

                                        <div class="alert alert-info " role="alert" id="datos-guia" style="display: none;">
                                            <strong >Datos de la Guía Seleccionada:</strong>
                                            <hr>
                                            <span class="d-block " id="guia-id" ></span>
                                            <span class="d-block " id="carga-bruta"></span>
                                            <span class="d-block" id="material-extrano"></span>
                                            <span class="d-block" id="tara"></span>
                                            <span class="d-block" id="monto-guia"></span>
                                        </div>


                                        <div class="form-group mt-4">
                                            <input type="number" class="form-control mt-2" id="monto" name="Monto" step="0.01" min="0" placeholder=" " maxlength="30" value="0">
                                            <label for="Monto" class="form-control-label ">Monto a pagar:</label>
                                        </div>
                                    </div>

                                </div>


                                <div class="form-group row">
                                    <div class="col text-center">
                                        <button type="submit" class="btn btn-success mt-3">
                                            <i class="fas fa-save"></i> Guardar
                                        </button>
                                        <button type="reset" class="btn btn-secondary mt-3" id="limpiar-btn">
                                            <i class="fas fa-broom"></i> Limpiar
                                        </button>
                                    </div>
                                </div>
                            </form>



                           <script>
                                document.addEventListener('DOMContentLoaded', function () {
                                    const guiaSelect = document.getElementById('guia_id');
                                    const datosGuia = document.getElementById('datos-guia');
                                    const guiasP = @json($guiasP);

                                    guiaSelect.addEventListener('change', function () {
                                        const guiaId = this.value;
                                        const guiaSeleccionada = guiasP.find(g => g.id === parseInt(guiaId));

                                        if (guiaId === '') {
                                            datosGuia.style.display = 'none';
                                        } else {
                                            document.getElementById('guia-id').textContent = `ID: ${guiaSeleccionada.id}`;
                                            document.getElementById('carga-bruta').textContent = `Carga Bruta: ${guiaSeleccionada.carga.total_carga_bruta}`;
                                            document.getElementById('material-extrano').textContent = `Material Extraño: ${guiaSeleccionada.carga.total_material_extrano}`;
                                            document.getElementById('tara').textContent = `Tara: ${guiaSeleccionada.carga.tara}`;
                                            datosGuia.style.display = 'block';
                                        }
                                    });

                                                            // Mostrar automáticamente los datos de la última guía al cargar la página
                                const ultimaGuia = guiasP[guiasP.length - 1]; // Última guía según el orden del servidor
                                if (ultimaGuia) {
                                    document.getElementById('guia-id').textContent = `ID: ${ultimaGuia.id}`;
                                    document.getElementById('carga-bruta').textContent = `Carga Bruta: ${ultimaGuia.carga.total_carga_bruta}`;
                                    document.getElementById('material-extrano').textContent = `Material Extraño: ${ultimaGuia.carga.total_material_extrano}`;
                                    document.getElementById('tara').textContent = `Tara: ${ultimaGuia.carga.tara}`;
                                    datosGuia.style.display = 'block';
                                } else {
                                    datosGuia.style.display = 'none';
                                }

                                // Evento change del select de guías
                                guiaSelect.addEventListener('change', function () {
                                    const guiaId = this.value;
                                    actualizarDatosGuia(guiaId);
                                });

                                                                function calcularMonto() {
                                    // Obtener el valor del adelanto y el precio unitario, o establecerlos en 0 si no se ha ingresado nada
                                    const adelanto = parseFloat(document.getElementById('adelanto').value) || 0;
                                    const precioUnitario = parseFloat(document.getElementById('precio_unitario').value) || 0;

                                    // Obtener el ID de la guía seleccionada desde el select
                                    const guiaId = document.getElementById('guia_id').value;

                                    // Buscar la guía seleccionada en el array de guías
                                    const guiaSeleccionada = guiasP.find(guia => guia.id === parseInt(guiaId));

                                    if (guiaSeleccionada) {
                                        const totalCargaBruta = parseFloat(guiaSeleccionada.carga.total_carga_bruta) || 0;
                                        const totalMaterialExtrano = parseFloat(guiaSeleccionada.carga.total_material_extrano) || 0;
                                        const tara = parseFloat(guiaSeleccionada.carga.tara) || 0;

                                        // Calcular el monto
                                        const monto = ((totalCargaBruta - totalMaterialExtrano - tara) * precioUnitario) - adelanto;

                                        // Actualizar el valor del input de monto
                                        document.getElementById('monto').value = monto.toFixed(2);

                                        // Mostrar los datos de la guía seleccionada
                                        document.getElementById('guia-id').textContent = `ID: ${guiaSeleccionada.id}`;
                                        document.getElementById('carga-bruta').textContent = `Carga Bruta: ${guiaSeleccionada.carga.total_carga_bruta}`;
                                        document.getElementById('material-extrano').textContent = `Material Extraño: ${guiaSeleccionada.carga.total_material_extrano}`;
                                        document.getElementById('tara').textContent = `Tara: ${guiaSeleccionada.carga.tara}`;
                                        document.getElementById('monto-guia').textContent = `Monto: ${monto.toFixed(2)}`;

                                        // Mostrar el div de información de la guía seleccionada
                                        document.getElementById('datos-guia').style.display = 'block';
                                    } else {
                                        // Si no hay guía seleccionada, ocultar el div de información de la guía
                                        document.getElementById('datos-guia').style.display = 'none';
                                    }
                                }

                                // Event listeners para los cambios en adelanto, precio unitario y selección de guía
                                document.getElementById('adelanto').addEventListener('input', calcularMonto);
                                document.getElementById('precio_unitario').addEventListener('input', calcularMonto);
                                document.getElementById('guia_id').addEventListener('change', calcularMonto);

                                // Llamar a la función inicialmente para calcular el monto y mostrar los datos de la última guía
                                calcularMonto();




                                });


                              </script>



                        </div>

                    </div>





          </div>
        </div>
      </div>










@endsection

@section('css')

    <link rel="stylesheet" href="{{ asset('css/form.css') }}">
    <link rel="stylesheet" href="{{ asset('css/botStyle.css') }}">
    <link rel="stylesheet" href="{{ asset('css/tableModal.css') }}">




@section('js')
    <script src="{{ asset('js/api.js') }}"></script>
    <script src="{{ asset('js/alert.js') }}"></script>
<!-- AdminLTE JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/3.1.0/js/adminlte.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    
    // tu código aquí
    function consultarRUCTransportistaDesdeTD(button) {
    // Obtener el ID del botón clickeado
    var id = button.getAttribute('data-id');
    // Obtener el RUC de la fila específica
    var ruc = button.closest('tr').querySelector('.ruc-transportista').innerText.trim();
    
    $.ajax({
        url: "{{ route('ruc.transportista') }}",
        method: 'POST',
        data: {
            '_token': '{{ csrf_token() }}',
            'id_transportista': id,
            'ruc_transportista': ruc
        },
        success: function(response) {
            console.log(response);
            if (response.error) {
                alert(response.error);
            } else {
                document.getElementById('razonSocialRemTransport').value = response.razon_social;
                document.getElementById('direccionRemTransport').value = response.direccion;
                document.getElementById('rucRemTransport').value = response.RUC;
                document.getElementById('cerrarModalTransportista').click();
            }
        },
        error: function(xhr) {
            alert('Error al consultar el transportista.');
            console.log(xhr);
        }
    });
}

function consultarRUCAgricultorDesdeTD(button) {
    // Obtener el ID del botón clickeado
    var id = button.getAttribute('data-id');
    // Obtener el RUC de la fila específica
    var ruc = button.closest('tr').querySelector('.ruc-agricultor').innerText.trim();
    
    $.ajax({
        url: "{{ route('ruc.agricultor') }}",
        method: 'POST',
        data: {
            '_token': '{{ csrf_token() }}',
            'id_agricultor': id,
            'ruc_agricultor': ruc
        },
        success: function(response) {
            console.log(response);
            if (response.error) {
                alert(response.error);
            } else {
                document.getElementById('razonSocialInput').value = response.razon_social;
                document.getElementById('direccionInput').value = response.direccion;
                document.getElementById('rucInput').value = response.ruc;
                document.getElementById('cerrarModalAgricultor').click();
            }
        },
        error: function(xhr) {
            alert('Error al consultar el agricultor.');
            console.log(xhr);
        }
    });
}

$('#guiaRemisionForm').submit(function(e) {
    e.preventDefault();
    
    $.ajax({
        url: $(this).attr('action'),
        method: 'POST',
        data: $(this).serialize(),
        success: function(response) {
            if (response.status === 'success') {
                Swal.fire({
                    icon: 'success',
                    title: '¡Éxito!',
                    text: response.message,
                    showConfirmButton: false,
                    timer: 1500
                }).then(() => {
                    // Opcional: limpiar el formulario o redirigir
                    window.location.reload();
                });
            }
        },
        error: function(xhr) {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: xhr.responseJSON.message
            });
        }
    });
});

</script>

@stop
