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
                    
                    <!-- Leyenda de los estados de los asientos -->
                    <div class="mb-6">
                        <div class="flex items-center mb-2">
                            <div class="w-6 h-6 bg-green-500 rounded-lg mr-2"></div>
                            <span>Disponible</span>
                        </div>
                        <div class="flex items-center mb-2">
                            <div class="w-6 h-6 bg-red-500 rounded-lg mr-2"></div>
                            <span>Ocupat</span>
                        </div>
                        <div class="flex items-center mb-2">
                            <div class="w-6 h-6 bg-yellow-500 rounded-lg mr-2"></div>
                            <span>Reservat</span>
                        </div>
                        <div class="flex items-center mb-2">
                            <div class="w-6 h-6 bg-blue-500 rounded-lg mr-2"></div>
                            <span>Seleccionat</span>
                        </div>
                    </div>

                    @foreach($seients as $fila => $seientsFila)
                        <div class="flex justify-center mb-4">
                            <div class="text-center mr-2">{{ $fila }}</div>
                            @foreach($seientsFila as $seient)
                                <div class="relative mx-1">
                                    <button class="seat @if($seient->estat_seient == 1) available @elseif($seient->estat_seient == 2) occupied @else reserved @endif" data-seient-id="{{ $seient->id_seient }}">
                                        <span class="seat-label">{{ $seient->fila }}-{{ $seient->columna }}</span>
                                    </button>
                                </div>
                            @endforeach
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const seients = document.querySelectorAll('button[data-seient-id]');
            seients.forEach(seient => {
                seient.addEventListener('click', function() {
                    const seientId = this.getAttribute('data-seient-id');
                    // Cambiar el estado del asiento a seleccionado
                    this.classList.toggle('selected');
                    // Cambiar el contenido del botón
                    if (this.classList.contains('selected')) {
                        this.innerHTML = '<svg class="v-icon v-icon--odeon-standard-seat-selected v-seat-picker-legend-item-seat__icon" x="0" y="0"><use xlink:href="#v-icon_odeon-standard-seat-selected" width="25" height="25"></use></svg>';
                    } else {
                        this.innerHTML = '<span class="seat-label">' + this.getAttribute('data-seient-id') + '</span>';
                    }
                });
            });
        });
    </script>
</x-app-layout>