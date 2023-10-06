<x-app-layout>
    @section('title', 'Editar agenda')

    <x-jet-bar-container>

        <div class="grid gap-4">
            <div class="p-4 bg-white border rounded-lg shadow-md">
                <div class="container mb-4">
                    <div class="flex justify-between">
                        <p class="text-2xl font-medium text-blue-700" 
                        style="text-shadow: 1px 1px 1px  rgba(49, 49, 49, 0.323);">{{ __('Actualizar agenda') }}
                        <p>
                            <button onclick="location.href='{{ route('admin.agendas.index') }}'"
                            class="rounded-full bg-blue-500 text-neutral-50 px-4 py-2 font-semibold shadow-md hover:bg-blue-700">Atrás</button>
                    </div>
                </div>

                <div class="mt-6">
                    @if (session()->has('message'))
                        <x-jet-bar-alert text="{{ session('message') }}" type="{{ session('color') }}" />
                    @endif
                </div>

                <form method="POST" action="{{ route('admin.agendas.update', $agenda->id) }}">
                    @csrf
                    @method('PUT')

                    @include('admin.agenda.fields')

                    <div class="mt-3 flex justify-end">
                        <button
                            class="rounded-full bg-blue-500 text-neutral-50 px-4 py-2 font-semibold shadow-md hover:bg-blue-700">Enviar</button>

                    </div>
                </form>
            </div>

        </div>
    </x-jet-bar-container>
</x-app-layout>
