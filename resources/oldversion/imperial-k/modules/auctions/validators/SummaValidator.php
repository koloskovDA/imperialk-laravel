<?php
/**
 * Created by PhpStorm.
 * User: Мухтар
 * Date: 11.03.15
 * Time: 23:29
 */

namespace app\modules\auctions\validators;

use Yii;
use app\modules\auctions\models\HistoryLots;
use yii\validators\Validator;

class SummaValidator extends Validator
{

    public function init()
    {
        parent::init();

    }


    public function validateAttribute($model,$attribute)
    {
        $maxPrice = HistoryLots::find()->where(['lot_id'=>$model->lot_id])->max('sum');
        $minimumRate = $maxPrice + ($maxPrice/100 * Yii::$app->params['ratePercent']);
        if (($minimumRate - $maxPrice)<1){
            $minimumRate = $maxPrice + 1;
        }
        $value = $model->$attribute;
        if ($value < $minimumRate){
            $model->addError($attribute,"Сумма должна быть больше ".$minimumRate);
        }
    }

    public function clientValidateAttribute($model,$attribute,$view)
    {
        return <<<JS

        var currentValue = parseInt(value);
        var minRateSumValue = parseInt($('#minRateSum').text());

        if (currentValue<minRateSumValue){
               messages.push('Сумма должна быть больше ' + minRateSumValue);
        }
JS;

    }



} 