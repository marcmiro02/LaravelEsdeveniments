<x-app-layout>
    <!-- Fullscreen Black Background -->
    <div class="min-h-screen bg-black flex items-center justify-center">
        <!-- Centered Table Container -->
        <div class="bg-gray-900 p-8 rounded-lg shadow-lg max-w-7xl w-full sm:px-6 lg:px-8 text-gray-100">

            <!-- Title and Actions -->
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-3xl font-bold text-rose-600">{{ __("Llistat d'Esdeveniments") }}</h3>
                <a href="{{ route('esdeveniments.create') }}"
                    class="flex items-center bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition-colors">
                    <span class="mr-2">➕</span> Afegir Esdeveniment
                </a>
            </div>

            <!-- Table -->
            @if ($esdeveniments->isEmpty())
                <p class="text-center text-lg text-gray-400">No s'han trobat esdeveniments.</p>
            @else
                <table class="w-full table-auto text-left">
                    <thead>
                        <tr class="border-b border-gray-700">
                            <th class="px-4 py-2 text-lg font-medium">Nom</th>
                            <th class="px-4 py-2 text-lg font-medium">Data Estrena</th>
                            <th class="px-4 py-2 text-lg font-medium">Accions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($esdeveniments as $esdeveniment)
                            <tr class="border-b border-gray-700">
                                <td class="px-4 py-2">{{ $esdeveniment->nom }}</td>
                                <td class="px-4 py-2">{{ $esdeveniment->data_estrena }}</td>
                                <td class="px-4 py-2 flex space-x-2">
                                    <!-- Ver Esdeveniment -->
                                    <a href="{{ route('esdeveniments.show', $esdeveniment->id_esdeveniment) }}"
                                        class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition-colors">
                                        Veure
                                    </a>
                                    <!-- Editar Esdeveniment -->
                                    <a href="{{ route('esdeveniments.edit', $esdeveniment->id_esdeveniment) }}"
                                        class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded transition-colors">
                                        Editar
                                    </a>
                                    <!-- Eliminar Esdeveniment -->
                                    <form action="{{ route('esdeveniments.destroy', $esdeveniment->id_esdeveniment) }}"
                                        method="POST" class="inline-block">
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
    </div>
</x-app-layout>