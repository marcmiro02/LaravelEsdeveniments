<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Editar Seients') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form id="seat-form" action="{{ route('sales.update', $sala->id_sala) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-4">
                            <label for="nom_sala" class="block text-sm font-medium text-gray-700">Nom Sala</label>
                            <input type="text" id="nom_sala" name="nom_sala" class="mt-1 block w-full text-black" value="{{ $sala->nom_sala }}" readonly>
                        </div>

                        <div id="seats-container" class="mt-6 grid grid-cols-1 gap-4">
                            @foreach ($seients->groupBy('fila') as $fila => $columnes)
                            <div class="flex justify-center">
                                @foreach ($columnes as $seient)
                                <div class="relative mx-1">
                                    <button class="seat Seient_d" data-fila="{{ $seient->fila }}" data-columna="{{ $seient->columna }}" data-estat-seient="{{ $seient->estat_seient }}" data-preu="{{ $seient->preu }}">
                                        @if ($seient->estat_seient == 1)
                                        <img src="{{ asset('img/seients/Seient_d.png') }}" alt="Seient">
                                        @elseif ($seient->estat_seient == 9)
                                        <img src="{{ asset('img/seients/Cadira_rodes_d.png') }}" alt="Seient">
                                        @elseif ($seient->estat_seient == 6)
                                        <img src="{{ asset('img/seients/Acompanyant_d.png') }}" alt="Seient">
                                        @elseif ($seient->estat_seient == 4)
                                        <img src="{{ asset('img/seients/Seient_b.png') }}" alt="Seient">
                                        @elseif ($seient->estat_seient == 5)
                                        <img src="{{ asset('img/seients/invisible.png') }}" alt="Seient">
                                        @else
                                        <img src="{{ asset('img/seients/Seient_d.png') }}" alt="Seient">
                                        @endif
                                    </button>
                                    <input type="hidden" class="preu-seient" value="{{ $seient->preu }}">
                                </div>
                                @endforeach
                            </div>
                            @endforeach
                        </div>

                        <div class="mt-4">
                            <label for="preu" class="block text-sm font-medium text-gray-700">Preu Seient Seleccionat</label>
                            <input type="number" id="preu" class="mt-1 block w-full text-black">
                        </div>

                        <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded mt-4" id="submit-seats">Guardar Canvis</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.querySelectorAll('button.seat').forEach(button => {
            button.addEventListener('click', function(event) {
                event.preventDefault();
                const currentState = parseInt(this.dataset.estatSeient);
                const nextState = (currentState % 5) + 1; // Cycle through states 1 to 5
                this.dataset.estatSeient = nextState;

                let nextImage = '';
                switch (nextState) {
                    case 1:
                        nextImage = 'Seient_d.png';
                        this.dataset.estatSeient = 1;
                        break;
                    case 2:
                        nextImage = 'Cadira_rodes_d.png';
                        this.dataset.estatSeient = 9;
                        break;
                    case 3:
                        nextImage = 'Acompanyant_d.png';
                        this.dataset.estatSeient = 6;
                        break;
                    case 4:
                        nextImage = 'Seient_b.png';
                        this.dataset.estatSeient = 4;
                        break;
                    case 5:
                        nextImage = 'invisible.png';
                        this.dataset.estatSeient = 5;
                        break;
                    default:
                        nextImage = 'Seient_d.png';
                        this.dataset.estatSeient = 1;
                }

                if (nextImage === 'invisible.png') {
                    this.classList.add('invisible');
                    this.innerHTML = '';
                } else {
                    this.classList.remove('invisible');
                    this.innerHTML = `<img src="{{ asset('img/seients/') }}/${nextImage}" alt="Seient">`;
                }

                const preuSeientInput = document.getElementById('preu');
                preuSeientInput.value = this.dataset.preu;
                preuSeientInput.dataset.fila = this.dataset.fila;
                preuSeientInput.dataset.columna = this.dataset.columna;
            });
        });

        document.getElementById('preu').addEventListener('change', function() {
            const fila = this.dataset.fila;
            const columna = this.dataset.columna;
            const newPreu = this.value;

            const seatButton = document.querySelector(`button[data-fila="${fila}"][data-columna="${columna}"]`);
            if (seatButton) {
                seatButton.dataset.preu = newPreu;
                seatButton.title = `Fila: ${fila}, Columna: ${columna}, Preu: ${newPreu}`;
                const preuInput = seatButton.nextElementSibling;
                if (preuInput) {
                    preuInput.value = newPreu;
                }
            }
        });

        document.getElementById('seat-form').addEventListener('submit', function(event) {
            const seatsContainer = document.getElementById('seats-container');
            const seatButtons = seatsContainer.querySelectorAll('button.seat');

            seatButtons.forEach(button => {
                const fila = button.dataset.fila;
                const columna = button.dataset.columna;
                const estatSeient = button.dataset.estatSeient;
                const preu = button.dataset.preu;

                const seatInputFila = document.createElement('input');
                seatInputFila.type = 'hidden';
                seatInputFila.name = `seats[${fila}][${columna}][fila]`;
                seatInputFila.value = fila;

                const seatInputColumna = document.createElement('input');
                seatInputColumna.type = 'hidden';
                seatInputColumna.name = `seats[${fila}][${columna}][columna]`;
                seatInputColumna.value = columna;

                const seatInputEstat = document.createElement('input');
                seatInputEstat.type = 'hidden';
                seatInputEstat.name = `seats[${fila}][${columna}][estat_seient]`;
                seatInputEstat.value = estatSeient;

                const seatInputPreu = document.createElement('input');
                seatInputPreu.type = 'hidden';
                seatInputPreu.name = `seats[${fila}][${columna}][preu]`;
                seatInputPreu.value = preu;

                button.appendChild(seatInputFila);
                button.appendChild(seatInputColumna);
                button.appendChild(seatInputEstat);
                button.appendChild(seatInputPreu);
            });
        });
    </script>
</x-app-layout>