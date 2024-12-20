@extends('layouts.app')

@section('content')
<div class="container my-5" style="max-width: 900px;">
    <!-- Título de la página -->
    <h1 class="text-center text-primary mb-4" style="font-size: 2.5rem; font-weight: bold;">Detalles del Turno</h1>

    <div class="bg-white shadow p-4 rounded" style="font-size: 1.2rem;">
        <p><strong>Tipo de Turno:</strong> {{ ucfirst($shift->tipodeturno) }}</p>
        <p><strong>Fecha:</strong> {{ $shift->date }}</p>
        <p><strong>Hora:</strong> {{ $shift->hour }}</p>
        <p><strong>Duración:</strong> {{ $shift->duration }} minutos</p>
        <p>
            <strong>Reservado por:</strong> 
            {{ $shift->user ? $shift->user->name : 'Sin asignar' }}
        </p>

        @if(!$shift->user)
        <form action="{{ route('shifts.reserve', $shift->id) }}" method="POST" class="text-center">
            @csrf
            <button type="submit" class="btn btn-success btn-lg my-3">
                Reservar Turno
            </button>
        </form>
        @endif
    </div>

    <div class="d-flex justify-content-center mt-4" style="gap: 20px;">
        <a href="{{ route('shifts.index') }}" class="btn btn-secondary btn-lg px-4 py-2">
            Volver
        </a>
    </div>
</div>

<style>
    .container {
        max-width: 800px;
        margin: auto;
    }

    h1 {
        font-weight: bold;
        font-family: 'Arial', sans-serif;
        text-transform: uppercase;
    }

    .btn {
        font-size: 1.1rem;
        padding: 10px 20px;
        border-radius: 5px;
        transition: all 0.3s ease-in-out;
    }

    .btn-success:hover {
        background-color: #218838;
    }

    .btn-secondary:hover {
        background-color: #6c757d;
    }
</style>
@endsection
