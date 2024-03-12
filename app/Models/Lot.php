<?php

namespace App\Models;

use App\Enums\AuctionStatusEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lot extends Model
{
    use HasFactory;

    protected $fillable = [
        'nominal', 'year', 'letter',
        'metal', 'save_id', 'metal_id',
        'price', 'closing_at', 'auction_id',
        'category_id', 'position', 'rarity', 'owner',
        'features'
    ];

    public static function getProperties() : array
    {
        return [
            'nominal',
            'year',
            'letter',
            'save_id',
            'metal_id',
            'price',
            'closing_at',
            'auction_id',
            'category_id',
            'position',
            'rarity',
            'owner',
            'features'
        ];
    }

    public static function getPropertiesLabels() : array
    {
        return [
            'nominal' => 'Номинал',
            'year' => 'Год',
            'letter' => 'Буквы',
            'save_id' => 'Сохр.',
            'metal_id' => 'Материал',
            'price' => 'Цена',
            'closing_at' => 'Закрытие',
            'auction_id' => 'Аукцион',
            'category_id' => 'Категория',
            'position' => 'Позиция',
            'rarity' => 'Редк.',
            'owner' => 'Владелец',
            'features' => 'Особенности'
        ];
    }

    public static function getLabel() : string
    {
        return 'Лот';
    }
}
