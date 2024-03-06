<?php

namespace App\Enums;

use Spatie\Enum\Enum;

/**
 * @method static self hidden()
 * @method static self published()
 * @method static self finished()
 */
class AuctionStatusEnum extends Enum
{
    public static function labels()
    {
        return [
            'hidden' => 'Скрыт',
            'published' => 'Опубликован',
            'finished' => 'Завершён'
        ];
    }
}
