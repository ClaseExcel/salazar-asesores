<x-app-layout>
    @section('title', 'Agenda')

    <x-jet-bar-container>

        <div class="container mx-5">
            <h1 class="text-4xl text-blue-900 font-semibold" style="text-shadow: 1px 1px 1px  rgba(49, 49, 49, 0.323);">
                {{ __('Agenda') }}
            </h1>
        </div>

        <div class="container mx-auto flex justify-end">
            <button onclick="location.href='{{ route('admin.agendas.create') }}'"
                class="rounded-full bg-blue-500 text-neutral-50 px-4 py-2 font-semibold shadow-lg hover:bg-blue-700">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-7 h-7">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M12 9v6m3-3H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>

            </button>
        </div>

        <div class="mt-6">
            @if (session()->has('message'))
                <x-jet-bar-alert text="{{ session('message') }}" type="{{ session('color') }}" />
            @endif
        </div>

        <div class="container mx-auto mt-5">
            @include('admin.agenda.table')
        </div>

    </x-jet-bar-container>
</x-app-layout>
