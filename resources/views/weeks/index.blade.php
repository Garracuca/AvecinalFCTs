@extends('layouts.app')

@section('content')
<div class="container my-5" style="max-width: 900px;">
    <!-- Título de la página -->
    <h1 class="text-center text-primary mb-4" style="font-size: 2.5rem; font-weight: bold;">Semanas y Turnos</h1>

    <!-- Tabla de semanas y turnos -->
    <div class="table-responsive">
        <table class="table table-bordered table-striped text-center" style="font-size: 1rem;">
            <thead class="table-dark">
                <tr>
                    <th>Semana</th>
                    <th>Fecha</th>
                    <th>Hora</th>
                    <th>Duración</th>
                    <th>Usuario</th>
                    <th>Tipo de Turno</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($weeks as $week)
                    @foreach ($week->shifts as $shift)
                        <tr>
                            <td>{{ $week->start_date->format('d-m-Y') }}</td>
                            <td>{{ $shift->date }}</td>
                            <td>{{ $shift->hour }}</td>
                            <td>{{ $shift->duration }} minutos</td>
                            <td>{{ $shift->user ? $shift->user->name : 'Sin asignar' }}</td>
                            <td>{{ ucfirst($shift->tipodeturno) }}</td>
                        </tr>
                    @endforeach
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection

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

    .table th {
        font-size: 1.1rem;
        font-weight: bold;
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
</style>
