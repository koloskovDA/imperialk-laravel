<?php

namespace App\Livewire\Admin;

use App\Livewire\AdminComponent;
use App\Models\Filial;
use Carbon\Carbon;
use Livewire\Component;

class Filials extends AdminComponent
{
    public function mount()
    {
        $this->class = Filial::class;
        $this->properties = Filial::getProperties();
        $this->requiredProperties = Filial::getRequiredProperties();
        $this->propertiesLabels = Filial::getPropertiesLabels();
        $this->classLabel = Filial::getLabel();
        $this->rules = Filial::rules();
        $this->rulesMessages = Filial::rulesMessages();
        $this->inputTypes = Filial::getInputTypes();
        $this->search = array_fill_keys(Filial::search(), null);
    }
}
