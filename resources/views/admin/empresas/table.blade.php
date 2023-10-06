<x-jet-bar-table :headers="['NIT', 'Empresa', 'E-mail', 'Frecuencia', 'Número contacto', '']">
    @foreach ($empresas as $empresa)
        <tr class="hover:bg-gray-50">
            <x-jet-bar-table-data>
                {{ $empresa->NIT }}
            </x-jet-bar-table-data>

            <x-jet-bar-table-data>
                {{ $empresa->razon_social }}
            </x-jet-bar-table-data>

            <x-jet-bar-table-data>
                {{ $empresa->correo_electronico }}
            </x-jet-bar-table-data>

            <x-jet-bar-table-data>
                {{ $empresa->frecuencias->nombre }}
            </x-jet-bar-table-data>

            <x-jet-bar-table-data>
                {{ $empresa->numero_contacto }}
            </x-jet-bar-table-data>

            <x-jet-bar-table-data>
                <div class="flex justify-between rounded-md shadow-sm">
                        <a href="{{ route('admin.empresas.edit', $empresa->id) }}"">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" style="color:#25709c; text-decoration: none !important;"
                                stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                            </svg>
                        </a>
                    <a href="{{ route('admin.empresas.show', $empresa->id) }}"">
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
    {{ $empresas->links() }}
</div>
