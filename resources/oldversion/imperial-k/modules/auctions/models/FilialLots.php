<?php


namespace app\modules\auctions\models;

/**
 * This is the model class for table "{{%filial_lots}}".
 *
 * @property integer $id
 * @property integer $filial_id
 * @property string $lot_id
 *
 * @property Filial $filial
 * @property Lots $lots
 */
class FilialLots extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return '{{%filial_lots}}';
    }

    public function rules()
    {
        return [
            [['filial_id','lot_id'],'required'],
            [['filial_id', 'lot_id'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'filial_id' => 'Филиал',
        ];
    }



}