<x-app-layout>
    @section('title', 'Citas')

    <x-jet-bar-container>

        <div class="container mx-5">
            <h1 class="text-4xl text-blue-900 font-semibold" style="text-shadow: 1px 1px 1px  rgba(49, 49, 49, 0.323);">
                {{ __('Citas') }}
            </h1>
        </div>

        <div class="mt-6">
            @if (session()->has('message'))
                <x-jet-bar-alert text="{{ session('message') }}" type="{{ session('color') }}" />
            @endif
            <div id='validation-success'>
            </div>
        </div>


        <div class="max-w p-6 bg-white border border-gray-200 rounded-lg shadow">
            <div class="bagde flex flex-wrap justify-center mb-3 ">
                <span class="rounded-full px-2 text-white mr-2" style="background-color:#0075F6;">Disponible</span>
                <span class=" rounded-full px-2 text-white mr-2" style="background-color:#0900C3;">Reservado</span>
                <span class=" rounded-full px-2 text-white mr-2" style="background-color:#030033;">Cancelado</span>
                <span class=" rounded-full px-2 text-white" style="background-color:#a1a1a1;">No disponible</span>
            </div>
            <div class="flex justify-center">
                <div id="calendario-agenda" style="display: inline-block;"></div>
            </div>
        </div>

        <div>
            @include('admin.citas.modal')
            @include('admin.citas.modalEdit')
        </div>

        <div>
            @include('admin.agenda.showCita')
        </div>


    </x-jet-bar-container>


    <script>
        let events = {!! json_encode($events) !!};
        let citas = {!! json_encode($citas) !!};
        let usuario_cliente = {!! $usuario_cliente->id !!}

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

        document.addEventListener('DOMContentLoaded', function() {

            var calendarEl = document.getElementById('calendario-agenda');

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
                events: festivos,
                //Muestra modal al dar clic al evento
                eventClick: function(calEvent, jsEvent, view) {

                    var fecha_inicio = moment(calEvent.event.start).format('yyyy-MM-DD HH:mm:ss');
                    var fecha_fin = moment(calEvent.event.end).format('yyyy-MM-DD HH:mm:ss');

                    const fechaActual = moment().format('yyyy-MM-DD HH:mm:ss');
                    const diferenciaDias = moment(fecha_fin).diff(fechaActual, 'days');

                    const ahora = new Date();
                    const horaLimite = new Date(ahora);
                    horaLimite.setHours(18, 0, 0, 0);

                    if (fecha_fin <= (fechaActual)) {
                        // Si la fecha final del evento es anterior a la fecha actual, no hacer nada
                        return;
                    } else if (ahora > horaLimite && diferenciaDias <= 1) {
                        return;
                    }

                    //Busca si la cita esta reservada para mostrar sus datos de la cita
                    citas.forEach(element => {
                        if (element.estados == 2) {
                            if (element.fecha_inicio.includes(fecha_inicio)) {
                                buscarEmpleado(element.empleado_cliente_id, element
                                    .modalidad_id,
                                    element.motivo, element.observacion, element.link,
                                    element
                                    .direccion, fecha_inicio, fecha_fin, element.id);
                            }
                        }
                    });

                    //si el estado de la cita es 1(vigente) mostrar modal de creacion de cita
                    if (calEvent.event.extendedProps.estado == 1) {
                        document.getElementById('agenda_id').value = calEvent.event.id;
                        document.getElementById('fecha_inicio').value = fecha_inicio;
                        document.getElementById('fecha_fin').value = fecha_fin;
                        $('#citaModal').show();
                    }
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


            events.forEach(element => {
                var startDate = new Date(element.start);
                var endDate = new Date(element.end);
                var now = new Date();



                // Duración del intervalo en minutos
                var intervalDuration = 60;

                // Cálculo de los intervalos entre la fecha de inicio y fin
                var interval = startDate;
                var intervals = [];

                while (interval <= endDate) {
                    intervals.push(interval);
                    interval = new Date(interval.getTime() + intervalDuration * 60000);

                    // // Verificar si el interval(fecha de inicio) es mayor a la fecha final, si sus horas coinciden y sus minutos son mayores o iguales a la fecha final.
                    if (interval > endDate || (interval.getHours() === endDate.getHours() && interval
                            .getMinutes() >= endDate.getMinutes())) {
                        break; // Salir del bucle
                    }
                }

                for (const interval of intervals) {
                    let hasMatch = false;

                    //veo la diferencia en dias entre los eventos y el actual
                    const diferenciaDias = moment(interval).diff(moment(now), 'days');

                    const horaLimite = new Date(now);
                    horaLimite.setHours(18, 0, 0, 0);

                    if (diferenciaDias < 0) {
                        calendar.addEvent({
                            id: element.id,
                            start: interval,
                            end: new Date(interval.getTime() + intervalDuration * 60000),
                            backgroundColor: '#a1a1a1',
                            borderColor: '#a1a1a1'
                        });
                        //si la fecha del evento el igual a la actual
                    } else if (moment(interval).format('DD/MM/YYYY') == moment().format('DD/MM/YYYY')) {
                        calendar.addEvent({
                            id: element.id,
                            start: interval,
                            end: new Date(interval.getTime() + intervalDuration * 60000),
                            backgroundColor: '#a1a1a1',
                            borderColor: '#a1a1a1'
                        });
                        //si la hora de hoy es mayor a las 6:00pm
                    } else if (now > horaLimite) {
                        calendar.addEvent({
                            id: element.id,
                            start: interval,
                            end: new Date(interval.getTime() + intervalDuration * 60000),
                            backgroundColor: '#a1a1a1',
                            borderColor: '#a1a1a1'
                        });

                    } else {
                        for (const cita of citas) {
                            const startCita = new Date(cita.fecha_inicio);

                            //compara si la fecha se la cita es similar a la de la agenda, si el estado es 3 y el empleado que la cancelo esta logueado mostrarlo como cancelado
                            //si no liberarlo para los demas empleados
                            if ((moment(interval).isSame(startCita, 'minute') && cita.estados == 3) && cita
                                .empleado_cliente_id == usuario_cliente) {
                                calendar.addEvent({
                                    id: element.id,
                                    start: interval,
                                    end: new Date(interval.getTime() + intervalDuration *
                                        60000),
                                    backgroundColor: '#030033',
                                    borderColor: '#030033',
                                });

                                hasMatch = true;
                                break;
                            }

                            //Compara la fecha de la agenda con la de la cita creada si es similar y su estado es diferente de 3(cancelado)
                            if (moment(interval).isSame(startCita, 'minute') && cita.estados != 3) {
                                calendar.addEvent({
                                    id: element.id,
                                    start: interval,
                                    end: new Date(interval.getTime() + intervalDuration *
                                        60000),
                                    backgroundColor: '#0900C3',
                                    borderColor: '#0900C3',
                                });

                                hasMatch = true;
                                break;
                            }



                        }

                        //Verifica si ya se paso por esa fecha, si lo hizo muestra las que no esta agendadas
                        if (!hasMatch) {
                            calendar.addEvent({
                                id: element.id,
                                start: interval,
                                end: new Date(interval.getTime() + intervalDuration * 60000),
                                backgroundColor: '#0075F6',
                                borderColor: '#0075F6',
                                estado: 1
                            });
                        }
                    }
                }
            });

            calendar.render();

        });

        function closemodal() {
            $('#citaModal').hide();
            $('#ShowCitaModal').hide();
            $('#citaEditar').hide();
        }

        function closealert() {
            $('#alert').hide();
        }

        $('#modalidadCreate').change(function() {
            var virtual = document.getElementById('virtual');
            var fisica = document.getElementById('fisica');

            if ($(this).val() == 1) {
                fisica.style.display = 'none';
                virtual.style.display = 'block';
            } else {
                virtual.style.display = 'none';
                fisica.style.display = 'block';
            }
        });

        function crearCita() {

            var empleadoCliente = $('#empleado_cliente_id').val();
            var agendaId = $('#agenda_id').val();
            var motivo = $('#motivoCreate').val();
            var link = $('#linkCreate').val();
            var fechaInicio = $('#fecha_inicio').val();
            var fechaFinal = $('#fecha_fin').val();
            var estado = $('#estado').val();
            var direccion = $('#direccionCreate').val();
            var observacion = $('#observacionCreate').val();
            var modalidad_id = $('#modalidadCreate').val();

            $.ajax({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                },
                type: 'POST',
                url: 'citas',
                data: {
                    empleado_cliente_id: empleadoCliente,
                    motivo: motivo,
                    modalidad_id: modalidad_id,
                    agenda_id: agendaId,
                    link: link,
                    fecha_inicio: fechaInicio,
                    fecha_fin: fechaFinal,
                    estados: estado,
                    direccion: direccion,
                    observacion: observacion
                },
                success: function(result) {
                    $('#citaModal').hide();

                    Swal.fire({
                        icon: 'success',
                        title: 'Creación exitosa',
                        text: 'Se ha creado tu cita con exito',
                    }).then((result) => {
                        location.reload();
                    });
                },
                error: function(xhr) {
                    $('#validation-errors').html('');
                    $.each(xhr.responseJSON.errors, function(key, value) {
                        $('#validation-errors').append('<div style="color:red;">' + value +
                            '</div>');
                    });
                },
            });
        }

        //trae la informacion del empleado
        function buscarEmpleado(usuario_id, modalidad, motivo, observacion, link, direccion, fecha_inicio,
            fecha_fin,
            cita_id) {

            $.ajax({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                },
                type: 'GET',
                url: 'agenda/EmpleadoCliente/' + usuario_id,
                success: function(data) {

                    document.getElementById('cita_id').value = cita_id;
                    $("#ShowCitaModal #empresa").html('<b> Empresa: </b>' + data.empresa);
                    $("#ShowCitaModal #empleado").html('<b> Empleado: </b>' + data.nombres);
                    $("#ShowCitaModal #motivo").html('<b> Motivo: </b>' + motivo);
                    $("#ShowCitaModal #horario").html('<b> Hora cita: </b>' + moment(fecha_inicio)
                        .format(
                            'D-MM-Y HH:mm a') + '-' + moment(fecha_fin).format('HH:mm a'));


                    if (modalidad == 1) {
                        $("#ShowCitaModal #modalidad").html('<b> Virtual: </b>' +
                            '<a style="color:blue; href="' + link + '" target="_blank">' + link +
                            '</a>');
                    } else {
                        $("#ShowCitaModal #modalidad").html('<b> Dirección: </b>' + direccion);
                    }

                    if (observacion != undefined) {
                        $("#ShowCitaModal #observacion").html('<b> Observación: </b>' + observacion);
                    }

                    $('#ShowCitaModal').show();

                },
            });
        }

        function showModalEditarCita() {
            const cita = $('#cita_id').val();
            $.ajax({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                },
                type: 'GET',
                url: 'citas/' + cita + '/edit ',
                success: function(data) {
                    if (data == 0) {

                        Swal.fire({
                            icon: 'error',
                            title: 'Cita no editada',
                            text: 'No puedes editar citas de otros compañeros',
                        })

                    } else {
                        //muestro el editar cita
                        $('#citaEditar').show();

                        //oculto es modal que muestra los datos
                        $('#ShowCitaModal').hide();

                        var virtual = document.getElementById('virtualEdit');
                        var fisico = document.getElementById('fisicaEdit');

                        $("#citaEditar #motivoEdit").val(data.motivo);

                        if (data.modalidad_id == 1) {
                            document.getElementById("modalidadEdit").selectedIndex = 1
                            virtual.style.display = 'block';
                            fisico.style.display = 'none';
                        } else {
                            document.getElementById("modalidadEdit").selectedIndex = 2
                            fisico.style.display = 'block';
                            virtual.style.display = 'none';
                        }

                        document.getElementById('citaId').value = cita;
                    }
                },
            });
        }

        $('#modalidadEdit').change(function() {

            var virtual = document.getElementById('virtualEdit');
            var fisica = document.getElementById('fisicaEdit');

            if ($(this).val() == 1) {
                fisica.style.display = 'none';
                virtual.style.display = 'block';

                document.getElementById('linkEdit').value = ""
            } else {
                virtual.style.display = 'none';
                fisica.style.display = 'block';
                document.getElementById('direccionEdit').value = ""
            }
        });

        function editarCita() {
            const cita = $('#citaId').val();
            var motivo = $('#motivoEdit').val();
            var direccion = $('#direccionEdit').val();
            var link = $('#linkEdit').val();
            var observacion = $('#observacionEdit').val();
            var modalidad_id = $('#modalidadEdit').val();

            $.ajax({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                },
                type: 'PUT',
                url: 'citas/' + cita,
                data: {
                    motivo: motivo,
                    modalidad_id: modalidad_id,
                    direccion: direccion,
                    observacion: observacion,
                    link: link,

                },
                success: function(data) {
                    if (data == true) {
                        $('#citaEditar').hide();
                        Swal.fire({
                            icon: 'success',
                            title: 'Actualización exitosa',
                            text: 'Se ha actualizado tu cita con exito',
                        })

                    }
                },
                error: function(xhr) {
                    $('#validation-errors-edit').html('');
                    $.each(xhr.responseJSON.errors, function(key, value) {
                        $('#validation-errors-edit').append('<div style="color:red;">' + value +
                            '</div>');
                    });
                },
            });
        }

        function cancelarCita() {
            const cita_id = $('#cita_id').val();
            $.ajax({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                },
                type: 'DELETE',
                url: 'citas/' + cita_id,
                success: function(data) {
                    if (data == true) {
                        $('#ShowCitaModal').hide();
                        Swal.fire({
                            icon: 'success',
                            title: 'Cancelación exitosa',
                            text: 'Se cancelado tu cita con exito',
                        }).then((result) => {
                            location.reload();
                        });

                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Cita no cancelada',
                            text: 'No puedes cancelar citas de otros compañeros',
                        })
                    }
                },
            });
        }
    </script>
</x-app-layout>
