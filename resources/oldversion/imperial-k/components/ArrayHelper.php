<?php
/**
 * Created by PhpStorm.
 * User: Мухтар
 * Date: 22.03.15
 * Time: 19:47
 */

namespace app\components;


class ArrayHelper extends \yii\helpers\ArrayHelper
{
    public static function map($array, $from, $to, $group = null)
    {
        $result = [];
        foreach ($array as $element) {
            $key = static::getValue($element, $from);
            $value = static::getValue($element,$to);
            $begin = '';
            for($i=0;$i<static::getValue($element,'depth');$i++)
            {
                $begin .=' -- ';
            }
            $value = $begin.$value;
            if ($group !== null) {
                $result[static::getValue($element, $group)][$key] = $value;
            } else {
                $result[$key] = $value;
            }
        }

        return $result;
    }

    public static function mapAuct($array, $from, $to, $group = null)
    {
        $result = [];
        foreach ($array as $element) {
            $key = static::getValue($element, $from);
            $value = $element->getAuctionName();
            if ($group !== null) {
                $result[static::getValue($element, $group)][$key] = $value;
            } else {
                $result[$key] = $value;
            }
        }

        return $result;
    }



} 