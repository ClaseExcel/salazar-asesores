<x-app-layout>
    @section('title', 'Dashboard')
    <x-slot name="header">
        {{ __('Dashboard') }}
    </x-slot>

    <x-jet-bar-container>

        <div class="mt-6">
            @if (session()->has('message'))
                <x-jet-bar-alert text="{{ session('message') }}" type="{{ session('color') }}" />
            @endif
        </div>

        <div class="max-w p-6 bg-white border border-gray-200 rounded-lg shadow">

            @if (in_array(Auth::user()->rol_id, [1, 2]))
                <div class="grid gap-4 sm:grid-cols-2 sm:gap-6 mb-4">
                    <div class="mb-3">
                        <label for="empresas"
                            class="block mb-2 text-sm font-medium text-blue-700 dark:text-white">Empresa</label>
                        <select id="empresa_id" name="empresa_id"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                            <option value="0">Todas las empresas</option>
                            @foreach ($empresas as $empresa)
                                <option value="{{ $empresa->id }}">{{ $empresa->razon_social }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="responsable"
                            class="block mb-2 text-sm font-medium text-blue-700 dark:text-white">Responsables</label>
                        <select id="responsable" name="responsable" disabled
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                            <option value="">Selecciona un responsable</option>
                        </select>
                    </div>
                </div>
            @endif

            <div class="bagde flex flex-wrap justify-center mb-3 ">
                <div>
                    <span class="rounded-full px-2 text-white mr-2" style="background-color:#0900C3;">Requerimientos</span>
                </div>
                <div>
                    <span class="rounded-full px-2 text-white mr-2" style="background-color:#0075F6;">Actividades</span>
                </div>
                <div>
                    <span class="rounded-full px-2 text-white mr-2" style="background-color:#D7001E;">Vencidas</span>
                </div>
                <div>
                    <span class="rounded-full px-2 text-white mr-2" style="background-color:#0DA13C;">Finalizadas</span>
                </div>
            </div>

            <div class="flex justify-center">
                <div id="calendario-actividades" style="display: inline-block;"></div>
            </div>
            <div class="flex justify-center">
                <div id="calendario-empleados" style="display: inline-block;"></div>
            </div>
        </div>

        @include('modal.actividades-modal')


    </x-jet-bar-container>
    <script src="{{ asset('js/actividadCalendario/calendario.js') }}" defer></script>
    <script>
        let events = {!! json_encode($events) !!};
        let event_requerimientos = {!! json_encode($event_requerimientos) !!};
        let festivos = [{
                title: 'Año Nuevo',
                start: '2023-01-01',
                end: '2023-01-01',
                backgroundColor: '#595959',
                borderColor: '#595959',
                classNames: 'event-class-1',
            },
            {
                title: 'Día de los Reyes Magos',
                start: '2023-01-09',
                end: '2023-01-09',
                backgroundColor: '#595959',
                classNames: 'event-class-1',
                borderColor: '#595959',
            },
            {
                title: 'Día de San José',
                start: '2023-03-20',
                end: '2023-03-20',
                backgroundColor: '#595959',
                classNames: 'event-class-1',
                borderColor: '#595959',
            },
            {
                title: 'Jueves Santo',
                start: '2023-04-09',
                end: '2023-04-09',
                backgroundColor: '#595959',
                classNames: 'event-class-1',
                borderColor: '#595959',
            },
            {
                title: 'Viernes Santo',
                start: '2023-04-10',
                end: '2023-04-10',
                backgroundColor: '#595959',
                classNames: 'event-class-1',
                borderColor: '#595959',
            },
            {
                title: 'Día del Trabajo',
                start: '2023-05-01',
                end: '2023-05-01',
                backgroundColor: '#595959',
                classNames: 'event-class-1',
                borderColor: '#595959',
            },
            {
                title: 'Día de la Ascensión',
                start: '2023-05-29',
                end: '2023-05-29',
                backgroundColor: '#595959',
                classNames: 'event-class-1',
                borderColor: '#595959',
            },
            {
                title: 'Corpus Christi',
                start: '2023-06-19',
                end: '2023-06-19',
                backgroundColor: '#595959',
                classNames: 'event-class-1',
                borderColor: '#595959',
            },
            {
                title: 'Sagrado Corazón',
                start: '2023-06-26',
                end: '2023-06-26',
                backgroundColor: '#595959',
                classNames: 'event-class-1',
                borderColor: '#595959',
            },
            {
                title: 'San Pedro y San Pablo',
                start: '2023-07-03',
                end: '2023-07-03',
                backgroundColor: '#595959',
                classNames: 'event-class-1',
                borderColor: '#595959',
            },
            {
                title: 'Día de la Independencia',
                start: '2023-07-20',
                end: '2023-07-20',
                backgroundColor: '#595959',
                classNames: 'event-class-1',
                borderColor: '#595959',
            },
            {
                title: 'Batalla de Boyacá',
                start: '2023-08-07',
                end: '2023-08-07',
                backgroundColor: '#595959',
                classNames: 'event-class-1',
                borderColor: '#595959',
            },
            {
                title: 'Día de la Asunción de la Virgen',
                start: '2023-08-21',
                end: '2023-08-21',
                backgroundColor: '#595959',
                classNames: 'event-class-1',
                borderColor: '#595959',
            },
            {
                title: 'Día de la Raza',
                start: '2023-10-16',
                end: '2023-10-16',
                backgroundColor: '#595959',
                classNames: 'event-class-1',
                borderColor: '#595959',
            },
            {
                title: 'Día de Todos los Santos',
                start: '2023-11-06',
                end: '2023-11-06',
                backgroundColor: '#595959',
                classNames: 'event-class-1',
                borderColor: '#595959',
            },
            {
                title: 'Independencia de Cartagena',
                start: '2023-11-13',
                end: '2023-11-13',
                backgroundColor: '#595959',
                classNames: 'event-class-1',
                borderColor: '#595959',
            },
            {
                title: 'Día de la Inmaculada Concepción',
                start: '2023-12-08',
                end: '2023-12-08',
                backgroundColor: '#595959',
                classNames: 'event-class-1',
                borderColor: '#595959',
            },
            {
                title: 'Navidad',
                start: '2023-12-25',
                end: '2023-12-25',
                backgroundColor: '#595959',
                classNames: 'event-class-1',
                borderColor: '#595959',
            }
        ];

        let allEvents = events.concat(festivos).concat(event_requerimientos);

        document.addEventListener('DOMContentLoaded', function() {

            var calendarEl = document.getElementById('calendario-actividades');

            var calendar = new FullCalendar.Calendar(calendarEl, {
                plugins: ['dayGrid', 'timeGrid', 'list', 'moment'],
                header: {
                    left: "prev,next",
                    center: "title",
                    right: "dayGridMonth,listWeek,timeGridDay"
                },
                buttonText: {
                    today: 'Hoy',
                    month: 'Mes',
                    week: 'Semana',
                    day: 'Día',
                },
                events: allEvents,
                //Muestra modal al dar clic al evento
                eventClick: function(calEvent, jsEvent, view) {
                    console.log(calEvent.event.backgroundColor);
                    reopenModal();
                    document.getElementById('actividad_id').value = calEvent.event.id;
                    $('#actividadModal #titulo-actividad').html('<b>' + calEvent.event.title + '</b>');
                    $('#actividadModal #descripcion').html(calEvent.event._def.extendedProps
                        .description);
                    if (calEvent.event.backgroundColor == '#0900C3') {
                        document.getElementById('button_actividad').style.display = 'none';
                    } else {
                        document.getElementById('button_actividad').style.display = 'block';
                    }
                    $('#actividadModal').modal("show");

                },
                weekends: true,
                selectable: true,
                editable: false,
                defaultView: 'dayGridMonth',
                contentHeight: 850,
                locale: 'es',
                views: {
                    week: {
                        type: 'timeGrid',
                        duration: {
                            days: 4
                        }
                    },
                    day: {
                        type: 'dayGrid',
                        duration: {
                            weeks: 4
                        }
                    }
                },
                eventTimeFormat: {
                    hour: '2-digit',
                    minute: '2-digit',
                    hour12: true,
                },
                slotLabelFormat: {
                    hour: '2-digit',
                    minute: '2-digit',
                    hour12: true,
                },
                displayEventEnd: true,
                minTime: '06:00:00',
                maxTime: '21:00:00',
            });

            calendar.render();
        });



        function closemodal() {
            $('#actividadModal').hide();
        }

        function reopenModal() {
            document.getElementById('actividadModal').style.display = 'block';
        }

        function reportarActividad() {
            var actividad = $('#actividad_id').val();
            location.href = "admin/actividad_cliente/reporte/" + actividad;
        }
    </script>
</x-app-layout>
