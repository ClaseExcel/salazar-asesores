document.addEventListener('DOMContentLoaded', function () {
    view_periodicidad();
});

function view_periodicidad() {
    var actividad_id = document.getElementById('actividad_id');
    var div_periodicidad = document.getElementById('div_periodicidad');
    // var div_periodicidad_corte = document.getElementById('div_periodicidad_corte');

    if (actividad_id.value == 1) {
        div_periodicidad.style.display = 'flex';
        // div_periodicidad_corte.style.display = 'flex';
    } else {
        div_periodicidad.style.display = 'none';
        // div_periodicidad_corte.style.display = 'none';
    }
}

$('#estado_actividad_id').change(function () {

    var empleado = document.getElementById('empleado');
    var just = document.getElementById('just');
    var empresa = document.getElementById('empresa');
    var progreso = document.getElementById('progreso');

    if ($(this).val() == 4 || $(this).val() == 3) {
        empleado.style.display = 'none';
        empresa.style.display = 'none';
        just.style.display = 'block';
        progreso.style.display = 'block';
    } else if ($(this).val() == 5) {
        just.style.display = 'none';
        empleado.style.display = 'block';
        empresa.style.display = 'block';
    } else {
        just.style.display = 'none';
        progreso.style.display = 'none';
        empleado.style.display = 'none';
        empresa.style.display = 'none';
    }
});

$('#responsable_id').change(function () {
    let responsableActividad = $(this).val();
    $('#cliente_id').prop("disabled", false);
    $('#usuario_id').prop("disabled", true);
    $('#usuario_id').empty();
    $("#usuario_id").append('<option value="">Seleccione una opción</option>');
    $.ajax({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        type: 'GET',
        url: 'cliente_id/' + responsableActividad,
        success: function ($empresas) {

            let empresas = JSON.parse($empresas);

            $('#cliente_id').empty();

            $("#cliente_id").append('<option value="">Seleccione una opción</option>');

            $.each(empresas, function (index, value) {
                $("#cliente_id").append('<option value=' + value.id + '>' + value
                    .razon_social + '</option>');
            });
        }
    })
});


$('#cliente_id').change(function () {
    let empresa = $(this).val();
    let cliente = document.getElementById('empresa_asociada');

    if(empresa == 1) {
        cliente.style.display = 'block';
    } else {
        cliente.style.display = 'none';
    }

    $('#usuario_id').prop("disabled", false);
    $.ajax({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        type: 'GET',
        url: 'usuario_id/' + empresa,
        success: function ($responsable) {

            let responsable = JSON.parse($responsable);

            $('#usuario_id').empty();

            $("#usuario_id").append('<option value="">Seleccione una opción</option>');

            $.each(responsable, function (index, value) {
                $("#usuario_id").append('<option value=' + value.id + '>' + value
                    .nombres + ' ' + value.apellidos + '</option>');
            });
        }
    })
});

$('#estado_actividad_id').change(function () {
    let empresa = $('#empresa_id').val();
    $('#usuario_id').prop("disabled", false);
    $.ajax({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        type: 'GET',
        url: 'usuario_id/' + empresa,
        success: function ($responsable) {

            let responsable = JSON.parse($responsable);

            $('#usuario_id').empty();

            $("#usuario_id").append('<option value="">Seleccione una opción</option>');

            $.each(responsable, function (index, value) {
                $("#usuario_id").append('<option value=' + value.id + '>' + value
                    .nombres + ' ' + value.apellidos + '</option>');
            });
        }
    })
});