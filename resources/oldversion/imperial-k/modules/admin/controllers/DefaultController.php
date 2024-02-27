<?php

namespace app\modules\admin\controllers;

use app\modules\auctions\models\Lookup;
use yii\filters\AccessControl;
use yii\web\Controller;

class DefaultController extends Controller
{
    public function behaviors()
    {
        return [
            'access'=>[
                'class'=>AccessControl::class,
                'only'=>['index'],
                'rules'=>[
                    [
                        'allow'=>true,
                        'actions'=>['index'],
                        'roles'=>['admin'],
                    ]
                ]
            ]
        ];

    }
    public function actionIndex()
    {
        $lotsMain = Lookup::find()->where(['type'=>'lots'])->all();
        $productMain = Lookup::find()->where(['type'=>'product'])->all();

        return $this->render('index',[

        ]);
    }


}
