<div class="grid gap-4 sm:grid-cols-2 sm:gap-6">
    <div class="sm:col-span-2">
        <div class="relative">
            <input type="text" id="NIT" name="NIT" value="{{ old('NIT', $empresa->NIT) }}"
                class="block px-2.5 pb-2.5 pt-4 w-full text-sm text-gray-900 bg-transparent rounded-lg border-1 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                placeholder=" " />
            <label for="NIT"
                class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white dark:bg-gray-900 px-2 peer-focus:px-2 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 left-1">NIT</label>
        </div>
        @if ($errors->has('NIT'))
            <p id="NIT" class="mt-2 text-xs text-red-600 dark:text-red-400">{{ $errors->first('NIT') }}</p>
        @endif
    </div>

    <div class="grid gap-4 col-span-2 sm:grid-cols-3 sm:gap-6">
        <div class="relative">
            <input type="text" id="razon_social" name="razon_social"
                value="{{ old('razon_social', $empresa->razon_social) }}"
                class="block px-2.5 pb-2.5 pt-4 w-full text-sm text-gray-900 bg-transparent rounded-lg border-1 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                placeholder=" " />
            <label for="razon_social"
                class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white dark:bg-gray-900 px-2 peer-focus:px-2 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 left-1">Razón
                social</label>
        </div>
        @if ($errors->has('razon_social'))
            <p id="razon_social" class="mt-2 text-xs text-red-600 dark:text-red-400">
                {{ $errors->first('razon_social') }}</p>
        @endif

        <div class="relative">
            <input type="text" id="correo_electronico" name="correo_electronico"
                value="{{ old('correo_electronico', $empresa->correo_electronico) }}"
                class="block px-2.5 pb-2.5 pt-4 w-full text-sm text-gray-900 bg-transparent rounded-lg border-1 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                placeholder=" "/>
            <label for="correo_electronico"
                class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white dark:bg-gray-900 px-2 peer-focus:px-2 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 left-1">Correo
                eléctronico</label>
        </div>
        @if ($errors->has('correo_electronico'))
            <p id="correo_electronico" class="mt-2 text-xs text-red-600 dark:text-red-400">
                {{ $errors->first('correo_electronico') }}</p>
        @endif

        <div class="relative">
            <input type="text" id="numero_contacto" name="numero_contacto"
                value="{{ old('numero_contacto', $empresa->numero_contacto) }}"
                class="block px-2.5 pb-2.5 pt-4 w-full text-sm text-gray-900 bg-transparent rounded-lg border-1 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                placeholder=" " />
            <label for="numero_contacto"
                class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white dark:bg-gray-900 px-2 peer-focus:px-2 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 left-1">Número
                contacto</label>
        </div>
        @if ($errors->has('numero_contacto'))
            <p id="numero_contacto" class="mt-2 text-xs text-red-600 dark:text-red-400">
                {{ $errors->first('numero_contacto') }}</p>
        @endif
    </div>

    <div class="sm:col-span-2">
        <div class="relative">
            <input type="text" id="direccion_fisica" name="direccion_fisica"
                value="{{ old('direccion_fisica', $empresa->direccion_fisica) }}"
                class="block px-2.5 pb-2.5 pt-4 w-full text-sm text-gray-900 bg-transparent rounded-lg border-1 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                placeholder=" " />
            <label for="direccion_fisica"
                class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white dark:bg-gray-900 px-2 peer-focus:px-2 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 left-1">Dirección
                física</label>
        </div>
        @if ($errors->has('direccion_fisica'))
            <p id="direccion_fisica" class="mt-2 text-xs text-red-600 dark:text-red-400">
                {{ $errors->first('direccion_fisica') }}</p>
        @endif
    </div>

    <div>
        <label for="frecuencias"
            class="block mb-2 text-sm font-medium text-blue-700 dark:text-white">Frecuencia</label>
        @if (!is_null($empresa->frecuencia_id))
            <select id="frecuencias" name="frecuencia_id"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                @foreach ($frecuencias as $id => $nombre)
                    @if ($empresa->frecuencia_id == $id)
                        <option selected value="{{ old('frecuencia_id', $empresa->frecuencia_id) }}">
                            {{ $nombre }} </option>
                    @else
                        <option value="{{ $id }}">{{ $nombre }}</option>
                    @endif
                @endforeach
            </select>
        @else
            <select id="frecuencias" name="frecuencia_id"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                @foreach ($frecuencias as $id => $nombre)
                    <option value="{{ $id }}">{{ $nombre }}</option>
                @endforeach
            </select>
        @endif

        @if ($errors->has('frecuencia_id'))
            <p id="frecuencia_id" class="mt-2 text-xs text-red-600 dark:text-red-400">
                {{ $errors->first('frecuencia_id') }}</p>
        @endif
    </div>
</div>
