<x-jet-bar-table :headers="[
    'ID actividad',
    'Nombre actividad',
    'Tipo actividad',
    'Progreso',
    'Vencimiento',
    'Responsable',
    'Empresa',
    '',
]">
    @foreach ($actividad_cliente as $actividad)
        <tr class="hover:bg-gray-50">
            <x-jet-bar-table-data>
                {{ $actividad->id }}
            </x-jet-bar-table-data>

            <x-jet-bar-table-data>
                {{ $actividad->nombre }}
            </x-jet-bar-table-data>

            <x-jet-bar-table-data>
                {{ $actividad->actividad->nombre }}
            </x-jet-bar-table-data>

            <x-jet-bar-table-data>
                {{ $actividad->progreso }}
            </x-jet-bar-table-data>

            <x-jet-bar-table-data>
                {{ $actividad->fecha_vencimiento }}
            </x-jet-bar-table-data>

            <x-jet-bar-table-data>
                {{ $actividad->responsable->nombre }}
            </x-jet-bar-table-data>

            <x-jet-bar-table-data>
                {{ $actividad->cliente->razon_social }}
            </x-jet-bar-table-data>

            <x-jet-bar-table-data>
                <div class="flex justify-between rounded-md shadow-sm">
                    <a href="{{ route('admin.actividad_cliente.edit', $actividad->id) }}">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            style="color:#25709c; text-decoration: none !important;" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                        </svg>
                    </a>
                    <a href="{{ route('admin.reporte.index', $actividad->id) }}">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            style="color:#9c2925; text-decoration: none !important;" stroke="currentColor"
                            class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M10.34 15.84c-.688-.06-1.386-.09-2.09-.09H7.5a4.5 4.5 0 110-9h.75c.704 0 1.402-.03 2.09-.09m0 9.18c.253.962.584 1.892.985 2.783.247.55.06 1.21-.463 1.511l-.657.38c-.551.318-1.26.117-1.527-.461a20.845 20.845 0 01-1.44-4.282m3.102.069a18.03 18.03 0 01-.59-4.59c0-1.586.205-3.124.59-4.59m0 9.18a23.848 23.848 0 018.835 2.535M10.34 6.66a23.847 23.847 0 008.835-2.535m0 0A23.74 23.74 0 0018.795 3m.38 1.125a23.91 23.91 0 011.014 5.395m-1.014 8.855c-.118.38-.245.754-.38 1.125m.38-1.125a23.91 23.91 0 001.014-5.395m0-3.46c.495.413.811 1.035.811 1.73 0 .695-.316 1.317-.811 1.73m0-3.46a24.347 24.347 0 010 3.46" />
                        </svg>
                    </a>
                    <a href="{{ route('admin.actividad_cliente.show', $actividad->id) }}">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            style="color:#da7312; text-decoration: none !important;" stroke-width="1.5"
                            stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                    </a>
                </div>
            </x-jet-bar-table-data>
        </tr>
    @endforeach
</x-jet-bar-table>

<div class="flex justify-end mt-6">
    {{ $actividad_cliente->links() }}
</div>
