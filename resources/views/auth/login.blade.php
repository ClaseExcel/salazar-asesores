<x-guest-layout>
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0">
        <div>
            <a href="{{ url('/') }}"><img src="{{ asset('img/logos/logo-salazar.svg') }}"
                    alt="" style="height:200px;"></a>
        </div>

        <div class="w-full sm:max-w-md px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
            <x-jet-validation-errors class="mb-4" />

            <div class="mt-6">
                @if (session()->has('message'))
                    <x-jet-bar-alert text="{{ session('message') }}" type="{{ session('color') }}" />
                @endif
            </div>

            @if (session('status'))
                <div class="mb-4 font-medium text-sm text-green-600">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div>
                    <label class="block font-medium text-sm text-gray-700" for="email">
                        Correo eléctronico
                    </label>
                    <input
                        class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm block mt-1 w-full"
                        id="email" type="email" name="email" required="required" autofocus="autofocus">
                </div>

                <div class="mt-4">
                    <label class="block font-medium text-sm text-gray-700" for="password">
                        Contraseña
                    </label>
                    <input
                        class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm block mt-1 w-full"
                        id="password" type="password" name="password" required="required"
                        autocomplete="current-password">
                </div>

                <div class="flex items-center justify-end mt-4">
                    <button type="submit"
                        class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition ml-4">
                        Ingresar
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>
