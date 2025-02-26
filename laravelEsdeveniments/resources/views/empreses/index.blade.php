<x-app-layout>
    <!-- Fullscreen Black Background -->
    <div class="min-h-screen bg-black flex items-center justify-center">
        <!-- Centered Table Container -->
        <div class="bg-gray-900 p-8 rounded-lg shadow-lg max-w-7xl w-full sm:px-6 lg:px-8 text-gray-100">

            <!-- Title and Actions -->
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-3xl font-bold text-rose-600">{{ __("Llistat d'empreses") }}</h3>
                <a href="{{ route('empreses.create') }}" 
                   class="flex items-center bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition-colors">
                    <span class="mr-2">🏢</span> Afegir Empresa
                </a>
            </div>

            <!-- Table -->
            @if ($empreses->isEmpty())
                <p class="text-center text-lg text-gray-400">No s'han trobat empreses.</p>
            @else
                <table class="w-full table-auto text-left">
                    <thead>
                        <tr class="border-b border-gray-700">
                            <th class="px-4 py-2 text-lg font-medium">Nom Empresa</th>
                            <th class="px-4 py-2 text-lg font-medium">NIF</th>
                            <th class="px-4 py-2 text-lg font-medium">Adreça</th>
                            <th class="px-4 py-2 text-lg font-medium">Ciutat</th>
                            <th class="px-4 py-2 text-lg font-medium">Telèfon</th>
                            <th class="px-4 py-2 text-lg font-medium">Email</th>
                            <th class="px-4 py-2 text-lg font-medium">Accions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($empreses as $empresa)
                            <tr class="border-b border-gray-700">
                                <td class="px-4 py-2">{{ $empresa->nom_empresa }}</td>
                                <td class="px-4 py-2">{{ $empresa->nif }}</td>
                                <td class="px-4 py-2">{{ $empresa->adreca }}</td>
                                <td class="px-4 py-2">{{ $empresa->ciutat }}</td>
                                <td class="px-4 py-2">{{ $empresa->telefon }}</td>
                                <td class="px-4 py-2">{{ $empresa->email }}</td>
                                <td class="px-4 py-2 flex space-x-2">
                                    <!-- Ver Empresa -->
                                    <a href="{{ route('empreses.show', ['id_empresa' => $empresa->id_empresa]) }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition-colors">Veure</a>

                                    <!-- Editar Empresa -->
                                    <a href="{{ route('empreses.edit', ['id_empresa' => $empresa->id_empresa]) }}" class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded transition-colors">Editar</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
</x-app-layout>