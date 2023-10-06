<x-app-layout>
    @section('title', 'Actividades')

    <x-jet-bar-container>

        <div class="container mx-5">
            <h1 class="text-4xl text-blue-900 font-semibold" style="text-shadow: 1px 1px 1px  rgba(49, 49, 49, 0.323);">
                {{ __('Actividades') }}
            </h1>
        </div>

        @if (in_array(Auth::user()->rol_id, [1, 2, 8]))
        <div class="container mx-auto flex justify-end">
            <button onclick="location.href='{{ route('admin.actividad_cliente.create') }}'"
                class="rounded-full bg-blue-500 text-neutral-50 px-4 py-2 font-semibold shadow-lg hover:bg-blue-700">Nueva
                actividad</button>
        </div>
        @endif

        <div class="mt-6">
            @if (session()->has('message'))
                <x-jet-bar-alert text="{{ session('message') }}" type="{{ session('color') }}" />
            @endif
        </div>

        <div class="container mx-auto mt-5">
            @include('admin.actividadcliente.table')
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
    </script>
</x-app-layout>
