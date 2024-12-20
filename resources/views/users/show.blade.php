@extends('layouts.app')

@section('title', 'Detalles del Usuario')

@section('content')
<div class="d-flex justify-content-center align-items-center" style="min-height: 100vh; background-color: #f9f9f9;">
    <div class="card shadow-lg p-5" style="width: 100%; max-width: 600px; border-radius: 10px;">
        <h2 class="text-center text-primary mb-4">Detalles del Usuario</h2>
        
        <!-- Detalles del usuario -->
        <ul class="list-unstyled">
            <li class="mb-3"><strong>Teléfono:</strong> {{ $user->numero_socio }}</li>
            <li class="mb-3"><strong>Nombre:</strong> {{ $user->name }}</li>
            <li class="mb-3"><strong>Apellido:</strong> {{ $user->surname }}</li>
            <li class="mb-3"><strong>Email:</strong> {{ $user->email }}</li>
            <li class="mb-3"><strong>Rol:</strong> {{ ucfirst($user->role) }}</li>
        </ul>
        
        <!-- Botón de volver -->
        <div class="text-center mt-4">
            <a href="{{ route('users.index') }}" class="btn w-100 py-2">Volver</a>
        </div>
    </div>
</div>

<!-- Estilos personalizados -->
<style>
    .card {
        background-color: #ffffff;
        border: 1px solid #e0e0e0;
    }

    .btn {
        background-color: #87ceeb; /* Celeste claro */
        color: #000; /* Letras negras */
        border: none;
        font-size: 16px;
        transition: all 0.3s ease;
    }

    .btn:hover {
        background-color: #00bfff; /* Azul más intenso al pasar el cursor */
        box-shadow: 0 0 10px rgba(0, 191, 255, 0.5);
    }

    h2 {
        font-weight: bold;
        color: #007bff;
    }

    ul {
        padding-left: 0;
    }

    ul li {
        font-size: 16px;
        color: #333;
        line-height: 1.6;
    }
</style>
@endsection
