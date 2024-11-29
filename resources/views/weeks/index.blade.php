@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Semanas y Turnos</h1>
    <table class="table">
        <thead>
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
                <tr>
                    <td>{{ $week->start_date }}</td>
                    @foreach ($week->shift as $shift)
                        <td>{{ $shift->date }}</td>
                        <td>{{ $shift->time }}</td>
                        <td>{{ $shift->duration }} minutos</td>
                        <td>{{ $shift->user->name }}</td>  <!-- Asegúrate de tener la relación correcta con el usuario -->
     
                    @endforeach
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
