<x-app-layout>
    <div class="min-h-screen bg-black flex justify-center items-center">
        <div class="max-w-7xl w-full bg-gray-900 overflow-hidden shadow-2xl sm:rounded-lg p-8 text-gray-100">
            <!-- Encabezado -->
            <h3 class="text-3xl font-bold text-center text-rose-600 mb-6">
                Selecciona el teu seient a la sala: {{ strtoupper($sala->nom_sala) }}
            </h3>

            <!-- Leyenda de asientos -->
            <div class="grid grid-cols-3 md:grid-cols-6 gap-4 mb-8">
                @php
                    $asientosReservados = session('asientosReservados', []);
                    $legend = [
                        ['Acompanyant_d.png', 'Acompanyament'],
                        ['Cadira_rodes_d.png', 'Cadira de rodes'],
                        ['Seient_b.png', 'Bloquejat'],
                        ['Seient_d.png', 'Disponible'],
                        ['Seient_nd.png', 'No disponible'],
                        ['Seient_s.png', 'Seleccionat']
                    ];
                @endphp
                @foreach($legend as $item)
                    <div class="flex items-center">
                        <img src="{{ asset('img/seients/' . $item[0]) }}" alt="{{ $item[1] }}" class="w-6 h-6 mr-2">
                        <span>{{ $item[1] }}</span>
                    </div>
                @endforeach
            </div>

            <!-- Selección de asientos -->
            @foreach($seients as $fila => $seientsFila)
                <div class="flex justify-center mb-4">
                    <div class="text-center text-rose-600 font-bold mr-4">{{ $fila }}</div>
                    @foreach($seientsFila as $seient)
                        @php
                            $isOccupied = collect($asientosReservados)->contains(function ($asiento) use ($seient) {
                                return $asiento['fila'] == $seient->fila && $asiento['columna'] == $seient->columna;
                            });
                            // Si el asiento está ocupado, forzamos a que se vea como "No disponible"
                            if ($isOccupied) {
                                $seient->estat_seient = 7; // Seient_nd (No disponible)
                            }
                        @endphp
                        <div class="relative mx-1">
                            <button 
                                class="seat @if($seient->estat_seient == 1) Seient_d 
                                    @elseif($seient->estat_seient == 2) Cadira_rodes_d 
                                    @elseif($seient->estat_seient == 3) Acompanyant_d 
                                    @elseif($seient->estat_seient == 4) Seient_b 
                                    @elseif($seient->estat_seient == 5) invisible 
                                    @elseif($seient->estat_seient == 6) Seient_s 
                                    @elseif($seient->estat_seient == 7) Seient_nd 
                                    @elseif($isOccupied) Seient_b @endif"
                                data-seient-id="{{ $seient->id_seient }}"
                                data-preu="{{ $seient->preu }}"
                                data-fila="{{ $seient->fila }}"
                                data-columna="{{ $seient->columna }}"
                                @if($isOccupied) disabled @endif
                            >
                                @if($seient->estat_seient != 5)
                                    <img src="{{ asset('img/seients/' . 
                                        ($seient->estat_seient == 1 ? 'Seient_d.png' : 
                                        ($seient->estat_seient == 2 ? 'Cadira_rodes_d.png' : 
                                        ($seient->estat_seient == 3 ? 'Acompanyant_d.png' : 
                                        ($seient->estat_seient == 4 ? 'Seient_b.png' : 
                                        ($seient->estat_seient == 6 ? 'Seient_s.png' : 
                                        ($seient->estat_seient == 7 ? 'Seient_nd.png' : 'Seient_d.png'))))))) }}" alt="Seient">
                                @endif
                            </button>
                        </div>
                    @endforeach
                </div>
            @endforeach

            <!-- Información de asientos seleccionados -->
            <div id="selected-seats-info" class="hidden bg-gray-800 p-4 rounded-lg mt-6">
                <h4 class="text-lg font-medium text-rose-600 mb-4">Seients Seleccionats:</h4>
                <div id="seats-info"></div>
                <p id="total-price" class="font-bold text-lg mt-2"></p>
                <button id="pay-button"
                    class="bg-rose-600 hover:bg-rose-800 text-white font-bold py-3 px-6 rounded-full mt-4 transition duration-300 ease-in-out transform hover:scale-105">
                    Continuar
                </button>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const seients = document.querySelectorAll('button[data-seient-id]');
            const selectedSeatsInfo = document.getElementById('selected-seats-info');
            const seatsInfo = document.getElementById('seats-info');
            const totalPrice = document.getElementById('total-price');
            const payButton = document.getElementById('pay-button');
            let selectedSeats = [];

            seients.forEach(seient => {
                seient.addEventListener('click', function (event) {
                    if (this.classList.contains('invisible') || this.classList.contains('Seient_b') || this.classList.contains('Seient_nd')) {
                        event.preventDefault();
                        return;
                    }

                    const seientId = this.getAttribute('data-seient-id');
                    const preu = parseFloat(this.getAttribute('data-preu'));
                    const fila = this.getAttribute('data-fila');
                    const columna = this.getAttribute('data-columna');

                    this.classList.toggle('selected');

                    if (this.classList.contains('selected')) {
                        selectedSeats.push({ seientId, preu, fila, columna });
                        this.innerHTML = `<img src="{{ asset('img/seients/Seient_s.png') }}" alt="Seleccionat">`;
                    } else {
                        selectedSeats = selectedSeats.filter(seat => seat.seientId !== seientId);
                        this.innerHTML = `<img src="{{ asset('img/seients/Seient_d.png') }}" alt="Seient">`;
                    }

                    if (selectedSeats.length > 0) {
                        let seatsInfoHtml = '';
                        let total = 0;
                        selectedSeats.forEach(seat => {
                            seatsInfoHtml += `<p>Fila ${seat.fila}, Columna ${seat.columna} - Preu: ${seat.preu}€</p>`;
                            total += seat.preu;
                        });
                        seatsInfo.innerHTML = seatsInfoHtml;
                        totalPrice.textContent = `Total: ${total.toFixed(2)}€`;
                        selectedSeatsInfo.classList.remove('hidden');
                        payButton.classList.remove('hidden');
                        localStorage.setItem('selectedSeats', JSON.stringify(selectedSeats));
                    } else {
                        selectedSeatsInfo.classList.add('hidden');
                        payButton.classList.add('hidden');
                    }
                });
            });

            payButton.addEventListener('click', function () {
                const esdevenimentId = "{{ $esdeveniment->id_esdeveniment }}";
                window.location.href = "{{ route('tickets.selectEntrades') }}?id_esdeveniment=" + esdevenimentId;
            });
        });
    </script>
</x-app-layout>
