<x-app-layout>
    @section('title', 'Solicitar requerimiento')

    <x-jet-bar-container>

        <div class="p-4 bg-white border rounded-lg shadow-md mt-6">
            <div class="container mx-auto flex justify-between mb-4">
                <div>
                    <p class="text-2xl font-medium text-blue-700"
                        style="text-shadow: 1px 1px 1px  rgba(49, 49, 49, 0.323);">
                        {{ __('Solicitar requerimiento') }}
                    <p>
                </div>
            </div>

            <div class="mt-6">
                @if (session()->has('message'))
                    <x-jet-bar-alert text="{{ session('message') }}" type="{{ session('color') }}" />
                @endif
            </div>

            <form method="POST" action="{{ route('admin.requerimientos.cliente.store') }}" enctype="multipart/form-data">
                @csrf
                
                @include('admin.requerimiento-cliente.fields')

                <div class="mt-3 flex justify-end">
                    <button
                        class="rounded-full bg-blue-500 text-neutral-50 px-4 py-2 font-semibold shadow-md hover:bg-blue-700">Solicitar</button>
                </div>
            </form>
        </div>
    </x-jet-bar-container>

    <script>
        const MAXIMO_TAMANIO_BYTES = 25 * 1000000;

        // Obtener referencia al elemento
        const miInput = document.querySelector("#files");
        miInput.addEventListener("change", function() {
            const archivos = this.files;
            let totalTamanio = 0;

            // Si no hay archivos, regresamos
            if (archivos.length <= 0) return;

            for (let i = 0; i < archivos.length; i++) {
                totalTamanio += archivos[i].size;
            }

           if (totalTamanio > MAXIMO_TAMANIO_BYTES) {

                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'No se permiten más de 25 MB en total',
                })

                miInput.value = "";
            }
        });
    </script>
</x-app-layout>
