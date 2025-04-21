
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
                    <th class="px-4 py-2 text-left text-sm font-semibold">#</th>
                    <th class="px-4 py-2 text-left text-sm font-semibold"><i class="ri-user-line mr-1"></i>Nombre</th>
                    <th class="px-4 py-2 text-left text-sm font-semibold"><i class="ri-heart-pulse-line mr-1"></i>Status</th>
                    <th class="px-4 py-2 text-left text-sm font-semibold"><i class="ri-dna-line mr-1"></i>Especie</th>
                    <th class="px-4 py-2 text-left text-sm font-semibold"><i class="ri-image-line mr-1"></i>Imagen</th>
                    <th class="px-4 py-2 text-left text-sm font-semibold"><i class="ri-information-line mr-1"></i>Detalle</th>
                    <th class="px-4 py-2 text-left text-sm font-semibold"><i class="ri-information-line mr-1"></i>Editar</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @foreach ($personajes as $p)
                <tr class="hover:bg-gray-50">
                    <td class="px-4 py-2 text-gray-700 font-semibold">{{ $p->id }}</td>
                    <td class="px-4 py-2">{{ $p->name }}</td>
                    <td class="px-4 py-2">
                        <span class="inline-flex items-center gap-1">
                            @if ($p->status == 'Alive')
                            <i class="ri-heart-line text-green-500"></i>
                            @elseif ($p->status == 'Dead')
                            <i class="ri-skull-line text-red-500"></i>
                            @else
                            <i class="ri-edit-line text-gray-500"></i>
                            @endif
                            {{ $p->status }}
                        </span>
                    </td>
                    <td class="px-4 py-2">{{ $p->species }}</td>
                    <td class="px-4 py-2">

                        @if(Storage::disk('public')->exists($p->image))
                        <img src="{{ Storage::url($p->image) }}" alt="Imagen del personaje" class="w-12 h-12 rounded-full shadow">
                        @else

                        <img src="{{ $p->image }}" alt="{{ $p->name }}" class="w-12 h-12 rounded-full shadow">

                        @endif
                    </td>
                    <td class="px-4 py-2">
                        <button wire:click="verDetalle({{ $p->id }})"
                            class="text-sm px-3 py-1 bg-blue-500 text-white rounded hover:bg-blue-600 transition inline-flex items-center gap-1">
                            <i class="ri-eye-line text-white"></i> Ver Detalle
                        </button>
                    </td>
                    <td class="px-4 py-2">
                        <a href="{{ url('editar', $p->id)}}" class="text-sm px-3 py-1 bg-blue-500 text-white rounded hover:bg-blue-600 transition inline-flex items-center gap-1"> <i class="ri-edit-line"></i>editar </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-6 flex justify-center">
        {{ $personajes->links() }}
    </div>



    <div
        class="fixed inset-0 bg-black/50 flex items-center justify-center z-50"
        wire:show="mostrarModal">
        <div class="bg-white rounded-lg p-6 w-full max-w-md shadow-lg relative">
            <button wire:click="$set('mostrarModal', false)" class="absolute top-2 right-2 text-red-500">
                <i class="ri-close-line text-xl"></i>
            </button>

            <div class="text-center">
            @if(!empty($detalleSeleccionado) && !empty($detalleSeleccionado['image']) && Storage::disk('public')->exists($detalleSeleccionado['image']))
                <img src="{{ Storage::url($detalleSeleccionado['image']) }}" class="w-20 h-20 rounded-full mx-auto">
            @else
                <img src="{{ $detalleSeleccionado['image'] ?? '' }}" class="w-20 h-20 rounded-full mx-auto">
            @endif

                <h2 class="text-lg font-bold mt-2">{{ $detalleSeleccionado['name'] ?? '' }}</h2>
                <p class="text-gray-600">{{ $detalleSeleccionado['species'] ?? '' }} - {{ $detalleSeleccionado['status'] ?? '' }}</p>
                <p class="text-gray-500 text-sm mt-1">{{ $detalleSeleccionado['type'] ?? 'N/A' }}</p>
                <p class="text-gray-500 text-sm">{{ $detalleSeleccionado['gender'] ?? '' }}</p>
                <p class="text-gray-500 text-sm">
                    Origen-name: {{ $detalleSeleccionado['origin-name'] ?? '' }}

                </p>
                <p class="text-gray-500 text-sm">
                    Origen-url: {{ $detalleSeleccionado['origin-url'] ?? '' }}

                </p>
            </div>
        </div>
    </div>

</div>