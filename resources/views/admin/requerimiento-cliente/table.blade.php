<x-jet-bar-table :headers="['Consecutivo', 'Descripcion', 'Tipo de requerimiento', 'Estado', '']">
    @foreach ($requerimiento_cliente as $requerimiento)
        <tr class="hover:bg-gray-50">
            <x-jet-bar-table-data>
                {{ $requerimiento['consecutivo'] }}
            </x-jet-bar-table-data>

            <x-jet-bar-table-data>
                {{ $requerimiento['descripcion'] }}
            </x-jet-bar-table-data>

            <x-jet-bar-table-data>
                {{ $requerimiento['tipo_requerimiento'] }}
            </x-jet-bar-table-data>

            <x-jet-bar-table-data>
                @if ($requerimiento['estado'] == 1)
                    <x-jet-bar-badge text="Enviado" type="success" />
                @elseif($requerimiento['estado'] == 2)
                    <x-jet-bar-badge text="Aceptado" type="success" />
                @elseif($requerimiento['estado'] == 3)
                    <x-jet-bar-badge text="Rechazado" type="danger" />
                @elseif($requerimiento['estado'] == 4)
                    <x-jet-bar-badge text="En proceso" type="warning" />
                @elseif($requerimiento['estado'] == 5)
                    <x-jet-bar-badge text="Finalizado" type="info" />
                @else
                    <x-jet-bar-badge text="Desistio" type="default" />
                @endif
            </x-jet-bar-table-data>

            <x-jet-bar-table-data>
                <div class="flex justify-center rounded-md shadow-sm">
                    <a href="{{ route('admin.requerimientos.cliente.show', $requerimiento['id']) }}">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            style="color:#da7312; text-decoration: none !important;" stroke-width="1.5"
                            stroke="currentColor" class="w-6 h-6 mr-4">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                    </a>

                    <a onclick="desistir({{ $requerimiento['id'] }})">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            style="color:#da1212; text-decoration: none !important;" stroke="currentColor"
                            class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M20.25 7.5l-.625 10.632a2.25 2.25 0 01-2.247 2.118H6.622a2.25 2.25 0 01-2.247-2.118L3.75 7.5m6 4.125l2.25 2.25m0 0l2.25 2.25M12 13.875l2.25-2.25M12 13.875l-2.25 2.25M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125z" />
                        </svg>
                    </a>
                </div>
            </x-jet-bar-table-data>
        </tr>
    @endforeach
</x-jet-bar-table>
