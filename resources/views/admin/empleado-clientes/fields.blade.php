<div class="grid gap-4 sm:grid-cols-2 sm:gap-6">
    <div>
        <div class="relative">
            <input type="text" id="nombres" name="nombres" value="{{ old('nombres', $empleado_cliente->nombres) }}"
                class="block px-2.5 pb-2.5 pt-4 w-full text-sm text-gray-900 bg-transparent rounded-lg border-1 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                placeholder=" " />
            <label for="nombres"
                class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white dark:bg-gray-900 px-2 peer-focus:px-2 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 left-1">
                Nombres</label>
        </div>
        @if ($errors->has('nombres'))
            <p id="nombres" class="mt-2 text-xs text-red-600 dark:text-red-400">{{ $errors->first('nombres') }}</p>
        @endif
    </div>

    <div>
        <div class="relative">
            <input type="text" id="apellidos" name="apellidos"
                value="{{ old('apellidos', $empleado_cliente->apellidos) }}"
                class="block px-2.5 pb-2.5 pt-4 w-full text-sm text-gray-900 bg-transparent rounded-lg border-1 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                placeholder=" " />
            <label for="apellidos"
                class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white dark:bg-gray-900 px-2 peer-focus:px-2 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 left-1">
                Apellidos</label>
        </div>
        @if ($errors->has('apellidos'))
            <p id="apellidos" class="mt-2 text-xs text-red-600 dark:text-red-400">
                {{ $errors->first('apellidos') }}</p>
        @endif
    </div>


    <div>
        <div class="relative">
            <input type="text" id="email" name="email"
                value="{{ old('email', $empleado_cliente->correo_electronico) }}"
                class="block px-2.5 pb-2.5 pt-4 w-full text-sm text-gray-900 bg-transparent rounded-lg border-1 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                placeholder=" " />
            <label for="email"
                class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white dark:bg-gray-900 px-2 peer-focus:px-2 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 left-1">Correo
                eléctronico</label>
        </div>
        @if ($errors->has('email'))
            <p id="email" class="mt-2 text-xs text-red-600 dark:text-red-400">
                {{ $errors->first('email') }}</p>
        @endif
    </div>

    <div>
        <div class="relative">
            <input type="text" id="numero_contacto" name="numero_contacto"
                value="{{ old('numero_contacto', $empleado_cliente->numero_contacto) }}"
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
            <input type="text" id="correos_secundarios" name="correos_secundarios"
                value="{{ old('correos_secundarios', $empleado_cliente->correos_secundarios) }}"
                class="block px-2.5 pb-2.5 pt-4 w-full text-sm text-gray-900 bg-transparent rounded-lg border-1 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                placeholder=" " />
            <label for="correos_secundarios"
                class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white dark:bg-gray-900 px-2 peer-focus:px-2 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 left-1">Correos
                secundarios</label>
        </div>
        <div style="display:flex; align-items:center;" class="mt-2">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="h-6" style="color:#0075F6;">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M11.25 11.25l.041-.02a.75.75 0 011.063.852l-.708 2.836a.75.75 0 001.063.853l.041-.021M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9-3.75h.008v.008H12V8.25z" />
            </svg>
            <small class="italic font-semibold mx-1">
                Si vas a ingresar más correos separalos por comas.
            </small>
        </div>

        @if ($errors->has('correos_secundarios'))
            <p id="correos_secundarios" class="mt-2 text-xs text-red-600 dark:text-red-400">
                {{ $errors->first('correos_secundarios') }}</p>
        @endif
    </div>


    <div>
        <label for="roles" class="block mb-2 text-sm font-medium text-blue-700 dark:text-white">Roles</label>
        @if (!is_null($empleado_cliente->rol_id))
            <select id="roles" name="rol_id"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                @foreach ($roles as $rol)
                    @if ($empleado_cliente->rol_id == $rol->id)
                        <option selected value="{{ old('rol_id', $empleado_cliente->rol_id) }}">
                            {{ $rol->nombre }} </option>
                    @else
                        <option value="{{ $rol->id }}">{{ $rol->nombre }}</option>
                    @endif
                @endforeach
            </select>
        @else
            <select id="roles" name="rol_id"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                <option value="">Selecciona un rol</option>
                @foreach ($roles as $rol)
                    <option value="{{ $rol->id }}">{{ $rol->nombre }}</option>
                @endforeach
            </select>
        @endif

        @if ($errors->has('rol_id'))
            <p id="rol_id" class="mt-2 text-xs text-red-600 dark:text-red-400">{{ $errors->first('rol_id') }}</p>
        @endif
    </div>

    <div>
        <label for="empresas" class="block mb-2 text-sm font-medium text-blue-700 dark:text-white">Empresa</label>
        @if (!is_null($empleado_cliente->empresa_id))
            <select id="empresas" name="empresa_id"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                @foreach ($empresas as $empresa)
                    @if ($empleado_cliente->empresa_id == $empresa->id)
                        <option selected value="{{ old('empresa_id', $empleado_cliente->empresa_id) }}">
                            {{ $empresa->razon_social }} </option>
                    @else
                        <option value="{{ $empresa->id }}">{{ $empresa->razon_social }}</option>
                    @endif
                @endforeach
            </select>
        @else
            <select id="empresas" name="empresa_id"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                <option value="">Selecciona una empresa</option>
                @foreach ($empresas as $empresa)
                    <option value="{{ $empresa->id }}">{{ $empresa->razon_social }}</option>
                @endforeach
            </select>
        @endif

        @if ($errors->has('empresa_id'))
            <p id="empresa_id" class="mt-2 text-xs text-red-600 dark:text-red-400">{{ $errors->first('empresa_id') }}
            </p>
        @endif
    </div>

    @if (request()->routeIs('admin.empleado-clientes.edit'))
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
                <p id="password" class="mt-2 text-xs text-red-600 dark:text-red-400">
                    {{ $errors->first('password') }}</p>
            @endif
        </div>
    @endif
</div>
