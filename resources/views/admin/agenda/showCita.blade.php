<div id="ShowCitaModal" tabindex="-1" aria-hidden="true"
    class="absolute hidden z-50 inset-0 flex items-center justify-center bg-gray-800 bg-opacity-50 w-50 md:w-auto md:rounded-lg overflow-hidden shadow-xl">

    <!-- Modal content -->
    <div class="relative rounded-lg shadow">
        <!-- Modal header -->
        <div class="flex items-start justify-between p-5 border-b rounded-t bg-blue-700">
            <h3 class="text-xl font-semibold lg:text-2xl text-white">
                Cita
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
            <input type="hidden" id="cita_id">
            <p id="empresa"></p>
            <p id="empleado"></p>
            <p id="motivo"></p>
            <p id="modalidad"></p>
            <p id="observacion"></p>
            <p id="horario"></p>
        </div>
        <!-- Modal footer -->
        <div class="flex items-center justify-end p-6 space-x-2 border-t rounded-b border-gray-600 bg-blue-700">
            @if (in_array(Auth::user()->rol_id, [6, 7]))
                <button
                    class="text-gray-500  bg-white hover:bg-gray-100 focus:ring-4  rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 
                    focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600" onclick="showModalEditarCita();">Editar cita</button>
            @endif
            <button
                class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg
                 text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900" onclick="cancelarCita();">Cancelar cita</button>

        </div>
    </div>
</div>
