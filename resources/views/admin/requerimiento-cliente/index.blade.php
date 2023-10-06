<x-app-layout>
    @section('title', 'Mis requerimientos')

    <x-jet-bar-container>

        <div class="container mx-5">
            <h1 class="text-4xl text-blue-900 font-semibold" style="text-shadow: 1px 1px 1px  rgba(49, 49, 49, 0.323);">
                {{ __('Mis requerimientos') }}
            </h1>
        </div>

        <div class="container mx-auto mt-5">
            @include('admin.requerimiento-cliente.table')
        </div>

    </x-jet-bar-container>

    <script>
        var ingreso = $("#tabla-info").DataTable({
            responsive: true,
            bLengthChange: false,
            bPaginate: false,
            language: {
                decimal: "",
                emptyTable: "No hay información",
                info: "Mostrando _START_ a _END_ de _TOTAL_",
                infoEmpty: "Mostrando 0 to 0 of 0 ",
                infoFiltered: "(Filtrado de _MAX_ total )",
                infoPostFix: "",
                thousands: ",",
                lengthMenu: "Mostrar _MENU_",
                loadingRecords: "Cargando...",
                processing: "Procesando...",
                search: "Buscar:",
                zeroRecords: "Sin resultados encontrados",
            },
        });

        function desistir(id) {

            Swal.fire({
                title: '¿Deseas deisitir?',
                text: "No podrás revertir este requerimiento",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sí',
                cancelButtonText: 'Cancelar',
            }).then((result) => {
                if (result.isConfirmed) {

                    $.ajax({
                        headers: {
                            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                        },
                        type: 'POST',
                        url: 'requerimientos-cliente/desisitir/' + id,
                        success: function() {
                            Swal.fire(
                                'Completado',
                                'Haz desistido en tu requerimento con éxito.',
                                'success'
                            ).then((result) => {
                                location.reload();
                            });
                        }
                    });
                }
            })
        }
    </script>
</x-app-layout>
