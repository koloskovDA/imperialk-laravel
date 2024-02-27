<?php
/**
 * Created by PhpStorm.
 * User: Мухтар
 * Date: 24.03.15
 * Time: 15:07
 */

namespace app\components;

use app\models\User;
use Yii;
use yii\db\Expression;

class Controller extends \yii\web\Controller
{
    public function init()
    {
        parent::init();
        if(!Yii::$app->user->isGuest){
           $user = User::findOne(Yii::$app->user->identity->id);
           $user->updated_at = new Expression('NOW()');
           $user->save();
        }
    }


    /**
     * @param \yii\base\Action $action
     * @param mixed $result
     * @return mixed
     */
    public function afterAction($action, $result)
    {
        Yii::$app->getUser()->setReturnUrl(Yii::$app->request->url);
        return parent::afterAction($action, $result);
    }


} 