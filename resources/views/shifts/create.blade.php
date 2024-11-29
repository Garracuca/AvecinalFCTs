<form action="{{ route('shifts.store') }}" method="POST">
    @csrf
    <label for="tipodeturno">Tipo de Turno:</label>
    <select name="tipodeturno" id="tipodeturno">
        <option value="tienda">Tienda</option>
        <option value="online">Online</option>
    </select>

    <label for="date">Fecha:</label>
    <input type="date" name="date" id="date" required>

    <label for="hour">Hora:</label>
    <input type="time" name="hour" id="hour" required>

    <label for="duration">Duración:</label>
    <input type="number" name="duration" id="duration" required>

    <label for="user_id">Usuario:</label>
    <select name="user_id" id="user_id" required>
        @foreach ($users as $user)
            <option value="{{ $user->id }}">{{ $user->name }}</option>
        @endforeach
    </select>

    <button type="submit">Crear Turno</button>
</form>
