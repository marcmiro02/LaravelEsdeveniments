<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Crear Empresa') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form action="{{ route('empreses.store') }}" method="POST">
                        @csrf

                        <div class="mb-4">
                            <label for="nif" class="block text-sm font-medium text-gray-700">NIF</label>
                            <input type="text" id="nif" name="nif" class="mt-1 block w-full text-black" required>
                        </div>
                        <div class="mb-4">
                            <label for="nom_empresa" class="block text-sm font-medium text-gray-700">Nom de l'empresa</label>
                            <input type="text" id="nom_empresa" name="nom_empresa" class="mt-1 block w-full text-black" required>
                        </div>
                        <div class="mb-4">
                            <label for="adreca" class="block text-sm font-medium text-gray-700">Adreça</label>
                            <input type="text" id="adreca" name="adreca" class="mt-1 block w-full text-black" required>
                        </div>
                        <div class="mb-4">
                            <label for="ciutat" class="block text-sm font-medium text-gray-700">Ciutat</label>
                            <input type="text" id="ciutat" name="ciutat" class="mt-1 block w-full text-black" required>
                        </div>
                        <div class="mb-4">
                            <label for="telefon" class="block text-sm font-medium text-gray-700">Telèfon</label>
                            <input type="text" id="telefon" name="telefon" class="mt-1 block w-full text-black" required>
                        </div>
                        <div class="mb-4">
                            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                            <input type="email" id="email" name="email" class="mt-1 block w-full text-black" required>
                        </div>

                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Crear Empresa</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
