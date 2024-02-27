<?php

namespace app\modules\auctions\models;


use Yii;
use app\models\User;
use app\modules\auctions\validators\SummcheckValidator;

/**
 * This is the model class for table "{{%profile_lots}}".
 *
 * @property integer $id
 * @property integer $lot_id
 * @property integer $user_id
 * @property string $sum
 *
 * @property User $user
 * @property Lots $lot
 */
class ProfileLots extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%profile_lots}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['lot_id', 'user_id'], 'integer'],
            ['sum','required','on' => 'signup'],
            ['sum',SummcheckValidator::class,'on' => 'signup'],
            [['sum'], 'number']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'lot_id' => 'Лот',
            'user_id' => 'Пользователь',
            'sum' => 'Ваш бид',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLot()
    {
        return $this->hasOne(Lots::class, ['id' => 'lot_id']);
    }
}
