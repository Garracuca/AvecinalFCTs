@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Editar Turno</h1>

    <form action="{{ route('shifts.update', $shift) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="tipodeturno">Tipo de Turno</label>
            <select name="tipodeturno" id="tipodeturno" class="form-control">
                <option value="tienda" {{ $shift->tipodeturno == 'tienda' ? 'selected' : '' }}>Tienda</option>
                <option value="online" {{ $shift->tipodeturno == 'online' ? 'selected' : '' }}>Online</option>
            </select>
        </div>

        <div class="form-group">
            <label for="date">Fecha</label>
            <input type="date" name="date" id="date" class="form-control" value="{{ $shift->date }}" required>
        </div>

        <div class="form-group">
            <label for="hour">Hora</label>
            <input type="time" name="hour" id="hour" class="form-control" value="{{ $shift->hour }}" required>
        </div>

        <div class="form-group">
            <label for="duration">Duración (minutos)</label>
            <input type="number" name="duration" id="duration" class="form-control" value="{{ $shift->duration }}" required>
        </div>

        <div class="form-group">
            <label for="user_id">Usuario</label>
            <select name="user_id" id="user_id" class="form-control" required>
                @foreach ($users as $user)
                    <option value="{{ $user->id }}" {{ $shift->user_id == $user->id ? 'selected' : '' }}>{{ $user->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="week_id">Semana</label>
            <select name="week_id" id="week_id" class="form-control" required>
                @foreach ($weeks as $week)
                    <option value="{{ $week->id }}" {{ $shift->week_id == $week->id ? 'selected' : '' }}>{{ $week->name }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-warning">Actualizar</button>
    </form>
</div>
@endsection
