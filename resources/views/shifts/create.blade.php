@extends('layouts.app')

@push('scripts')
<script>
    document.getElementById('month_id').addEventListener('change', function() {
        const monthId = this.value;

        fetch(`/api/weeks?month_id=${monthId}`)
            .then(response => response.json())
            .then(weeks => {
                const weekSelect = document.getElementById('week_id');
                weekSelect.innerHTML = ''; // Limpiar las opciones previas

                weeks.forEach(week => {
                    const option = document.createElement('option');
                    option.value = week.id;
                    option.textContent = `${week.label} (${week.start_date})`;
                    weekSelect.appendChild(option);
                });
            })
            .catch(error => {
                console.error('Error al cargar las semanas:', error);
                alert('Hubo un problema al cargar las semanas. Inténtelo más tarde.');
            });
    });
</script>
@endpush

@section('content')
<div class="container my-5" style="max-width: 800px;">
    <!-- Título de la página -->
    <h1 class="text-center text-primary mb-4" style="font-size: 2.5rem; font-weight: bold;">Crear un nuevo Turno</h1>

    <!-- Formulario -->
    <div class="card shadow-lg">
        <div class="card-body">
            <form action="{{ route('shifts.store') }}" method="POST">
                @csrf
                <div class="form-group mb-3">
                    <label for="month_id" class="form-label">Mes</label>
                    <select name="month_id" id="month_id" class="form-select" required>
                        @foreach ($months as $month)
                            <option value="{{ $month->id }}" {{ $month->start_date->isSameMonth($selectedDate) ? 'selected' : '' }}>
                                {{ $month->start_date->format('F Y') }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group mb-3">
                    <label for="week_id" class="form-label">Semana</label>
                    <select name="week_id" id="week_id" class="form-select" required>
                        @foreach ($weeks as $week)
                            <option value="{{ $week->id }}">{{ $week->week_label }} ({{ $week->start_date->format('d-m-Y') }})</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group mb-3">
                    <label for="tipodeturno" class="form-label">Tipo de Turno:</label>
                    <select name="tipodeturno" id="tipodeturno" class="form-select">
                        <option value="tienda">Tienda</option>
                        <option value="online">Online</option>
                    </select>
                </div>

                <div class="form-group mb-3">
                    <label for="date" class="form-label">Fecha</label>
                    <input type="date" name="date" value="{{ request('date', old('date', now()->toDateString())) }}" class="form-control" required>
                </div>

                <div class="form-group mb-3">
                    <label for="hour" class="form-label">Hora</label>
                    <input type="time" name="hour" id="hour" class="form-control" required>
                </div>

                <div class="form-group mb-3">
                    <label for="duration" class="form-label">Duración (minutos)</label>
                    <input type="number" name="duration" id="duration" class="form-control" required>
                </div>

                <div class="form-group mb-4">
                    <label for="user_id" class="form-label">Usuario (Opcional)</label>
                    <select name="user_id" id="user_id" class="form-select">
                        <option value="">Sin asignar</option>
                        @foreach ($users as $user)
                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="d-flex justify-content-between">
                    <button type="submit" class="btn btn-success px-4">Crear Turno</button>
                    <a href="{{ route('shifts.index') }}" class="btn btn-secondary px-4">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

<style>
    h1 {
        font-family: 'Arial', sans-serif;
        font-weight: bold;
        color: #2c3e50;
    }

    .card {
        border-radius: 10px;
        border: none;
    }

    .form-label {
        font-size: 1rem;
        font-weight: bold;
        color: #495057;
    }

    .form-control, .form-select {
        border-radius: 5px;
        font-size: 1rem;
    }

    .btn-success {
        background-color: #28a745;
        border: none;
    }

    .btn-success:hover {
        background-color: #218838;
    }

    .btn-secondary {
        background-color: #6c757d;
        border: none;
    }

    .btn-secondary:hover {
        background-color: #5a6268;
    }

    .container {
        padding: 20px;
    }
</style>
