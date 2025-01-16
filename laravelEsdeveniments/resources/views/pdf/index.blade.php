<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Selecciona un Esdeveniment') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-black-900 dark:text-white-100">
                <form action="{{ route('pdf.generarEntrada') }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label for="id_esdeveniment" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                            Esdeveniment:
                        </label>
                        <select name="id_esdeveniment" id="id_esdeveniment" class="form-control mt-1 block w-full">
                            @foreach ($esdeveniments as $esdeveniment)
                                <option value="{{ $esdeveniment->id_esdeveniment }}">{{ $esdeveniment->nom }}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        CONFIRMAR
                    </button>
                </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
