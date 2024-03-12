<?php

namespace App\Livewire\Admin;

use App\Models\Auction;
use Carbon\Carbon;
use Livewire\Component;

class Auctions extends Component
{
    public string $name = '';

    public string $visibility = '';

    public $closing_at = '';

    public Auction|null $auction_to_delete = null;

    public Auction|null $auction_to_update = null;

    public function showModal()
    {
        $this->closing_at = Carbon::parse("Last tuesday of this month")
            ->subWeek()
            ->addHours(17);
        $this->closing_at = $this->closing_at->format('Y-m-d H:i');
        $this->closing_at = str_replace(' ', 'T', $this->closing_at);
        $this->name = 'Аукцион №'.Auction::count()+1;
    }

    public function render()
    {
        $auctions = Auction::all();

        return view('livewire.admin.auctions', compact('auctions'));
    }

    public function createAuction()
    {
        $this->validate([
            'name' => 'required'
        ], [
            'name.required' => 'Укажите название'
        ]);
        Auction::create([
            'name' => $this->name,
            'closing_at' => $this->closing_at,
            'closing_end' => Carbon::parse($this->closing_at)->addSeconds(5),
            'visibility' => $this->visibility
        ]);
        $this->dispatch('close-modal');
    }

    public function editAuction(Auction $auction)
    {
        $this->closing_at = $auction->closing_at;
        $this->name = $auction->name;
        $this->visibility = $auction->visibility;
        $this->auction_to_update = $auction;
    }

    public function confirmEdit()
    {
        $this->validate([
            'name' => 'required'
        ], [
            'name.required' => 'Укажите название'
        ]);
        $this->auction_to_update->update([
            'name' => $this->name,
            'closing_at' => $this->closing_at,
            'closing_end' => Carbon::parse($this->closing_at)->addSeconds(5),
            'visibility' => $this->visibility
        ]);
        $this->dispatch('close-modal');
    }

    public function deleteAuction(Auction $auction)
    {
        $this->auction_to_delete = $auction;
    }

    public function confirmDelete()
    {
        if ($this->auction_to_delete)
        {
            $this->auction_to_delete->delete();
        }
        $this->auction_to_delete = null;
    }
}
