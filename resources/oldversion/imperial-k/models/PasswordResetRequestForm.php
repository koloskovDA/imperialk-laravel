<?php
/**
 * Created by PhpStorm.
 * User: Мухтар
 * Date: 05.02.15
 * Time: 8:16
 */

namespace app\models;

use app\models\User;
use yii\base\Model;


class PasswordResetRequestForm extends Model
{
    public $email;

    public function rules()
    {
        return [
            ['email','filter','filter'=>'trim'],
            ['email','required'],
            ['email','email'],
            ['email','exist',
                'targetClass'=>'\app\models\User',
                'filter'=>['status'=>User::STATUS_ACTIVE],
                'message'=>'Нет такого пользователя c таким email'
            ],

        ];
    }


    public function sendEmail()
    {
        $user = User::findOne([
            'status'=>User::STATUS_ACTIVE,
            'email'=>$this->email,
        ]);

        if ($user){
            if(!User::isPasswordResetTokenValid($user->password_reset_token)){
                $user->generatePasswordResetToken();
            }

            if ($user->save()){
                return \Yii::$app->mailer->compose(['html'=>'passwordResetToken-html','text'=>'passwordResetToken-text'],['user'=>$user])
                    ->setFrom([\Yii::$app->params['supportEmail'] => 'Администрация Империал-К'])
                    ->setTo($this->email)
                    ->setSubject('Сброс пароля для  '. \Yii::$app->name)
                    ->send();
            }
        }
        return false;
    }


} 