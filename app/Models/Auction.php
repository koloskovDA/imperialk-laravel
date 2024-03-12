<?php

namespace App\Models;

use App\Enums\AuctionStatusEnum;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Auction extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'closing_at', 'closing_end', 'visibility'
    ];

    public function getClosingAtAttribute($value)
    {
        return Carbon::parse($value)->translatedFormat('d F Y, H:i:s');
    }

    public function getClosingEndAttribute($value)
    {
        return Carbon::parse($value)->translatedFormat('d F Y, H:i:s');
    }

    public function getVisibilityAttribute($value)
    {
        return AuctionStatusEnum::from($value)->label;
    }

    public function lots() : HasMany
    {
        return $this->hasMany(Lot::class, 'auction_id', 'id');
    }

    public static function getProperties() : array
    {
        return [
            'name', 'closing_at', 'closing_end', 'visibility'
        ];
    }

    public static function getRequiredProperties() : array
    {
        return [
            'name'
        ];
    }

    public static function getPropertiesLabels() : array
    {
        return [
            'name' => 'Название',
            'closing_at' => 'Дата закрытия',
            'closing_end' => 'Окончание закрытия',
            'visibility' => 'Статус'
        ];
    }

    public static function getLabel() : string
    {
        return 'Аукцион';
    }
}
