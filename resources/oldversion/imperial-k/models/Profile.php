<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%profile}}".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $firstname
 * @property string $lastname
 * @property string $patronym
 * @property string $address
 * @property string $phone1
 * @property string $phone2
 *
 * @property User $user
 */
class Profile extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%profile}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id'], 'integer'],
            [['firstname', 'lastname', 'patronym', 'address', 'phone1', 'phone2'], 'string', 'max' => 255],
            [['firstname', 'lastname', 'patronym', 'address', 'phone1', 'phone2'], 'safe'],
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
            'firstname' => 'Фамилия',
            'lastname' => 'Имя',
            'patronym' => 'Отчество',
            'address' => 'Адрес',
            'phone1' => 'Телефон1',
            'phone2' => 'Телефон2',
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
