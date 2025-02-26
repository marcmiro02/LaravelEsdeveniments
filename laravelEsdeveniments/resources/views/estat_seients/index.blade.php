<x-app-layout>
    <!-- Fullscreen Black Background -->
    <div class="min-h-screen bg-black flex items-center justify-center">
        <!-- Centered Table Container -->
        <div class="bg-gray-900 p-8 rounded-lg shadow-lg max-w-7xl w-full sm:px-6 lg:px-8 text-gray-100">

            <!-- Title and Actions -->
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-3xl font-bold text-rose-600">{{ __("Llistat d'Estats dels Seients") }}</h3>
                <a href="{{ route('estat_seients.create') }}" 
                   class="flex items-center bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition-colors">
                    <span class="mr-2">➕</span> Afegir Estat del Seient
                </a>
            </div>

            <!-- Table -->
            @if ($estat_seients->isEmpty())
                <p class="text-center text-lg text-gray-400">No s'han trobat estats dels seients.</p>
            @else
                <table class="w-full table-auto text-left">
                    <thead>
                        <tr class="border-b border-gray-700">
                            <th class="px-4 py-2 text-lg font-medium">Nom Estat del Seient</th>
                            <th class="px-4 py-2 text-lg font-medium">Accions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($estat_seients as $estat_seient)
                            <tr class="border-b border-gray-700">
                                <td class="px-4 py-2">{{ $estat_seient->nom_estat_seient }}</td>
                                <td class="px-4 py-2 flex space-x-2">
                                    <!-- Ver Estat del Seient -->
                                    <a href="{{ route('estat_seients.show', ['id_estat_seient' => $estat_seient->id_estat_seient]) }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition-colors">Veure</a>

                                    <!-- Editar Estat del Seient -->
                                    <a href="{{ route('estat_seients.edit', ['id_estat_seient' => $estat_seient->id_estat_seient]) }}" class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded transition-colors">Editar</a>

                                    <!-- Eliminar Estat del Seient -->
                                    <form action="{{ route('estat_seients.destroy', ['id_estat_seient' => $estat_seient->id_estat_seient]) }}" method="POST" class="inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded transition-colors">Eliminar</button>
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