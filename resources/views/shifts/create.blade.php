@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Crear un nuevo turno</h2>
    <form action="{{ route('shifts.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="month_id">Mes</label>
            <select name="month_id" id="month_id" class="form-control" required>
                @foreach ($months as $month)
                    <option value="{{ $month->id }}">{{ $month->start_date->format('F Y') }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="week_id">Semana</label>
            <select name="week_id" id="week_id" class="form-control" required>
                <!-- Aquí puedes cargar las semanas relacionadas con el mes seleccionado -->
                @foreach ($weeks as $week)
                    <option value="{{ $week->id }}">{{ $week->start_date->format('d M Y') }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="tipodeturno">Tipo de Turno:</label>
                <select name="tipodeturno" id="tipodeturno">
                    <option value="tienda">Tienda</option>
                    <option value="online">Online</option>
                </select>
        </div>

        

        <div class="form-group">
            <label for="date">Fecha</label>
            <input type="date" name="date" id="date" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="hour">Hora</label>
            <input type="time" name="hour" id="hour" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="duration">Duración</label>
            <input type="number" name="duration" id="duration" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="user_id">Usuario</label>
            <select name="user_id" id="user_id" class="form-control" required>
                @foreach ($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Crear Turno</button>
    </form>
</div>
@endsection
