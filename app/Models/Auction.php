<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Auction extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'closing_at', 'closing_end', 'status'
    ];

    public function lots()
    {
        return $this->hasMany(Lot::class, 'auction_id', 'id');
    }
}
