<x-app-layout>
    <!-- Fullscreen Black Background -->
    <div class="min-h-screen bg-black flex items-center justify-center">
        <!-- Centered Form Container -->
        <div class="bg-gray-900 p-8 rounded-lg shadow-lg max-w-7xl w-full sm:px-6 lg:px-8 text-gray-100">

            <!-- Title -->
            <h3 class="text-3xl font-bold text-rose-600 mb-6 text-center">Crear Seients</h3>

            <form id="seat-form" action="{{ route('sales.store') }}" method="POST" class="space-y-6">
                @csrf

                <div class="mb-4">
                    <label for="nom_sala" class="block text-lg font-medium text-gray-100">Nom Sala</label>
                    <input type="text" id="nom_sala" name="nom_sala"
                        class="mt-2 block w-full px-4 py-3 bg-gray-800 border border-gray-700 rounded-lg focus:outline-none focus:border-rose-600 text-white"
                        required>
                </div>
                <div class="mb-4">
                    <label for="num_files" class="block text-lg font-medium text-gray-100">Número de Files</label>
                    <input type="number" id="num_files" name="num_files"
                        class="mt-2 block w-full px-4 py-3 bg-gray-800 border border-gray-700 rounded-lg focus:outline-none focus:border-rose-600 text-white"
                        required>
                </div>
                <div class="mb-4">
                    <label for="num_columnes" class="block text-lg font-medium text-gray-100">Número de Columnes</label>
                    <input type="number" id="num_columnes" name="num_columnes"
                        class="mt-2 block w-full px-4 py-3 bg-gray-800 border border-gray-700 rounded-lg focus:outline-none focus:border-rose-600 text-white"
                        required>
                </div>
                <div class="mb-4">
                    <label for="preu_estandard" class="block text-lg font-medium text-gray-100">Preu Estàndard</label>
                    <input type="number" id="preu_estandard" name="preu_estandard"
                        class="mt-2 block w-full px-4 py-3 bg-gray-800 border border-gray-700 rounded-lg focus:outline-none focus:border-rose-600 text-white"
                        required>
                </div>

                <button type="button" id="generate-seats"
                    class="w-full bg-rose-600 hover:bg-rose-700 text-white font-bold py-3 rounded-lg transition-colors duration-300">Generar
                    Seients</button>

                <div id="seats-container" class="mt-6 grid grid-cols-1 gap-4"></div>

                <div class="mt-4">
                    <label for="preu" class="block text-lg font-medium text-gray-100">Preu Seient Seleccionat</label>
                    <input type="number" id="preu"
                        class="mt-2 block w-full px-4 py-3 bg-gray-800 border border-gray-700 rounded-lg focus:outline-none focus:border-rose-600 text-white">
                </div>

                <button type="submit"
                    class="w-full bg-rose-600 hover:bg-rose-700 text-white font-bold py-3 rounded-lg transition-colors duration-300 mt-4 hidden"
                    id="submit-seats">Crear Seients</button>
            </form>

        </div>
    </div>

    <script>
        document.getElementById('generate-seats').addEventListener('click', function () {
            const numFiles = document.getElementById('num_files').value;
            const numColumnes = document.getElementById('num_columnes').value;
            const preuEstandard = document.getElementById('preu_estandard').value;
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
                    seatButton.dataset.preu = preuEstandard; // Default preu

                    seatButton.innerHTML = `<img src="{{ asset('img/seients/Seient_d.png') }}" alt="Seient">`;
                    seatButton.title = `Fila: ${fila}, Columna: ${columna}, Preu: ${preuEstandard}`;

                    seatButton.addEventListener('click', function (event) {
                        event.preventDefault();
                        const currentState = parseInt(this.dataset.estatSeient);
                        let nextState = (currentState % 5) + 1; // Cycle through states 1 to 5

                        let nextImage = '';
                        if (nextState === 1) {
                            nextImage = 'Seient_d.png';
                        } else if (nextState === 2) {
                            nextImage = 'Cadira_rodes_d.png';
                        } else if (nextState === 3) {
                            nextImage = 'Acompanyant_d.png';
                        } else if (nextState === 4) {
                            nextImage = 'Seient_b.png';
                        } else if (nextState === 5) {
                            nextImage = 'invisible.png';
                        }

                        this.dataset.estatSeient = nextState;
                        this.innerHTML = `<img src="{{ asset('img/seients/') }}/${nextImage}" alt="Seient">`;
                    });

                    seatButton.addEventListener('click', function (event) {
                        event.preventDefault();
                        const preuSeientInput = document.getElementById('preu');
                        preuSeientInput.value = this.dataset.preu;
                        preuSeientInput.dataset.fila = this.dataset.fila;
                        preuSeientInput.dataset.columna = this.dataset.columna;
                    });

                    const preuInput = document.createElement('input');
                    preuInput.type = 'hidden';
                    preuInput.classList.add('preu-seient');
                    preuInput.value = preuEstandard;

                    seatDiv.appendChild(seatButton);
                    seatDiv.appendChild(preuInput);
                    rowDiv.appendChild(seatDiv);
                }

                seatsContainer.appendChild(rowDiv);
            }

            document.getElementById('submit-seats').classList.remove('hidden');
        });

        document.getElementById('preu').addEventListener('change', function () {
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

        document.getElementById('seat-form').addEventListener('submit', function (event) {
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