<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Informations du profil') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Mettez à jour les informations de votre profil et votre adresse email.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <!-- Prénom -->
            <div class="md:col-span-1">
                <x-input-label for="prenom" :value="__('Prénom')" />
                <x-text-input 
                    id="prenom" 
                    name="prenom" 
                    type="text" 
                    class="mt-1 block w-full" 
                    :value="old('prenom', $user->prenom)" 
                    required 
                    autofocus 
                    autocomplete="given-name" 
                />
                <x-input-error class="mt-2" :messages="$errors->get('prenom')" />
            </div>

            <!-- Nom -->
            <div class="md:col-span-1">
                <x-input-label for="nom" :value="__('Nom')" />
                <x-text-input 
                    id="nom" 
                    name="nom" 
                    type="text" 
                    class="mt-1 block w-full" 
                    :value="old('nom', $user->nom)" 
                    required 
                    autocomplete="family-name" 
                />
                <x-input-error class="mt-2" :messages="$errors->get('nom')" />
            </div>
        </div>

        <div>
            <!-- Téléphone -->
            <div class="mt-4">
                <x-input-label for="telephone" :value="__('Téléphone')" />
                <x-text-input 
                    id="telephone" 
                    name="telephone" 
                    type="tel" 
                    class="mt-1 block w-full" 
                    :value="old('telephone', $user->telephone)" 
                    autocomplete="tel" 
                />
                <x-input-error class="mt-2" :messages="$errors->get('telephone')" />
            </div>

            <!-- Adresse -->
            <div class="mt-4">
                <x-input-label for="adresse" :value="__('Adresse')" />
                <x-text-input 
                    id="adresse" 
                    name="adresse" 
                    type="text" 
                    class="mt-1 block w-full" 
                    :value="old('adresse', $user->adresse)" 
                    autocomplete="street-address" 
                />
                <x-input-error class="mt-2" :messages="$errors->get('adresse')" />
            </div>

            <!-- Ville -->
            <div class="mt-4">
                <x-input-label for="ville" :value="__('Ville')" />
                <x-text-input 
                    id="ville" 
                    name="ville" 
                    type="text" 
                    class="mt-1 block w-full" 
                    :value="old('ville', $user->ville)" 
                    autocomplete="address-level2" 
                />
                <x-input-error class="mt-2" :messages="$errors->get('ville')" />
            </div>
        </div>

        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-gray-800">
                        {{ __('Your email address is unverified.') }}

                        <button form="send-verification" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600"
                >{{ __('Enregistré.') }}</p>
            @endif
        </div>
    </form>
</section>
