<!-- resources/views/tickets/payment.blade.php -->
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Resum de la Comanda') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-lg font-medium text-black">Resum de la Comanda</h3>
                    <br>
                    <div id="order-summary">
                        <h4 class="text-md font-medium text-black">Pel·lícula: <span id="movie-title"></span></h4>
                        <p id="movie-info"></p>
                        <h4 class="text-md font-medium text-black">Seients Seleccionats:</h4>
                        <ul id="selected-seats-list" class="list-disc pl-5"></ul>
                        <p class="text-md font-medium text-black">Preu Total: <span id="total-price"></span>€</p>
                    </div>
                    <form action="{{ route('tickets.processPayment') }}" method="POST" id="payment-form">
                        @csrf
                        <input type="hidden" name="seats" id="selected-seats">
                        <button type="submit" id="pay-button" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Pagar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const selectedSeatsInput = document.getElementById('selected-seats');
            const selectedSeats = JSON.parse(localStorage.getItem('selectedSeats')) || [];
            selectedSeatsInput.value = JSON.stringify(selectedSeats);

            const movieTitle = "Nom de la Pel·lícula"; // Canvia això segons el teu cas
            const movieInfo = "Informació de la pel·lícula"; // Canvia això segons el teu cas

            document.getElementById('movie-title').textContent = movieTitle;
            document.getElementById('movie-info').textContent = movieInfo;

            const selectedSeatsList = document.getElementById('selected-seats-list');
            let total = 0;
            selectedSeats.forEach(seat => {
                const listItem = document.createElement('li');
                listItem.textContent = `Fila ${seat.fila}, Columna ${seat.columna} - Preu: ${seat.preu}€`;
                selectedSeatsList.appendChild(listItem);
                total += seat.preu;
            });

            document.getElementById('total-price').textContent = total.toFixed(2);
        });
    </script>
</x-app-layout>