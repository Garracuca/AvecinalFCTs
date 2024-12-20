@extends('layouts.app')

@section('content')
<div class="container my-5" style="max-width: 1100px;">
    <!-- Título de la página -->
    <h1 class="text-center text-primary mb-4" style="font-size: 2.5rem; font-weight: bold;">Turnos</h1>

    <!-- Mensaje de éxito -->
    @if(session('success'))
        <div class="alert alert-success text-center" style="font-size: 1.2rem;">
            {{ session('success') }}
        </div>
    @endif

    <!-- Botón para crear un nuevo turno -->
    @if(auth()->user()->rol === 'admin')
        <div class="d-flex justify-content-end mb-4">
            <a href="{{ route('shifts.create') }}" class="btn btn-lg btn-success px-4 py-2">
                <i class="fas fa-plus-circle"></i> Crear Turno
            </a>
        </div>
    @endif

    <!-- Tabla de turnos -->
    <div class="table-responsive">
        <table class="table table-bordered table-striped text-center" style="font-size: 1rem;">
            <thead class="table-dark">
                <tr>
                    <th>Tipo de Turno</th>
                    <th>Fecha</th>
                    <th>Hora</th>
                    <th>Duración</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($shifts as $shift)
                    <tr>
                        <td>{{ ucfirst($shift->tipodeturno) }}</td>
                        <td>{{ $shift->date }}</td>
                        <td>{{ $shift->hour }}</td>
                        <td>{{ $shift->duration }} minutos</td>
                        <td>
                            <span class="badge {{ $shift->completed ? 'bg-danger' : 'bg-success' }} text-light">
                                {{ $shift->completed ? 'Completado' : 'Disponible' }}
                            </span>
                        </td>
                        <td>
                            @if(auth()->user()->rol === 'admin')
                                <!-- Botón Editar -->
                                <a href="{{ route('shifts.edit', $shift) }}" class="btn btn-warning btn-sm mx-1">
                                    <i class="fas fa-edit"></i> Editar
                                </a>

                                <!-- Botón Eliminar -->
                                <form action="{{ route('shifts.destroy', $shift) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm mx-1" onclick="return confirm('¿Estás seguro de que deseas eliminar este turno?');">
                                        <i class="fas fa-trash-alt"></i> Eliminar
                                    </button>
                                </form>
                            @else
                                @if(!$shift->completed)
                                    <!-- Botón Reservar -->
                                    <a href="{{ route('shifts.reserve', $shift) }}" class="btn btn-success btn-sm mx-1">
                                        <i class="fas fa-check-circle"></i> Reservar
                                    </a>
                                @endif
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- Confirmación de eliminación -->
<script>
    function confirmDelete() {
        return confirm('¿Estás seguro de que deseas eliminar este turno? Esta acción no se puede deshacer.');
    }
</script>

<style>
    h1 {
        font-family: 'Arial', sans-serif;
        font-weight: bold;
    }

    .table {
        width: 100%;
        margin: 0 auto;
        border-collapse: collapse;
    }

    .table th, .table td {
        padding: 15px;
        vertical-align: middle;
    }

    .table thead {
        background-color: #343a40;
        color: #fff;
    }

    .table-striped tbody tr:nth-of-type(odd) {
        background-color: #f9f9f9;
    }

    .table-striped tbody tr:hover {
        background-color: #f1f1f1;
    }

    .table-bordered {
        border: 1px solid #dee2e6;
    }

    .table-bordered th, .table-bordered td {
        border: 1px solid #dee2e6;
    }

    .btn {
        font-size: 1rem;
        padding: 10px 15px;
        transition: all 0.3s ease-in-out;
    }

    .btn-warning:hover {
        background-color: #d39e00;
    }

    .btn-danger:hover {
        background-color: #c82333;
    }

    .btn-success {
        background-color: #28a745;
        border: none;
        font-size: 18px;
    }

    .btn-success:hover {
        background-color: #218838;
        box-shadow: 0 0 10px rgba(33, 136, 56, 0.5);
    }
</style>
@endsection
