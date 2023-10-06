<x-app-layout>
    @section('title', 'Crear usuario cliente')

    <x-jet-bar-container>

        <div class="p-4 bg-white border rounded-lg shadow-md mt-6">
            <div class="container mx-auto flex justify-between mb-4">
                <div>
                    <p class="text-2xl font-medium text-blue-700"
                     style="text-shadow: 1px 1px 1px  rgba(49, 49, 49, 0.323);">{{ __('Crear usuario cliente') }}
                    <p>
                </div>

                <button onclick="location.href='{{ route('admin.empleado-clientes.index') }}'"
                    class="rounded-full bg-blue-500 text-neutral-50 px-4 py-2 font-semibold shadow-md hover:bg-blue-700">Atrás</button>
            </div>

            <form method="POST" action="{{ route('admin.empleado-clientes.store') }}" enctype="multipart/form-data">
                @csrf

                <input type="hidden" value="{{ $cargo->id }}" name="cargo_id">

                @include('admin.empleado-clientes.fields')

                <div class="mt-3 flex justify-end">
                    <button
                        class="rounded-full bg-blue-500 text-neutral-50 px-4 py-2 font-semibold shadow-md hover:bg-blue-700">Enviar</button>
                </div>
            </form>
        </div>
    </x-jet-bar-container>
</x-app-layout>