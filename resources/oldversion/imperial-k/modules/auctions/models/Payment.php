<?php

namespace app\modules\auctions\models;

use app\models\User;
use Yii;


/**
 * This is the model class for table "{{%payment}}".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $inv
 * @property integer $commission
 *
 * @property User $user
 */
class Payment extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%payment}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'commission'], 'integer'],
            [['inv'], 'number']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'inv' => 'Inv',
            'commission' => 'Коммиссонный процент',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }
}
