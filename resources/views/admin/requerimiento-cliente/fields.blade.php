<div class="grid gap-4">
    <div class="sm:col-span-2">
        <div>
            <label for="tipo_requerimiento" class="block mb-2 text-sm font-medium text-blue-700 dark:text-white">Tipo de
                requerimiento</label>
            @if (!is_null($requerimiento->tipo_requerimiento_id))
                <select id="tipo_requerimiento" name="tipo_requerimiento_id"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                    @foreach ($tipo_requerimientos as $id => $nombre)
                        @if ($requerimiento->tipo_requerimiento_id == $id)
                            <option selected
                                value="{{ old('tipo_requerimiento_id', $requerimiento->tipo_requerimiento_id) }}">
                                {{ $nombre }} </option>
                        @else
                            <option value="{{ $id }}">{{ $nombre }}</option>
                        @endif
                    @endforeach
                </select>
            @else
                <select id="tipo_requerimiento" name="tipo_requerimiento_id"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                    @foreach ($tipo_requerimientos as $id => $nombre)
                        <option value="{{ $id }}">{{ $nombre }}</option>
                    @endforeach
                </select>
            @endif

            @if ($errors->has('tipo_requerimiento_id'))
                <p id="tipo_requerimiento_id" class="mt-2 text-xs text-red-600 dark:text-red-400">
                    {{ $errors->first('tipo_requerimiento_id') }}</p>
            @endif
        </div>
    </div>

    <div class="sm:col-span-2">
        <label for="descripcion"
            class="block mb-2 text-sm font-medium text-blue-700  dark:text-white">Descripción</label>
        <textarea id="descripcion" rows="5" name="descripcion"
            class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
            placeholder="Escribe acerca de tu requerimiento..."></textarea>
        @if ($errors->has('descripcion'))
            <p id="descripcion" class="mt-2 text-xs text-red-600 dark:text-red-400">{{ $errors->first('descripcion') }}
            </p>
        @endif
    </div>


    <div class="sm:col-span-2">
        <div class="relative">
            <input type="file" id="files" name="documentos[]"
            class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"/>
        </div>
        @if ($errors->has('documentos'))
            <p id="descripcion" class="mt-2 text-xs text-red-600 dark:text-red-400">{{ $errors->first('documentos') }}
            </p>
        @endif
    </div>

    <div class="sm:col-span-2">
        <div class="relative">
            <input type="file" id="files" name="documentos[]"
            class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"/>
        </div>
        @if ($errors->has('documentos'))
            <p id="documentos" class="mt-2 text-xs text-red-600 dark:text-red-400">{{ $errors->first('documentos') }}
            </p>
        @endif
    </div>
    <div class="sm:col-span-2">
        <div class="relative">
            <input type="file" id="files" name="documentos[]"
            class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"/>
        </div>
        @if ($errors->has('documentos'))
            <p id="documentos" class="mt-2 text-xs text-red-600 dark:text-red-400">{{ $errors->first('documentos') }}
            </p>
        @endif
    </div>
    <div class="sm:col-span-2">
        <div class="relative">
            <input type="file" id="files" name="documentos[]"
            class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"/>
        </div>
        @if ($errors->has('documentos'))
            <p id="documentos" class="mt-2 text-xs text-red-600 dark:text-red-400">{{ $errors->first('documentos') }}
            </p>
        @endif
    </div>
    <div class="sm:col-span-2">
        <div class="relative">
            <input type="file" id="files" name="documentos[]"
            class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"/>
        </div>
        @if ($errors->has('documentos'))
            <p id="documentos" class="mt-2 text-xs text-red-600 dark:text-red-400">{{ $errors->first('documentos') }}
            </p>
        @endif
    </div>
</div>
