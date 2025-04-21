<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Http;
Use App\Models\Personaje;
use Livewire\WithPagination;
class CargarPersonajes extends Component
{    use WithPagination;
    //public $personajes = [];

    public $filtroStatus = ''; 
    public $detalleSeleccionado = null;
    public bool $mostrarModal = false;
    public function verDetalle($id)
    {
        $personaje = Personaje::find($id);
        $this->mostrarModal = true;
        if ($personaje) {
            $this->detalleSeleccionado = [
                'id' => $personaje->id,
                'name' => $personaje->name,
                'status' => $personaje->status,
                'species' => $personaje->species,
                'type' => $personaje->type,
                'gender' => $personaje->gender,
                'origin-name' => $personaje->origin_name,
                'origin-url' => $personaje->origin_url,
                'image' => $personaje->image,
            ];
        }
    }

    public function cargarPersonajesDesdeApi()
    {
        if (Personaje::count() === 0) {
            $url = 'https://rickandmortyapi.com/api/character';

            do {
                $response = Http::withOptions([
                    'verify' => false,
                ])->get($url);
                $data = $response->json();

                foreach ($data['results'] as $p) {
                    Personaje::updateOrCreate(
                        ['id' => $p['id']],
                        [
                            'name'        => $p['name'],
                            'status'      => $p['status'],
                            'species'     => $p['species'],
                            'type'        => $p['type'],
                            'gender'      => $p['gender'],
                            'origin_name' => $p['origin']['name'],
                            'origin_url'  => $p['origin']['url'],
                            'image'       => $p['image'],
                        ]
                    );
                }

                $url = $data['info']['next'];
            } while ($url && Personaje::count() < 100);
        }
    }

    public function mount()
    {
        $this->cargarPersonajesDesdeApi();
    }

    public function updatingFiltroStatus()
    {
        $this->resetPage(); 
    }

    public function render()
    {
        $query = Personaje::query();

        if ($this->filtroStatus) {
            $query->where('status', $this->filtroStatus);
        }

        return view('livewire.cargar-personajes', [
            'personajes' => $query->orderBy('id')->paginate(10),
        ]);
    }
}