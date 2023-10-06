<div class="grid gap-4 sm:grid-cols-3 sm:gap-6">
    <div class="relative">
        <label for="fecha_disponibilidad" class="block mb-2 text-sm font-medium text-blue-700 dark:text-white">Fecha de
            disponibilidad</label>
        <div class="absolute mt-7 inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
            <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor" viewBox="0 0 20 20"
                xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd"
                    d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                    clip-rule="evenodd"></path>
            </svg>
        </div>
        <input datepicker datepicker-autohide type="text" name="fecha_disponibilidad" value="{{ old('fecha_disponibilidad', Carbon\Carbon::parse($agenda->fecha_disponibilidad)->format('m/d/Y')) }}"
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
            placeholder="Selecciona una fecha">
        @if ($errors->has('fecha_disponibilidad'))
            <p id="fecha_disponibilidad" class="mt-2 text-xs text-red-600 dark:text-red-400">
                {{ $errors->first('fecha_disponibilidad') }}
            </p>
        @endif
    </div>

    <div>
        <div class="relative">
            <label for="hora_inicio" class="block mb-2 text-sm font-medium text-blue-700 dark:text-white">Hora
                inicio</label>
            <input type="time" name="hora_inicio" value="{{ old('hora_inicio', Carbon\Carbon::parse($agenda->hora_inicio)->format('H:i')) }}"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5">
        </div>
        @if ($errors->has('hora_inicio'))
            <p id="hora_inicio" class="mt-2 text-xs text-red-600 dark:text-red-400">{{ $errors->first('hora_inicio') }}
            </p>
        @endif
    </div>

    <div class="relative">
        <label for="hora_fin" class="block mb-2 text-sm font-medium text-blue-700 dark:text-white">Hora
            fin</label>
        <input type="time" name="hora_fin" value="{{ old('hora_fin', Carbon\Carbon::parse($agenda->hora_fin)->format('H:i')) }}"
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
        @if ($errors->has('hora_fin'))
            <p id="hora_fin" class="mt-2 text-xs text-red-600 dark:text-red-400">{{ $errors->first('hora_fin') }}
            </p>
        @endif
    </div>



    <div>
        <label for="empresa_id" class="block mb-2 text-sm font-medium text-blue-700 dark:text-white">Clientes</label>

        @if (!is_null($agenda->empresa_id))
            <select id="empresa_id" name="empresa_id"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                <option value="">Selecciona un cliente </option>
                @foreach ($clientes as  $empresa)
                    @if ($agenda->empresa_id == $empresa->id)
                        <option selected value="{{ old('empresa_id', $agenda->empresa_id) }}">
                            {{ $empresa->razon_social }} </option>
                    @else
                        <option value="{{ $empresa->id }}">{{ $empresa->razon_social }}</option>
                    @endif
                @endforeach
            </select>
        @else
            <select id="empresa_id" name="empresa_id"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                <option selected value="">Selecciona un cliente </option>
                @foreach ($clientes as $empresa)
                    <option value="{{ $empresa->id }}">{{ $empresa->razon_social }}</option>
                @endforeach
            </select>
        @endif

        @if ($errors->has('empresa_id'))
            <p id="empresa_id" class="mt-2 text-xs text-red-600 dark:text-red-400">
                {{ $errors->first('empresa_id') }}
            </p>
        @endif
    </div>
</div>
