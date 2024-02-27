<?php

namespace app\modules\auctions\models;

use Yii;
use app\models\User;
use app\modules\auctions\validators\SummcheckValidator;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

/**
 * This is the model class for table "{{%history_lots}}".
 *
 * @property integer $id
 * @property string $sum
 * @property string $create_date
 * @property integer $user_id
 * @property integer $lot_id
 * @property integer $excess;
 * @property string $nickname;
 * @property Lots $lot
 * @property User $user
 */
class HistoryLots extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%history_lots}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['sum'], 'number','message'=>'Sum должна быть цифрой'],
            ['sum','required'],

            ['sum',SummcheckValidator::class],


            [['create_date','excess'], 'safe'],
            [['user_id', 'lot_id'], 'integer']
        ];
    }




    public function behaviors()
    {
        return [
            'timestamp' => [
                'class'=>TimestampBehavior::class,
                'createdAtAttribute' => 'create_date',
                'updatedAtAttribute' => false,
                'value' => new Expression('NOW()'),
            ],
        ];
    }


    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'sum'=>'Ваша ставка',
            'create_date' => 'Create Date',
            'user_id' => 'User ID',
            'lot_id' => 'Lot ID',
            'excess' => 'Excess'
        ];
    }


    public function getLeaderLot($lot_id)
    {

    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLot()
    {
        return $this->hasOne(Lots::class, ['id' => 'lot_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }
}
