<!-- Table -->
<div class="flex flex-col mt-6">
    <div class="-my-2 overflow-x-auto sm:-mx-3 lg:-mx-3">
        <div class="py-2 align-middle inline-block min-w-full">
            <table class="min-w-full divide-y divide-gray-200" id="tabla-info">
                <thead class="bg-blue-500 hover:bg-blue-700">
                    <tr>
                        @foreach ($headers as $header)
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-neutral-50 uppercase tracking-wider">
                                {{ $header }}
                            </th>
                        @endforeach
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    {{ $slot }}
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- End Table -->
