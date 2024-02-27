<?php
/**
 * Created by PhpStorm.
 * User: Мухтар
 * Date: 28.02.15
 * Time: 21:45
 */

namespace app\models;

use Yii;
use yii\base\Model;
use app\models\Profile;

class ChangeContactForm extends Model
{
    public $email;
    public $address;
    public $phone1;
    public $phone2;

    public function rules()
    {
        return [
            ['email', 'email'],
            ['email', 'unique', 'targetClass' => '\app\models\User', 'when' => function($model) {
                    return $model->email != Yii::$app->user->identity->email;},'message' => 'Этот email уже зарегистрирован в системе'],
            [['phone1','phone2','address'],'safe'],
        ];
    }


    public function attributeLabels()
    {
        return [
            'address'=>'Адрес',
            'phone1'=>'Телефон1',
            'phone2'=>'Телефон2',

        ];
    }


    public function changecontact()
    {
        if($this->validate()){
            $user = User::findOne(Yii::$app->user->id);
            $user->email = $this->email;
            $user->save();
            $profile = Profile::findOne(['user_id'=>$user->id]);
            $profile->address = $this->address;
            $profile->phone1 = $this->phone1;
            $profile->phone2 = $this->phone2;
            $profile->save();
            return true;


        }

        return false;
    }

}