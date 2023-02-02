<div wire:key="dashboard-calendar-{{ \Illuminate\Support\Str::random() }}">
    <div id="calendar"></div>

    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                var calendarEl = document.getElementById('calendar');
                var calendar = new FullCalendar.Calendar(calendarEl, {
                    initialView: 'dayGridMonth',
                    events: @json($eventList),
                });
                calendar.render();
            });
        </script>
        <link href='https://cdn.jsdelivr.net/npm/fullcalendar@5.3.1/main.min.css' rel='stylesheet' />
    @endpush

    @push('styles')
        <style>
            .fc-day-today {
                background: #252735 !important;
                border: none !important;
            }
        </style>
    @endpush
</div>
