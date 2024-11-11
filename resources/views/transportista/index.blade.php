@extends('layouts.template')

<link rel="stylesheet" href="{{ asset('css/transportista.css') }}">



@section('content')
<nav aria-label="breadcrumb" style="line-height: 0; padding-top: 0; padding-bottom: 0; ">
    <ol class="breadcrumb small" style="font-size: 1rem;">
        {{ Breadcrumbs::render('transportista.index') }}
    </ol>
</nav>
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


<div style="text-align: center;color:green">
    <hr style="border-top: 2px dashed green; width: 35%; max-width: 320px; display: inline-block; margin-right: 2vw;">
    <h6 style="display: inline-block; font-size: 1.5vw; margin: 0;" class="title">Transportistas Registrados</h6>
    <hr style="border-top: 2px dashed green; width: 35%; max-width: 320px; display: inline-block; margin-left: 2vw;">
</div>


<section class="general mt-3">
    <form action="{{ route('transportista.buscar') }}" method="GET" style="width: 100%;">
        <div class="container p-4" style="box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); min-width: 95%;">
            <h6 class="block">Filtrar por:</h6>
            <div class="d-flex mb-2 ">


                <select class="form-control mr-2  " name="ruc" id="rucSelect">
                    <option value="">Seleccionar RUC</option>
                    @foreach($transportistas as $transportista)
                    <option value="{{ $transportista->RUC }}" data-razon="{{ $transportista->razon_social }}">{{ $transportista->RUC }}</option>
                    @endforeach
                </select>




                <select class="form-control mr-2 " name="razon_social" id="razonSocialSelect">
                    <option value="">Seleccionar Razón Social</option>
                    @foreach($transportistas as $transportista)
                    @php
                    $razonSocial = \Illuminate\Support\Str::limit($transportista->razon_social, 55, '...');
                    @endphp
                    <option value="{{ $transportista->razon_social }}">{{ $razonSocial }}</option>
                    @endforeach
                </select>





                <script>
                    $(document).ready(function() {
                        $('#rucSelect').change(function() {
                            var rucValue = $(this).val();
                            var razonSocial = $(this).find('option:selected').data('razon');
                            $('#razonSocialSelect').val(razonSocial);
                        });
                    });
                </script>

            </div>
            <div class="d-flex mb-2 ">
                <input type="text" class="form-control mr-2" name="campo" placeholder="Campo">
                <!--<input type="text" class="form-control mr-2" name="unidad_tecnica" placeholder="Unidad Técnica">-->
                <input type="text" class="form-control mr-2" name="zona" placeholder="Zona">
                <input type="text" class="form-control mr-2" name="correo_electronico" placeholder="Correo Electrónico">
            </div>
            <div class="d-flex">
                <a href="{{ route('transportista.index') }}" class="btn btn-secondary mr-2">
                    <i class="fas fa-undo"></i> Restablecer
                </a>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-filter"></i> Filtrar
                </button>
            </div>
        </div>
    </form>

</section>


<div class="card">
    <div class="card-header">
        <div class="row col-md-12">

            <h5 class="card-title col-md-9 text-success ">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-clipboard-list" width="28" height="28" viewBox="0 0 24 24" stroke-width="1.5" stroke="#00b341" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path d="M9 5h-2a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-12a2 2 0 0 0 -2 -2h-2" />
                    <path d="M9 3m0 2a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v0a2 2 0 0 1 -2 2h-2a2 2 0 0 1 -2 -2z" />
                    <path d="M9 12l.01 0" />
                    <path d="M13 12l2 0" />
                    <path d="M9 16l.01 0" />
                    <path d="M13 16l2 0" />
                </svg>
                Lista de Transportistas
            </h5>



            <div class=" text-center col-md-3 border rounded  ">
                <button type="button" class="btn btn-danger" onclick="borrarSeleccionadosOtodo()" title=" Borrar Seleccionados">
                    <i class="fas fa-trash-alt"></i>
                </button>
                <!-- Botón para abrir la modal -->
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#crearTransportistaModal">
                    <i class="fas fa-plus"></i>
                </button>


                <!-- Modal de registro de transportista -->
                <div class="modal fade" id="crearTransportistaModal" tabindex="-1" aria-labelledby="crearTransportistaModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header bg-success text-center text-white">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="32" height="32" color="#ffffff" fill="none">
                                    <path d="M12 2H6C3.518 2 3 2.518 3 5V22H15V5C15 2.518 14.482 2 12 2Z" stroke="currentColor" stroke-width="1.5" stroke-linejoin="round" />
                                    <path d="M18 8H15V22H21V11C21 8.518 20.482 8 18 8Z" stroke="currentColor" stroke-width="1.5" stroke-linejoin="round" />
                                    <path d="M8 6L10 6M8 9L10 9M8 12L10 12" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                    <path d="M11.5 22V18C11.5 17.0572 11.5 16.5858 11.2071 16.2929C10.9142 16 10.4428 16 9.5 16H8.5C7.55719 16 7.08579 16 6.79289 16.2929C6.5 16.5858 6.5 17.0572 6.5 18V22" stroke="currentColor" stroke-width="1.5" stroke-linejoin="round" />
                                </svg>
                                <h5 class="modal-title" id="crearTransportistaModalLabel">Registrar Transportista</h5>
                                <button type="button" class="btn-close rounded" data-bs-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <!-- Formulario de registro -->
                                <form id="crearTransportistaForm" action="/transportista" method="POST">
                                    @csrf
                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <!--
                                                <div class="mt-2 text-left">
                                                    <label for="unidad_tecnica" class="form-label">Unidad Técnica:</label>
                                                    <input type="text" class="form-control" id="unidad_tecnica" name="unidad_tecnica" required>
                                                </div>
                                                    -->
                                            <div class=" mt-2 text-left">
                                                <label for="campo" class="form-label">Campo:</label>
                                                <input type="text" class="form-control" id="campo" name="campo" required>
                                            </div>
                                            <div class="mt-2 text-left">
                                                <label for="ruc" class="form-control-label">RUC:</label>
                                                <input type="text" class="form-control " id="rucDos" name="RUC" placeholder=" " data-token="{{ env('RUC_API_TOKEN') }}" maxlength="11" required>
                                            </div>
                                            <div class="mt-2 text-left">
                                                <label for="razonSocial" class="form-control-label">Razon Social:</label>
                                                <input type="text" class="form-control " id="razonSocialDos" name="razon_social" placeholder=" " required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">

                                            <div class="mt-2 text-left">
                                                <label for="direccion" class="form-control-label">Direccion:</label>
                                                <input type="text" class="form-control " id="direccionDos" name="direccion" placeholder=" " required>
                                            </div>

                                            <div class="mt-2 text-left">
                                                <label for="correo_electronico" class="form-label">Correo:</label>
                                                <input type="text" class="form-control" id="correo_electronico" name="correo_electronico" required>
                                            </div>

                                            <div class="mt-2 text-left">
                                                <label for="zona" class="form-label">Zona:</label>
                                                <input type="text" class="form-control" id="zona" name="zona" required>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Agrega más campos si es necesario -->
                                    <div class="modal-footer mt-0 mb-0">
                                        <button type="submit" class="btn btn-success">Guardar</button>
                                        <button type="reset" class="btn btn-secondary">Restablecer</button>
                                    </div>

                                </form>


                                <script src="{{ asset('js/api.js') }}"></script>
                            </div>
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
                    <th><input type="checkbox" id="selectAllCheckbox" onchange="selectAll()" style="cursor: pointer;"></th>
                    <th>ID</th>
                    <!--<th>Unidad Tecnica</th>-->
                    <th>Campo</th>
                    <th>RUC</th>
                    <th>Razon Social</th>
                    <th>Dirección</th>
                    <th>Zona</th>
                    <th>Email</th>
                    <th>Acciones</th>

                </tr>

            </thead>
            <tbody>
                @foreach ($transportistas as $transportista)
                <tr>
                    <td><input type="checkbox" class="deleteCheckbox" value="{{ $transportista->id }}" style="cursor: pointer;"></td>
                    <td>{{ $transportista->id }}</td>
                    <!--<td>{{ $transportista->unidad_tecnica }}</td>-->
                    <td>{{ $transportista->campo }}</td>
                    <td>{{ $transportista->RUC }}</td>
                    <td class="width-td">
                        {{ strlen($transportista->razon_social) > 50 ? substr($transportista->razon_social, 0, 47) . '...' : $transportista->razon_social }}
                    </td>
                    <td class="width-td">
                        {{ strlen($transportista->direccion) > 50 ? substr($transportista->direccion, 0, 47) . '...' : $transportista->direccion }}
                    </td>


                    <td>{{ $transportista->zona }}</td>
                    <td>{{ $transportista->correo_electronico }}</td>


                    <td class="acciones">
                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#editModal{{ $transportista->id }}">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-edit" width="20" height="20" viewBox="0 0 24 24" stroke-width="2" stroke="#ffffff" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" />
                                <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" />
                                <path d="M16 5l3 3" />
                            </svg>
                        </button>
                        <div class="modal fade" id="editModal{{ $transportista->id }}" tabindex="-1" aria-labelledby="editModalLabel{{ $transportista->id }}" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header bg-success">
                                        <h5 class="modal-title text-white" id="editModalLabel{{ $transportista->id }}">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="32" height="32" color="#ffffff" fill="none">
                                                <path d="M12 2H6C3.518 2 3 2.518 3 5V22H15V5C15 2.518 14.482 2 12 2Z" stroke="currentColor" stroke-width="1.5" stroke-linejoin="round" />
                                                <path d="M18 8H15V22H21V11C21 8.518 20.482 8 18 8Z" stroke="currentColor" stroke-width="1.5" stroke-linejoin="round" />
                                                <path d="M8 6L10 6M8 9L10 9M8 12L10 12" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                                <path d="M11.5 22V18C11.5 17.0572 11.5 16.5858 11.2071 16.2929C10.9142 16 10.4428 16 9.5 16H8.5C7.55719 16 7.08579 16 6.79289 16.2929C6.5 16.5858 6.5 17.0572 6.5 18V22" stroke="currentColor" stroke-width="1.5" stroke-linejoin="round" />
                                            </svg>
                                            Editar Transportista
                                        </h5>
                                        <button type="button" class="close " data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <!-- Formulario para editar la guía de remisión -->
                                        <form id="editForm{{ $transportista->id }}" action="{{ route('transportista.update', $transportista->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <!-- Campos para editar -->
                                            <div class="form-group row">
                                                <!--
                                                <div class="col-md-6 ">
                                                    <label for="unidad_tecnica">Unidad Tecnica:</label>
                                                    <input type="text" class="form-control" id="unidad_tecnica" name="unidad_tecnica" value="{{ $transportista->unidad_tecnica }}" required>

                                                </div>-->
                                                <div class="col-md-6">
                                                    <label for="campo">Campo: </label>
                                                    <input type="text" class="form-control" id="campo" name="campo" value="{{ $transportista->campo    }}" required>

                                                </div>

                                            </div>
                                            <div class="form-group row">
                                                <div class="col-md-6 ">
                                                    <label for="RUC">RUC:</label>
                                                    <input type="text" class="form-control" id="RUC" name="RUC" value="{{ $transportista->RUC }}" required>

                                                </div>
                                                <div class="col-md-6">
                                                    <label for="razon_social">Razon Social: </label>
                                                    <input type="text" class="form-control" id="razon_social" name="razon_social" value="{{ $transportista->razon_social }}" required>


                                                </div>


                                            </div>
                                            <div class="form-group row">

                                                <div class="col-md-6 ">
                                                    <label for="zona">Zona:</label>
                                                    <input type="text" class="form-control" id="zona" name="zona" value="{{ $transportista->zona }}">

                                                </div>
                                                <div class="col-md-6">
                                                    <label for="razon_social">Dirección: </label>
                                                    <input type="text" class="form-control" id="razon_social" name="razon_social" value="{{ $transportista->direccion }}" required>


                                                </div>

                                            </div>
                                            <div class="form-group row">
                                                <div class="col-md-6">
                                                    <label for="correo_electronico">Email:</label>
                                                    <input type="text" class="form-control" id="correo_electronico" name="correo_electronico" value="{{ $transportista->correo_electronico }}">

                                                </div>

                                            </div>

                                            <!-- Agrega aquí más campos para editar -->
                                            <button type="submit" class="btn btn-success">
                                                <i class="fas fa-save"></i>
                                                Guardar
                                            </button>

                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <form action="{{ route('pago.destroy', $transportista->id) }}" method="POST" style="display: inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-trash-filled" width="20" height="20" viewBox="0 0 24 24" stroke-width="2" stroke="#ffffff" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M20 6a1 1 0 0 1 .117 1.993l-.117 .007h-.081l-.919 11a3 3 0 0 1 -2.824 2.995l-.176 .005h-8c-1.598 0 -2.904 -1.249 -2.992 -2.75l-.005 -.167l-.923 -11.083h-.08a1 1 0 0 1 -.117 -1.993l.117 -.007h16z" stroke-width="0" fill="currentColor" />
                                    <path d="M14 2a2 2 0 0 1 2 2a1 1 0 0 1 -1.993 .117l-.007 -.117h-4l-.007 .117a1 1 0 0 1 -1.993 -.117a2 2 0 0 1 1.85 -1.995l.15 -.005h4z" stroke-width="0" fill="currentColor" />
                                </svg>
                            </button>
                        </form>
                    </td>
                </tr>

                @endforeach

            </tbody>

        </table>

        <nav aria-label="Page navigation example">
            <ul class="pagination justify-content-center">
                @if ($transportistas->currentPage() > 1)
                <li class="page-item">
                    <a class="page-link" href="{{ $transportistas->previousPageUrl() }}" tabindex="-1" aria-disabled="true">Previous</a>
                </li>
                @endif
                @for ($i = 1; $i <= $transportistas->lastPage(); $i++)
                    <li class="page-item {{ $i == $transportistas->currentPage() ? 'active' : '' }}"><a class="page-link" href="{{ $transportistas->url($i) }}">{{ $i }}</a></li>
                    @endfor
                    @if ($transportistas->currentPage() < $transportistas->lastPage())
                        <li class="page-item">
                            <a class="page-link" href="{{ $transportistas->nextPageUrl() }}">Next</a>
                        </li>
                        @endif
            </ul>
        </nav>


    </div>

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
            var transportistasSeleccionados = document.querySelectorAll('.deleteCheckbox:checked');
            if (transportistasSeleccionados.length === 0) {
                alert('Debes seleccionar al menos un transportista  para borrar.');
            } else {
                if (confirm('¿Estás seguro de que quieres borrar los transportistas selecionados?')) {
                    var transportistaIds = [];
                    transportistasSeleccionados.forEach(function(transportista) {
                        transportistaIds.push(transportista.value);
                    });
                    // Crear un formulario dinámico para enviar la solicitud DELETE
                    var form = document.createElement('form');
                    form.method = 'POST';
                    form.action = '{{ route("transportista.borrar_seleccionados")}}';
                    form.innerHTML = '<input type="hidden" name="_method" value="DELETE">' +
                        '<input type="hidden" name="_token" value="{{ csrf_token() }}">' +
                        '<input type="hidden" name="transportista_ids" value="' + transportistaIds.join(',') + '">';
                    document.body.appendChild(form);
                    // Enviar el formulario una vez creado
                    form.submit();
                }
            }
        }
    </script>

</div>



@endsection

@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>

@endsection
@section('css')
<link rel="stylesheet" href="{{ asset('css/styleTables.css') }}">
@endsection