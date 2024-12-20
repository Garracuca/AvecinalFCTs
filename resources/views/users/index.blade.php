@extends('layouts.app')

@section('content')
<div class="container my-5" style="max-width: 1100px; margin: auto;">
    <!-- Título principal -->
    <h1 class="text-center text-primary mb-4" style="font-size: 3rem; font-weight: bold;">Lista de Usuarios</h1>

    <!-- Mensajes de éxito -->
    @if (session('success'))
        <div class="alert alert-info text-center" style="font-size: 1.2rem;">
            {{ session('success') }}
        </div>
    @endif

    <!-- Botón para crear un nuevo usuario -->
    <div class="text-end mb-3">
        <a href="{{ route('users.create') }}" class="btn btn-success px-4 py-2" style="font-size: 1.2rem; font-weight: bold; border-radius: 8px;">
            <i class="fas fa-plus-circle"></i> Crear Nuevo Usuario
        </a>
    </div>

    <!-- Tabla de usuarios -->
    <div class="table-responsive">
        <table class="table table-bordered table-hover text-center align-middle" style="font-size: 18px;">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Email</th>
                    <th>Rol</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            <span class="badge bg-info text-dark" style="font-size: 1rem;">{{ ucfirst($user->rol) }}</span>
                        </td>
                        <td class="d-flex justify-content-center gap-2">
                            <!-- Botón Ver -->
                            <a href="{{ route('users.show', $user) }}" class="btn btn-primary btn-sm" style="border-radius: 8px;">
                                <i class="fas fa-eye"></i> Ver
                            </a>
                            <!-- Botón Editar -->
                            <a href="{{ route('users.edit', $user) }}" class="btn btn-warning btn-sm" style="border-radius: 8px;">
                                <i class="fas fa-edit"></i> Editar
                            </a>
                            <!-- Botón Eliminar -->
                            <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display: inline-block;" onsubmit="return confirm('¿Estás segura/o de que deseas eliminar este usuario? Esta acción no se puede deshacer.');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" style="border-radius: 8px;">
                                    <i class="fas fa-trash-alt"></i> Eliminar
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection

<style>
    h1 {
        font-weight: bold;
        font-family: Arial, sans-serif;
    }

    .table {
        margin-top: 20px;
        border-collapse: separate;
        border-spacing: 0;
        border-radius: 10px;
        overflow: hidden;
    }

    .table th, .table td {
        padding: 15px;
        vertical-align: middle;
    }

    .table th {
        background-color: #2c3e50;
        color: white;
        font-size: 1.1rem;
    }

    .btn {
        font-size: 1rem;
        font-weight: bold;
        transition: all 0.3s ease-in-out;
    }

    .btn-success:hover {
        background-color: #218838;
        box-shadow: 0 0 10px rgba(33, 136, 56, 0.5);
    }

    .btn-primary {
        background-color: #007bff;
        border: none;
    }

    .btn-primary:hover {
        background-color: #0056b3;
    }

    .btn-warning {
        background-color: #ffc107;
        border: none;
    }

    .btn-warning:hover {
        background-color: #e0a800;
    }

    .btn-danger {
        background-color: #dc3545;
        border: none;
    }

    .btn-danger:hover {
        background-color: #c82333;
    }

    .badge {
        padding: 5px 12px;
        font-size: 16px;
        border-radius: 10px;
    }

    .alert {
        font-size: 1.2rem;
        border-radius: 8px;
    }
</style>
