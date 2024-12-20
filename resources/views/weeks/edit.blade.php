<div class="form-group">
    <label for="month_id">Mes</label>
    <select name="month_id" id="month_id" class="form-control" required>
        <option value="{{ $month->id }}" selected>{{ $month->start_date->format('F Y') }}</option>
    </select>
</div>

<div class="form-group">
    <label for="week_id">Semana</label>
    <select name="week_id" id="week_id" class="form-control" required>
        @foreach ($weeks as $week)
            <option value="{{ $week->id }}" {{ $shift->week_id == $week->id ? 'selected' : '' }}>
                {{ $week->getWeekLabelAttribute() }} ({{ $week->start_date->format('d-m-Y') }})
            </option>
        @endforeach
    </select>
</div>