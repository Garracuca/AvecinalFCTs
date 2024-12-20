@extends('layouts.app')
@push('styles')
<style>
     .fc-day-sun {
        background-color: red !important; /* Cambia el color de fondo de los sábados y domingos */
        color: white; /* Opcional: cambia el color del texto */
    }
</style>
@endpush
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    <div id='calendar'></div>
                </div>
            </div>
        </div>
    </div>
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
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,timeGridDay'
            },
            events: '/api/shifts', // Obtiene los turnos desde la API
            eventClick: function(info) {
                if (info.event.extendedProps.status === 'disponible') {
                    window.location.href = `/shifts/${info.event.id}`;
                } else if (info.event.extendedProps.status === 'ocupado') {
                    alert('Turno ya reservado por otro usuario.');
                }
            },
            dateClick: function(info) {
                // Redirige al formulario para crear un turno en el día seleccionado
                window.location.href = `/shifts/create?date=${info.dateStr}`;
            },
            
        });

        calendar.render();
    });
</script>

@endpush
@endsection

