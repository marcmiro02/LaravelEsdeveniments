<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Crear Horaris per a l\'Esdeveniment: ') . $esdeveniment->nom }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form id="horaris-form" action="{{ route('horaris.store', $esdeveniment->id_esdeveniment) }}" method="POST">
                        @csrf
                        <input type="hidden" name="data_hora" id="data_hora">
                        <div id="calendar" style="max-width: 900px; margin: 0 auto;"></div>
                        <br>
                        <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Crear Horaris</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- FullCalendar CSS -->
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/index.global.min.css" rel="stylesheet">

    <!-- FullCalendar JS -->
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/index.global.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const calendarEl = document.getElementById('calendar');
            const dataHoraInput = document.getElementById('data_hora');
            const form = document.getElementById('horaris-form');
            const duracio = "{{ $esdeveniment->duracio }}"; // Duració de l'esdeveniment en format HH:mm:ss

            const calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                locale: 'ca',
                selectable: true,
                editable: true,
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay'
                },
                dateClick: function(info) {
                    const dateStr = prompt('Introdueix l\'hora (HH:mm):', '12:00');
                    if (dateStr) {
                        const dateTimeStr = info.dateStr + 'T' + dateStr + ':00';
                        const startDateTime = new Date(dateTimeStr);
                        const [hours, minutes, seconds] = duracio.split(':').map(Number);
                        const endDateTime = new Date(startDateTime);
                        endDateTime.setHours(startDateTime.getHours() + hours);
                        endDateTime.setMinutes(startDateTime.getMinutes() + minutes);
                        endDateTime.setSeconds(startDateTime.getSeconds() + seconds);

                        calendar.addEvent({
                            title: 'Horari',
                            start: startDateTime,
                            end: endDateTime,
                            allDay: false
                        });
                    }
                },
                eventClick: function(info) {
                    if (confirm('Vols eliminar aquest horari?')) {
                        info.event.remove();
                    }
                }
            });

            calendar.render();

            form.addEventListener('submit', function() {
                const events = calendar.getEvents();
                const dataHoraArray = events.map(event => ({
                    start: event.start.toISOString(),
                    end: event.end ? event.end.toISOString() : null
                }));
                dataHoraInput.value = JSON.stringify(dataHoraArray);
            });
        });
    </script>
</x-app-layout>