{{-- resources/views/users/create.blade.php --}}
@extends('layouts.app')

@section('content')
    <h1>Crear Usuario</h1>
    <form action="{{ route('users.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="numero_socio">Número de socio:</label>
            <input type="text" name="numero_socio" class="form-control" value="{{ old('number') }}">
        </div>
        <div class="form-group">
            <label for="name">Nombre:</label>
            <input type="text" name="name" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" name="email" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="password">Contraseña:</label>
            <input type="password" name="password" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="rol">Rol:</label>
            <select name="rol" class="form-control" required>
                <option value="socio">Socio</option>
                <option value="tienda">Tienda</option>
                <option value="admin">Admin</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Guardar</button>
    </form>
@endsection
