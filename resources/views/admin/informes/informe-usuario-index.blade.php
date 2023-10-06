<x-app-layout>
    @section('title', 'Informe usuario')

    <x-jet-bar-container>

        <div class="container mx-5">
            <h1 class="text-4xl text-blue-900 font-semibold mb-4"
                style="text-shadow: 1px 1px 1px  rgba(49, 49, 49, 0.323);">
                {{ __('Informe actividades por usuario') }}
            </h1>
        </div>

        <div class="mt-6">
            @if (session()->has('message'))
                <x-jet-bar-alert text="{{ session('message') }}" type="{{ session('color') }}" />
            @endif
        </div>


        <form action="{{ route('admin.excel-usuario') }}" method="get" enctype="multipart/form">
            <div class=" p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                <div class="grid gap-4 col-span-2 sm:grid-cols-4 sm:gap-6">

                    <div class="relative">
                        <select name="empresa" id="empresa"
                            class="block px-2.5 pb-2.5 pt-4 w-full text-sm text-gray-900 bg-transparent rounded-lg border-1 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer">
                            <option value="">Seleccione una empresa</option>
                            @foreach ($empresa as $empresa)
                                <option value="{{ $empresa->id }}">
                                    {{ $empresa->razon_social }}
                                </option>
                            @endforeach
                        </select>
                        <label for="empresa"
                            class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white dark:bg-gray-900 px-2 peer-focus:px-2 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 left-1">
                            Empresa</label>
                        @error('empresa')
                            <p id="empresa" class="mt-2 text-xs text-red-600 dark:text-red-400">
                                {{ $message }}</p>
                        @enderror
                    </div>
                    <div class="relative">
                        <select name="usuario" id="usuario" disabled
                            class="block px-2.5 pb-2.5 pt-4 w-full text-sm text-gray-900 bg-transparent rounded-lg border-1 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer">
                            <option value="">Seleccione un usuario</option>
                        </select>
                        <label for="usuario"
                            class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white dark:bg-gray-900 px-2 peer-focus:px-2 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 left-1">
                            Usuario</label>
                        @error('usuario')
                            <p id="usuario" class="mt-2 text-xs text-red-600 dark:text-red-400">
                                {{ $message }}</p>
                        @enderror
                    </div>
                    <div class="relative">
                        <select name="tipo_actividad_id" id="tipo_actividad_id"
                            class="block px-2.5 pb-2.5 pt-4 w-full text-sm text-gray-900 bg-transparent rounded-lg border-1 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer">
                            <option value="">Seleccione un tipo de actividad</option>
                            @foreach ($tipo_actividad as $actividad)
                                <option value="{{ $actividad->id }}">
                                    {{ $actividad->nombre }}
                                </option>
                            @endforeach
                        </select>
                        <label for="tipo_actividad_id"
                            class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white dark:bg-gray-900 px-2 peer-focus:px-2 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 left-1">
                            Tipo de actividad</label>
                        @error('tipo_actividad_id')
                            <p id="tipo_actividad_id" class="mt-2 text-xs text-red-600 dark:text-red-400">
                                {{ $message }}</p>
                        @enderror
                    </div>
                    <div class="relative">
                        <input type="date" id="fecha_inicio" name="fecha_inicio"
                            class="block px-2.5 pb-2.5 pt-4 w-full text-sm text-gray-900 bg-transparent rounded-lg border-1 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                            placeholder="" />
                        <label for="fecha_inicio"
                            class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white dark:bg-gray-900 px-2 peer-focus:px-2 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 left-1">
                            Fecha inicio</label>
                        @error('fecha_inicio')
                            <p id="fecha_inicio" class="mt-2 text-xs text-red-600 dark:text-red-400">{{ $message }}
                            </p>
                        @enderror
                    </div>
                    <div class="relative">
                        <input type="date" id="fecha_fin" name="fecha_fin"
                            class="block px-2.5 pb-2.5 pt-4 w-full text-sm text-gray-900 bg-transparent rounded-lg border-1 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                            placeholder="" />
                        <label for="fecha_fin"
                            class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white dark:bg-gray-900 px-2 peer-focus:px-2 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 left-1">
                            Fecha fin</label>
                        @error('fecha_fin')
                            <p id="fecha_fin" class="mt-2 text-xs text-red-600 dark:text-red-400">{{ $message }}
                            </p>
                        @enderror
                    </div>
                </div>
                <div class="mt-5">
                    <button class="rounded-full bg-blue-500 text-neutral-50 px-4 py-2 font-semibold shadow-md hover:bg-blue-700">Generar</button>
                </div>
            </div>

           
        </form>

    </x-jet-bar-container>

    <script src="{{ asset('js/reportes/reportes.js') }}" defer></script>
</x-app-layout>
