<x-app-layout>
    <!-- Fullscreen Black Background -->
    <div class="min-h-screen bg-black flex items-center justify-center">
        <!-- Centered Table Container -->
        <div class="bg-gray-900 p-8 rounded-lg shadow-lg max-w-7xl w-full sm:px-6 lg:px-8 text-gray-100">
            <div class="py-12">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg border-2 border-pink-600">
                        <div class="p-6 text-gray-100">
                            <form action="{{ route('dades.esdeveniment') }}" method="POST">
                                @csrf
                                <div class="mb-6">
                                    <label for="id_esdeveniment" class="block text-sm font-medium text-pink-400">
                                        Esdeveniment:
                                    </label>
                                    <select name="id_esdeveniment" id="id_esdeveniment" class="mt-1 block w-full bg-gray-700 border border-pink-600 text-pink-100 rounded-md shadow-sm focus:ring-pink-500 focus:border-pink-500 sm:text-sm py-2 px-3">
                                        @foreach ($esdeveniments as $esdeveniment)
                                            <option value="{{ $esdeveniment->id_esdeveniment }}" class="bg-gray-800">{{ $esdeveniment->nom }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="flex justify-end">
                                    <button type="submit" class="bg-pink-600 hover:bg-pink-700 text-white font-bold py-2 px-6 rounded-lg transition-colors transform hover:scale-105">
                                        Confirmar
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>