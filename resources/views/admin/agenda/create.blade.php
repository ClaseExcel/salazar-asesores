<x-app-layout>
    @section('title', 'Crear agenda')

    <x-jet-bar-container>

        <div class="p-4 bg-white border rounded-lg shadow-md mt-6">
            <div class="container mx-auto flex justify-between mb-4">
                <div>
                    <p class="text-2xl font-medium text-blue-700"
                        style="text-shadow: 1px 1px 1px  rgba(49, 49, 49, 0.323);">
                        {{ __('Crear agenda') }}
                    <p>
                </div>

                <button onclick="location.href='{{ route('admin.agendas.index') }}'"
                    class="rounded-full bg-blue-500 text-neutral-50 px-4 py-2 font-semibold shadow-md hover:bg-blue-700">Atrás</button>
            </div>

            <div class="mt-6">
                @if (session()->has('message'))
                    <x-jet-bar-alert text="{{ session('message') }}" type="{{ session('color') }}" />
                @endif
            </div>

            <form method="POST" action="{{ route('admin.agendas.store') }}" enctype="multipart/form-data">
                @csrf

                @include('admin.agenda.fields')

                <div class="mt-3 flex justify-end">
                    <button
                        class="rounded-full bg-blue-500 text-neutral-50 px-4 py-2 font-semibold shadow-md hover:bg-blue-700">Enviar</button>
                </div>
            </form>
        </div>
    </x-jet-bar-container>
</x-app-layout>
