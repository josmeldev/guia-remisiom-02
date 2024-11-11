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

    <div class="dropdown  text-right">
        <!-- Botón del dropdown -->
        <button class="btn btn-outline-secondary mb-1" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <!-- Icono dentro del botón -->
            <span class="float-right">
                <i class="fas fa-ellipsis-v"></i>
            </span>
        </button>
        <!-- Menú del dropdown -->
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
            <button class="btn  mb-3" type="button" data-toggle="collapse" data-target="#MasOpciones" aria-expanded="false" aria-controls="tablaVehiculos">
                Más Opciones
            </button>
            <a class="dropdown-item" href="#">Opción 2</a>
            <a class="dropdown-item" href="#">Opción 3</a>

        </div>
    </div>
   <!-- Script para manejar el despliegue del menú -->
<script>
    $(document).ready(function(){
        $(".dropdown-menu").hide();
        $("#dropdownMenuButton").click(function(){
            $(".dropdown-menu").toggle();
        });
    });

    $(document).click(function(e) {
            if (!$(e.target).closest('.dropdown').length) {
                $(".dropdown-menu").hide();
            }
        });
    </script>


<div class="collapse" id="MasOpciones">
    <div class="col-md-12 row ">
        <div class="col-md-8">
            <div class="collapse" id="formAgricultor">
                <div class="card">
                    <div class="card-header bg-blue">
                        <h3 class="card-title">Registrar Agricultor</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('agricultor.store') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="ruc" class="form-label" >RUC:</label>
                                        <input type="text" class="form-control" id="rucAgricultor" name="ruc" required maxlength="11" data-token="{{ env('RUC_API_TOKEN') }}" oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 11);" >
                                    </div>
                                    <div class="mb-3">
                                        <label for="razon_social" class="form-label">Razón Social:</label>
                                        <input type="text" class="form-control" id="razonSocialAgricultor" name="razon_social" required maxlength="100">
                                    </div>
                                    <div class="mb-3">
                                        <label for="direccion" class="form-label">Dirección:</label>
                                        <input type="text" class="form-control" id="direccionAgricultor" name="direccion" required maxlength="100">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="apellidos" class="form-label">Apellidos:</label>
                                        <input type="text" class="form-control" id="apellidos" name="apellidos" maxlength="100">
                                    </div>
                                    <div class="mb-3">
                                        <label for="nombres" class="form-label">Nombres:</label>
                                        <input type="text" class="form-control" id="nombres" name="nombres" maxlength="100">
                                    </div>
                                    <div class="mb-3">
                                        <label for="dni" class="form-label">DNI:</label>
                                        <input type="text" class="form-control" id="dni" name="dni" maxlength="8">
                                    </div>

                                </div>
                            </div>
                            <div class="row justify-content-center mb-0">

                                <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Registrar</button>
                            </div>

                        </form>

                        <script src="{{ asset('js/api.js') }}"></script>

                    </div>
                    <div class="card-footer mb-0 mt-0">

                    </div>
                </div>

            </div>


        </div>
        <div class="col-md-2 ">
            <div class="card bg-yellow text-white rounded shadow ml-auto" style="width: 10rem;">
                <div class="card-header bg-red text-center p-1">
                    <h6 class="mb-0">Registrar Agricultor</h6>
                </div>
                <div class="card-body p-2">
                    <div class="d-flex align-items-center justify-content-center">
                        <i class=" fa-lg mr-2"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="32" height="32" color="#000000" fill="none">
                            <path d="M2.5 12C2.5 7.52166 2.5 5.28249 3.89124 3.89124C5.28249 2.5 7.52166 2.5 12 2.5C16.4783 2.5 18.7175 2.5 20.1088 3.89124C21.5 5.28249 21.5 7.52166 21.5 12C21.5 16.4783 21.5 18.7175 20.1088 20.1088C18.7175 21.5 16.4783 21.5 12 21.5C7.52166 21.5 5.28249 21.5 3.89124 20.1088C2.5 18.7175 2.5 16.4783 2.5 12Z" stroke="currentColor" stroke-width="1.5" />
                            <path d="M11 7L17 7" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                            <path d="M7 7L8 7" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                            <path d="M7 12L8 12" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                            <path d="M7 17L8 17" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                            <path d="M11 12L17 12" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                            <path d="M11 17L17 17" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                        </svg></i>
                        <button class="btn btn-outline-secondary " type="button" data-toggle="collapse" data-target="#formAgricultor" aria-expanded="false" aria-controls="formVehiculo" style="font-size: 10px">
                            <i class="fas fa-plus"></i> Ver más
                        </button>

                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-2  ">
            <div class="card bg-yellow text-white rounded shadow ml-auto" style="width: 10rem;">
                <div class="card-header bg-red text-center p-1">
                    <h6 class="mb-0">Agricultores</h6>
                </div>
                <div class="card-body p-2">
                    <div class="d-flex align-items-center justify-content-center">
                        <i class=" fa-lg"><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-trees" width="32" height="32" viewBox="0 0 24 24" stroke-width="1.5" stroke="#000000" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                            <path d="M16 5l3 3l-2 1l4 4l-3 1l4 4h-9" />
                            <path d="M15 21l0 -3" />
                            <path d="M8 13l-2 -2" />
                            <path d="M8 12l2 -2" />
                            <path d="M8 21v-13" />
                            <path d="M5.824 16a3 3 0 0 1 -2.743 -3.69a3 3 0 0 1 .304 -4.833a3 3 0 0 1 4.615 -3.707a3 3 0 0 1 4.614 3.707a3 3 0 0 1 .305 4.833a3 3 0 0 1 -2.919 3.695h-4z" />
                          </svg></i>
                        <h4 class="ml-2 mb-0">{{$totalAgricultores}}</h4>
                    </div>
                </div>
            </div>
        </div>


        <style>
            h4{
                font-size: 12px;
                font-weight: bold;
                height: 30px;
                width: 30px;
                background-color: rgb(55, 0, 255);
                border-radius: 50%;
                color: azure;
                align-items: center;
                align-content: center;
                text-align: center;
                justify-content: center;
                justify-items: center;
            }
        </style>

    </div>




</div>







    <div class="card">
        <div class="card-header bg-primary">
            <h5 class="card-title">Buscar Agricultor</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('agricultores.buscar') }}" method="GET">
                <div class="row">
                    <div class="col-md-3">
                        <div class="mb-3">
                            <label for="ruc" class="form-label">RUC:</label>
                            <input type="text" class="form-control" id="ruc" name="ruc" oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 11);">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="mb-3">
                            <label for="razon_social" class="form-label">Razón Social:</label>
                            <input type="text" class="form-control" id="razon_social" name="razon_social">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="mb-3">
                            <label for="direccion" class="form-label">Dirección:</label>
                            <input type="text" class="form-control" id="direccion" name="direccion">
                        </div>
                    </div>
                    
                </div>
                <div class="row">
                    
                    <div class="col-md-3">
                        <div class="mb-3">
                            <label for="dni" class="form-label">DNI:</label>
                            <input type="text" class="form-control" id="dni" name="dni" oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 8);">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="mb-3">
                            <label for="numero_cuenta" class="form-label">Número de Cuenta:</label>
                            <input type="text" class="form-control" id="numero_cuenta" name="numero_cuenta">
                        </div>
                    </div> 
                    <div class="col-md-3">
                        <div class="mb-3">
                            <label for="banco" class="form-label">Banco:</label>
                            <input type="text" class="form-control" id="banco" name="banco">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-3">
                        <div class="mb-3">
                            <label for="cci" class="form-label">CCI:</label>
                            <input type="text" class="form-control" id="cci" name="cci">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="mb-3">
                            <label for="email" class="form-label">Correo Electrónico:</label>
                            <input type="email" class="form-control" id="correo_electronico" name="correo_electronico">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="mb-3">
                            <label for="telefono" class="form-label">Teléfono:</label>
                            <input type="text" class="form-control" id="telefono" name="telefono" oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 9);">
                        </div>
                    </div>
                </div>


                <button type="submit" class="btn btn-outline-primary">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24" color="#000000" fill="none">
                        <path d="M20.9843 5C21.0344 4.28926 20.9732 3.83888 20.672 3.5074C20.2111 3 19.396 3 17.7657 3H6.23433C4.60404 3 3.7889 3 3.32795 3.5074C2.86701 4.0148 2.96811 4.8008 3.17033 6.3728C3.22938 6.8319 3.3276 7.09253 3.62734 7.44867C4.59564 8.59915 6.36901 10.6456 8.85746 12.5061C9.08486 12.6761 9.23409 12.9539 9.25927 13.2614C9.53961 16.6864 9.79643 19.0261 9.93278 20.1778C10.0043 20.782 10.6741 21.2466 11.226 20.8563C12.1532 20.2006 13.8853 19.4657 14.1141 18.2442C14.1986 17.7934 14.3136 17.0803 14.445 16" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M15.0132 6L14.5139 8.08437L15.3434 7.56607C15.9343 7.11729 16.6687 6.85119 17.4646 6.85119C19.4172 6.85119 21 8.45151 21 10.4256C21 12.3997 19.4172 14 17.4646 14C15.7543 14 14.3276 12.772 14 11.1405" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                    Filtrar</button>
                <a href="/agricultores" class="btn btn-outline-secondary mr-2">
                    <i class="fas fa-undo"></i> Restablecer
                </a>
            </form>


        </div>
        <div class="card-footer">

        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h5 class="card-title">Lista de Agricultores</h5>
        </div>

        <div class="card-body p-2" style="max-height: 400px;overflow-y: auto;scrollbar-width: thin">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>RUC</th>
                        <th>Razón Social</th>
                        <th>Dirección</th>
                        
                        <th>DNI</th>
                        <th>Numero de Cuenta</th>
                        <th>Banco</th>
                        <th>CCI</th>
                        <th>Correo Electrónico</th>
                        <th>Teléfono</th>
                        <td>Acciones</td>

                    </tr>

                </thead>
                <tbody>
                    @php $contador = 1; @endphp
                        @foreach ($agricultores as $agricultor)
                        <tr>
                            <td>{{ $contador }}</td>
                            <td>{{ $agricultor->ruc }}</td>
                            <td>{{ $agricultor->razon_social }}</td>
                            <td>{{ $agricultor->direccion }}</td>
                            
                            <td>{{ $agricultor->dni }}</td>
                            <td>{{ $agricultor->numero_cuenta }}</td>
                            <td>{{ $agricultor->banco }}</td>
                            <td>{{ $agricultor->cci }}</td>
                            <td>{{ $agricultor->correo_electronico}}</td>
                            <td>{{ $agricultor->telefono }}</td>


                            <td>
                                <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#editModal{{ $agricultor->id }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-edit" width="20" height="20" viewBox="0 0 24 24" stroke-width="2" stroke="#ffffff" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                        <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" />
                                        <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" />
                                        <path d="M16 5l3 3" />
                                      </svg>
                                </button>
                                <div class="modal fade" id="editModal{{ $agricultor->id }}" tabindex="-1" aria-labelledby="editModalLabel{{ $agricultor->id }}" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header bg-primary">
                                                <h5 class="modal-title" id="editModalLabel{{ $agricultor->id }}">Editar Conductor</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <!-- Formulario para editar la guía de remisión -->
                                                <form id="editForm{{ $agricultor->id }}" action="{{ route('agricultor.update', $agricultor->id) }}" method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <!-- Campos para editar -->
                                            
                                                    <div class="form-group row">
                                                        <div class="col-md-6">
                                                            <label for="dni">DNI:</label>
                                                            <input type="text" class="form-control" id="dni" name="dni" value="{{ $agricultor->dni }}" maxlength="8" oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 8);">
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label for="ruc">RUC:</label>
                                                            <input type="text" class="form-control" id="ruc" name="ruc" value="{{ $agricultor->ruc }}" maxlength="11" oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 11);">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <div class="col-md-6">
                                                            <label for="razon_social">Razón Social:</label>
                                                            <input type="text" class="form-control" id="razon_social" name="razon_social" value="{{ $agricultor->razon_social }}">
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label for="direccion">Dirección:</label>
                                                            <input type="text" class="form-control" id="direccion" name="direccion" value="{{ $agricultor->direccion }}">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <div class="col-md-6">
                                                            <label for="numero_cuenta">Número de Cuenta:</label>
                                                            <input type="text" class="form-control" id="numero_cuenta" name="numero_cuenta" value="{{ $agricultor->numero_cuenta }}">
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label for="banco">Banco:</label>
                                                            <input type="text" class="form-control" id="banco" name="banco" value="{{ $agricultor->banco }}">
                                                        </div>

                                                    </div>
                                                    <div class="form-group row">
                                                        <div class="col-md-6">
                                                            <label for="cci">CCI:</label>
                                                            <input type="text" class="form-control" id="cci" name="cci" value="{{ $agricultor->cci }}">
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label for="email">Correo Electrónico:</label>
                                                            <input type="email" class="form-control" id="correo_electronico" name="correo_electronico" value="{{ $agricultor->correo_electronico }}">
                                                        </div>        
                                                                
                                                    </div>
                                                    <div class="form-group row">
                                                        <div class="col-md-6">
                                                            <label for="telefono">Teléfono:</label>
                                                            <input type="text" class="form-control" id="telefono" name="telefono" value="{{ $agricultor->telefono }}" maxlength="9" oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 9);">
                                                        </div>           
                                                                
                                                    </div>
                                                    <!-- Agrega más campos aquí si es necesario -->
                                                    <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                                                </form>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <form action="{{ route('pago.destroy', $agricultor->id) }}" method="POST" style="display: inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-trash-filled" width="20" height="20" viewBox="0 0 24 24" stroke-width="2" stroke="#ffffff" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                            <path d="M20 6a1 1 0 0 1 .117 1.993l-.117 .007h-.081l-.919 11a3 3 0 0 1 -2.824 2.995l-.176 .005h-8c-1.598 0 -2.904 -1.249 -2.992 -2.75l-.005 -.167l-.923 -11.083h-.08a1 1 0 0 1 -.117 -1.993l.117 -.007h16z" stroke-width="0" fill="currentColor" />
                                            <path d="M14 2a2 2 0 0 1 2 2a1 1 0 0 1 -1.993 .117l-.007 -.117h-4l-.007 .117a1 1 0 0 1 -1.993 -.117a2 2 0 0 1 1.85 -1.995l.15 -.005h4z" stroke-width="0" fill="currentColor" />
                                          </svg>
                                    </button>
                                </form>
                            </td>
                        </tr>

                        @php $contador++; @endphp
                    @endforeach
                </tbody>

            </table>

        </div>



    </div>
@endsection

@section('css')
<link rel="stylesheet" href="{{ asset('css/styleTables.css') }}">


@endsection

@section('js')

@endsection
