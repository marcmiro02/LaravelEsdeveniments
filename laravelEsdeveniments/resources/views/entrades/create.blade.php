<x-app-layout>
    <!-- Fullscreen Black Background -->
    <div class="min-h-screen bg-black flex items-center justify-center">
        <!-- Centered Form Container -->
        <div class="bg-gray-900 p-8 rounded-lg shadow-lg max-w-7xl w-full sm:px-6 lg:px-8 text-gray-100">

            <!-- Title -->
            <h3 class="text-3xl font-bold text-rose-600 mb-6 text-center">Crear Empresa</h3>

            <!-- Form -->
            <form action="{{ route('empreses.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf

                <!-- NIF -->
                <div>
                    <label for="nif" class="block text-lg font-medium text-gray-100">NIF</label>
                    <input type="text" id="nif" name="nif" 
                           class="mt-2 block w-full px-4 py-3 bg-gray-800 border border-gray-700 rounded-lg focus:outline-none focus:border-rose-600 text-white"
                           required>
                </div>

                <!-- Nom de l'empresa -->
                <div>
                    <label for="nom_empresa" class="block text-lg font-medium text-gray-100">Nom de l'empresa</label>
                    <input type="text" id="nom_empresa" name="nom_empresa" 
                           class="mt-2 block w-full px-4 py-3 bg-gray-800 border border-gray-700 rounded-lg focus:outline-none focus:border-rose-600 text-white"
                           required>
                </div>

                <!-- Adreça -->
                <div>
                    <label for="adreca" class="block text-lg font-medium text-gray-100">Adreça</label>
                    <input type="text" id="adreca" name="adreca" 
                           class="mt-2 block w-full px-4 py-3 bg-gray-800 border border-gray-700 rounded-lg focus:outline-none focus:border-rose-600 text-white"
                           required>
                </div>

                <!-- Ciutat -->
                <div>
                    <label for="ciutat" class="block text-lg font-medium text-gray-100">Ciutat</label>
                    <input type="text" id="ciutat" name="ciutat" 
                           class="mt-2 block w-full px-4 py-3 bg-gray-800 border border-gray-700 rounded-lg focus:outline-none focus:border-rose-600 text-white"
                           required>
                </div>

                <!-- Telèfon -->
                <div>
                    <label for="telefon" class="block text-lg font-medium text-gray-100">Telèfon</label>
                    <input type="text" id="telefon" name="telefon" 
                           class="mt-2 block w-full px-4 py-3 bg-gray-800 border border-gray-700 rounded-lg focus:outline-none focus:border-rose-600 text-white"
                           required>
                </div>

                <!-- Email -->
                <div>
                    <label for="email" class="block text-lg font-medium text-gray-100">Email</label>
                    <input type="email" id="email" name="email" 
                           class="mt-2 block w-full px-4 py-3 bg-gray-800 border border-gray-700 rounded-lg focus:outline-none focus:border-rose-600 text-white"
                           required>
                </div>

                <!-- Logo -->
                <div>
                    <label for="logo" class="block text-lg font-medium text-gray-100">Logo</label>
                    <input type="file" id="logo" name="logo" 
                           class="mt-2 block w-full px-4 py-3 bg-gray-800 border border-gray-700 rounded-lg focus:outline-none focus:border-rose-600 text-white">
                </div>

                <!-- Logo Capsalera -->
                <div>
                    <label for="logo_capsalera" class="block text-lg font-medium text-gray-100">Logo Capsalera</label>
                    <input type="file" id="logo_capsalera" name="logo_capsalera" 
                           class="mt-2 block w-full px-4 py-3 bg-gray-800 border border-gray-700 rounded-lg focus:outline-none focus:border-rose-600 text-white">
                </div>

                <!-- Submit Button -->
                <button type="submit" 
                        class="w-full bg-rose-600 hover:bg-rose-700 text-white font-bold py-3 rounded-lg transition-colors duration-300">
                    Crear Empresa
                </button>
            </form>
        </div>
    </div>
</x-app-layout>