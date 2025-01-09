<x-guest-layout>
    <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
        @csrf

        @if ($errors->has('error'))
            <div class="mt-4">
                <span class="text-red-500">{{ $errors->first('error') }}</span>
            </div>
        @endif

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Surname -->
        <div class="mt-4">
            <x-input-label for="surname" :value="__('Surname')" />
            <x-text-input id="surname" class="block mt-1 w-full" type="text" name="surname" :value="old('surname')" required autocomplete="surname" />
            <x-input-error :messages="$errors->get('surname')" class="mt-2" />
        </div>

        <!-- Username -->
        <div class="mt-4">
            <x-input-label for="nom_usuari" :value="__('Username')" />
            <x-text-input id="nom_usuari" class="block mt-1 w-full" type="text" name="nom_usuari" :value="old('nom_usuari')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('nom_usuari')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Address -->
        <div class="mt-4">
            <x-input-label for="adreca" :value="__('Address')" />
            <x-text-input id="adreca" class="block mt-1 w-full" type="text" name="adreca" :value="old('adreca')" required autocomplete="address" />
            <x-input-error :messages="$errors->get('adreca')" class="mt-2" />
        </div>

        <!-- Bank Card -->
        <div class="mt-4">
            <x-input-label for="targeta_bancaria" :value="__('Bank Card')" />
            <x-text-input id="targeta_bancaria" class="block mt-1 w-full" type="text" name="targeta_bancaria" :value="old('targeta_bancaria')" required autocomplete="cc-number" />
            <x-input-error :messages="$errors->get('targeta_bancaria')" class="mt-2" />
        </div>

        <!-- Date of Birth -->
        <div class="mt-4">
            <x-input-label for="data_naixement" :value="__('Date of Birth')" />
            <x-text-input id="data_naixement" class="block mt-1 w-full" type="date" name="data_naixement" :value="old('data_naixement')" required autocomplete="bday" />
            <x-input-error :messages="$errors->get('data_naixement')" class="mt-2" />
        </div>

        <!-- Profile Photo -->
        <div class="mt-4">
            <label for="foto_perfil">Foto de perfil</label>
            <input type="file" name="foto_perfil" id="foto_perfil" accept="image/*">
            <x-input-error :messages="$errors->get('foto_perfil')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
