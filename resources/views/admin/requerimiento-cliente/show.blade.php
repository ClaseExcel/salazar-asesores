<x-app-layout>
    @section('title', 'Ver empleado cliente')

    <x-jet-bar-container>

        <div class="p-4 bg-white border rounded-lg shadow-md mt-6">
            <div class="container  flex justify-between mb-4">
                <div>
                    <p class="text-2xl font-medium text-blue-700"
                        style="text-shadow: 1px 1px 1px  rgba(49, 49, 49, 0.323);">
                        Consecutivo: {{ $requerimiento->consecutivo }}
                    <p>
                </div>

                <button onclick="location.href='{{ route('admin.requerimientos.cliente.index') }}'"
                    class="rounded-full bg-blue-500 text-neutral-50 px-4 py-2 font-semibold shadow-md hover:bg-blue-700">Atrás</button>
            </div>

            <div class="leading-loose info-empresas">
                <p>
                    <b>Tipo de requerimiento:</b> &nbsp; {{ $requerimiento->tipo_requerimientos->nombre }}
                </p>
                <p>
                    <b>Descripción:</b> &nbsp;{{ $requerimiento->descripcion }}
                </p>
                <p>
                    @if($documento != null)
                    <b>Mi archivos</b> &nbsp;&nbsp; <button
                        onclick="location.href='{{ route('admin.requerimientos.cliente.download', ['id' => $requerimiento->id ]) }}'"
                        class="rounded-full bg-blue-500 text-neutral-50 px-2 font-semibold shadow-md hover:bg-blue-700">Descargar</button>
                    @endif
                </p>
                <p class="text-2xl font-medium text-blue-700 mb-3 mt-4"
                    style="text-shadow: 1px 1px 1px  rgba(49, 49, 49, 0.323);">
                    Seguimiento
                <p>

                <p>
                    <b>Estado:</b> &nbsp; {{ $seguimiento_requerimiento->estado_requerimientos->nombre }}
                </p>

                <p>
                    <b>Observación:</b> &nbsp;

                    @if ($seguimiento_requerimiento->observacion)
                        {{ $seguimiento_requerimiento->observacion }}
                    @else
                        Aún tu requerimiento no ha sido asignado.
                    @endif
                </p>

                <p>
                    <b>Responsable:</b> &nbsp;
                    @if ($seguimiento_requerimiento->user_id)
                        {{ $seguimiento_requerimiento->usuario_responsable->nombres . ' ' . $seguimiento_requerimiento->usuario_responsable->apellidos }}
                    @else
                        Aún tu requerimiento no ha sido asignado.
                    @endif
                </p>
            </div>
        </div>
    </x-jet-bar-container>
</x-app-layout>
