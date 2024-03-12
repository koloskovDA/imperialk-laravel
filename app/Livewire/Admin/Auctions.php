<?php

namespace App\Livewire\Admin;

use App\Livewire\AdminComponent;
use App\Models\Auction;
use Carbon\Carbon;
use Livewire\Component;

class Auctions extends AdminComponent
{
    public function mount()
    {
        $this->class = Auction::class;
        $this->properties = Auction::getProperties();
        $this->requiredProperties = Auction::getRequiredProperties();
        $this->propertiesLabels = Auction::getPropertiesLabels();
        $this->classLabel = Auction::getLabel();
        $this->rules = Auction::rules();
        $this->rulesMessages = Auction::rulesMessages();
        $this->inputTypes = Auction::getInputTypes();
        $this->enums = Auction::getEnums();
        $this->search = array_fill_keys(Auction::search(), null);
    }

    public function createInstance()
    {
        $closing_at = Carbon::parse("Last tuesday of this month")
            ->subWeek()
            ->addHours(17);

        $closing_at = $closing_at->format('Y-m-d H:i');
        $closing_at = str_replace(' ', 'T', $closing_at);

        $this->values = [
            'name' => 'Аукцион №'.Auction::count()+1,
            'closing_at' => $closing_at,
        ];
    }
}
