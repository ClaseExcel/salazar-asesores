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
            @if ($requerimiento->estado_requerimiento_id == 4 || $requerimiento->estado_requerimiento_id == 5)
                <select id="estado_requerimiento" name="estado_requerimiento_id" disabled
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                    <option value="" disabled>Selecciona un estado</option>
                    @foreach ($estados as $estado)
                        @if ($requerimiento->estado_requerimiento_id == $estado->id)
                            <option 
                                value="{{ old('estado_requerimiento_id', $requerimiento->estado_requerimiento_id) }}">
                                {{ $estado->nombre }} </option>
                        @else
                            <option value="{{ $estado->id }}">{{ $estado->nombre }}</option>
                        @endif
                    @endforeach
                </select>
            @else
                @if (!is_null($requerimiento->estado_requerimiento_id))
                    <select id="estado_requerimiento" name="estado_requerimiento_id"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                        <option value="" disabled selected>Selecciona un estado</option>
                        @foreach ($estados as $estado)
                            @if ($requerimiento->estado_requerimiento_id == $estado->id)
                                <option
                                    value="{{ old('estado_requerimiento_id', $requerimiento->estado_requerimiento_id) }}">
                                    {{ $estado->nombre }} </option>
                            @else
                                <option value={{ $estado->id }}> {{ $estado->nombre }} </option>
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
            @endif


            @if ($errors->has('estado_requerimiento_id'))
                <p id="estado_requerimiento_id" class="mt-2 text-xs text-red-600 dark:text-red-400">
                    {{ $errors->first('estado_requerimiento_id') }}</p>
            @endif
        </div>
    </div>

    @if ($requerimiento->estado_requerimiento_id == 4 || $requerimiento->estado_requerimiento_id == 5)
        <div class="sm:col-span-2">
            <label for="observacion"
                class="block mb-2 text-sm font-medium text-blue-700  dark:text-white">Observación</label>
            <textarea id="observacion" rows="3" name="observacion" disabled
                class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">{{ $requerimiento->observacion }}</textarea>
            @if ($errors->has('observacion'))
                <p id="observacion" class="mt-2 text-xs text-red-600 dark:text-red-400">
                    {{ $errors->first('observacion') }}
                </p>
            @endif
        </div>
    @else
        <div class="sm:col-span-2">
            <label for="observacion"
                class="block mb-2 text-sm font-medium text-blue-700  dark:text-white">Observación</label>
            <textarea id="observacion" rows="3" name="observacion"
                class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">{{ $requerimiento->observacion }}</textarea>
            @if ($errors->has('observacion'))
                <p id="observacion" class="mt-2 text-xs text-red-600 dark:text-red-400">
                    {{ $errors->first('observacion') }}
                </p>
            @endif
        </div>
    @endif


    <div class="sm:col-span-2" id='fecha' style="display:none;">
        <div class="relative">
            <label for="fecha_vencimiento" class="block mb-2 text-sm font-medium text-blue-700 dark:text-white">Fecha de
                vencimiento</label>
            <div class="absolute mt-7 inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor"
                    viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                        d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                        clip-rule="evenodd"></path>
                </svg>
            </div>
            <input datepicker datepicker-autohide type="text" name="fecha_vencimiento"
                value="{{ old('fecha_vencimiento', Carbon\Carbon::parse($requerimiento->fecha_vencimiento)->format('m/d/Y')) }}"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                placeholder="Selecciona una fecha">
            @if ($errors->has('fecha_vencimiento'))
                <p id="fecha_vencimiento" class="mt-2 text-xs text-red-600 dark:text-red-400">
                    {{ $errors->first('fecha_vencimiento') }}
                </p>
            @endif
        </div>
    </div>

    <div class="sm:col-span-2" id='responsable' style="display:none;">
        <div>
            <label for="user" class="block mb-2 text-sm font-medium text-blue-700 dark:text-white">Responsable
                requerimiento</label>
            @if (!is_null($requerimiento->user_id))
                <select id="user" name="user_id"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                    @foreach ($responsables as $responsable)
                        @if ($requerimiento->user_id == $id)
                            <option selected value="{{ old('user_id', $requerimiento->user_id) }}">
                                {{ $responsable->nombres . ' ' . $responsable->apellidos }} </option>
                        @else
                            <option selected value="{{ old('user_id', $requerimiento->user_id) }}">
                                {{ $responsable->nombres . ' ' . $responsable->apellidos }} </option>
                        @endif
                    @endforeach
                </select>
            @else
                <select id="user" name="user_id"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                    <option value="" selected disabled>Selecciona un responsable</option>
                    @foreach ($responsables as $responsable)
                        <option value="{{ $responsable->id }}">
                            {{ $responsable->nombres . ' ' . $responsable->apellidos }} </option>
                    @endforeach
                </select>
            @endif

            @if ($errors->has('user_id'))
                <p id="user_id" class="mt-2 text-xs text-red-600 dark:text-red-400">
                    {{ $errors->first('user_id') }}</p>
            @endif
        </div>
    </div>

</div>
