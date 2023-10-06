<div id="citaModal" tabindex="-1" aria-hidden="true"
    class="absolute hidden z-50 inset-0 flex items-center justify-center bg-gray-800 bg-opacity-50 w-50 md:w-auto md:rounded-lg overflow-hidden shadow-xl">

    <!-- Modal content -->
    <div class="relative rounded-lg shadow">
        <!-- Modal header -->
        <div class="flex items-start justify-between p-5 border-b rounded-t bg-blue-700">
            <h3 class="text-xl font-semibold lg:text-2xl text-white">
                Crear cita
            </h3>
            <button onclick="closemodal()" type="button"
                class="bg-transparent rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center hover:bg-blue-900 hover:text-white">
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 14 14" style="color:white;">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                </svg>
                <span class="sr-only">Close modal</span>
            </button>
        </div>
        <!-- Modal body -->
        <div class="p-6 space-y-6 bg-white">

            <div class="sm:col-span-2">
                <div id="validation-errors"></div>
            </div>

            <form>
                <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">
                    <input type="hidden" name="empleado_cliente_id" id="empleado_cliente_id"
                        value="{{ $usuario_cliente->id }}">
                    <input type="hidden" name="agenda_id" id="agenda_id">
                    <input type="hidden" name="fecha_inicio" id="fecha_inicio">
                    <input type="hidden" name="fecha_fin" id="fecha_fin">
                    <input type="hidden" name="estado" id="estado" value="2">

                    <div>
                        <div class="relative mt-6">
                            <input type="text" id="motivoCreate" name="motivo"
                                class="block px-2.5 pb-2.5 pt-4 w-full text-sm text-gray-900 bg-transparent rounded-lg border-1 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                placeholder=" " />
                            <label for="motivo"
                                class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white dark:bg-gray-900 px-2 peer-focus:px-2 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 left-1">
                                Motivo</label>
                        </div>
                    </div>

                    <div>
                        <label for="modalidad"
                            class=" block mb-2 text-sm font-medium text-blue-700 dark:text-white">Modalidades</label>
                        <select id="modalidadCreate" name="modalidad_id"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                            <option value="">Selecciona una modalidad</option>
                            @foreach ($modalidades as $modalidad)
                                <option value="{{ $modalidad->id }}">{{ $modalidad->nombre }}</option>
                            @endforeach
                        </select>
                    </div>


                    <div class="sm:col-span-2" id="fisica" style="display: none;">
                        <div class="relative">
                            <input type="text" id="direccionCreate" name="direccion"
                                class="block px-2.5 pb-2.5 pt-4 w-full text-sm text-gray-900 bg-transparent rounded-lg border-1 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                placeholder=" " />
                            <label for="direccion" id="label-fisico"
                                class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white dark:bg-gray-900 px-2 peer-focus:px-2 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 left-1">
                                Direccion</label>
                        </div>
                    </div>

                    <div class="sm:col-span-2" id="virtual" style="display: none;">
                        <div class="relative">
                            <input type="text" id="linkCreate" name="link" 
                                class="block px-2.5 pb-2.5 pt-4 w-full text-sm text-gray-900 bg-transparent rounded-lg border-1 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                placeholder=" " />
                            <label for="link" id="label-virtual"
                                class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white dark:bg-gray-900 px-2 peer-focus:px-2 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 left-1">
                                Link</label>
                        </div>
                    </div>

                    <div class="sm:col-span-2">
                        <div class="relative">
                            <input type="text" id="observacionCreate" name="observacion"
                                class="block px-2.5 pb-2.5 pt-4 w-full text-sm text-gray-900 bg-transparent rounded-lg border-1 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                placeholder=" " />
                            <label for="observacion"
                                class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white dark:bg-gray-900 px-2 peer-focus:px-2 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 left-1">
                                Observación</label>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <!-- Modal footer -->
        <div class="flex items-center justify-end p-6 space-x-2 border-t rounded-b border-gray-600 bg-blue-700">
            <button
                class="text-gray-500  bg-white hover:bg-gray-100 focus:ring-4  rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 
                focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600"
                onclick="crearCita()">Enviar</button>

        </div>
    </div>
</div>
