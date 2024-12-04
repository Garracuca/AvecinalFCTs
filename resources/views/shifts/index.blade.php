@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Turnos</h1>
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if(auth()->user()->rol === 'admin')
        <a href="{{ route('shifts.create') }}" class="btn btn-primary">Crear Turno</a>
    @endif

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
            @foreach($shifts as $shift)
                <tr>
                    <td>{{ $shift->tipodeturno }}</td>
                    <td>{{ $shift->date }}</td>
                    <td>{{ $shift->hour }}</td>
                    <td>{{ $shift->duration }} minutos</td>
                    <td>{{ $shift->completed ? 'Completado' : 'Disponible' }}</td>
                    <td>
                        @if(auth()->user()->rol === 'admin')
                            <a href="{{ route('shifts.edit', $shift) }}" class="btn btn-warning">Editar</a>
                            <form action="{{ route('shifts.destroy', $shift) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Eliminar</button>
                            </form>
                        @else
                            @if(!$shift->completed)
                                <a href="{{ route('shifts.reserve', $shift) }}" class="btn btn-success">Reservar</a>
                            @endif
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
