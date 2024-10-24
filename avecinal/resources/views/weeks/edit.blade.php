{{-- resources/views/weeks/index.blade.php --}}
@extends('layouts.app')

@section('content')
    <h1>Semanas</h1>
    <a href="{{ route('weeks.create') }}" class="btn btn-primary">Crear nueva semana</a>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Fecha de Inicio</th>
                <th>Mes</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($weeks as $week)
                <tr>
                    <td>{{ $week->id }}</td>
                    <td>{{ $week->start_date }}</td>
                    <td>{{ $week->month->start_date }}</td>
                    <td>
                        <a href="{{ route('weeks.edit', $week->id) }}" class="btn btn-sm btn-warning">Editar</a>
                        <form action="{{ route('weeks.destroy', $week->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
