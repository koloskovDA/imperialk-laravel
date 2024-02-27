<?php
/**
 * Created by PhpStorm.
 * User: Мухтар
 * Date: 16.02.15
 * Time: 16:03
 */

namespace app\components;

use Yii;
use yii\base\Widget;
use app\models\LoginForm;
use app\models\Messages;

class LoginWidget extends Widget
{
    public function run()
    {
        $model = new LoginForm();
        $newMessagesCount = 0;
        if(!Yii::$app->user->isGuest){
            $newMessagesCount = Messages::find()->where(['user_to'=>Yii::$app->user->id,'status'=>Messages::STATUS_NEW])->count();
        }
        return $this->render('loginWidget',[
            'model'=>$model,
            'newMessagesCount'=>$newMessagesCount,
        ]);
    }


} 