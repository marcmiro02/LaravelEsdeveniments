<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Crear Seients') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form id="seat-form" action="{{ route('seients.store') }}" method="POST">
                        @csrf

                        <div class="mb-4">
                            <label for="id_sala" class="block text-sm font-medium text-gray-700">ID Sala</label>
                            <input type="number" id="id_sala" name="id_sala" class="mt-1 block w-full text-black" required>
                        </div>
                        <div class="mb-4">
                            <label for="num_files" class="block text-sm font-medium text-gray-700">Número de Files</label>
                            <input type="number" id="num_files" name="num_files" class="mt-1 block w-full text-black" required>
                        </div>
                        <div class="mb-4">
                            <label for="num_columnes" class="block text-sm font-medium text-gray-700">Número de Columnes</label>
                            <input type="number" id="num_columnes" name="num_columnes" class="mt-1 block w-full text-black" required>
                        </div>

                        <button type="button" id="generate-seats" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Generar Seients</button>

                        <div id="seats-container" class="mt-6 grid grid-cols-1 gap-4"></div>

                        <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded mt-4 hidden" id="submit-seats">Crear Seients</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('generate-seats').addEventListener('click', function() {
            const numFiles = document.getElementById('num_files').value;
            const numColumnes = document.getElementById('num_columnes').value;
            const seatsContainer = document.getElementById('seats-container');
            seatsContainer.innerHTML = '';

            for (let fila = 1; fila <= numFiles; fila++) {
                const rowDiv = document.createElement('div');
                rowDiv.classList.add('flex', 'justify-center', 'mb-4');

                for (let columna = 1; columna <= numColumnes; columna++) {
                    const seatDiv = document.createElement('div');
                    seatDiv.classList.add('relative', 'mx-1');

                    const seatButton = document.createElement('button');
                    seatButton.classList.add('seat', 'Seient_d');
                    seatButton.dataset.fila = fila;
                    seatButton.dataset.columna = columna;
                    seatButton.dataset.estatSeient = 1; // Default estat_seient

                    seatButton.innerHTML = `<img src="{{ asset('img/seients/Seient_d.png') }}" alt="Seient">`;

                    seatButton.addEventListener('click', function(event) {
                        event.preventDefault();
                        const currentState = parseInt(this.dataset.estatSeient);
                        const nextState = (currentState % 5) + 1; // Cycle through states 1 to 6
                        this.dataset.estatSeient = nextState;

                        let nextImage = '';
                        switch (nextState) {
                            case 1:
                                nextImage = 'Seient_d.png';
                                break;
                            case 2:
                                nextImage = 'Cadira_rodes_d.png';
                                break;
                            case 3:
                                nextImage = 'Acompanyant_d.png';
                                break;
                            case 4:
                                nextImage = 'Seient_b.png';
                                break;
                            case 5:
                                nextImage = 'invisible.png'; // Invisible state
                                break;
                            default:
                                nextImage = 'Seient_d.png';
                        }

                        if (nextImage === '') {
                            this.classList.add('invisible');
                            this.innerHTML = '';
                        } else {
                            this.classList.remove('invisible');
                            this.innerHTML = `<img src="{{ asset('img/seients/') }}/${nextImage}" alt="Seient">`;
                        }
                    });

                    seatDiv.appendChild(seatButton);
                    rowDiv.appendChild(seatDiv);
                }

                seatsContainer.appendChild(rowDiv);
            }

            document.getElementById('submit-seats').classList.remove('hidden');
        });

        document.getElementById('seat-form').addEventListener('submit', function(event) {
            const seatsContainer = document.getElementById('seats-container');
            const seatButtons = seatsContainer.querySelectorAll('button.seat');

            seatButtons.forEach(button => {
                const fila = button.dataset.fila;
                const columna = button.dataset.columna;
                const estatSeient = button.dataset.estatSeient;

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

                button.appendChild(seatInputFila);
                button.appendChild(seatInputColumna);
                button.appendChild(seatInputEstat);
            });
        });
    </script>
</x-app-layout>