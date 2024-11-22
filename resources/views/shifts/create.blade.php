@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Crear Nuevo Turno</h2>
    <form action="{{ route('shift.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="date" class="form-label">Fecha</label>
            <input type="date" name="date" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="hour" class="form-label">Hora de Comienzo</label>
            <input type="time" name="hour" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="duration" class="form-label">Duración (en horas)</label>
            <input type="number" name="duration" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="type_shift_id" class="form-label">Tipo de Turno</label>
            <select name="type_shift_id" class="form-select" required>
                @foreach($typeShifts as $typeShift)
                    <option value="{{ $typeShift->id }}">{{ $typeShift->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="user_id" class="form-label">Persona Asignada</label>
            <select name="user_id" class="form-select" required>
                @foreach($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="week_id" class="form-label">Semana</label>
            <select name="week_id" class="form-select" required>
                @foreach($weeks as $week)
                    <option value="{{ $week->id }}">Semana {{ $week->number }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Crear Turno</button>
    </form>
</div>
@endsection
