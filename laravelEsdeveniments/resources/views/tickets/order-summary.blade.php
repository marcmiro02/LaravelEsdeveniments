<x-app-layout>
    <div class="py-12 bg-black dark:bg-black">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-900 dark:bg-gray-900 overflow-hidden shadow-2xl sm:rounded-lg mb-8">
                <div class="p-8 text-gray-100 dark:text-gray-100">
                    <h1 class="text-3xl font-bold text-center text-rose-600 mb-4">
                        {{ strtoupper(optional($esdeveniment)->nom ?? 'Esdeveniment no trobat') }}
                    </h1>

                    <div class="flex justify-center">
                        @if($esdeveniment && $esdeveniment->foto_portada)
                            <img src="data:image/png;base64,{{ $esdeveniment->foto_portada }}" 
                                 alt="{{ $esdeveniment->nom }}" 
                                 class="w-full h-96 object-cover mb-4">
                        @else
                            <p class="text-center text-gray-500">No hi ha imatge disponible</p>
                        @endif
                    </div>

                    <div id="entrades-summary" class="mb-4">
                        <table class="table-auto w-full">
                            <thead>
                                <tr>
                                    <th class="px-4 py-2">Asiento</th>
                                    <th class="px-4 py-2">Precio</th>
                                    <th class="px-4 py-2">Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($selectedEntrades as $entrada)
                                    <tr>
                                        <td class="border px-4 py-2">{{ $entrada['asiento'] }}</td>
                                        <td class="border px-4 py-2">{{ number_format($entrada['precio'], 2) }}€</td>
                                        <td class="border px-4 py-2">
                                            {{ number_format($entrada['precio'] * $entrada['cantidad'], 2) }}€
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="flex justify-between mt-4">
                        <h4 class="text-md font-medium text-rose-600">Entrades Seleccionades: <span id="selected-entrades-count">{{ count($selectedEntrades) }}</span></h4>
                        <button id="pay-button" class="bg-rose-600 hover:bg-rose-800 text-white font-bold py-2 px-4 rounded mt-2" disabled>Pagar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const quantitatInputs = document.querySelectorAll('.entrada-quantitat');
            const selectedEntradesCount = document.getElementById('selected-entrades-count');
            const payButton = document.getElementById('pay-button');
            let totalEntrades = 0;

            quantitatInputs.forEach(input => {
                input.addEventListener('input', function() {
                    const descompte = parseFloat(this.dataset.descompte);
                    const preu = 10; // Asegúrate de tener el precio correcto aquí.
                    const preuAmbDescompte = preu - (preu * (descompte / 100));
                    const quantitat = parseInt(this.value);
                    const subtotalElement = this.closest('tr').querySelector('.entrada-subtotal');
                    subtotalElement.textContent = (preuAmbDescompte * quantitat).toFixed(2) + '€';

                    totalEntrades = Array.from(quantitatInputs).reduce((total, input) => total + parseInt(input.value), 0);
                    selectedEntradesCount.textContent = `${totalEntrades}`;

                    payButton.disabled = totalEntrades === 0;
                });
            });

            payButton.addEventListener('click', function() {
                window.location.href = "{{ route('tickets.orderSummary') }}";
            });
        });
    </script>
</x-app-layout>
