<?php

namespace App\Livewire\Admin;

use App\Livewire\AdminComponent;
use App\Models\Auction;
use App\Models\Lot;
use Livewire\Component;

class Lots extends AdminComponent
{
    public function mount()
    {
        $this->class = Lot::class;
        $this->properties = Lot::getProperties();
        $this->propertiesLabels = Lot::getPropertiesLabels();
        $this->classLabel = Lot::getLabel();
        $this->createUrl = '#';
        $this->editUrl = '#';
    }
}
