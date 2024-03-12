<?php

namespace App\Livewire;

use App\Models\Auction;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Livewire\Component;
use Livewire\WithPagination;

class AdminComponent extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public array $properties = [];
    public array $requiredProperties = [];
    public array $propertiesLabels = [];
    public array $values = [];

    public string $class = '';
    public string $classLabel = '';

    public Model|null $toUpdate = null;
    public Model|null $toDelete = null;

    public string $createUrl = '';
    public string $editUrl = '';

    public string $showUrl = '';

    public array $rules = [];
    public array $rulesMessages = [];

    public array $inputTypes = [];

    public array $enums = [];

    public array $search = [];

    public int $paginator = 20;

    public function render()
    {
        $collection = call_user_func($this->class .'::query');

        foreach ($this->search as $prop => $value)
        {
            if ($value != null)
            {
                $collection = $collection->where($prop, 'ilike', '%'.$value.'%');
            }
        }
        if ($this->paginator > 0)
        {
            $collection = $collection->paginate($this->paginator);
        }
        else
        {
            $collection = $collection->get();
        }

        return view('livewire.admin.admin-component', compact('collection'));
    }

    public function createInstance()
    {

    }

    public function confirmCreate()
    {
        $this->validate($this->rules, $this->rulesMessages);
        call_user_func($this->class .'::create', $this->values);
        $this->values = [];

        $this->dispatch('close-modal');
    }

    public function editInstance(array $model)
    {
        $this->values = array_flip($this->properties);
        $this->toUpdate = call_user_func($this->class .'::find', $model['id']);
        $instanceAttributes = array_intersect_key($this->toUpdate->getAttributes(), $this->values);

        $this->values = $instanceAttributes;
    }

    public function confirmEdit()
    {
        $this->validate($this->rules, $this->rulesMessages);
        $this->toUpdate->update($this->values);
        $this->values = [];

        $this->dispatch('close-modal');
    }

    public function deleteInstance(array $model)
    {
        $this->toDelete = call_user_func($this->class .'::find', $model['id']);
    }

    public function confirmDelete()
    {
        if ($this->toDelete)
        {
            $this->toDelete->delete();
        }
        $this->toDelete = null;
    }
}
