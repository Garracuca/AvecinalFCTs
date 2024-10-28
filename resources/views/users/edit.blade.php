{{-- resources/views/users/edit.blade.php --}}
@extends('layouts.app')

@section('content')
    <h1>Editar Usuario</h1>
    <form action="{{ route('users.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="numero_socio">Número de socio:</label>
            <input type="text" name="numero_socio" class="form-control" value="{{ $user->numero_socio }}" required>
        </div>
        <div class="form-group">
            <label for="name">Nombre:</label>
            <input type="text" name="name" class="form-control" value="{{ $user->name }}" required>
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" name="email" class="form-control" value="{{ $user->email }}" required>
        </div>
        <div class="form-group">
            <label for="rol">Rol:</label>
            <select name="rol" class="form-control" required>
                <option value="socio" {{ $user->rol == 'socio' ? 'selected' : '' }}>Socio</option>
                <option value="tienda" {{ $user->rol == 'tienda' ? 'selected' : '' }}>Tienda</option>
                <option value="administración" {{ $user->rol == 'administración' ? 'selected' : '' }}>Administración</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Actualizar</button>
    </form>
@endsection
