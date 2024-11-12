
@extends('layouts.template')

@section('content')
<div class="container">
    <h1>Auditorías</h1>

    <!-- Campos de búsqueda -->
    <form method="GET" action="{{ route('auditorias.buscar') }}" class="form-inline mb-3">
        <div class="form-group mx-sm-2 mb-2">
            <input type="text" name="usuario" class="form-control" placeholder="Buscar por Usuario" value="{{ request('usuario') }}">
        </div>
        <div class="form-group mx-sm-2 mb-2">
            <input type="text" name="accion" class="form-control" placeholder="Buscar por Acción" value="{{ request('accion') }}">
        </div>
        <div class="form-group mx-sm-2 mb-2">
            <input type="text" name="modulo" class="form-control" placeholder="Buscar por Módulo" value="{{ request('modulo') }}">
        </div>
        <button type="submit" class="btn btn-primary mb-2" style="background-color: #034436; border: none;">Buscar</button>
        <a href="/auditorias" class="btn btn-secondary mb-2 ml-2">Restablecer</a>
    </form>

    <div class="d-flex justify-content-end mb-3">
        <button class="btn btn-danger" onclick="eliminarSeleccionados()">
            <i class="fas fa-trash-alt"></i>
        </button>
    </div>

    <table class="table table-striped">
        <thead>
            <tr>
                <th><input type="checkbox" id="selectAllCheckbox" onclick="selectAll()" style="cursor: pointer;"></th>
                <th>ID</th>
                <th>Usuario</th>
                <th>Rol</th>
                <th>Acción</th>
                <th>Módulo</th>
                <th>Fecha</th>
                <th>Detalles</th>
            </tr>
        </thead>
        <tbody>
            @foreach($audits as $audit)
            <tr>
                <td><input type="checkbox" class="deleteCheckbox" value="{{ $audit->id }}" style="cursor: pointer;"></td>
                <td>{{ $audit->id }}</td>
                <td>{{ $usuariosMapeo[$audit->user_id] ?? 'Usuario desconocido' }}</td>
                <td>{{ $rolesMapeo[$audit->user_id] ?? 'Sin roles' }}</td>
                <td>{{ $eventosMapeo[$audit->event] ?? $audit->event }}</td>
                <td>{{ class_basename($audit->auditable_type) }}</td>
                <td>{{ $audit->created_at }}</td>
                <td>
                    <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#auditDetails{{ $audit->id }}">Ver</button>
                    <!-- Modal -->
                    <div class="modal fade" id="auditDetails{{ $audit->id }}" tabindex="-1" role="dialog" aria-labelledby="auditDetailsLabel{{ $audit->id }}" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="auditDetailsLabel{{ $audit->id }}">Detalles de la Auditoría</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <h5>Contenido Antiguo</h5>
                                    <ul>
                                        @foreach($audit->old_values as $key => $value)
                                            <li><strong>{{ $key }}:</strong> {{ $value }}</li>
                                        @endforeach
                                    </ul>
                                    <h5>Contenido Nuevo</h5>
                                    <ul>
                                        @foreach($audit->new_values as $key => $value)
                                            <li><strong>{{ $key }}:</strong> {{ $value }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Mostrar enlaces de paginación -->
    <div class="d-flex justify-content-center">
        {{ $audits->links() }}
    </div>
</div>
@endsection

@section('css')
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
@endsection

@section('js')
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
    function selectAll() {
        var checkboxes = document.querySelectorAll('.deleteCheckbox');
        checkboxes.forEach(function(checkbox) {
            checkbox.checked = document.getElementById('selectAllCheckbox').checked;
        });
    }

    function eliminarSeleccionados() {
        var seleccionados = document.querySelectorAll('.deleteCheckbox:checked');
        if (seleccionados.length === 0) {
            alert('Debes seleccionar al menos un registro para eliminar.');
            return;
        }

        if (confirm('¿Estás seguro de que quieres eliminar los registros seleccionados?')) {
            var ids = [];
            seleccionados.forEach(function(checkbox) {
                ids.push(checkbox.value);
            });

            var form = document.createElement('form');
            form.method = 'POST';
            form.action = '{{ route("auditorias.eliminarSeleccionados") }}';
            form.innerHTML = '<input type="hidden" name="_method" value="DELETE">' +
                             '<input type="hidden" name="_token" value="{{ csrf_token() }}">' +
                             '<input type="hidden" name="ids" value="' + ids.join(',') + '">';
            document.body.appendChild(form);
            form.submit();
        }
    }
</script>
@endsection