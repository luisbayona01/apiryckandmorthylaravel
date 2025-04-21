<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Personaje;

class EditarPersonajes extends Component
{

    use WithFileUploads;

    public $personaje;
    public $name, $status, $gender, $type;
    public $image;

    public function mount($id)
    {
        $this->personaje = Personaje::findOrFail($id);
        $this->name = $this->personaje->name;
        $this->status = $this->personaje->status;
        $this->gender = $this->personaje->gender;
        $this->type = $this->personaje->type;
    }

    public function update()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'status' => 'required|string',
            'gender' => 'required|string',
            'type' => 'nullable|string|max:255',
            'image' => 'nullable|image|max:5120',
        ]);

        if ($this->image) {
            $path = $this->image->store('personajes', 'public');
            $this->personaje->image =  $path;
        }

        $this->personaje->update([
            'name' => $this->name,
            'status' => $this->status,
            'gender' => $this->gender,
            'type' => $this->type,
        ]);

        $this->dispatch('personaje-actualizado');
    }
    public function render()
    {
        return view('livewire.editar-personajes');
    }
}
