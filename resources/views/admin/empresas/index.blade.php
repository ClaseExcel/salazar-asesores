<x-app-layout>
    @section('title', 'Empresas')

    <x-jet-bar-container>

        <div class="container mx-5">
            <h1 class="text-4xl text-blue-900 font-semibold" style="text-shadow: 1px 1px 1px  rgba(49, 49, 49, 0.323);">
                {{ __('Empresas') }}
            </h1>
        </div>

        <div class="container mx-auto flex justify-end">
            <button onclick="location.href='{{ route('admin.empresas.create') }}'"
                class="rounded-full bg-blue-500 text-neutral-50 px-4 py-2 font-semibold shadow-lg hover:bg-blue-700">Nueva
                empresa</button>
        </div>

        <div class="mt-6">
            @if (session()->has('message'))
                <x-jet-bar-alert text="{{ session('message') }}" type="{{ session('color') }}" />
            @endif
        </div>

        <div class="container mx-auto mt-5">
            @include('admin.empresas.table')
        </div>

    </x-jet-bar-container>
</x-app-layout>
