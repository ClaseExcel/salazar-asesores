<x-app-layout>
    @section('title', 'Reporte actividad cliente')

    <x-jet-bar-container>

        <div class="flex justify-end mb-4">
            <button onclick="location.href='{{ route('admin.actividad_cliente.index') }}'"
                class="rounded-full bg-blue-500 text-neutral-50 px-4 py-2 font-semibold shadow-md hover:bg-blue-700">Atrás</button>
        </div>

        <div class="grid grid-cols-1 gap-4">
            <div class="p-4 bg-white border rounded-lg shadow-md">
                <div class="container mb-4">
                    <div>
                        <p class="text-2xl font-medium text-blue-700"
                            style="text-shadow: 1px 1px 1px  rgba(49, 49, 49, 0.323);">
                            {{ __('Reporte actividad cliente') }}
                        <p>
                    </div>
                </div>

                <form method="POST" action="{{ route('admin.reporte.update', $actividad_cliente->id) }}"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">
                        <div class="grid gap-4 col-span-2 sm:grid-cols-3 sm:gap-6">
                            <div class="relative">
                                <input type="text" id="nombre" name="nombre"
                                    value="{{ $actividad_cliente->nombre }}"
                                    class="block px-2.5 pb-2.5 pt-4 w-full text-sm text-gray-900 bg-transparent rounded-lg border-1 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                    placeholder="" disabled />
                                <label for="nombre"
                                    class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white dark:bg-gray-900 px-2 peer-focus:px-2 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 left-1">
                                    Nombre</label>
                            </div>

                            @if ($reporteActividad->estado_actividad_id != 7)
                                <div class="relative">
                                    <select name="estado_actividad_id" id="estado_actividad_id" 
                                        class="block px-2.5 pb-2.5 pt-4 w-full text-sm text-gray-900 bg-transparent rounded-lg border-1 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer">
                                        <option value="">Seleccione un estado</option>
                                        @foreach ($estado_actividad as $actividad)
                                            <option value="{{ $actividad->id }}">
                                                {{ $actividad->nombre }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <label for="estado_actividad_id"
                                        class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white dark:bg-gray-900 px-2 peer-focus:px-2 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 left-1">
                                        Estado actividad</label>
                                    @error('estado_actividad_id')
                                        <p id="estado_actividad_id" class="mt-2 text-xs text-red-600 dark:text-red-400">
                                            {{ $message }}</p>
                                    @enderror
                                </div>
                            @else
                                <div class="relative">
                                    <select name="estado_actividad_id" id="estado_actividad_id" disabled
                                        class="block px-2.5 pb-2.5 pt-4 w-full text-sm text-gray-900 bg-transparent rounded-lg border-1 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer">
                                        <option value="">Seleccione un estado</option>
                                        @foreach ($estado_actividad as $actividad)
                                            <option value="{{ $actividad->id }}">
                                                {{ $actividad->nombre }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <label for="estado_actividad_id"
                                        class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white dark:bg-gray-900 px-2 peer-focus:px-2 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 left-1">
                                        Estado actividad</label>
                                    @error('estado_actividad_id')
                                        <p id="estado_actividad_id" class="mt-2 text-xs text-red-600 dark:text-red-400">
                                            {{ $message }}</p>
                                    @enderror
                                </div>
                            @endif


                            @if (Auth::user()->id == $actividad_cliente->usuario_id)
                                <div class="relative" style="display:none;" id="progreso">
                                    <select name="progreso" id="progreso"
                                        class="block px-2.5 pb-2.5 pt-4 w-full text-sm text-gray-900 bg-transparent rounded-lg border-1 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer">
                                        <option value="">Seleccione un progreso</option>
                                        @for ($i = 0; $i <= 100; $i++)
                                            <option {{ $actividad_cliente->progreso == $i ? 'selected' : '' }}
                                                value="{{ $i }}">{{ $i }}
                                            </option>
                                        @endfor
                                    </select>
                                    <label for="progreso"
                                        class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white dark:bg-gray-900 px-2 peer-focus:px-2 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 left-1">
                                        Progreso %</label>
                                    @error('progreso')
                                        <p id="progreso" class="mt-2 text-xs text-red-600 dark:text-red-400">
                                            {{ $message }}</p>
                                    @enderror
                                </div>
                            @endif

                            <div class="relative" id="empresa" style="display:none;">
                                <select name="cliente_id" id="empresa_id" disabled
                                    class="block px-2.5 pb-2.5 pt-4 w-full text-sm text-gray-900 bg-transparent rounded-lg border-1 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer">
                                    <option value="">Seleccione un cliente</option>
                                    @if (!is_null($cliente))
                                        @foreach ($cliente as $cliente)
                                            <option
                                                {{ $actividad_cliente->cliente_id == $cliente->id ? 'selected' : '' }}
                                                value="{{ $cliente->id }}">{{ $cliente->razon_social }}
                                            </option>
                                        @endforeach
                                    @endif
                                </select>
                                <label for="cliente_id"
                                    class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white dark:bg-gray-900 px-2 peer-focus:px-2 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 left-1">
                                    Empresa</label>
                                @error('cliente_id')
                                    <p id="cliente_id" class="mt-2 text-xs text-red-600 dark:text-red-400">
                                        {{ $message }}</p>
                                @enderror
                            </div>

                            <div class="relative" id="empleado" style="display:none;">
                                <select name="usuario_id" id="usuario_id"
                                    class="block px-2.5 pb-2.5 pt-4 w-full text-sm text-gray-900 bg-transparent rounded-lg border-1 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer">
                                    <option value="">Seleccione una opción</option>
                                    @if (!is_null($usuario))
                                        @foreach ($usuario as $item)
                                            <option {{ $actividad_cliente->usuario_id == $item->id ? 'selected' : '' }}
                                                value="{{ $item->id }}">
                                                {{ $item->nombres . ' ' . $item->apellidos }}
                                            </option>
                                        @endforeach
                                    @endif
                                </select>
                                <label for="usuario_id"
                                    class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white dark:bg-gray-900 px-2 peer-focus:px-2 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 left-1">
                                    Empleado</label>
                                @error('usuario_id')
                                    <p id="usuario_id" class="mt-2 text-xs text-red-600 dark:text-red-400">
                                        {{ $message }}</p>
                                @enderror
                            </div>

                            <div class="sm:col-span-2" id="just" style="display:none;">
                                <div class="relative">
                                    <input type="text" id="justificacion" name="justificacion"
                                        class="block px-2.5 pb-2.5 pt-4 w-full text-sm text-gray-900 bg-transparent rounded-lg border-1 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                        placeholder=" " />
                                    <label for="justificacion"
                                        class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white dark:bg-gray-900 px-2 peer-focus:px-2 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 left-1">
                                        Justificación</label>
                                    @error('justificacion')
                                        <p id="justificacion" class="mt-2 text-xs text-red-600 dark:text-red-400">
                                            {{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            @if (Auth::user()->id == $actividad_cliente->usuario_id)
                                <div class="relative">
                                    <input type="file" id="documento" name="documento"
                                        class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" />
                                </div>
                            @endif
                        </div>

                    </div>

                    <div class="mt-3 flex justify-end">
                        <button type="submit"
                            class="rounded-full bg-blue-500 text-neutral-50 px-4 py-2 font-semibold shadow-md hover:bg-blue-700">Enviar</button>
                    </div>
                </form>
            </div>
        </div>
    </x-jet-bar-container>
    <script src="{{ asset('js/actividadcliente/show.js') }}" defer></script>
</x-app-layout>
