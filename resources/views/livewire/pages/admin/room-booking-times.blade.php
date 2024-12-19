<div>
    <x-mary-header title="Booking time" />
    <div id="calendar"></div>

    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/index.global.min.js"></script>
        <script type="module">
            document.addEventListener('DOMContentLoaded', function () {
                const calendarEl = document.getElementById('calendar')
                const calendar = new FullCalendar.Calendar(calendarEl, {
                    initialView: 'dayGridMonth',
                    events: @json($events)
                })
                calendar.render()
            })
        </script>
    @endpush

    <script>
        document.addEventListener('reloadCalendar', (event) => {
            const calendarEl = document.getElementById('calendar');
            const calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                events: event.detail.events
            });
            calendar.render();
        });
    </script>

</div>