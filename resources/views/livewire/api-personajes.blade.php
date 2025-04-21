<div>
<div class="p-6 max-w-7xl mx-auto bg-white shadow-md rounded-lg">
    <div class="mb-6 flex flex-col sm:flex-row sm:items-center sm:justify-between">
        <label class="text-sm font-medium mb-2 sm:mb-0">Filtrar por Status:</label>
        <select wire:model.live="filtroStatus"
            class="border border-gray-300 rounded px-3 py-2 text-sm shadow-sm focus:ring-blue-500 focus:border-blue-500">
            <option value="">-- Todos --</option>
            <option value="Alive">Alive</option>
            <option value="Dead">Dead</option>
            <option value="unknown">Unknown</option>
        </select>
    </div>

    <div class="overflow-x-auto">
        <table class="min-w-full bg-white border border-gray-200 shadow-sm rounded-lg overflow-hidden">
            <thead class="bg-blue-100 text-gray-800">
                <tr>
                    <th class="px-4 py-2">#</th>
                    <th class="px-4 py-2">Nombre</th>
                    <th class="px-4 py-2">Status</th>
                    <th class="px-4 py-2">Especie</th>
                    <th class="px-4 py-2">Imagen</th>
                    <th class="px-4 py-2">Detalle</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($personajes as $p)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-2">{{ $p['id'] }}</td>
                        <td class="px-4 py-2">{{ $p['name'] }}</td>
                        <td class="px-4 py-2">
                            @if ($p['status'] == 'Alive')
                                <span class="text-green-600 font-semibold">{{ $p['status'] }}</span>
                            @elseif ($p['status'] == 'Dead')
                                <span class="text-red-600 font-semibold">{{ $p['status'] }}</span>
                            @else
                                <span class="text-gray-600">{{ $p['status'] }}</span>
                            @endif
                        </td>
                        <td class="px-4 py-2">{{ $p['species'] }}</td>
                        <td class="px-4 py-2">
                            <img src="{{ $p['image'] }}" alt="{{ $p['name'] }}" class="w-12 h-12 rounded-full shadow">
                        </td>
                        <td class="px-4 py-2">
                            <button wire:click="verDetalle({{ $p['id'] }})"
                                class="text-sm px-3 py-1 bg-blue-500 text-white rounded hover:bg-blue-600 transition">
                                Ver Detalle
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-6 flex justify-center">
    {{ $personajes->links() }}
    </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    Livewire.on('mostrarDetalleSweetAlert', (detalle) => {
        //console.log('detalles',detalle[0].name);
        Swal.fire({
            title: detalle[0].name,
            html: `
                <img src="${detalle[0].image}" class="rounded-full mb-2" style="width:100px;height:100px;">
                <p><strong>Especie:</strong> ${detalle[0].species}</p>
                <p><strong>Status:</strong> ${detalle[0].status}</p>
                <p><strong>Tipo:</strong> ${detalle[0].type || 'N/A'}</p>
                <p><strong>Género:</strong> ${detalle[0].gender}</p>
                <p><strong>Origen:</strong> ${detalle[0]['origin-name']}</p>
                <p><strong>URL Origen:</strong> <a href="${detalle[0]['origin-url']}" target="_blank">${detalle[0]['origin-url']}</a></p>
            `,
            confirmButtonText: 'Cerrar',
            width: '30rem',
        });
    });
</script>
@endpush
</div>
