<div class="grid gap-4 sm:grid-cols-2 sm:gap-6">
    <div class="sm:col-span-2">
        <div class="relative">
            <input type="text" id="cedula" name="cedula" value="{{ old('nombres', $empleado->cedula) }}"
                class="block px-2.5 pb-2.5 pt-4 w-full text-sm text-gray-900 bg-transparent rounded-lg border-1 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                placeholder=" " />
            <label for="cedula"
                class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white dark:bg-gray-900 px-2 peer-focus:px-2 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 left-1">Cédula</label>
        </div>
        @if ($errors->has('cedula'))
            <p id="cedula" class="mt-2 text-xs text-red-600 dark:text-red-400">{{ $errors->first('cedula') }}</p>
        @endif
    </div>

    <div>
        <div class="relative">
            <input type="text" id="nombres" name="nombres" value="{{ old('nombres', $empleado->nombres) }}"
                class="block px-2.5 pb-2.5 pt-4 w-full text-sm text-gray-900 bg-transparent rounded-lg border-1 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                placeholder=" " />
            <label for="nombres"
                class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white dark:bg-gray-900 px-2 peer-focus:px-2 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 left-1">Nombres</label>
        </div>
        @if ($errors->has('nombres'))
            <p id="nombres" class="mt-2 text-xs text-red-600 dark:text-red-400">{{ $errors->first('nombres') }}</p>
        @endif
    </div>

    <div>
        <div class="relative">
            <input type="text" id="apellidos" name="apellidos" value="{{ old('apellidos', $empleado->apellidos) }}"
                class="block px-2.5 pb-2.5 pt-4 w-full text-sm text-gray-900 bg-transparent rounded-lg border-1 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                placeholder=" " />
            <label for="apellidos"
                class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white dark:bg-gray-900 px-2 peer-focus:px-2 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 left-1">Apellidos</label>
        </div>
        @if ($errors->has('apellidos'))
            <p id="apellidos" class="mt-2 text-xs text-red-600 dark:text-red-400">{{ $errors->first('apellidos') }}</p>
        @endif
    </div>


    <div class="sm:col-span-2">
        <div class="relative">
            <input type="text" id="email" name="email" value="{{ old('email', $empleado->email) }}"
                class="block px-2.5 pb-2.5 pt-4 w-full text-sm text-gray-900 bg-transparent rounded-lg border-1 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                placeholder=" " />
            <label for="email"
                class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white dark:bg-gray-900 px-2 peer-focus:px-2 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 left-1">Email</label>
        </div>
        @if ($errors->has('email'))
            <p id="email" class="mt-2 text-xs text-red-600 dark:text-red-400">{{ $errors->first('email') }}</p>
        @endif
    </div>

    <div>
        <label for="cargos" class="block mb-2 text-sm font-medium text-blue-700 dark:text-white">Cargos</label>
        @if (!is_null($empleado->cargo_id))
            <select id="cargos" name="cargo_id"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                @foreach ($cargos as $id => $nombres)
                    @if ($empleado->cargo_id == $id)
                        <option selected value="{{ old('cargo_id', $empleado->cargo_id) }}">
                            {{ $nombres }} </option>
                    @else
                        <option value="{{ $id }}">{{ $nombres }}</option>
                    @endif
                @endforeach
            </select>
        @else
            <select id="cargos" name="cargo_id"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                @foreach ($cargos as $id => $nombre)
                    <option value="{{ $id }}">{{ $nombre }}</option>
                @endforeach
            </select>
        @endif

        @if ($errors->has('cargo_id'))
            <p id="cargo_id" class="mt-2 text-xs text-red-600 dark:text-red-400">{{ $errors->first('cargo_id') }}</p>
        @endif
    </div>
    <div>
        <label for="roles" class="block mb-2 text-sm font-medium text-blue-700 dark:text-white">Roles</label>

        @if (!is_null($empleado->rol_id))
            <select id="roles" name="rol_id"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                @foreach ($roles as $rol)
                    @if ($empleado->rol_id == $rol->id)
                        <option selected value="{{ old('rol_id', $empleado->rol_id) }}">
                            {{ $rol->nombre }} </option>
                    @else
                        <option value="{{ $rol->id }}">{{ $rol->nombre }}</option>
                    @endif
                @endforeach
            </select>
        @else
            <select id="roles" name="rol_id"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                @foreach ($roles as $rol)
                    <option value="{{ $rol->id }}">{{ $rol->nombre }}</option>
                @endforeach
            </select>
        @endif

        @if ($errors->has('rol_id'))
            <p id="rol_id" class="mt-2 text-xs text-red-600 dark:text-red-400">{{ $errors->first('rol_id') }}</p>
        @endif
    </div>

    @if(request()->routeIs('admin.empleados.edit'))

    @else
    <div class="sm:col-span-2">
        <div class="relative">
            <input type="password" id="contraseña" name="password"
                class="block px-2.5 pb-2.5 pt-4 w-full text-sm text-gray-900 bg-transparent rounded-lg border-1 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                placeholder=" " />
            <label for="contraseña"
                class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white dark:bg-gray-900 px-2 peer-focus:px-2 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 left-1">Contraseña</label>
        </div>
        @if ($errors->has('password'))
            <p id="password" class="mt-2 text-xs text-red-600 dark:text-red-400">{{ $errors->first('password') }}</p>
        @endif
    </div>
    @endif
</div>
