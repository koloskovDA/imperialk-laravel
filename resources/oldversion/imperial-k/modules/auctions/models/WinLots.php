<?php

namespace app\modules\auctions\models;

use Yii;
use app\modules\auctions\models\Lots;

/**
 * This is the model class for table "{{%win_lots}}".
 *
 * @property integer $id
 * @property integer $lot_id
 * @property integer $user_id
 */
class WinLots extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%win_lots}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['lot_id', 'user_id'], 'required'],
            [['lot_id', 'user_id'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'lot_id' => 'Lot ID',
            'user_id' => 'User ID',
        ];
    }

    public function getLot()
    {
        return $this->hasOne(Lots::class, ['id' => 'lot_id']);
    }
}
