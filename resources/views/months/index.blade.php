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
        var initialLocaleCode = 'es';
        const calendarEl = document.getElementById('calendar');
        
        var eventsData = @json($events);

        const calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'timeGridWeek',
            slotMinTime: '07:30',
            headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay'
                },
                businessHours: true,
            businessHours: [ 
  {
    daysOfWeek: [ 1, 3 ,4], // Lunes, Miércoles y Jueves
    startTime: '10:00', 
    endTime: '13:30' 
  },
  {
    daysOfWeek: [ 2, 5 ], // Martes y viernes
    startTime: '10:00', 
    endTime: '20:30' 
  }, 
  {
    daysOfWeek: [ 1, 3 ,4], // Lunes, Miércoles y Jueves
    startTime: '17:00', 
    endTime: '20:30' 
  },
  {
    daysOfWeek: [ 6],
    startTime: '10:00', 
    endTime: '13:30' 
  }
],
            firstDay: 1,
            locale: initialLocaleCode,
            events: eventsData ,
            eventColor: 'blue',
            weekNumbers: true,
            weekText: 'S'
        });            

        calendar.render();
    });
</script>

@endpush
@endsection

