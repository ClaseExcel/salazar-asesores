<x-app-layout>
    @section('title', 'Editar usuario cliente')

    <x-jet-bar-container>

        <div class="flex justify-end mb-4">
            <button onclick="location.href='{{ route('admin.empleado-clientes.index') }}'"
                class="rounded-full bg-blue-500 text-neutral-50 px-4 py-2 font-semibold shadow-md hover:bg-blue-700">Atrás</button>
        </div>

        <div class="grid grid-cols-1 gap-4">
            <div class="p-4 bg-white border rounded-lg shadow-md">
                <div class="container mb-4">
                    <div>
                        <p class="text-2xl font-medium text-blue-700" 
                        style="text-shadow: 1px 1px 1px  rgba(49, 49, 49, 0.323);">{{ __('Actualizar usuario cliente') }}
                        <p>
                    </div>
                </div>

                <form method="POST" action="{{ route('admin.empleado-clientes.update', $empleado_cliente->id) }}">
                    @csrf
                    @method('PUT')

                    @include('admin.empleado-clientes.fields')

                    <div class="mt-3 flex justify-end">
                        <button
                            class="rounded-full bg-blue-500 text-neutral-50 px-4 py-2 font-semibold shadow-md hover:bg-blue-700">Enviar</button>

                    </div>
                </form>
            </div>
        </div>
    </x-jet-bar-container>
</x-app-layout>
