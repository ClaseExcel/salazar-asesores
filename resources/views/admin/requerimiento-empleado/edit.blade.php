<x-app-layout>
    @section('title', 'Actualizar requerimiento')

    <x-jet-bar-container>

        <div class="flex justify-end mb-4">
            <button onclick="location.href='{{ route('admin.requerimientos.empleado.index') }}'"
                class="rounded-full bg-blue-500 text-neutral-50 px-4 py-2 font-semibold shadow-md hover:bg-blue-700">Atrás</button>
        </div>

        <div class="grid grid-cols-1 gap-4">
            <div class="p-4 bg-white border rounded-lg shadow-md">
                <div class="container mb-4">
                    <div>
                        <p class="text-2xl font-medium text-blue-700"
                            style="text-shadow: 1px 1px 1px  rgba(49, 49, 49, 0.323);">
                            {{ __('Requerimiento') . ' ' . $requerimiento->requerimientos->consecutivo }}
                        <p>
                    </div>
                </div>

                <form method="POST" action="{{ route('admin.requerimientos.empleado.update', $requerimiento->id) }}" id="edit-requerimiento">
                    @csrf
                    @method('PUT')

                    @include('admin.requerimiento-empleado.fields')

                    <div class="mt-3 flex justify-end">
                        <button
                            class="rounded-full bg-blue-500 text-neutral-50 px-4 py-2 font-semibold shadow-md hover:bg-blue-700" form="edit-requerimiento">Enviar</button>

                    </div>
                </form>
            </div>
        </div>
    </x-jet-bar-container>

    <script>
        $('#estado_requerimiento').change(function() {

            var fecha = document.getElementById('fecha');
            var responsable = document.getElementById('responsable');

            if ($(this).val() == 3) {
                fecha.style.display = 'none';
                responsable.style.display = 'none';
            } else {
                fecha.style.display = 'block';
                responsable.style.display = 'block';
            }
        });
    </script>
</x-app-layout>
