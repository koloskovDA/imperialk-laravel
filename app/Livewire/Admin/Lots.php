<?php

namespace App\Livewire\Admin;

use App\Models\Auction;
use Livewire\Component;

class Lots extends Component
{
    public Auction $auction;

    public function render()
    {
        return view('livewire.admin.lots');
    }
}
