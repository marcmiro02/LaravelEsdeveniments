<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Horaris de l\'Esdeveniment: ') . $esdeveniment->nom }}
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
            const esdevenimentId = "{{ $esdeveniment->id_esdeveniment }}";
            const esdevenimentNom = "{{ $esdeveniment->nom }}";
            const esdevenimentDuracio = "{{ $esdeveniment->duracio }}"; // Duració de l'esdeveniment en format HH:mm:ss

            const events = {!! json_encode($horaris->map(function($horari) {
                $start = new DateTime($horari->data_hora);
                $duracio = explode(':', $horari->esdeveniment->duracio);
                $end = (clone $start)->add(new DateInterval("PT{$duracio[0]}H{$duracio[1]}M{$duracio[2]}S"));

                return [
                    'title' => $horari->esdeveniment->nom,
                    'start' => $start->format('Y-m-d\TH:i:s'),
                    'end' => $end->format('Y-m-d\TH:i:s'),
                    'url' => route('horaris.show', $horari->id_horari),
                    'id' => $horari->id_horari,
                    'description' => $horari->esdeveniment->sinopsis,
                    'sala' => $horari->esdeveniment->sala ? $horari->esdeveniment->sala->nom_sala : 'No assignada',  
                    'director' => $horari->esdeveniment->director,
                    'actors' => $horari->esdeveniment->actors,
                    'durada' => $horari->esdeveniment->duracio
                ];
            })->toArray()) !!};

            const calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                locale: 'ca',
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay'
                },
                events: events,
                editable: true,
                selectable: true,
                dateClick: function(info) {
                    Swal.fire({
                        title: 'Afegir Horari',
                        html: `
                            <input type="time" id="hora" class="swal2-input" value="12:00">
                        `,
                        showCancelButton: true,
                        confirmButtonText: 'Afegir',
                        cancelButtonText: 'Cancel·lar',
                        preConfirm: () => {
                            const hora = document.getElementById('hora').value;
                            if (!hora) {
                                Swal.showValidationMessage('L\'hora és requerida');
                                return false;
                            }
                            return hora;
                        }
                    }).then((result) => {
                        if (result.isConfirmed) {
                            const dateTimeStr = info.dateStr + 'T' + result.value + ':00';
                            const startDateTime = new Date(dateTimeStr);
                            const [hours, minutes, seconds] = esdevenimentDuracio.split(':').map(Number);
                            const endDateTime = new Date(startDateTime);
                            endDateTime.setHours(startDateTime.getHours() + hours);
                            endDateTime.setMinutes(startDateTime.getMinutes() + minutes);
                            endDateTime.setSeconds(startDateTime.getSeconds() + seconds);

                            calendar.addEvent({
                                title: esdevenimentNom,
                                start: startDateTime,
                                end: endDateTime,
                                allDay: false
                            });

                            // Save the new event to the server
                            try {
                                fetch(`/horaris/${esdevenimentId}`, {
                                    method: 'POST',
                                    headers: {
                                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                        'Content-Type': 'application/json'
                                    },
                                    body: JSON.stringify({
                                        data_hora: JSON.stringify({
                                            start: dateTimeStr
                                        }),
                                        id_esdeveniment: esdevenimentId
                                    })
                                }).then(response => {
                                    try {
                                        if (response.ok) {
                                            response.json().then(data => {
                                                try {
                                                    Swal.fire('Afegit!', 'L\'horari ha estat afegit.', 'success');
                                                } catch (error) {
                                                    console.error('Error processing JSON:', error);
                                                    Swal.fire('Error!', 'Error processant la resposta JSON.', 'error');
                                                }
                                            }).catch(error => {
                                                console.error('Error parsing JSON:', error);
                                                Swal.fire('Error!', 'Error analitzant la resposta JSON.', 'error');
                                            });
                                        } else {
                                            console.error('Response not OK:', response);
                                            response.text().then(text => {
                                                console.error('Error response text:', text);
                                                Swal.fire('Error!', 'Error creant l\'horari.', 'error');
                                            }).catch(error => {
                                                console.error('Error reading response text:', error);
                                                Swal.fire('Error!', 'Error llegint la resposta.', 'error');
                                            });
                                        }
                                    } catch (error) {
                                        console.error('Error handling response:', error);
                                        Swal.fire('Error!', 'Error gestionant la resposta.', 'error');
                                    }
                                }).catch(error => {
                                    console.error('Fetch error:', error);
                                    Swal.fire('Error!', 'Error creant l\'horari.', 'error');
                                });
                            } catch (error) {
                                console.error('Try-catch error:', error);
                                Swal.fire('Error!', 'Error enviant la sol·licitud.', 'error');
                            }
                        }
                    });
                },
                eventClick: function(info) {
                    info.jsEvent.preventDefault(); // don't let the browser navigate

                    Swal.fire({
                        title: info.event.title,
                        html: `
                            <p><strong>Data i Hora:</strong> ${info.event.start.toLocaleString()}</p>
                            <p><strong>Durada:</strong> ${info.event.extendedProps.durada}</p>
                            <p><strong>Sinopsis:</strong> ${info.event.extendedProps.description}</p>
                            <p><strong>Sala:</strong> ${info.event.extendedProps.sala}</p>
                            <p><strong>Director:</strong> ${info.event.extendedProps.director}</p>
                            <p><strong>Actors:</strong> ${info.event.extendedProps.actors}</p>
                        `,
                        showCancelButton: true,
                        confirmButtonText: 'Eliminar',
                        cancelButtonText: 'Tancar'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            try {
                                fetch(`/horaris/${info.event.id}`, {
                                    method: 'DELETE',
                                    headers: {
                                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                        'Content-Type': 'application/json'
                                    }
                                }).then(response => {
                                    if (response.ok) {
                                        info.event.remove();
                                        Swal.fire('Eliminat!', 'L\'horari ha estat eliminat.', 'success');
                                    } else {
                                        response.text().then(text => {
                                            try {
                                                const data = JSON.parse(text);
                                                console.error('Error response:', data);
                                                Swal.fire('Error!', 'Error eliminant l\'horari.', 'error');
                                            } catch (error) {
                                                console.error('Error parsing response:', text);
                                                Swal.fire('Error!', 'Error processant la resposta.', 'error');
                                            }
                                        }).catch(() => {
                                            Swal.fire('Error!', 'Error processant la resposta.', 'error');
                                        });
                                    }
                                }).catch(error => {
                                    console.error('Fetch error:', error);
                                    Swal.fire('Error!', 'Error eliminant l\'horari.', 'error');
                                });
                            } catch (error) {
                                console.error('Try-catch error:', error);
                                Swal.fire('Error!', 'Error enviant la sol·licitud.', 'error');
                            }
                        }
                    });
                },
                eventDrop: function(info) {
                    const start = info.event.start.toISOString();
                    const end = info.event.end ? info.event.end.toISOString() : null;

                    // Log the date being sent to the server
                    console.log("Updating event with start date:", start);

                    fetch(`/horaris/${info.event.id}`, {
                        method: 'PUT',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify({
                            start,
                            end
                        })
                    }).then(response => {
                        if (!response.ok) {
                            Swal.fire('Error!', 'Error actualitzant l\'horari.', 'error');
                        }
                    }).catch(error => {
                        Swal.fire('Error!', 'Error actualitzant l\'horari.', 'error');
                    });
                }
            });

            calendar.render();
        });
    </script>
</x-app-layout>