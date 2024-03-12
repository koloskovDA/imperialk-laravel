<?php

namespace App\Models;

use App\Enums\AuctionStatusEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'slug', 'position'
    ];

    public static function getProperties() : array
    {
        return [
            'name', 'slug', 'position'
        ];
    }

    public static function getRequiredProperties() : array
    {
        return [
            'name', 'slug'
        ];
    }

    public static function getInputTypes() : array
    {
        return [
            'name' => 'text',
            'slug' => 'text',
            'position' => 'number'
        ];
    }

    public static function getPropertiesLabels() : array
    {
        return [
            'name' => 'Название',
            'slug' => 'Тег',
            'position' => 'Позиция'
        ];
    }

    public static function getLabel() : string
    {
        return 'Категория';
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
