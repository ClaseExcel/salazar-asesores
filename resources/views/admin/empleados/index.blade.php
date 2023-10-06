<x-app-layout>
    @section('title', 'Empleados')

    <x-jet-bar-container>

        <div class="container">
            <h1 class="text-4xl text-blue-900 font-semibold" style="text-shadow: 1px 1px 1px  rgba(49, 49, 49, 0.323);">
                {{ __('Empleados') }}
            </h1>
        </div>

        <div class="container mx-auto flex justify-end mt-5">
            <button onclick="location.href='{{ route('admin.empleados.create') }}'"
                class="rounded-full bg-blue-500 text-neutral-50 px-4 py-2 font-semibold shadow-lg hover:bg-blue-700">Nuevo
                empleado</button>
        </div>

        <div class="mt-6">
            @if (session()->has('message'))
                <x-jet-bar-alert text="{{ session('message') }}" type="{{ session('color') }}" />
            @endif
        </div>

        <div class="container mx-auto mt-5">
            @include('admin.empleados.table')
        </div>

    </x-jet-bar-container>
</x-app-layout>
