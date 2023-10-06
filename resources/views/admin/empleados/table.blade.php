 <x-jet-bar-table :headers="['Nombres', 'Apellidos', 'E-mail', 'Cargo', 'Rol', 'Estado', '']">
     @foreach ($empleados as $empleado)
         <tr class="hover:bg-gray-50">
             <x-jet-bar-table-data>
                 {{ $empleado->nombres }}
             </x-jet-bar-table-data>

             <x-jet-bar-table-data>
                 {{ $empleado->apellidos }}
             </x-jet-bar-table-data>

             <x-jet-bar-table-data>
                {{ $empleado->email }}
            </x-jet-bar-table-data>

             <x-jet-bar-table-data>
                 {{ $empleado->cargos->nombre }}
             </x-jet-bar-table-data>

             <x-jet-bar-table-data>
                 {{ $empleado->roles->nombre }}
             </x-jet-bar-table-data>

             <x-jet-bar-table-data>
                 @if ($empleado->estado == 1)
                     <x-jet-bar-badge text="Activo" type="success" />
                 @else
                     <x-jet-bar-badge text="Inactivo" type="default" />
                 @endif
             </x-jet-bar-table-data>

             <x-jet-bar-table-data>

                 <div class="flex justify-between rounded-md shadow-sm">
                     @if ($empleado->estado == 0)
                         <a href="{{ route('admin.empleados.edit', $empleado->id) }}"
                             style="color:#4a4a4a; pointer-events:none; display:inline-block;">
                             <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                 stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                 <path stroke-linecap="round" stroke-linejoin="round"
                                     d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                             </svg>
                         </a>
                     @else
                         <a href="{{ route('admin.empleados.edit', $empleado->id) }}">
                             <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                 stroke-width="1.5" style="color:#25709c; text-decoration: none !important;"
                                 stroke="currentColor" class="w-6 h-6">
                                 <path stroke-linecap="round" stroke-linejoin="round"
                                     d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                             </svg>
                         </a>
                     @endif
                     @if ($empleado->estado == 1)
                         <a href="{{ route('admin.update.status', $empleado->id) }}">
                             <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                 stroke-width="1.5" style="color:#db3e3e; text-decoration: none !important;"
                                 stroke="currentColor" class="w-6 h-6">
                                 <path stroke-linecap="round" stroke-linejoin="round"
                                     d="M22 10.5h-6m-2.25-4.125a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zM4 19.235v-.11a6.375 6.375 0 0112.75 0v.109A12.318 12.318 0 0110.374 21c-2.331 0-4.512-.645-6.374-1.766z" />
                             </svg>
                         </a>
                     @else
                         <a href="{{ route('admin.update.status', $empleado->id) }}">
                             <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                 style="color:#14a220; text-decoration: none !important;" stroke-width="1.5"
                                 stroke="currentColor" class="w-6 h-6">
                                 <path stroke-linecap="round" stroke-linejoin="round"
                                     d="M5.636 5.636a9 9 0 1012.728 0M12 3v9" />
                             </svg>
                         </a>
                     @endif

                 </div>
             </x-jet-bar-table-data>
         </tr>
     @endforeach
 </x-jet-bar-table>

 <div class="flex justify-end mt-6">
     {{ $empleados->links() }}
 </div>
