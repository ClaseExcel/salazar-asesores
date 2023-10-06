<x-jet-bar-table class="text-center" :headers="['Fecha', 'Hora inicio', 'Hora fin', 'Cliente', '']">
    @foreach ($agendas as $agenda)
        <tr class="hover:bg-gray-50">
            <x-jet-bar-table-data>
                {{ $agenda->fecha_disponibilidad }}
            </x-jet-bar-table-data>

            <x-jet-bar-table-data>
                {{ \Carbon\Carbon::parse($agenda->hora_inicio)->format('h:i a') }}
            </x-jet-bar-table-data>

            <x-jet-bar-table-data>
                {{ \Carbon\Carbon::parse($agenda->hora_fin)->format('h:i a') }}
            </x-jet-bar-table-data>

            <x-jet-bar-table-data>
                {{ $agenda->clientes->razon_social }}
            </x-jet-bar-table-data>

            <x-jet-bar-table-data>
                <div class="flex justify-center rounded-md shadow-sm">
                        <a href="{{ route('admin.agendas.edit', $agenda->id) }}">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" style="color:#25709c; text-decoration: none !important;"
                                stroke="currentColor" class="w-6 h-6 mr-3">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                            </svg>
                        </a>

                        <form method="POST" action="{{ route('admin.agendas.destroy', $agenda->id) }}">
                            @csrf
                            <input name="_method" type="hidden" value="DELETE">

                                <button type="submit">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" 
                                    style="color:#9c2525; text-decoration: none !important;"
                                    stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                      </svg></button>
                            </div>
                        </form>
                </div>
            </x-jet-bar-table-data>
        </tr>
    @endforeach
</x-jet-bar-table>

<div class="flex justify-end mt-6">
    {{ $agendas->links() }}
</div>
