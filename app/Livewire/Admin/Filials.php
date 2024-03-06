<?php

namespace App\Livewire\Admin;

use App\Models\Filial;
use Carbon\Carbon;
use Livewire\Component;

class Filials extends Component
{
    public string $name = '';

    public string $info = '';

    public string $address = '';

    public Filial $filial_to_delete;

    public Filial $filial_to_update;

    public function showModal()
    {

    }

    public function createFilial()
    {
        $this->validate([
            'name' => 'required',
            'address' => 'required'
        ], [
            'name.required' => 'Укажите название',
            'address.required' => 'Укажите адрес'
        ]);
        Filial::create([
            'name' => $this->name,
            'info' => $this->info,
            'address' => $this->address
        ]);
        $this->dispatch('close-modal');
    }

    public function editFilial(Filial $filial)
    {
        $this->filial_to_update = $filial;
        $this->name = $filial->name;
        $this->info = $filial->info;
        $this->address = $filial->address;
    }

    public function confirmEdit()
    {
        $this->validate([
            'name' => 'required',
            'address' => 'required'
        ], [
            'name.required' => 'Укажите название',
            'address.required' => 'Укажите адрес'
        ]);
        $this->filial_to_update->update([
            'name' => $this->name,
            'info' => $this->info,
            'address' => $this->address
        ]);
        $this->dispatch('close-modal');
    }

    public function deleteFilial(Filial $filial)
    {
        $this->filial_to_delete = $filial;
    }

    public function confirmDelete()
    {
        $this->filial_to_delete->delete();
    }

    public function render()
    {
        $filials = Filial::all();

        return view('livewire.admin.filials', compact('filials'));
    }
}
