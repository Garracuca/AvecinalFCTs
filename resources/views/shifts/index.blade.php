@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Lista de Turnos</h1>
    <a href="{{ route('shifts.create') }}" class="btn btn-primary">Crear nuevo turno</a>
    
    <table class="table mt-3">
        <thead>
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
            @foreach ($shifts as $shift)
                <tr>
                    <td>{{ $shift->tipodeturno }}</td>
                    <td>{{ $shift->date }}</td>
                    <td>{{ $shift->hour }}</td>
                    <td>{{ $shift->duration }} minutos</td>
                    <td>{{ $shift->completed ? 'Realizado' : 'Pendiente' }}</td>
                    <td>
                        <a href="{{ route('shifts.edit', $shift) }}" class="btn btn-warning">Editar</a>
                        <form action="{{ route('shifts.destroy', $shift) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
