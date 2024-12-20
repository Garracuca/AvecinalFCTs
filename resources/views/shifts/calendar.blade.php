@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Calendario de Turnos</h2>
    <div id="calendar"></div>
</div>

@push('scripts')
<link href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
    const calendarEl = document.getElementById('calendar');

    const calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        locale: 'es',
        events: eventsData.map(event => ({
    id: event.id,
    title: `${event.tipodeturno} - ${event.extendedProps.status}`,
    start: event.start,
    color: event.color,
    extendedProps: event.extendedProps,
})),
        //events: '/api/shifts', // Conectamos con la API
        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek,timeGridDay'
        },
        eventClick: function(info) {
            if (info.event.extendedProps.status === 'disponible') {
                window.location.href = `/shifts/${info.event.id}`;
            } else {
                alert('Este turno no está disponible.');
            }
        },
        dateClick: function(info) {
            window.location.href = `/shifts/create?date=${info.dateStr}`;
        },
    });

    calendar.render();
});

</script>
@endpush
@endsection
