<?php

namespace app\modules\auctions\controllers;

use app\modules\news\models\News;
use app\components\Controller;

class DefaultController extends Controller
{
    public function actionIndex()
    {
        $lastNews = News::find()->orderBy('created_at DESC')->all();
        return $this->render('index',['lastNews'=>$lastNews]);
    }



}
