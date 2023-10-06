<x-app-layout>
    @section('title', 'Crear actividad')

    <x-jet-bar-container>

        <div class="p-4 bg-white border rounded-lg shadow-md mt-6">
            <div class="container mx-auto flex justify-between mb-4">
                <div>
                    <p class="text-2xl font-medium text-blue-700"
                     style="text-shadow: 1px 1px 1px  rgba(49, 49, 49, 0.323);">{{ __('Crear actividad') }}
                    <p>
                </div>

                <button onclick="location.href='{{ route('admin.actividad_cliente.index') }}'"
                    class="rounded-full bg-blue-500 text-neutral-50 px-4 py-2 font-semibold shadow-md hover:bg-blue-700">Atrás</button>
            </div>

            <form method="POST" action="{{ route('admin.actividad_cliente.store') }}" enctype="multipart/form-data">
                @csrf

                <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">
                    <div class="grid gap-4 col-span-2 sm:grid-cols-3 sm:gap-6">
                        <div class="relative">
                            <input type="text" id="nombre" name="nombre"
                                value="{{ old('nombre','') }}"
                                class="block px-2.5 pb-2.5 pt-4 w-full text-sm text-gray-900 bg-transparent rounded-lg border-1 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                placeholder=""/>
                            <label for="nombre"
                                class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white dark:bg-gray-900 px-2 peer-focus:px-2 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 left-1">
                                Nombre</label>
                        </div>

                        <div class="relative">
                            <select name="actividad_id" id="actividad_id" onchange="view_periodicidad()" 
                                class="block px-2.5 pb-2.5 pt-4 w-full text-sm text-gray-900 bg-transparent rounded-lg border-1 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer">
                                <option value="">Seleccione una actividad</option>
                                @if (!is_null($actividad))
                                    @foreach ($actividad as $id => $nombre)
                                        <option
                                            {{ old('actividad_id') == $id ? 'selected' : '' }} 
                                            value="{{ $id }}">{{ $nombre }}
                                        </option>
                                    @endforeach
                                @endif
                            </select>
                            <label for="actividad_id"
                                class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white dark:bg-gray-900 px-2 peer-focus:px-2 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 left-1">
                                Tipo actividad</label>
                            @error('actividad_id')
                                <p id="actividad_id" class="mt-2 text-xs text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror   
                        </div>
                        
                        <div class="relative">
                            <select name="progreso" id="progreso" 
                                class="block px-2.5 pb-2.5 pt-4 w-full text-sm text-gray-900 bg-transparent rounded-lg border-1 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer">
                                <option value="">Seleccione un progreso</option>
                                @for ($i = 0; $i <= 100; $i++)
                                    <option 
                                        {{ old('progreso') == $i ? 'selected' : '' }} 
                                        value="{{ $i }}">{{ $i }}
                                    </option>
                                @endfor
                            </select>
                            <label for="progreso"
                                class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white dark:bg-gray-900 px-2 peer-focus:px-2 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 left-1">
                                Progreso %</label>
                            @error('progreso')
                                <p id="progreso" class="mt-2 text-xs text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror  
                        </div>

                        <div class="relative">
                            <select name="prioridad" id="prioridad" 
                                class="block px-2.5 pb-2.5 pt-4 w-full text-sm text-gray-900 bg-transparent rounded-lg border-1 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer">
                                <option value="">Selecciona una prioridad</option>
                                <option value="SI" {{ old('prioridad') == 'SI' ? 'selected' : '' }}>SI</option>
                                <option value="NO" {{ old('prioridad') == 'NO' ? 'selected' : '' }}>NO</option>
                            </select>
                            <label for="prioridad"
                                class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white dark:bg-gray-900 px-2 peer-focus:px-2 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 left-1">
                                Prioridad alta</label>
                        </div>
                
                        <div class="relative">
                            <input type="date" id="fecha_vencimiento" name="fecha_vencimiento"
                                value="{{ old('fecha_vencimiento','') }}"
                                class="block px-2.5 pb-2.5 pt-4 w-full text-sm text-gray-900 bg-transparent rounded-lg border-1 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                placeholder=""/>
                            <label for="fecha_vencimiento"
                                class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white dark:bg-gray-900 px-2 peer-focus:px-2 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 left-1">
                                Fecha vencimiento</label>
                            @error('fecha_vencimiento')
                                <p id="fecha_vencimiento" class="mt-2 text-xs text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror  
                        </div>

                        <div class="relative" id="div_periodicidad">
                            <input type="number" id="periodicidad" name="periodicidad"
                                value="{{ old('periodicidad','') }}"
                                class="block px-2.5 pb-2.5 pt-4 w-full text-sm text-gray-900 bg-transparent rounded-lg border-1 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                placeholder=""/>
                            <label for="periodicidad"
                                class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white dark:bg-gray-900 px-2 peer-focus:px-2 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 left-1">
                                Periodicidad</label>
                            @error('periodicidad')
                                <p id="periodicidad" class="mt-2 text-xs text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- <div class="relative" id="div_periodicidad_corte">
                            <input type="number" id="periodicidad_corte" name="periodicidad_corte"
                                value="{{ old('periodicidad_corte','') }}"
                                class="block px-2.5 pb-2.5 pt-4 w-full text-sm text-gray-900 bg-transparent rounded-lg border-1 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                placeholder=""/>
                            <label for="periodicidad_corte"
                                class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white dark:bg-gray-900 px-2 peer-focus:px-2 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 left-1">
                                Fecha finalización periodicidad</label>
                            @error('periodicidad_corte')
                                <p id="periodicidad_corte" class="mt-2 text-xs text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror  
                        </div> --}}

                        <div class="relative">
                            <input type="number" id="recordatorio" name="recordatorio"
                                value="{{ old('recordatorio','') }}"
                                class="block px-2.5 pb-2.5 pt-4 w-full text-sm text-gray-900 bg-transparent rounded-lg border-1 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                placeholder=""/>
                            <label for="recordatorio"
                                class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white dark:bg-gray-900 px-2 peer-focus:px-2 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 left-1">
                                Cantidad recordatorios</label>
                            @error('recordatorio')
                                <p id="recordatorio" class="mt-2 text-xs text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror  
                        </div>
                
                        <div class="relative">
                            <input type="number" id="recordatorio_distancia" name="recordatorio_distancia"
                                value="{{ old('recordatorio_distancia','') }}"
                                class="block px-2.5 pb-2.5 pt-4 w-full text-sm text-gray-900 bg-transparent rounded-lg border-1 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                placeholder=""/>
                            <label for="recordatorio_distancia"
                                class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white dark:bg-gray-900 px-2 peer-focus:px-2 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 left-1">
                                Cantidad días entre recordatorios</label>
                            @error('recordatorio_distancia')
                                <p id="recordatorio_distancia" class="mt-2 text-xs text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror  
                        </div>

                        <div class="relative">
                            <textarea id="nota" name="nota" rows="1" 
                                class="block px-2.5 pb-2.5 pt-4 w-full text-sm text-gray-900 bg-transparent rounded-lg border-1 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                >{{ old('nota','') }}</textarea>
                            <label for="nota"
                                class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white dark:bg-gray-900 px-2 peer-focus:px-2 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 left-1">
                                Observación</label>
                        </div>

                        <div class="relative">
                            <select name="responsable_id" id="responsable_id" 
                                class="block px-2.5 pb-2.5 pt-4 w-full text-sm text-gray-900 bg-transparent rounded-lg border-1 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer">
                                <option value="">Seleccione un responsable</option>
                                @if (!is_null($responsable))
                                    @foreach ($responsable as $id => $nombre)
                                        <option
                                            {{ old('responsable_id') == $id ? 'selected' : '' }} 
                                            value="{{ $id }}">{{ $nombre }}
                                        </option>
                                    @endforeach
                                @endif
                            </select>
                            <label for="responsable_id"
                                class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white dark:bg-gray-900 px-2 peer-focus:px-2 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 left-1">
                                Responsable actividad</label>
                            @error('responsable_id')
                                <p id="responsable_id" class="mt-2 text-xs text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror  
                        </div>
                
                        <div class="relative">
                            <select name="cliente_id" id="cliente_id" disabled
                                class="block px-2.5 pb-2.5 pt-4 w-full text-sm text-gray-900 bg-transparent rounded-lg border-1 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer">
                                <option value="">Seleccione una opción</option>
                            </select>
                            <label for="cliente_id"
                                class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white dark:bg-gray-900 px-2 peer-focus:px-2 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 left-1">
                                Empresa</label>
                            @error('cliente_id')
                                <p id="cliente_id" class="mt-2 text-xs text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror  
                        </div>

                        <div class="relative">
                            <select name="usuario_id" id="usuario_id" disabled
                                class="block px-2.5 pb-2.5 pt-4 w-full text-sm text-gray-900 bg-transparent rounded-lg border-1 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer">
                                <option value="">Seleccione una opción</option>
                            </select>
                            <label for="usuario_id"
                                class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white dark:bg-gray-900 px-2 peer-focus:px-2 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 left-1">
                                Responsable</label>
                            @error('usuario_id')
                                <p id="usuario_id" class="mt-2 text-xs text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror  
                        </div>
                        
                        <div class="relative" style="display:none;" id='empresa_asociada'>
                            <select name="empresa_asociada_id" id="empresa_asociada_id" 
                                class="block px-2.5 pb-2.5 pt-4 w-full text-sm text-gray-900 bg-transparent rounded-lg border-1 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer">
                                <option value="">Seleccione un cliente</option>
                                @foreach ($clientes as $cliente)
                                <option value="{{ $cliente->id }}">{{ $cliente->razon_social }}</option>
                                @endforeach
                            </select>
                            <label for="empresa_asociada_id"
                                class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white dark:bg-gray-900 px-2 peer-focus:px-2 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 left-1">
                                Cliente</label>
                            @error('empresa_asociada_id')
                                <p id="empresa_asociada_id" class="mt-2 text-xs text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror  
                        </div>


                    </div>

                    <div class="grid gap-4 col-span-2 sm:grid-cols-3 sm:gap-6">
                        <div class="relative">
                            <label class="block mb-2 text-sm font-medium text-gray-500 dark:text-gray-400" for="documento_1">Adjunto 1</label>
                            <input type="file" id="documento_1" name="documento_1"
                            class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"/>
                        </div>

                        <div class="relative">
                            <label class="block mb-2 text-sm font-medium text-gray-500 dark:text-gray-400" for="documento_2">Adjunto 2</label>
                            <input type="file" id="documento_2" name="documento_2"
                            class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"/>
                        </div>

                        <div class="relative">
                            <label class="block mb-2 text-sm font-medium text-gray-500 dark:text-gray-400" for="documento_3">Adjunto 3</label>
                            <input type="file" id="documento_3" name="documento_3"
                            class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"/>
                        </div>

                        <div class="relative">
                            <label class="block mb-2 text-sm font-medium text-gray-500 dark:text-gray-400" for="documento_4">Adjunto 4</label>
                            <input type="file" id="documento_4" name="documento_4"
                            class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"/>
                        </div>

                        <div class="relative">
                            <label class="block mb-2 text-sm font-medium text-gray-500 dark:text-gray-400" for="documento_5">Adjunto 5</label>
                            <input type="file" id="documento_5" name="documento_5"
                            class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"/>
                        </div>
                    </div>
                </div>

                <div class="mt-3 flex justify-end">
                    <button
                        class="rounded-full bg-blue-500 text-neutral-50 px-4 py-2 font-semibold shadow-md hover:bg-blue-700">Enviar</button>
                </div>
            </form>
        </div>
    </x-jet-bar-container>
    <script src="{{ asset('js/actividadcliente/show.js') }}" defer></script>
</x-app-layout>