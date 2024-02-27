<?php
/**
 * Created by PhpStorm.
 * User: Мухтар
 * Date: 24.03.15
 * Time: 11:46
 */

namespace app\modules\auctions\models;


use yii\db\ActiveRecord;

/**
 * Class Lookup
 * @package app\modules\auctions\models
 * @property integer $id
 * @property string $type
 * @property integer $value
 */
class Lookup extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%lookup}}';
    }

    public function rules()
    {
        return [
            [['type','value'], 'required'],
            [['value'], 'integer'],
            [['type'], 'string', 'max' => 255]
        ];
    }


    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'type' => 'Тип',
            'value' => 'Значение',
        ];
    }

} 