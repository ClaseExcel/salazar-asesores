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
            <div class="bagde flex flex-wrap justify-center mb-3">
                <span class="rounded-full px-2 text-white mr-2" style="background-color:#0075F6;">Actividades</span>
                <span class="rounded-full px-2 text-white mr-2" style="background-color:#D7001E;">Vencidas</span>
                <span class="rounded-full px-2 text-white mr-2" style="background-color:#0DA13C;">Finalizadas</span>
            </div>

            <div class="flex justify-center">
                <div id="calendario-actividades" style="display: inline-block;"></div>
            </div>
        </div>

        @include('modal.actividades-modal')


    </x-jet-bar-container>
    <script>
        let events = {!! json_encode($events) !!};

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

        let allEvents = events.concat(festivos);

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
                    reopenModal();
                    document.getElementById('actividad_id').value = calEvent.event.id;
                    $('#actividadModal #titulo-actividad').html('<b>' + calEvent.event.title + '</b>');
                    $('#actividadModal #descripcion').html(calEvent.event._def.extendedProps.description);
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
