<div>
<div class="max-w-xl mx-auto bg-white rounded-2xl shadow-md p-6">
    <h2 class="text-2xl font-bold mb-6 text-gray-800">Editar Personaje</h2>

    <form wire:submit.prevent="update">
        <!-- Imagen -->
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700">Imagen</label>
            <input type="file" wire:model="image" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
            @if ($image)
                <img src="{{ $image->temporaryUrl() }}" class="mt-2 h-24 rounded shadow">
            @elseif(Storage::disk('public')->exists($personaje->image))
            <img src="{{ Storage::url($personaje->image) }}" alt="Imagen del personaje" class="w-12 h-12 rounded-full shadow">
            @else
            <img src="{{ $personaje->image }}" class="mt-2 h-24 rounded shadow">    
            @endif
         @error('image') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <!-- Nombre -->
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700">Nombre</label>
            <input type="text" wire:model="name" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
            @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <!-- Status -->
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700">Estado</label>
            <select wire:model="status" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                <option value="">-- Selecciona --</option>
                <option value="Alive">Vivo</option>
                <option value="Dead">Muerto</option>
                <option value="Unknown">Desconocido</option>
            </select>
            @error('status') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <!-- Género -->
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700">Género</label>
            <select wire:model="gender" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                <option value="">-- Selecciona --</option>
                <option value="Male">Masculino</option>
                <option value="Female">Femenino</option>
                <option value="Genderless">Sin género</option>
                <option value="Unknown">Desconocido</option>
            </select>
            @error('gender') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <!-- Tipo -->
        <div class="mb-6">
            <label class="block text-sm font-medium text-gray-700">Tipo</label>
            <input type="text" wire:model="type" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
            @error('type') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <!-- Botón -->
        <div class="flex justify-end">
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition">
                Guardar Cambios
            </button>
        </div>
    </form>
</div>

</div>
@push('scripts')
<script>
    window.addEventListener('personaje-actualizado', event => {
        Swal.fire({
            title: '¡Éxito!',
            text: 'Personaje actualizado correctamente.',
            icon: 'success',
            confirmButtonText: 'Ok'
        });
    });
</script>
@endpush