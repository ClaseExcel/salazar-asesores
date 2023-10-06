<x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            <a href="{{ url('/') }}"><img src="{{ asset('/img/logos/Logo_1.png') }}" alt="" class="h-32"></a>
        </x-slot>

        <x-jet-validation-errors class="mb-4" />

        <div class="mt-6">
            @if (session()->has('message'))
                <x-jet-bar-alert text="{{ session('message') }}" type="{{ session('color') }}" />
            @endif
        </div>

        <form method="POST" action="{{ route('password.usuario') }}">
            @csrf

            <div class="block">
                <x-jet-label for="email" value="{{ __('Correo eléctronico') }}" />
                <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email', $request->email)" required autofocus />
            </div>

            <div class="mt-4">
                <x-jet-label for="password" value="{{ __('Contraseña') }}" />
                <x-jet-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
            </div>

            <div class="mt-4">
                <x-jet-label for="password_confirmation" value="{{ __('Confirmar contraseña') }}" />
                <x-jet-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-jet-button>
                    {{ __('Reestablecer contraseña') }}
                </x-jet-button>
            </div>
        </form>
    </x-jet-authentication-card>
</x-guest-layout>
