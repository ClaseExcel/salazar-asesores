<div class="grid gap-4">


    <div class="sm:col-span-2">
        <div>
            <label for="tipo_requerimiento" class="block mb-2 text-sm font-medium text-blue-700 dark:text-white">Tipo de
                requerimiento</label>
            @if (!is_null($requerimiento->requerimientos->tipo_requerimiento_id))
                <select id="tipo_requerimiento" name="tipo_requerimiento_id" disabled
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                    @foreach ($tipo_requerimientos as $id => $nombre)
                        @if ($requerimiento->requerimientos->tipo_requerimiento_id == $id)
                            <option selected
                                value="{{ old('tipo_requerimiento_id', $requerimiento->requerimientos->tipo_requerimiento_id) }}">
                                {{ $nombre }} </option>
                        @else
                            <option value="{{ $id }}">{{ $nombre }}</option>
                        @endif
                    @endforeach
                </select>
            @endif
        </div>
    </div>

    <div class="sm:col-span-2">
        <label for="descripcion"
            class="block mb-2 text-sm font-medium text-blue-700  dark:text-white">Descripción</label>
        <textarea id="descripcion" rows="5" name="descripcion"
            class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
            disabled>{{ $requerimiento->requerimientos->descripcion }}</textarea>
        @if ($errors->has('descripcion'))
            <p id="descripcion" class="mt-2 text-xs text-red-600 dark:text-red-400">{{ $errors->first('descripcion') }}
            </p>
        @endif
    </div>

    <p>
        @if($documento != null)
        <b>Archivos</b> &nbsp;&nbsp; <button type="button"
            onclick="location.href='{{ route('admin.requerimientos.cliente.download', ['id' => $requerimiento->requerimientos->id]) }}'"
            class="rounded-full bg-blue-500 text-neutral-50 px-2 font-semibold shadow-md hover:bg-blue-700">Descargar</button>
        @endif
    </p>

    <div class="sm:col-span-2">
        <div>
            <label for="estado_requerimiento"
                class="block mb-2 text-sm font-medium text-blue-700 dark:text-white">Estado requerimento</label>
            @if (!is_null($requerimiento->estado_requerimiento_id))
                <select id="estado_requerimiento" name="estado_requerimiento_id"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                    <option value="" selected disabled>Selecciona un estado</option>
                    @foreach ($estados as $estado)
                        @if ($requerimiento->estado_requerimiento_id == $estado->id)
                            <option
                                value="{{ old('estado_requerimiento_id', $requerimiento->estado_requerimiento_id) }}">
                                {{ $estado->nombre }} </option>
                        @else
                            <option value={{ $estado->id }}>  {{ $estado->nombre }} </option>
                        @endif
                    @endforeach
                </select>
            @else
                <select id="estado_requerimiento" name="estado_requerimiento_id"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                    <option value="" selected disabled>Selecciona un estado</option>
                    @foreach ($estados as $estado)
                        <option value="{{ $estado->id }}">{{ $estado->nombre }}</option>
                    @endforeach
                </select>
            @endif

            @if ($errors->has('estado_requerimiento_id'))
                <p id="estado_requerimiento_id" class="mt-2 text-xs text-red-600 dark:text-red-400">
                    {{ $errors->first('estado_requerimiento_id') }}</p>
            @endif
        </div>
    </div>

    <div class="sm:col-span-2">
        <label for="observacion"
            class="block mb-2 text-sm font-medium text-blue-700  dark:text-white">Observación</label>
        <textarea id="observacion" rows="3" name="observacion"
            class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">{{ $requerimiento->observacion }}</textarea>
        @if ($errors->has('observacion'))
            <p id="observacion" class="mt-2 text-xs text-red-600 dark:text-red-400">{{ $errors->first('observacion') }}
            </p>
        @endif
    </div>
</div>
