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


    <section class="general mt-3">

        <form action="{{ route('carga.buscar') }}" method="GET">
            <div class="form-row">
                <div class="form-group col-md-3">
                    <label for="total_carga_bruta">Total de Carga Bruta:</label>
                    <input type="text" class="form-control" id="total_carga_bruta" name="total_carga_bruta" placeholder="Total de Carga Bruta">
                </div>

                <div class="form-group col-md-3">
                    <label for="total_material_extrano">Material Extraño:</label>
                    <input type="text" class="form-control" id="total_material_extrano" name="total_material_extrano" placeholder="Material Extraño">
                </div>
                <div class="form-group col-md-3">
                    <label for="chofer_id">ID Conductor:</label>
                    <select class="form-control" id="chofer_id" name="chofer_id">
                        <option value="">Seleccionar Conductor</option>
                        @foreach($choferes as $conductor)
                            <option value="{{ $conductor->id }}">{{ $conductor->id }} - {{ $conductor->nombre_apellidos }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-3">
                    <label for="km_origen">Km de Origen:</label>
                    <input type="text" class="form-control" id="km_origen" name="km_origen" placeholder="Km de Origen">
                </div>
                <div class="form-group col-md-3">
                    <label for="km_de_destino">Km de Destino:</label>
                    <input type="text" class="form-control" id="km_de_destino" name="km_de_destino" placeholder="Km de Destino">
                </div>
                <div class="form-group col-md-3">
                    <label for="fecha_carga">Fecha de Carga:</label>
                    <input type="date" class="form-control" id="fecha_carga" name="fecha_carga">
                </div>
                <div class="form-group col-md-3">
                    <label for="fecha_de_descarga">Fecha de Descarga:</label>
                    <input type="date" class="form-control" id="fecha_de_descarga" name="fecha_de_descarga">
                </div>
            </div>
            <div class="form-row">
                <div class="col-md-12 text-right">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-filter"></i> Filtrar
                    </button>
                    <a href="{{ route('carga.index') }}" class="btn btn-secondary">
                        <i class="fas fa-undo"></i> Restablecer
                    </a>
                </div>
            </div>
        </form>


    </section>

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Lista de Cargas</h3>
            <div class="text-right">
                <button type="button" class="btn btn-danger" onclick="borrarSeleccionadosOtodo()" title=" Borrar Seleccionados">
                    <i class="fas fa-trash-alt"></i>
                </button>
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" title="Registrar Carga">
                    <i class="fas fa-plus"></i>
                  </button>

                  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header bg-purple">
                          <h5 class="modal-title" id="exampleModalLabel">Registrar Carga</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('carga.store') }}" method="POST">
                                @csrf
                                <div class="row text-left">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="chofer_id" class="form-label">Chofer:</label>
                                            <select name="chofer_id" id="chofer_id" class="form-control" required>
                                                <option value="">Seleccionar Chofer</option>
                                                @foreach ($choferes as $chofer)
                                                    <option value="{{ $chofer->id }}">{{ $chofer->nombre_apellidos }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="total_carga_bruta" class="form-label">Total Carga Bruta:</label>
                                            <input type="text" class="form-control" id="total_carga_bruta" name="total_carga_bruta" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="total_material_extrano" class="form-label">Total Material Extraño:</label>
                                            <input type="text" class="form-control" id="total_material_extrano" name="total_material_extrano" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="tara" class="form-label">Tara:</label>
                                            <input type="text" class="form-control" id="tara" name="tara" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="nro_ticket" class="form-label">Número de Ticket:</label>
                                            <input type="text" class="form-control" id="nro_ticket" name="nro_ticket" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="km_origen" class="form-label">Kilómetros de Origen:</label>
                                            <input type="number" class="form-control" id="km_origen" name="km_origen" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="km_de_destino" class="form-label">Kilómetros de Destino:</label>
                                            <input type="number" class="form-control" id="km_de_destino" name="km_de_destino" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="fecha_carga" class="form-label">Fecha de Carga:</label>
                                            <input type="date" class="form-control" id="fecha_carga" name="fecha_carga" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="fecha_de_descarga" class="form-label">Fecha de Descarga:</label>
                                            <input type="date" class="form-control" id="fecha_de_descarga" name="fecha_de_descarga" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row text-left">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="RUC_Agricultor" class="form-label">Agricultor:</label>
                                            <select name="RUC_Agricultor" id="RUC_Agricultor" class="form-control" required style="font-size: 15px">
                                                <option value="">Seleccionar Agricultor</option>
                                                @foreach ($agricultores as $agricultor)
                                                    @php
                                                        // Limitar la longitud del texto y agregar puntos suspensivos si es necesario
                                                        $razon_social = strlen($agricultor->razon_social) > 30 ? substr($agricultor->razon_social, 0, 30) . '...' : $agricultor->razon_social;
                                                    @endphp
                                                    <option value="{{ $agricultor->id }}">{{ $razon_social }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                    </div>
                                    
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fas fa-check"></i> Registrar Carga
                                        </button>
                                    </div>
                                    <div class="col-md-6 text-left">
                                        <button type="reset" class="btn btn-secondary">
                                            <i class="fas fa-times"></i> Restablecer
                                        </button>
                                    </div>
                                </div>


                            </form>


                        </div>
                        <div class="modal-footer bg-purple ">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">
                                <i class="fas fa-window-close"></i> Cerrar
                            </button>


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
                        <th>ID Conductor</th>
                        <th>Carga Bruta</th>
                        <th>Material Extraño</th>
                        <th>Tara</th>
                        <th>N° Ticket</th>
                        <th>Km Origen</th>
                        <th>Km Destino</th>
                        <th>Fecha Carga</th>
                        <th>Fecha Descarga</th>
                        <th>Acciones</th>

                    </tr>

                </thead>
                <tbody>
                    @foreach ($cargas as $carga)
                        <tr>
                            <td><input type="checkbox" class="deleteCheckbox" value="{{ $carga->id }}" style="cursor: pointer;"></td>
                            <td>{{ $carga->id }}</td>
                            <td>{{ $carga->chofer_id }}</td>
                            <td>{{ $carga->total_carga_bruta }}</td>

                            <td>{{ $carga->total_material_extrano }}</td>
                            <td>{{ $carga->tara }}</td>
                            <td>{{ $carga->nro_ticket }}</td>
                            <td>{{ $carga->km_origen }}</td>
                            <td>{{ $carga->km_de_destino }}</td>
                            <td>{{ $carga->fecha_carga }}</td>
                            <td>{{ $carga->fecha_de_descarga }}</td>


                            <td>
                                <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#editModal{{ $carga->id }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-edit" width="20" height="20" viewBox="0 0 24 24" stroke-width="2" stroke="#ffffff" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                        <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" />
                                        <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" />
                                        <path d="M16 5l3 3" />
                                      </svg>
                                </button>
                                <div class="modal fade" id="editModal{{ $carga->id }}" tabindex="-1" aria-labelledby="editModalLabel{{ $carga->id }}" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header bg-primary">
                                                <h5 class="modal-title" id="editModalLabel{{ $carga->id }}">Editar Conductor</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <!-- Formulario para editar la guía de remisión -->
                                                <form id="editForm{{ $carga->id }}" action="{{ route('carga.update', $carga->id) }}" method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <!-- Campos para editar -->
                                                    <div class="form-group row">
                                                        <div class="col-md-6">
                                                            <label for="id_conductor">ID Conductor:</label>
                                                            <input type="number" class="form-control" id="id_conductor" name="id_conductor" value="{{ $carga->chofer_id }}" required>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label for="total_carga_bruta">Total de Carga Bruta:</label>
                                                            <input type="number" class="form-control" id="total_carga_bruta" name="total_carga_bruta" value="{{ $carga->total_carga_bruta }}" required>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">

                                                        <div class="col-md-6">
                                                            <label for="total_material_extrano">Material Extraño:</label>
                                                            <input type="number" class="form-control" id="total_material_extrano" name="total_material_extrano" value="{{ $carga->total_material_extrano }}" required>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <div class="col-md-6">
                                                            <label for="tara">Tara:</label>
                                                            <input type="number" class="form-control" id="tara" name="tara" value="{{ $carga->tara }}" required>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label for="nro_ticket">Nro. Ticket:</label>
                                                            <input type="text" class="form-control" id="nro_ticket" name="nro_ticket" value="{{ $carga->nro_ticket }}" required>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <div class="col-md-6">
                                                            <label for="km_origen">Km de Origen:</label>
                                                            <input type="number" class="form-control" id="km_origen" name="km_origen" value="{{ $carga->km_origen }}" required>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label for="km_de_destino">Km de Destino:</label>
                                                            <input type="number" class="form-control" id="km_de_destino" name="km_de_destino" value="{{ $carga->km_de_destino }}" required>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <div class="col-md-6">
                                                            <label for="fecha_carga">Fecha de Carga:</label>
                                                            <input type="date" class="form-control" id="fecha_carga" name="fecha_carga" value="{{ $carga->fecha_carga }}" required>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label for="fecha_de_descarga">Fecha de Descarga:</label>
                                                            <input type="date" class="form-control" id="fecha_de_descarga" name="fecha_de_descarga" value="{{ $carga->fecha_de_descarga }}" required>
                                                        </div>
                                                    </div>
                                                    <!-- Agrega aquí más campos para editar -->
                                                    <div class="text-center mb-3">
                                                        <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                                                    </div>
                                                </form>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <form action="{{ route('carga.destroy', $carga->id) }}" method="POST" style="display: inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-trash" width="20" height="20" viewBox="0 0 24 24" stroke-width="2" stroke="#ffffff" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                            <path d="M4 7l16 0" />
                                            <path d="M10 11l0 6" />
                                            <path d="M14 11l0 6" />
                                            <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />
                                            <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
                                          </svg>
                                    </button>
                                </form>
                            </td>
                        </tr>

                    @endforeach

                </tbody>

            </table>

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
                var cargasSeleccionadas = document.querySelectorAll('.deleteCheckbox:checked');
                if (cargasSeleccionadas.length === 0) {
                    alert('Debes seleccionar al menos un registro  para borrar.');
                } else {
                    if (confirm('¿Estás seguro de que quieres borrar los registros selecionados?')) {
                        var cargaIds = [];
                        cargasSeleccionadas.forEach(function(carga) {
                            cargaIds.push(carga.value);
                        });
                        // Crear un formulario dinámico para enviar la solicitud DELETE
                        var form = document.createElement('form');
                        form.method = 'POST';
                        form.action = '{{ route('carga.borrar_seleccionadas') }}';
                        form.innerHTML = '<input type="hidden" name="_method" value="DELETE">' +
                                         '<input type="hidden" name="_token" value="{{ csrf_token() }}">' +
                                         '<input type="hidden" name="pago_ids" value="' + cargaIds.join(',') + '">';
                        document.body.appendChild(form);
                        // Enviar el formulario una vez creado
                        form.submit();
                    }
                }
            }
        </script>

    </div>
@endsection
@section('css')
<link rel="stylesheet" href="{{ asset('css/styleTables.css') }}">
@endsection
