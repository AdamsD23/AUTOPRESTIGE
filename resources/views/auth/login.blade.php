<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <div class="bg-white p-6 rounded-lg shadow-md">
        <h2 class="text-2xl font-bold text-gray-800 mb-6 text-center">Connexion</h2>
        
        <form method="POST" action="{{ route('login') }}" class="space-y-4">
            @csrf

            <!-- Email -->
            <div>
                <x-input-label for="email" :value="__('Adresse email')" />
                <div class="mt-1">
                    <x-text-input 
                        id="email" 
                        class="block w-full" 
                        type="email" 
                        name="email" 
                        :value="old('email')" 
                        required 
                        autofocus 
                        autocomplete="email" 
                        placeholder="votre@email.com"
                    />
                </div>
                <x-input-error :messages="$errors->get('email')" class="mt-1" />
            </div>

            <!-- Mot de passe -->
            <div>
                <x-input-label for="password" :value="__('Mot de passe')" />
                <div class="mt-1">
                    <x-text-input 
                        id="password" 
                        class="block w-full"
                        type="password"
                        name="password"
                        required 
                        autocomplete="current-password"
                        placeholder="••••••••"
                    />
                </div>
                <x-input-error :messages="$errors->get('password')" class="mt-1" />
            </div>

            <!-- Se souvenir de moi -->
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <input id="remember_me" 
                           type="checkbox" 
                           class="rounded border-gray-300 text-blue-600 shadow-sm focus:ring-blue-500" 
                           name="remember"
                    >
                    <label for="remember_me" class="ms-2 text-sm text-gray-600">
                        {{ __('Se souvenir de moi') }}
                    </label>
                </div>

                @if (Route::has('password.request'))
                    <a class="text-sm text-blue-600 hover:text-blue-500" href="{{ route('password.request') }}">
                        {{ __('Mot de passe oublié ?') }}
                    </a>
                @endif
            </div>

            <!-- Bouton de connexion -->
            <div class="pt-4">
                <x-primary-button class="w-full justify-center bg-blue-600 hover:bg-blue-700 focus:ring-blue-500">
                    {{ __('Se connecter') }}
                </x-primary-button>
            </div>

            <!-- Lien vers l'inscription -->
            <div class="text-center text-sm text-gray-600 mt-4">
                <p>
                    {{ __("Vous n'avez pas de compte ?") }}
                    <a href="{{ route('register') }}" class="text-blue-600 hover:text-blue-500 font-medium">
                        {{ __('Créer un compte') }}
                    </a>
                </p>
            </div>
        </form>
    </div>
</x-guest-layout>
