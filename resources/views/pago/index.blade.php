@extends('layouts.template')
<!-- Aquí puedes agregar tu formulario, tabla u otro contenido -->
<script src="{{ asset('js/Chart.min.js') }}"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

<link rel="stylesheet" href="{{ asset('css/pago.css') }}">
<link rel="stylesheet" href="{{ asset('css/styleTables.css') }}">
<link href="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/3.1.0/css/adminlte.min.css" rel="stylesheet">

@section('content')

<nav aria-label="breadcrumb" style="line-height: 0; padding-top: 0; padding-bottom: 0; ">
    <ol class="breadcrumb small" style="font-size: 1rem;">
        {{ Breadcrumbs::render('pago.index') }}
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

    @if (session('info'))
        <div class="alert alert-info">
            {{ session('info') }}
        </div>
    @endif

    <div style="text-align: center;color:green">
        <hr style="border-top: 2px dashed green; width: 30%; max-width: 320px; display: inline-block; margin-right: 2vw;">
        <h6 style="display: inline-block; font-size: 1.5vw; margin: 0;">Sección de Pagos a los Agricultores</h6>
        <hr style="border-top: 2px dashed green; width: 30%; max-width: 320px; display: inline-block; margin-left: 2vw;">
    </div>




    <hr style="border-top: 2px solid #ccc;">



        <div class="card-group mb-3">

            <div class="card shadow p-1">
                <div class="card-header bg-purple text-center rounded">
                    <h5 class="card-title">
                        <i class="fas fa-file-alt"></i> Total de Pagos Registrados
                    </h5>
                </div>

                <div class="card-body ">
                    <div class="row">
                        <div class="col-md-6 d-flex justify-content-center align-items-center" >
                            <img class="card-img-top rounded" src="https://cdn2.iconfinder.com/data/icons/business-rounded-2/512/xxx009-1024.png" alt="Imagen de la Tarjeta" >
                          </div>

                        <div class="col-md-6 d-flex justify-content-center align-items-center">
                            <div class="circle border shadow" style="width: 100%; height: 100%; border-radius: 50%; display: flex; justify-content: center; align-items: center;">
                                <h3>{{ $totalPagos }}</h3>
                            </div>
                        </div>
                    </div >
                    <div class="row mt-2 d-flex">
                        <div class="col-md-6 flex-fill">
                            <div class="bg-green rounded text-center mx-2">
                                <span><i class="fas fa-check-circle"></i> Pagados:</span>
                                <h5 class="bg-white rounded">{{ $totalAgricultoresConSaldoPositivo->total_agricultores_con_saldo_positivo }}</h5>
                            </div>
                        </div>

                        <div class="col-md-6 flex-fill">
                            <div class="bg-red rounded text-center mx-2">
                                <span><i class="fas fa-times-circle"></i> No Pagados:</span>
                                <h5 class="bg-white rounded">{{ $totalAgricultoresConSaldoNegativo->total_agricultores_con_saldo_negativo }}</h5>
                            </div>
                        </div>
                    </div>


                </div>
                <div class="card-footer">
                    <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapsibleSection" aria-expanded="false" aria-controls="collapsibleSection" title="Lista de Pagos">
                        <span id="toggleIcon"><i class="fas fa-plus"></i></span>
                    </button>
                    <a href="#" class="card-link fa">Ver más <i class="fas fa-chevron-right mb-2"></i></a>
                </div>
            </div>



            <div class="card  shadow p-1">
                <div class="card-header bg-orange rounded">
                    <h5 class="card-title" style="color:white">
                        <i class="fas fa-coins"></i> Total Pagado
                    </h5>
                </div>
                <div class="card-body align-content-center" >
                    <div class="row" >
                        <div class="col">
                            <div class="row">
                                <div class="col-md-6 text-center">
                                    <img src="https://cdn-icons-png.flaticon.com/512/124/124353.png" alt="Imagen de Agricultor" width="100">
                                </div>
                                <div class="col-md-6 circle border shadow text-center">

                                    <span>Total a Pagar:<h5 >S/. {{ number_format($PagoTotalAgri->total_pago),0 }}</h5></span>
                                </div>

                            </div>

                        </div>

                    </div>
                    <hr style="border: solid 0.1px rgb(177, 202, 228)">
                    <div class="row mt-2">
                        <div class="col-md-6 bg-purple rounded shadow" >
                            <span><i class="fas fa-check-circle text-success"></i> Cancelado: <h5 class="bg-white rounded">S/. {{ number_format($SumMonto, 0) }}</h5></span>
                        </div>
                        <div class="col-md-6 bg-yellow rounded shadow">
                            <span><i class="fas fa-times-circle text-danger"></i> No Cancelado:  <h5 class="bg-white rounded">S/. {{ number_format($TotalFaltaPagar->total_falta_pagar, 0) }}</h5></span>
                        </div>
                    </div>

                </div>
                <div class="card-footer text-right">
                    <a href="#" class="card-link fa">Ver más <i class="fas fa-chevron-right"></i></a>

                </div >
            </div>

            <div class="card  shadow p-1">
                <div class="card-header bg-blue rounded">
                    <h5 class="card-title" style="color:white">
                        <i class="fas fa-chart-line"></i> Tendencias
                    </h5>
                </div>

               <div class="card-body">
                <canvas id="grafico-lineal" ></canvas>
               </div>
               <div class="card-footer text-right">

                <a href="#" class="card-link fa">Ver más <i class="fas fa-chevron-right"></i></a>


               </div>
            </div>


        </div>














        <div class="container overflow-hidden text-center">
            <div class="row gx-5">
                <div class="col-md-6 bg-yellow shadow-lg ">
                    <div class="p-3">
                        <h5 class="mb-3" style="color:white">Top 5 Agricultores con Saldo Pendiente Más Negativo</h5>
                        <ul class="list-group">
                            @foreach ($agricultoresConSaldoNegativo as $index => $agricultor)
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <div style="max-width: 375px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">
                                        {{ $index + 1 }}. {{ $agricultor->agricultor_nombre }}
                                    </div>
                                    <span class="badge badge-danger badge-pill">{{ $agricultor->saldo_pendiente }}</span>
                                </li>
                            @endforeach
                        </ul>
                        <div class="row pr-2">
                            <div class="col-md-5 text-left mt-3">
                                <a href="/agricultores_saldo_negativo" class="btn btn-primary">
                                    <i class="fas fa-plus-circle"></i> Ver más
                                </a>



                            </div>
                            <div class="col-md-7 text-center mt-3 pt-2  bg-orange d-flex justify-content-center align-items-center rounded" >
                                <h5 style="color:white"> <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24" color="#ffffff" fill="none">
                                    <path d="M14.9998 14.4986C14.9981 15.0266 14.983 15.3137 14.8502 15.5299C14.5236 16.0612 13.8736 15.9976 13.3241 15.9976H10.7994C9.69158 15.9976 9.13766 15.9976 9.01957 15.6713C8.90149 15.345 9.32205 14.9765 10.1632 14.2394L11.8529 12.7588C12.2554 12.4062 12.4566 12.2298 12.4566 12C12.4566 11.7702 12.2554 11.5938 11.8529 11.2412L10.1632 9.76058C9.32205 9.02355 8.90149 8.65503 9.01957 8.3287C9.13766 8.00237 9.69158 8.00237 10.7994 8.00237H13.3241C13.8736 8.00237 14.5236 7.93885 14.8502 8.47006C14.983 8.68627 14.9981 8.97338 14.9998 9.50144" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                    <circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="1.5" />
                                </svg> Total: S/{{ $sumaSaldoNegativo5->suma_total_saldo_negativo }}</h5>
                            </div>

                        </div>

                    </div>
                </div>



                <div class="col-md-6">
                    <canvas id="bar-chart" width="200" height="140"></canvas>

                </div>
                <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                <script>
                    // Función para truncar los nombres de los agricultores si son demasiado largos
                    function truncateText(str, maxLength) {
                        if (str.length > maxLength) {
                            return str.substring(0, maxLength - 3) + '...'; // Agregar puntos suspensivos
                        } else {
                            return str;
                        }
                    }

                    var nombresAgricultores = {!! json_encode($nombresAgricultores) !!};
                    var truncatedNombresAgricultores = nombresAgricultores.map(function(nombre) {
                        return truncateText(nombre, 15); // Truncar nombres a 15 caracteres
                    });

                    var saldosNegativos = {!! json_encode($saldosNegativos) !!};

                    // Convertir los saldos negativos a positivos
                    var saldosPositivos = saldosNegativos.map(function(saldo) {
                        return Math.abs(saldo);
                    });

                    var ctx = document.getElementById('bar-chart').getContext('2d');
                    var myChart = new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: truncatedNombresAgricultores, // Nombres truncados de los agricultores en el eje Y
                            datasets: [{
                                label: 'Saldo Negativo',
                                data: saldosPositivos, // Saldos positivos en el eje X
                                backgroundColor: [
                                    'rgba(255, 99, 132, 0.5)',  // Rojo
                                    'rgba(54, 162, 235, 0.5)',   // Azul
                                    'rgba(255, 205, 86, 0.5)',   // Amarillo
                                    'rgba(75, 192, 192, 0.5)',   // Verde
                                    'rgba(153, 102, 255, 0.5)', // Púrpura
                                    'rgba(255, 159, 64, 0.5)',   // Naranja
                                    'rgba(255, 99, 132, 0.5)',  // Rojo
                                    'rgba(54, 162, 235, 0.5)',   // Azul
                                    'rgba(255, 205, 86, 0.5)',   // Amarillo
                                    'rgba(75, 192, 192, 0.5)'   // Verde
                                ],
                                borderColor: [
                                    'rgba(255, 99, 132, 1)',    // Rojo
                                    'rgba(54, 162, 235, 1)',    // Azul
                                    'rgba(255, 205, 86, 1)',    // Amarillo
                                    'rgba(75, 192, 192, 1)',    // Verde
                                    'rgba(153, 102, 255, 1)',   // Púrpura
                                    'rgba(255, 159, 64, 1)',    // Naranja
                                    'rgba(255, 99, 132, 1)',    // Rojo
                                    'rgba(54, 162, 235, 1)',    // Azul
                                    'rgba(255, 205, 86, 1)',    // Amarillo
                                    'rgba(75, 192, 192, 1)'     // Verde
                                ],
                                borderWidth: 1
                            }]
                        },
                        options: {
                            indexAxis: 'x', // Cambia el eje de referencia a X para mostrar los nombres de agricultores al comienzo de las barras
                            scales: {
                                x: {
                                    title: {
                                        display: true,
                                        text: 'Agricultores'
                                    },
                                    reverse: false // Invierte el eje X para que las barras inicien de izquierda a derecha
                                },
                                y: {
                                    title: {
                                        display: true,
                                        text: 'Saldo Negativo'
                                    }
                                }
                            }
                        }
                    });
                </script>


            </div>
        </div>

        <div class="card card-body">

            <section class="general mt-3">
                <form action="{{ route('pago.buscar') }}" method="GET" style="width: 100%;">
                    <div class="container p-4" style="box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); min-width: 95%;">
                        <h4 class="block">Filtrar por:</h4>
                        <div class="row mb-2">
                            <div class="col-md-3">
                                <input type="text" class="form-control" name="Adelanto" placeholder="Adelanto">
                            </div>
                            <div class="col-md-3">
                                <select name="Metodo_Pago" class="form-control">
                                    <option value="">Seleccionar método de pago</option>
                                    <option value="Efectivo">Efectivo</option>
                                    <option value="Transferencias bancarias">Transferencia bancaria</option>
                                    <option value="Tarjetas de débito">Tarjeta de débito</option>
                                    <option value="Pagos electrónicos">Pagos electrónicos</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <select id="tipoPago" name="Tipo_Pago" class="form-control">
                                    <option value="">Seleccionar tipo de pago</option>
                                    <option value="Yape">Yape</option>
                                    <option value="Tunki">Tunki</option>
                                    <option value="BIM">BIM</option>
                                    <!-- Agrega aquí otras opciones si es necesario -->
                                </select>
                            </div>
                            <div class="col-md-3">
                                <input type="text" class="form-control" name="Nro_Operacion" placeholder="Número de Operación">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-3">
                                <input type="text" class="form-control" name="Monto" placeholder="Monto">
                            </div>
                            <div class="col-md-3">
                                <input type="text" class="form-control" name="Precio_Unitario" placeholder="Precio Unitario">
                            </div>
                            <div class="col-md-6">
                                <select class="form-control" name="agricultor_id" id="agricultor_id">
                                    <option value="">Seleccionar la Razon Social</option>
                                    @foreach ($guias as $guia)
                                        <?php $razon_social = strlen($guia->agricultor->razon_social) > 53 ? substr($guia->agricultor->razon_social, 0,53) . '...' : $guia->agricultor->razon_social; ?>
                                        <option value="{{ $guia->agricultor_id }}">{{ $razon_social }}</option>
                                    @endforeach
                                </select>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <a href="/pagos" class="btn btn-secondary mr-2">
                                    <i class="fas fa-undo"></i> Restablecer
                                </a>
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-filter"></i> Filtrar
                                </button>
                            </div>
                        </div>
                    </div>
                </form>







            </section>



            <div class="card" >
                <div class="card-header">
                    <h3 class="card-title">Lista de Pagos</h3>
                    <div class="text-right">
                        <button type="button" class="btn btn-danger" onclick="borrarSeleccionadosOtodo()"
                            title=" Borrar Seleccionados">
                            <i class="fas fa-trash-alt"></i>
                        </button>
                        
                    </div>

                    


                </div>

                <div class="card-body p-2" style="width: auto;height: 300px;overflow: auto;scrollbar-width: thin; ">
                    <table class="table table-striped" id="tablaPagos" style="position: relative">
                        <thead>
                            <tr>
                                <th><input type="checkbox" id="selectAllCheckbox" onchange="selectAll()"
                                        style="cursor: pointer;"></th>
                                <th>N°</th>
                                <th>Razon Social</th>
                                <th>Metodo Pago</th>
                                <th>Precio Unitario</th>
                                <th>Adelanto</th>
                                <th>Monto Pagado</th>
                                <th>Acciones</th>
                            </tr>

                        </thead>
                        <tbody>
                            @foreach ($pagos as $index => $pago)
                                <tr>
                                    <td><input type="checkbox" class="deleteCheckbox" value="{{ $pago->id }}"
                                            style="cursor: pointer;"></td>
                                    <td>{{ $index + 1 }}</td>
                                    <td style="max-width: 200px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">{{ $pago->guia->agricultor->razon_social }}</td>
                                    <td>{{ $pago->Metodo_Pago }}</td>
                                    <td>{{ $pago->Precio_Unitario }}</td>
                                    <td>{{ $pago->Adelanto }}</td>

                                    <td>{{ $pago->Monto }}</td>

                                    <td>
                                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal"
                                            data-target="#editModal{{ $pago->id }}">
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                class="icon icon-tabler icon-tabler-edit" width="20"
                                                height="20" viewBox="0 0 24 24" stroke-width="1.5"
                                                stroke="#ffffff" fill="none" stroke-linecap="round"
                                                stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" />
                                                <path
                                                    d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" />
                                                <path d="M16 5l3 3" />
                                            </svg>
                                        </button>
                                        <div class="modal fade" id="editModal{{ $pago->id }}" tabindex="-1"
                                            aria-labelledby="editModalLabel{{ $pago->id }}" aria-hidden="true">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header bg-primary">
                                                        <h5 class="modal-title"
                                                            id="editModalLabel{{ $pago->id }}">Editar Pagos</h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <!-- Formulario para editar la guía de remisión -->
                                                        <form id="editForm{{ $pago->id }}" action="{{ route('pago.update', $pago->id) }}" method="POST" class="form-horizontal">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="form-group row">
                                                                <div class="col">
                                                                    <label for="Adelanto" class="form-control-label">Adelanto:</label>
                                                                    <input type="number" name="Adelanto" class="form-control mt-2 @error('Adelanto') is-invalid @enderror" id="adelanto" placeholder=" " value="{{ $pago->Adelanto }}">
                                                                    @error('Adelanto')
                                                                        <span class="invalid-feedback" role="alert">
                                                                            <strong>{{ $message }}</strong>
                                                                        </span>
                                                                    @enderror
                                                                </div>
                                                                <div class="col">
                                                                    <label for="Precio_Unitario" class="form-control-label">Precio Unitario:</label>
                                                                    <input type="number" class="form-control mt-2 @error('Precio_Unitario') is-invalid @enderror" id="precio_unitario" name="Precio_Unitario" placeholder=" " value="{{ $pago->Precio_Unitario }}">
                                                                    @error('Precio_Unitario')
                                                                        <span class="invalid-feedback" role="alert">
                                                                            <strong>{{ $message }}</strong>
                                                                        </span>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <div class="col">
                                                                    <label for="guia_id" class="form-control-label">Guía ID:</label>
                                                                    <select name="guia_id" class="form-control mt-2 @error('guia_id') is-invalid @enderror" id="guia_id">
                                                                        <option value="">Seleccionar Guía ID:</option>
                                                                        @foreach ($guias as $guia)
                                                                        <option value="{{ $guia->id }}" {{ $guia->id == $pago->guia_id ? 'selected' : '' }}>
                                                                            {{ $guia->id }}
                                                                        </option>
                                                                        @endforeach
                                                                    </select>
                                                                    @error('guia_id')
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                    @enderror
                                                                </div>
                                                                <div class="col">
                                                                    <label for="Metodo_Pago" class="form-control-label">Método de Pago:</label>
                                                                    <select name="Metodo_Pago" class="form-control mt-2" id="metodo_pago" onchange="mostrarCampos()">
                                                                        <option value="">Seleccionar método de pago</option>
                                                                        <option value="Efectivo" {{ $pago->Metodo_Pago == 'Efectivo' ? 'selected' : '' }}>Efectivo</option>
                                                                        <option value="Transferencias bancarias" {{ $pago->Metodo_Pago == 'Transferencias bancarias' ? 'selected' : '' }}>Transferencia bancaria</option>
                                                                        <option value="Tarjetas de débito" {{ $pago->Metodo_Pago == 'Tarjetas de débito' ? 'selected' : '' }}>Tarjeta de débito</option>
                                                                        <option value="Pagos electrónicos" {{ $pago->Metodo_Pago == 'Pagos electrónicos' ? 'selected' : '' }}>Pagos electrónicos</option>
                                                                    </select>
                                                                </div>
                                                            </div>

                                                            <div class="form-group row">

                                                                <div class="col-md-6 mt-2" id="tipoPagoElectronico" style="{{ $pago->Metodo_Pago === 'Pagos electrónicos' ? 'display: block;' : 'display: none;' }}">
                                                                    <label for="TipoPago" class="form-control-label">Tipo de Pago Electrónico:</label>
                                                                    <select id="tipoPago" name="Tipo_Pago" class="form-control mt-2">
                                                                        <option value="">Seleccionar tipo de pago electrónico</option>
                                                                        <option value="Yape" {{ $pago->Tipo_Pago == 'Yape' ? 'selected' : '' }}>Yape</option>
                                                                        <option value="Tunki" {{ $pago->Tipo_Pago == 'Tunki' ? 'selected' : '' }}>Tunki</option>
                                                                        <option value="BIM" {{ $pago->Tipo_Pago == 'BIM' ? 'selected' : '' }}>BIM</option>
                                                                        <!-- Agrega aquí otras opciones si es necesario -->
                                                                    </select>
                                                                </div>


                                                                <div class="col-md-6 mt-2" id="campoNumeroOperacion" style="{{ in_array($pago->Metodo_Pago, ['Transferencias bancarias', 'Pagos electrónicos']) ? 'display: block;' : 'display: none;' }}">
                                                                    <label for="numeroOperacion" class="form-control-label">Número de Operación:</label>
                                                                    <input type="text" class="form-control mt-2" id="numeroOperacion" name="Nro_Operacion" placeholder=" " maxlength="30" value="{{ $pago->Nro_Operacion }}">
                                                                </div>


                                                            </div>

                                                            <div class="form-group row" >
                                                                <div class="col-md-6 mt-2" id="campoMonto" style="{{ in_array($pago->Metodo_Pago, ['Efectivo', 'Transferencias bancarias', 'Tarjetas de débito', 'Pagos electrónicos']) ? 'display: block;' : 'display: none;' }}">
                                                                    <label for="Monto" class="form-control-label">Monto a pagar:</label>
                                                                    <input type="number" class="form-control mt-2" id="monto" name="Monto" step="0.01" min="0" placeholder=" " maxlength="30" value="{{ $pago->Monto }}">
                                                                </div>
                                                                <div class="col">

                                                                </div>



                                                            </div>









                                                            <div class="form-group row">
                                                                <div class="col text-center">
                                                                    <button type="submit" class="btn btn-primary mt-3">
                                                                        <i class="fas fa-save"></i> Guardar Cambios
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </form>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <form action="{{ route('pago.destroy', $pago->id) }}" method="POST"
                                            style="display: inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                    class="icon icon-tabler icon-tabler-trash-x-filled" width="20"
                                                    height="20" viewBox="0 0 24 24" stroke-width="1.5"
                                                    stroke="#ffffff" fill="none" stroke-linecap="round"
                                                    stroke-linejoin="round">
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
                            var pagosSeleccionados = document.querySelectorAll('.deleteCheckbox:checked');
                            if (pagosSeleccionados.length === 0) {
                                alert('Debes seleccionar al menos un pago  para borrar.');
                            } else {
                                if (confirm('¿Estás seguro de que quieres borrar los pagos selecionados?')) {
                                    var pagoIds = [];
                                    pagosSeleccionados.forEach(function(pago) {
                                        pagoIds.push(pago.value);
                                    });
                                    // Crear un formulario dinámico para enviar la solicitud DELETE
                                    var form = document.createElement('form');
                                    form.method = 'POST';
                                    form.action = '{{ route('pago.borrar_seleccionados') }}';
                                    form.innerHTML = '<input type="hidden" name="_method" value="DELETE">' +
                                        '<input type="hidden" name="_token" value="{{ csrf_token() }}">' +
                                        '<input type="hidden" name="pago_ids" value="' + pagoIds.join(',') + '">';
                                    document.body.appendChild(form);
                                    // Enviar el formulario una vez creado
                                    form.submit();
                                }
                            }
                        }
                    </script>




                </div>
                <div class="card-footer">
                    <nav aria-label="Page navigation example">
                        <ul class="pagination justify-content-center">
                            @if ($pagos->currentPage() > 1)
                                <li class="page-item">
                                    <a class="page-link" href="{{ $pagos->previousPageUrl() }}" tabindex="-1" aria-disabled="true">Previous</a>
                                </li>
                            @endif
                            @for ($i = 1; $i <= $pagos->lastPage(); $i++)
                                <li class="page-item {{ $i == $pagos->currentPage() ? 'active' : '' }}"><a class="page-link" href="{{ $pagos->url($i) }}">{{ $i }}</a></li>
                            @endfor
                            @if ($pagos->currentPage() < $pagos->lastPage())
                                <li class="page-item">
                                    <a class="page-link" href="{{ $pagos->nextPageUrl() }}">Next</a>
                                </li>
                            @endif
                        </ul>
                    </nav>
                </div>

            </div>
        </div>



















    <span>
        <div class="carousel-container">
            <div class="carousel-header">
                <div class="header-item" data-target="past-periods">
                    <i class="fas fa-history"></i>
                    <span>Periodos Pasados</span>

                </div>
                <div class="header-item active" data-target="current-period">
                    <i class="fas fa-calendar-alt"></i>
                    <span>Periodo Actual</span>

                </div>
                <div class="header-item" data-target="future-period">
                    <i class="fas fa-calendar-check"></i>
                    <span>Periodo Futuro</span>
                </div>
            </div>
            <div class="carousel-body">
                <div class="carousel-item" id="past-periods" >



                    <div id="tables-container">

                        <div class="col-md-12 txt-orange">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24" color="#ff9e16" fill="none">
                                <path d="M18 2V4M6 2V4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M11.05 22C7.01949 22 5.00424 22 3.75212 20.6464C2.5 19.2927 2.5 17.1141 2.5 12.7568V12.2432C2.5 7.88594 2.5 5.70728 3.75212 4.35364C5.00424 3 7.01949 3 11.05 3H12.95C16.9805 3 18.9958 3 20.2479 4.35364C21.4267 5.62803 21.4957 7.63364 21.4997 11.5V13" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M13 17.5L21 17.5M13 17.5C13 18.2002 14.9943 19.5085 15.5 20M13 17.5C13 16.7998 14.9943 15.4915 15.5 15" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M3 8H21" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                            <p style="color:orange">Inicio del período pasado: {{ $inicio_periodo_pasado->toDateString() }}</p>
                        </div>

                        <div class="input-group mb-3">
                            <input type="text" id="busqueda" class="form-control" placeholder="Buscar...">
                            <div class="input-group-append">
                                <span class="input-group-text"><i class="fas fa-search"></i></span>
                            </div>
                        </div>



                        <table class="table table-striped" id="tablaPagosPasados">
                            <thead>
                                <tr>
                                    <th>N°</th>
                                    <th>Agricultor</th>
                                    <th>Total Devengado</th>
                                    <th>Adelanto</th>
                                    <th>Total Pago</th>
                                    <th>Saldo</th>
                                    <th>Estado</th>
                                    <th>Acciones
                                        <button class="btn btn-info mt-3" type="button" data-toggle="collapse" data-target="#formularioColapsable" aria-expanded="false" aria-controls="formularioColapsable">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="16" height="16" color="#ffffff" fill="none">
                                                <path d="M4 18.6458V8.05426C4 5.20025 4 3.77325 4.87868 2.88663C5.75736 2 7.17157 2 10 2H14C16.8284 2 18.2426 2 19.1213 2.88663C20 3.77325 20 5.20025 20 8.05426V18.6458C20 20.1575 20 20.9133 19.538 21.2108C18.7831 21.6971 17.6161 20.6774 17.0291 20.3073C16.5441 20.0014 16.3017 19.8485 16.0325 19.8397C15.7417 19.8301 15.4949 19.9768 14.9709 20.3073L13.06 21.5124C12.5445 21.8374 12.2868 22 12 22C11.7132 22 11.4555 21.8374 10.94 21.5124L9.02913 20.3073C8.54415 20.0014 8.30166 19.8485 8.03253 19.8397C7.74172 19.8301 7.49493 19.9768 6.97087 20.3073C6.38395 20.6774 5.21687 21.6971 4.46195 21.2108C4 20.9133 4 20.1575 4 18.6458Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                                <path d="M16 6L8 6" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                                <path d="M10 10H8" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                                <path d="M14.5 9.875C13.6716 9.875 13 10.4626 13 11.1875C13 11.9124 13.6716 12.5 14.5 12.5C15.3284 12.5 16 13.0876 16 13.8125C16 14.5374 15.3284 15.125 14.5 15.125M14.5 9.875C15.1531 9.875 15.7087 10.2402 15.9146 10.75M14.5 9.875V9M14.5 15.125C13.8469 15.125 13.2913 14.7598 13.0854 14.25M14.5 15.125V16" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                                            </svg>
                                        </button>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (empty($pagosPeriodoPasado))
                                    <tr>

                                        <td colspan="4">No hay registros para períodos pasados.</td>
                                    </tr>
                                @else

                                    @foreach ($pagosPeriodoPasado as $index => $pago)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $pago->agricultor_nombre }}</td>
                                            <td>{{ $pago->total_devengado }}</td>
                                            <td>{{ $pago->adelanto_total }}</td>
                                            <td>{{ $pago->monto_total }}</td>
                                            <td>{{ $pago->saldo_pendiente }}</td>
                                            <td>
                                                @if ($pago->monto_total >= $pago->total_a_pagar)
                                                    <span class="text-success"><i class="fas fa-check-circle">
                                                            SC</i></span>
                                                @else
                                                    <span class="text-danger"><i class="fas fa-times-circle">
                                                            NC</i></span>
                                                @endif
                                            </td>
                                            <td>

                                                <div class="collapse mt-3" id="formularioColapsable">
                                                    <form action="{{ route('agregar_pago', ['agricultor_id' => $pago->agricultor_id]) }}" method="POST">
                                                        @csrf
                                                        <input type="hidden" name="guia_id" value="{{ $pago->id }}">
                                                        <div class="form-group mb-0">
                                                            <label for="monto_pago" class="{{ $pago->saldo_pendiente >= 0 ? 'text-success' : 'text-danger' }}">
                                                                Monto {{ $pago->saldo_pendiente >= 0 ? ': Pagado' : 'a Pagar: ' . abs($pago->saldo_pendiente) }}
                                                            </label>
                                                            <div class="input-group">
                                                                <input type="number" name="monto_pago" id="monto_pago" step="0.01" class="form-control form-control-sm" placeholder="Ingrese...">
                                                                <div class="input-group-append">
                                                                    <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <button type="submit" class="btn btn-success btn-sm mt-2"><i class="fas fa-plus-circle"></i> Agregar</button>
                                                    </form>


                                                </div>

                                            </td>

                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>







                    </div>
                </div>






                <div class="carousel-item active" id="current-period">
                    <div class="current-period-content" >
                        <span>

                            <div class="row">


                                <div class="col-md-6">
                                    <p style="color: orange;"><i class="fas fa-play-circle"></i> Inicio del período: <span style="color: orange;">{{ $inicio_periodo->toDateString() }}</span></p>
                                </div>

                                <div class="col-md-6">
                                    <p style="color: orange;"><i class="fas fa-stop-circle"></i> Fin del período: <span style="color: orange;">{{ $fin_periodo->toDateString() }}</span></p>
                                </div>


                                <div class="input-group mb-3">
                                    <input type="text" id="busquedaP" class="form-control" placeholder="Buscar...">
                                    <div class="input-group-append">
                                        <span class="input-group-text"><i class="fas fa-search"></i></span>
                                    </div>
                                </div>



                            </div>



                                <table class="table table-striped" id="tablaPagosPresentes">
                                    <thead>
                                        <tr>
                                            <th>N°</th>
                                            <th>Agricultor Nombre</th>
                                            <th>Total Devengado</th>
                                            <th>Adelanto</th>
                                            <th>Pago Total</th>
                                            <th>Saldo</th>
                                            <th>Estado</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
    @foreach ($pagosPeriodo as $index => $pago)
        <tr>
            <td>{{ $index + 1 }}</td>
            <td>{{ $pago->agricultor_nombre }}</td>
            <td>S/ {{ $pago->total_devengado }}</td>
            <td>S/ {{ $pago->adelanto_total }}</td>
            <td>S/ {{ $pago->total_a_pagar }}</td>
            <td>S/ {{ $pago->saldo_pendiente }}</td>
            <td>
                @if ($pago->monto_total >= $pago->total_a_pagar)
                    <span class="text-success"><i class="fas fa-check-circle"> SC</i></span>
                @else
                    <span class="text-danger"><i class="fas fa-times-circle"> NC</i></span>
                @endif
            </td>
            <td>
                @if ($pago->monto_total < $pago->total_a_pagar)
                    <!-- Dentro de tu vista Blade -->
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal{{ $pago->id }}" title="Agregar Pago">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="16" height="16" color="#ffffff" fill="none">
                            <path d="M16.4407 21.3478L16.9929 20.6576C17.4781 20.0511 18.5085 20.1 18.9184 20.7488C19.4114 21.5295 20.6292 21.3743 20.9669 20.6562C20.9845 20.6189 20.9405 20.7123 20.9781 20.3892C21.0156 20.0661 21 19.9923 20.9687 19.8448L19.0456 10.7641C18.5623 8.48195 18.3206 7.34086 17.4893 6.67043C16.6581 6 15.4848 6 13.1384 6H10.8616C8.51517 6 7.34194 6 6.51066 6.67043C5.67937 7.34086 5.43771 8.48195 4.95439 10.7641L3.0313 19.8448C3.00004 19.9923 2.98441 20.0661 3.02194 20.3892C3.05946 20.7123 3.01554 20.6189 3.0331 20.6562C3.37084 21.3743 4.58856 21.5295 5.08165 20.7488C5.49152 20.1 6.52187 20.0511 7.00709 20.6576L7.55934 21.3478C8.25514 22.2174 9.70819 22.2174 10.404 21.3478L10.4908 21.2392C11.2291 20.3165 12.7709 20.3165 13.5092 21.2392L13.596 21.3478C14.2918 22.2174 15.7449 22.2174 16.4407 21.3478Z" stroke="currentColor" stroke-width="1.5" stroke-linejoin="round" />
                            <path d="M2.48336 9.5C1.89805 8.89199 2.00824 8.10893 2.00824 6.15176C2.00824 4.1946 2.00824 3.21602 2.59355 2.60801C3.17886 2 4.1209 2 6.00497 2L17.9952 2C19.8792 2 20.8213 2 21.4066 2.60801C21.9919 3.21602 21.9919 4.1946 21.9919 6.15176C21.9919 8.10893 22.1014 8.89199 21.5161 9.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                            <path d="M12 10H9" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M14 14L8 14" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal{{ $pago->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Agregar Pago</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('agregar_pago', ['agricultor_id' => $pago->agricultor_id]) }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="guia_id" value="{{ $pago->guia_id }}">
                                        <div class="form-group mb-0">
                                            <label for="monto_pago" class="text-danger">
                                                Monto a Pagar: {{ abs($pago->saldo_pendiente) }}
                                            </label>
                                            <div class="input-group">
                                                <input type="number" name="monto_pago" id="monto_pago" step="0.01" class="form-control form-control-sm" placeholder="Ingrese...">
                                                <div class="input-group-append">
                                                    <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>
                                                </div>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-success btn-sm mt-2"><i class="fas fa-plus-circle"></i> Agregar</button>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </td>
        </tr>
    @endforeach
</tbody>
                                </table>




                        </span>

                    </div>

                    <div class="card-footer">
                        <nav aria-label="Page navigation example">
                            <ul class="pagination justify-content-center">
                                @if ($pagosPeriodo->currentPage() > 1)
                                    <li class="page-item">
                                        <a class="page-link" href="{{ $pagosPeriodo->previousPageUrl() }}" tabindex="-1" aria-disabled="true">Previous</a>
                                    </li>
                                @endif
                                @for ($i = 1; $i <= $pagosPeriodo->lastPage(); $i++)
                                    <li class="page-item {{ $i == $pagosPeriodo->currentPage() ? 'active' : '' }}"><a class="page-link" href="{{ $pagosPeriodo->url($i) }}">{{ $i }}</a></li>
                                @endfor
                                @if ($pagosPeriodo->currentPage() < $pagosPeriodo->lastPage())
                                    <li class="page-item">
                                        <a class="page-link" href="{{ $pagosPeriodo->nextPageUrl() }}">Next</a>
                                    </li>
                                @endif
                            </ul>
                        </nav>
                    </div>


                </div>













                <div class="carousel-item" id="future-period">

                    <div class="col-md-12  text-orange  rounded mb-2 " >
                        <p>
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24" color="#ff9e16" fill="none">
                                <path d="M11.05 22C7.01949 22 5.00424 22 3.75212 20.6464C2.5 19.2927 2.5 17.1141 2.5 12.7568V12.2432C2.5 7.88594 2.5 5.70728 3.75212 4.35364C5.00424 3 7.01949 3 11.05 3H12.95C16.9805 3 18.9958 3 20.2479 4.35364C21.4267 5.62803 21.4957 7.63364 21.4997 11.5V13" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M21 18.5L13 18.5M21 18.5C21 19.2002 19.0057 20.5085 18.5 21M21 18.5C21 17.7998 19.0057 16.4915 18.5 16" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M18 2V4M6 2V4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M3 8H21" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                            Inicio del período futuro: {{ $inicio_periodo_futuro->toDateString() }}
                        </p>
                    </div>



                    <div class="input-group mb-3 " >
                        <input type="text" id="busquedaF" class="form-control" placeholder="Buscar...">
                        <div class="input-group-append">
                            <span class="input-group-text"><i class="fas fa-search"></i></span>
                        </div>
                    </div>

                    <table class="table" id="tablaPagosFuturos">
                        <thead>
                            <tr>
                                <th>N°</th>
                                <th>Agricultor</th>
                                <th>Total Devengado</th>
                                <th>Adelanto</th>
                                <th>Total Pago</th>
                                <th>Saldo</th>
                                <th>Estado</th>

                            </tr>
                        </thead>
                        <tbody>
                            @if (empty($pagosPeriodoFuturo))
                                <tr>
                                    <td colspan="4">No hay registros para períodos futuros.</td>
                                </tr>
                            @else
                                @foreach ($pagosPeriodoFuturo as $index => $pagosF)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>

                                        <td>{{ $pagosF->agricultor_nombre }}</td>
                                        <td>{{ $pagosF->total_devengado }}</td>
                                        <td>{{ $pagosF->adelanto_total }}</td>
                                        <td>{{ $pagosF->total_a_pagar }}</td>
                                        <td>{{ $pagosF->saldo_pendiente }}</td>
                                        <td>
                                            @if ($pagosF->monto_total >= $pagosF->total_a_pagar)
                                                <span class="text-success"><i class="fas fa-check-circle">
                                                        SC</i></span>
                                            @else
                                                <span class="text-danger"><i class="fas fa-times-circle">
                                                        NC</i></span>
                                            @endif
                                        </td>

                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </span>

    <script src="{{ asset('js/search.js') }}"></script>







@endsection

@section('js')
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const headerItems = document.querySelectorAll('.header-item');
            const carouselItems = document.querySelectorAll('.carousel-item');

            headerItems.forEach((item, index) => {
                item.addEventListener('click', () => {
                    // Remover la clase 'active' de todos los elementos del encabezado y del carrusel
                    headerItems.forEach(item => item.classList.remove('active'));
                    carouselItems.forEach(item => item.classList.remove('active'));

                    // Agregar la clase 'active' al elemento clickeado del encabezado y su correspondiente en el carrusel
                    item.classList.add('active');
                    carouselItems[index].classList.add('active');
                });
            });
        });
    </script>


    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>


    <script>
        $(document).ready(function() {
            $('#collapsibleSection').on('shown.bs.collapse', function() {
                $('#toggleIcon').html('<i class="fas fa-minus"></i>');
            });

            $('#collapsibleSection').on('hidden.bs.collapse', function() {
                $('#toggleIcon').html('<i class="fas fa-plus"></i>');
            });
        });
    </script>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    // Datos del gráfico (obtenidos de la vista de Laravel)
    var pagosPorDia = {!! json_encode($pagosPorDiaAgricultor) !!};

    // Procesar los datos para obtener días de la semana y total pagado
    var diasSemana = pagosPorDia.map(function(pago) {
        return pago.dia_semana;
    });
    var totalPagado = pagosPorDia.map(function(pago) {
        return pago.total_pagado;
    });

    // Configuración del gráfico de línea
    var ctxLinea = document.getElementById('grafico-lineal').getContext('2d');
    var graficoLineal = new Chart(ctxLinea, {
        type: 'line',
        data: {
            labels: diasSemana,
            datasets: [{
                label: 'Total Pagado',
                data: totalPagado,
                borderColor: 'green',
                fill: false
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                x: {
                    display: true,
                    title: {
                        display: true,
                        text: 'Días de la Semana' , // Ocultar etiquetas del eje x

                    }


                },
                y: {
                    min: 0, // Establecer el valor mínimo del eje y en 0
                    title: {
                        display: true,
                        text: 'Cantidad' // Título del eje y
                    }
                }
            }
        }
    });
</script>




@endsection
