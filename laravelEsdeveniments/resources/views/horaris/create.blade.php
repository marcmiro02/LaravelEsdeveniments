<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Crear Horari per l\'Esdeveniment: ') . $esdeveniment->nom }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div id="calendar" style="max-width: 900px; margin: 0 auto;"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- FullCalendar CSS -->
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/index.global.min.css" rel="stylesheet">

    <!-- FullCalendar JS -->
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/index.global.min.js"></script>
    <!-- SweetAlert2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.8/dist/sweetalert2.min.css" rel="stylesheet">
    <!-- SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.8/dist/sweetalert2.all.min.js"></script>

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
                    Swal.fire({
                        title: 'Introdueix l\'hora',
                        input: 'time',
                        inputLabel: 'Hora (HH:mm)',
                        inputValue: '12:00',
                        showCancelButton: true,
                        confirmButtonText: 'Afegir',
                        cancelButtonText: 'Cancel·lar',
                        preConfirm: (time) => {
                            if (!time) {
                                Swal.showValidationMessage('L\'hora és requerida');
                                return false;
                            }
                            return time;
                        }
                    }).then((result) => {
                        if (result.isConfirmed) {
                            const dateTimeStr = info.dateStr + 'T' + result.value + ':00';
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

                            // Update the hidden input field with the selected date and time
                            dataHoraInput.value = dateTimeStr;
                        }
                    });
                },
                eventClick: function(info) {
                    Swal.fire({
                        title: 'Vols eliminar aquest horari?',
                        showCancelButton: true,
                        confirmButtonText: 'Eliminar',
                        cancelButtonText: 'Cancel·lar'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            info.event.remove();
                        }
                    });
                }
            });

            calendar.render();
        });
    </script>
</x-app-layout>