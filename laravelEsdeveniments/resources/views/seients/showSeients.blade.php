<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Selecciona els Seients') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-lg font-medium text-black">Sala: {{ $sala->nom_sala }}</h3>
                    <br>
                    <!-- Leyenda de los estados de los asientos -->
                    <div class="mb-6 flex justify-between">
                        <div class="flex items-center mb-2">
                            <img src="{{ asset('img/seients/Acompanyant_d.png') }}" alt="Acompanyant" class="w-6 h-6 mr-2">
                            <span>Acompanyament</span>
                        </div>
                        <div class="flex items-center mb-2">
                            <img src="{{ asset('img/seients/Cadira_rodes_d.png') }}" alt="Cadira_rodes" class="w-6 h-6 mr-2">
                            <span>Cadira rodes</span>
                        </div>
                        <div class="flex items-center mb-2">
                            <img src="{{ asset('img/seients/Seient_b.png') }}" alt="Seient_b" class="w-6 h-6 mr-2">
                            <span>Bloquejat</span>
                        </div>
                        <div class="flex items-center mb-2">
                            <img src="{{ asset('img/seients/Seient_d.png') }}" alt="Seient_d" class="w-6 h-6 mr-2">
                            <span>Disponible</span>
                        </div>
                        <div class="flex items-center mb-2">
                            <img src="{{ asset('img/seients/Seient_nd.png') }}" alt="Seient_ns" class="w-6 h-6 mr-2">
                            <span>No disponible</span>
                        </div>
                        <div class="flex items-center mb-2">
                            <img src="{{ asset('img/seients/Seient_s.png') }}" alt="Seient_s" class="w-6 h-6 mr-2">
                            <span>Seleccionat</span>
                        </div>
                    </div>

                    @foreach($seients as $fila => $seientsFila)
                        <div class="flex justify-center mb-4">
                            <div class="text-center mr-2">{{ $fila }}</div>
                            @foreach($seientsFila as $seient)
                                <div class="relative mx-1">
                                    <button class="seat @if($seient->estat_seient == 1) Seient_d @elseif($seient->estat_seient == 2) Seient_s @elseif($seient->estat_seient == 3) Seient_nd @elseif($seient->estat_seient == 4) Seient_b @elseif($seient->estat_seient == 5) invisible @elseif($seient->estat_seient == 6) Acompanyant_d @elseif($seient->estat_seient == 7) Acompanyant_nd @elseif($seient->estat_seient == 8) Acompanyant_s @elseif($seient->estat_seient == 9) Cadira_rodes_d @elseif($seient->estat_seient == 10) Cadira_rodes_nd @elseif($seient->estat_seient == 11) Cadira_rodes_s @else Seient_s @endif" data-seient-id="{{ $seient->id_seient }}" data-preu="{{ $seient->preu }}" data-fila="{{ $seient->fila }}" data-columna="{{ $seient->columna }}">
                                        @if($seient->estat_seient != 5)
                                            <img src="@if($seient->estat_seient == 1) {{ asset('img/seients/Seient_d.png') }} @elseif($seient->estat_seient == 2) {{ asset('img/seients/Seient_s.png') }} @elseif($seient->estat_seient == 3) {{ asset('img/seients/Seient_nd.png') }} @elseif($seient->estat_seient == 4) {{ asset('img/seients/Seient_b.png') }} @elseif($seient->estat_seient == 6) {{ asset('img/seients/Acompanyant_d.png') }} @elseif($seient->estat_seient == 7) {{ asset('img/seients/Acompanyant_nd.png') }} @elseif($seient->estat_seient == 8) {{ asset('img/seients/Acompanyant_s.png') }} @elseif($seient->estat_seient == 9) {{ asset('img/seients/Cadira_rodes_d.png') }} @elseif($seient->estat_seient == 10) {{ asset('img/seients/Cadira_rodes_nd.png') }} @elseif($seient->estat_seient == 11) {{ asset('img/seients/Cadira_rodes_s.png') }} @else {{ asset('img/seients/Seient_s.png') }} @endif" alt="Seient">
                                        @endif
                                    </button>
                                </div>
                            @endforeach
                        </div>
                    @endforeach

                    <!-- Contenedor para mostrar la información de los asientos seleccionados -->
                    <div id="selected-seats-info" class="mt-6 p-4 bg-gray-200 dark:bg-gray-700 rounded-lg hidden">
                        <h4 class="text-lg font-medium text-black dark:text-white">Asientos Seleccionados</h4>
                        <div id="seats-info" class="text-black dark:text-white"></div>
                        <p id="total-price" class="text-black dark:text-white mt-2"></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const seients = document.querySelectorAll('button[data-seient-id]');
            const selectedSeatsInfo = document.getElementById('selected-seats-info');
            const seatsInfo = document.getElementById('seats-info');
            const totalPrice = document.getElementById('total-price');
            let selectedSeats = [];

            seients.forEach(seient => {
                seient.addEventListener('click', function(event) {
                    // Evitar clic en asientos invisibles, bloqueados o no disponibles
                    if (this.classList.contains('invisible') || this.classList.contains('Seient_b') || this.classList.contains('Seient_nd')) {
                        event.preventDefault();
                        return;
                    }

                    const seientId = this.getAttribute('data-seient-id');
                    const preu = parseFloat(this.getAttribute('data-preu'));
                    const fila = this.getAttribute('data-fila');
                    const columna = this.getAttribute('data-columna');

                    // Cambiar el estado del asiento a seleccionado
                    this.classList.toggle('selected');

                    // Actualizar la lista de asientos seleccionados
                    if (this.classList.contains('selected')) {
                        selectedSeats.push({ seientId, preu, fila, columna });
                    } else {
                        selectedSeats = selectedSeats.filter(seat => seat.seientId !== seientId);
                    }

                    // Actualizar el contenido del botón
                    if (this.classList.contains('selected')) {
                        let selectedImage = '';
                        if (this.classList.contains('Acompanyant_d')) {
                            selectedImage = 'Acompanyant_s.png';
                        } else if (this.classList.contains('Cadira_rodes_d')) {
                            selectedImage = 'Cadira_rodes_s.png';
                        } else if (this.classList.contains('Seient_d')) {
                            selectedImage = 'Seient_s.png';
                        } else {
                            selectedImage = 'Seient_s.png';
                        }
                        this.innerHTML = `<img src="{{ asset('img/seients/') }}/${selectedImage}" alt="Seleccionat">`;
                    } else {
                        let estatSeient = '';
                        if (this.classList.contains('Acompanyant_d')) {
                            estatSeient = 'Acompanyant_d';
                        } else if (this.classList.contains('Cadira_rodes_d')) {
                            estatSeient = 'Cadira_rodes_d';
                        } else if (this.classList.contains('Seient_b')) {
                            estatSeient = 'Seient_b';
                        } else if (this.classList.contains('Seient_d')) {
                            estatSeient = 'Seient_d';
                        } else if (this.classList.contains('Seient_ns')) {
                            estatSeient = 'Seient_ns';
                        } else {
                            estatSeient = 'Seient_s';
                        }
                        this.innerHTML = estatSeient !== 'invisible' ? `<img src="{{ asset('img/seients/') }}/${estatSeient}.png" alt="Seient">` : '';
                    }

                    // Mostrar la información de los asientos seleccionados
                    if (selectedSeats.length > 0) {
                        let seatsInfoHtml = '';
                        let total = 0;
                        selectedSeats.forEach(seat => {
                            seatsInfoHtml += `<p>Ubicación: Fila ${seat.fila}, Columna ${seat.columna} - Precio: ${seat.preu}€</p>`;
                            total += seat.preu;
                        });
                        seatsInfo.innerHTML = seatsInfoHtml;
                        totalPrice.textContent = `Total: ${total.toFixed(2)}€`;
                        selectedSeatsInfo.classList.remove('hidden');
                    } else {
                        selectedSeatsInfo.classList.add('hidden');
                    }
                });
            });
        });
    </script>
</x-app-layout>