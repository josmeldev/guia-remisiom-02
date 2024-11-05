
@extends('layouts.template')
<!-- CSS de Bootstrap -->
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

@section('content')
<table class="table table-striped" >
    <thead >
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Role</th>
            <th>Created At</th>
            <th>Acciones</th>

        </tr>
    </thead>
    <tbody>
        @foreach($users as $user)
        <tr>
            <td>{{ $user->id }}</td>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->role }}</td>
            <td>{{ $user->created_at }}</td>
            <td>
                @if($user->id !== Auth::id() && $user->role !== 'Administrador')
                    <form method="POST" action="{{ route('usuarios.eliminar', ['id' => $user->id]) }}" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                    </form>
                @endif

                <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#editarUsuario{{ $user->id }}">
                    Editar
                </button>
                <div class="modal fade" id="editarUsuario{{ $user->id }}" tabindex="-1" role="dialog" aria-labelledby="editarUsuarioLabel{{ $user->id }}" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editarUsuarioLabel{{ $user->id }}">Editar Usuario</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <!-- Aquí va el formulario de edición -->
                                <form action="{{ route('usuarios.actualizar', ['id' => $user->id]) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')

                                    <!-- Campos de edición -->
                                    <div class="form-group">
                                        <label for="nombre">Nombre</label>
                                        <input type="text" class="form-control" id="nombre" name="nombre" value="{{ $user->name }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}">
                                    </div>

                                    <div class="form-group">
                                        <label for="role">Rol</label>
                                        <select class="form-control" id="role" name="role">
                                            <option value="Administrador" {{ $user->role === 'Administrador' ? 'selected' : '' }}>Administrador</option>
                                            <option value="Asistente" {{ $user->role === 'Asistente' ? 'selected' : '' }}>Asistente</option>
                                            <option value="Usuario" {{ $user->role === 'Usuario' ? 'selected' : '' }}>Usuario</option>
                                        </select>
                                    </div>

                                    <!-- Mostrar imagen actual del usuario -->
                                    <div class="form-group">
                                        <label for="imagen_actual">Imagen actual:</label><br>
                                        @if($user->profile_photo_path)
                                            <img src="{{ asset($user->profile_photo_path) }}" alt="Imagen de perfil" style="max-width: 200px;">
                                        @else
                                            <p>No tiene imagen de perfil</p>
                                        @endif
                                    </div>



                                    <!-- Campo para seleccionar nueva imagen -->
                                    <div class="form-group">
                                        <label for="profile_photo_path">Seleccionar nueva imagen de perfil:</label>
                                        <input type="file" name="profile_photo_path" id="profile_photo_path">
                                    </div>

                                    <!-- Botones de envío -->
                                    <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </td>
        </tr>

        @endforeach
    </tbody>
</table>

@endSection

@section('css')
<!-- CSS de Bootstrap -->
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

<link rel="stylesheet" href="{{ asset('css/styleTables.css') }}">
@endSection

@section('js')
<!-- JavaScript de Bootstrap (si necesitas funcionalidad interactiva) -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

@endSection
