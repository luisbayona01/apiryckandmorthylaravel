<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Http;
use Livewire\WithPagination;
use Illuminate\Pagination\LengthAwarePaginator;

class ApiPersonajes extends Component
{
    use WithPagination;

    public $filtroStatus = '';
    public $todosPersonajes;

    public function mount()
    {
        $this->obtenerPersonajesDesdeApi();
    }

    public function obtenerPersonajesDesdeApi()
    {
        $personajes = collect();
        $url = 'https://rickandmortyapi.com/api/character';

        do {
            $response = Http::withOptions(['verify' => false])->get($url);

            $data = $response->json();
            $personajes = $personajes->merge(collect($data['results']));

            $url = $data['info']['next'];
        } while ($url && $personajes->count() < 100);

        $this->todosPersonajes = $personajes;
    }

    public function verDetalle($id)
    {
        $response = Http::withOptions(['verify' => false])
            ->get("https://rickandmortyapi.com/api/character/{$id}");
     
        if ($response->successful()) {
            $personaje = $response->json();
          //dd($personaje['id']);
            $detalle = [
                'id' => $personaje['id'],
                'name' => $personaje['name'],
                'status' => $personaje['status'],
                'species' => $personaje['species'],
                'type' => $personaje['type'],
                'gender' => $personaje['gender'],
                'origin-name' => $personaje['origin']['name'],
                'origin-url' => $personaje['origin']['url'],
                'image' => $personaje['image'],
            ];

            $this->dispatch('mostrarDetalleSweetAlert', $detalle);
        }
    }

    public function getPersonajesFiltradosProperty()
    {
        $filtrados = $this->todosPersonajes;

        if ($this->filtroStatus) {
            $filtrados = $filtrados->where('status', $this->filtroStatus);
        }

        return $filtrados->values();
    }

    public function render()
    {
        $items = $this->personajesFiltrados;
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $perPage = 10;
        $currentItems = $items->slice(($currentPage - 1) * $perPage, $perPage)->values();

        $paginatedItems = new LengthAwarePaginator(
            $currentItems,
            $items->count(),
            $perPage,
            $currentPage,
            ['path' => request()->url(), 'query' => request()->query()]
        );

        return view('livewire.api-personajes', [
            'personajes' => $paginatedItems,
        ]);
    }

    public function updatingFiltroStatus()
    {
        $this->resetPage();
    }
}
