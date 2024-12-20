@extends('layouts.app')

@section('content')
<div class="container my-5" style="max-width: 900px;">
    <!-- Título de la página -->
    <h1 class="text-center text-primary mb-4" style="font-size: 2.5rem; font-weight: bold;">Editar Turno</h1>

    <!-- Mensaje de éxito -->
    @if(session('success'))
        <div class="alert alert-success text-center" style="font-size: 1.2rem;">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('shifts.update', $shift) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group mb-3">
            <label for="tipodeturno" class="form-label">Tipo de Turno</label>
            <select name="tipodeturno" id="tipodeturno" class="form-select">
                <option value="tienda" {{ $shift->tipodeturno == 'tienda' ? 'selected' : '' }}>Tienda</option>
                <option value="online" {{ $shift->tipodeturno == 'online' ? 'selected' : '' }}>Online</option>
            </select>
        </div>

        <div class="form-group mb-3">
            <label for="date" class="form-label">Fecha</label>
            <input type="date" name="date" id="date" class="form-control" value="{{ $shift->date }}" required>
        </div>

        <div class="form-group mb-3">
            <label for="hour" class="form-label">Hora</label>
            <input type="time" name="hour" id="hour" class="form-control" value="{{ $shift->hour }}" required>
        </div>

        <div class="form-group mb-3">
            <label for="duration" class="form-label">Duración (minutos)</label>
            <input type="number" name="duration" id="duration" class="form-control" value="{{ $shift->duration }}" required>
        </div>

        <div class="form-group mb-3">
            <label for="user_id" class="form-label">Usuario</label>
            <select name="user_id" id="user_id" class="form-select">
                <option value="" {{ is_null($shift->user_id) ? 'selected' : '' }}>Sin asignar</option>
                @foreach ($users as $user)
                    <option value="{{ $user->id }}" {{ $shift->user_id == $user->id ? 'selected' : '' }}>{{ $user->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group mb-3">
            <label for="month_id" class="form-label">Mes</label>
            <select name="month_id" id="month_id" class="form-select" required>
                <option value="{{ $month->id }}" selected>{{ $month->start_date->format('F Y') }}</option>
            </select>
        </div>

        <div class="form-group mb-3">
            <label for="week_id" class="form-label">Semana</label>
            <select name="week_id" id="week_id" class="form-select" required>
                @foreach ($weeks as $week)
                    <option value="{{ $week->id }}" {{ $shift->week_id == $week->id ? 'selected' : '' }}>
                        {{ $week->getWeekLabelAttribute() }} ({{ $week->start_date->format('d-m-Y') }})
                    </option>
                @endforeach
            </select>
        </div>

        <div class="d-flex justify-content-between mt-4">
            <button type="submit" class="btn btn-warning px-4 py-2">Actualizar</button>
            <a href="{{ route('shifts.index') }}" class="btn btn-secondary px-4 py-2">Cancelar</a>
        </div>
    </form>
</div>

<style>
    h1 {
        font-family: 'Arial', sans-serif;
        font-weight: bold;
        text-align: center;
    }

    .form-label {
        font-weight: bold;
    }

    .btn {
        font-size: 1rem;
        padding: 10px 20px;
        transition: all 0.3s ease-in-out;
    }

    .btn-warning:hover {
        background-color: #d39e00;
    }

    .btn-secondary:hover {
        background-color: #6c757d;
    }
</style>
@endsection
