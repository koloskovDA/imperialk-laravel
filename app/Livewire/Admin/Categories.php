<?php

namespace App\Livewire\Admin;

use App\Livewire\AdminComponent;
use App\Models\Category;

class Categories extends AdminComponent
{
    public function mount()
    {
        $this->class = Category::class;
        $this->properties = Category::getProperties();
        $this->requiredProperties = Category::getRequiredProperties();
        $this->propertiesLabels = Category::getPropertiesLabels();
        $this->classLabel = Category::getLabel();
        $this->rules = Category::rules();
        $this->rulesMessages = Category::rulesMessages();
        $this->inputTypes = Category::getInputTypes();
        $this->search = array_fill_keys(Category::search(), null);
    }
}
