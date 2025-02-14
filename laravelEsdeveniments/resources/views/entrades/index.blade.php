<x-app-layout>
    <!-- Fullscreen Black Background -->
    <div class="min-h-screen bg-black flex items-center justify-center">
        <!-- Centered Table Container -->
        <div class="bg-gray-900 p-8 rounded-lg shadow-lg max-w-7xl w-full sm:px-6 lg:px-8 text-gray-100">

            <!-- Title and Actions -->
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-3xl font-bold text-rose-600">{{ __("Llistat d'Entrades") }}</h3>
                <a href="{{ route('entrades.create') }}" 
                   class="flex items-center bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition-colors">
                    <span class="mr-2">➕</span> Afegir Entrada
                </a>
            </div>

            <!-- Table -->
            @if ($entrades->isEmpty())
                <p class="text-center text-lg text-gray-400">No s'han trobat entrades.</p>
            @else
                <table class="w-full table-auto text-left">
                    <thead>
                        <tr class="border-b border-gray-700">
                            <th class="px-4 py-2 text-lg font-medium">Tipus d'Entrada</th>
                            <th class="px-4 py-2 text-lg font-medium">Descompte</th>
                            <th class="px-4 py-2 text-lg font-medium">Accions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($entrades as $entrada)
                            <tr class="border-b border-gray-700">
                                <td class="px-4 py-2">{{ $entrada->tipus_entrada }}</td>
                                <td class="px-4 py-2">{{ $entrada->descompte }}%</td>
                                <td class="px-4 py-2 flex space-x-2">
                                    <!-- Ver Entrada -->
                                    <a href="{{ route('entrades.show', ['id_entrada' => $entrada->id_entrada]) }}" 
                                       class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition-colors">
                                        Veure
                                    </a>
                                    <!-- Editar Entrada -->
                                    <a href="{{ route('entrades.edit', ['id_entrada' => $entrada->id_entrada]) }}" 
                                       class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded transition-colors">
                                        Editar
                                    </a>
                                    <!-- Eliminar Entrada -->
                                    <form action="{{ route('entrades.destroy', ['id_entrada' => $entrada->id_entrada]) }}" method="POST" class="inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded transition-colors">
                                            Eliminar
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
</x-app-layout>