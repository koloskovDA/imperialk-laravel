<?php

namespace App\Models;

use App\Enums\AuctionStatusEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Filial extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'info', 'address'
    ];

    public static function getProperties() : array
    {
        return [
            'name', 'info', 'address'
        ];
    }

    public static function getRequiredProperties() : array
    {
        return [
            'name', 'address'
        ];
    }

    public static function getInputTypes() : array
    {
        return [
            'name' => 'text',
            'info' => 'text',
            'address' => 'text'
        ];
    }

    public static function getPropertiesLabels() : array
    {
        return [
            'name' => 'Название',
            'info' => 'Информация',
            'address' => 'Адрес'
        ];
    }

    public static function getLabel() : string
    {
        return 'Филиал';
    }

    public static function rules() : array
    {
        return [
            'values.name' => 'required',
            'values.address' => 'required'
        ];
    }

    public static function rulesMessages() : array
    {
        return [
            'values.name.required' => 'Укажите название',
            'values.address.required' => 'Укажите адрес'
        ];
    }

    public static function search() : array
    {
        return ['name', 'address'];
    }
}
