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

    public static function boot()
    {
        parent::boot();

        self::saving(function ($model) {
            if (empty($model->closing_end) || ($model->closing_at > $model->closing_end)) {
                $model->closing_end = Carbon::parseFromLocale($model->closing_at)->addSeconds(5);
            }
        });
    }

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

    public static function getInputTypes() : array
    {
        return [
            'name' => 'text',
            'closing_at' => 'datetime-local',
            'visibility' => 'select'
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

    public static function getEnums() : array
    {
        return [
            'visibility' => AuctionStatusEnum::toArray()
        ];
    }

    public static function getLabel() : string
    {
        return 'Аукцион';
    }

    public static function rules() : array
    {
        return [
            'values.name' => 'required'
        ];
    }

    public static function rulesMessages() : array
    {
        return [
            'values.name.required' => 'Укажите название'
        ];
    }

    public static function search() : array
    {
        return [ 'name' ];
    }
}
