@extends('layouts.app')

@section('content')
<div class="container my-5" style="max-width: 800px;">
    <!-- Título -->
    <h1 class="text-center text-primary mb-4" style="font-size: 2.5rem; font-weight: bold;">Editar Usuario</h1>

    <!-- Mensajes de éxito -->
    @if (session('success'))
        <div class="alert alert-success text-center" style="font-size: 1.2rem;">
            {{ session('success') }}
        </div>
    @endif

    <!-- Formulario de edición -->
    <form action="{{ route('users.update', $user->id) }}" method="POST" class="p-4 border rounded" style="background-color: #f8f9fa;">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="numero_socio" class="form-label">Número de socio</label>
            <input type="text" name="numero_socio" id="numero_socio" class="form-control" value="{{ old('numero_socio', $user->numero_socio) }}">
        </div>

        <div class="mb-3">
            <label for="name" class="form-label">Nombre</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $user->name) }}" required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" id="email" class="form-control" value="{{ old('email', $user->email) }}" required>
        </div>

        <div class="mb-3">
            <label for="rol" class="form-label">Rol</label>
            <select name="rol" id="rol" class="form-control">
                <option value="socio" {{ $user->rol === 'socio' ? 'selected' : '' }}>Socio</option>
                <option value="tienda" {{ $user->rol === 'tienda' ? 'selected' : '' }}>Tienda</option>
                <option value="admin" {{ $user->rol === 'admin' ? 'selected' : '' }}>Admin</option>
            </select>
        </div>

        <!-- Botones de acción -->
        <div class="d-flex justify-content-between">
            <button type="submit" class="btn btn-success px-4 py-2" style="font-size: 1.2rem; border-radius: 8px;">
                <i class="fas fa-save"></i> Actualizar
            </button>
            <a href="{{ route('users.index') }}" class="btn btn-secondary px-4 py-2" style="font-size: 1.2rem; border-radius: 8px;">
                <i class="fas fa-arrow-left"></i> Atrás
            </a>
        </div>
    </form>
</div>
@endsection

<style>
    h1 {
        font-family: 'Arial', sans-serif;
        font-weight: bold;
    }

    .form-control {
        font-size: 1.1rem;
        padding: 10px;
        border-radius: 8px;
        border: 1px solid #ced4da;
    }

    .form-control:focus {
        border-color: #80bdff;
        box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
    }

    .btn {
        font-size: 1rem;
        font-weight: bold;
        transition: background-color 0.3s, box-shadow 0.3s;
    }

    .btn-success:hover {
        background-color: #218838;
        box-shadow: 0 0 10px rgba(33, 136, 56, 0.5);
    }

    .btn-secondary:hover {
        background-color: #5a6268;
        box-shadow: 0 0 10px rgba(90, 98, 104, 0.5);
    }

    .alert {
        font-size: 1.1rem;
        border-radius: 8px;
    }
</style>
