<x-jet-bar-table :headers="['Consecutivo', 'Observacion', 'Tipo de requerimiento', 'Estado', 'Fecha de Vencimiento', 'Responsable', '']">
    @foreach ($requerimientos as $requerimiento)
        <tr class="hover:bg-gray-50">
            <x-jet-bar-table-data>
                {{ $requerimiento->requerimientos->consecutivo }}
            </x-jet-bar-table-data>

            <x-jet-bar-table-data>
                {{ $requerimiento->observacion }}
            </x-jet-bar-table-data>

            <x-jet-bar-table-data>
                {{ $requerimiento->requerimientos->tipo_requerimientos->nombre }}
            </x-jet-bar-table-data>

            <x-jet-bar-table-data>
                @if ($requerimiento->estado_requerimiento_id == 1)
                    <x-jet-bar-badge text="Enviado" type="success" />
                @elseif($requerimiento->estado_requerimiento_id == 2)
                    <x-jet-bar-badge text="Aceptado" type="success" />
                @elseif($requerimiento->estado_requerimiento_id == 3)
                    <x-jet-bar-badge text="Rechazado" type="danger" />
                @elseif($requerimiento->estado_requerimiento_id == 4)
                    <x-jet-bar-badge text="En proceso" type="warning" />
                @elseif($requerimiento->estado_requerimiento_id == 5)
                    <x-jet-bar-badge text="Finalizado" type="info" />
                @else
                    <x-jet-bar-badge text="Desistio" type="default" />
                @endif
            </x-jet-bar-table-data>

            <x-jet-bar-table-data>
                {{ $requerimiento->fecha_vencimiento }}
            </x-jet-bar-table-data>

            <x-jet-bar-table-data>
                @if ($requerimiento->user_id)
                    {{ $requerimiento->usuario_responsable->nombres . ' ' . $requerimiento->usuario_responsable->apellidos }}
                @endif
            </x-jet-bar-table-data>

            <x-jet-bar-table-data>
                @if ($requerimiento->estado_requerimiento_id === 5)
                @else
                    @if (request()->routeIs('admin.requerimientos.empleado.show'))
                        <div class="flex justify-center rounded-md shadow-sm">
                            <button
                                onclick="location.href='{{ route('admin.requerimientos.empleado.edit-requerimiento', $requerimiento->id) }}'"
                                class="rounded-full bg-green-500 text-neutral-50 px-4 py-2 font-semibold shadow-md hover:bg-green-800">Actualizar
                                requerimiento</button>
                        </div>
                    @else
                        <div class="flex justify-center rounded-md shadow-sm">
                            <button
                                onclick="location.href='{{ route('admin.requerimientos.empleado.edit', $requerimiento->id) }}'"
                                class="rounded-full bg-green-500 text-neutral-50 px-4 py-2 font-semibold shadow-md hover:bg-green-800">Actualizar
                                requerimiento</button>
                        </div>
                    @endif
                @endif


            </x-jet-bar-table-data>
        </tr>
    @endforeach
</x-jet-bar-table>
