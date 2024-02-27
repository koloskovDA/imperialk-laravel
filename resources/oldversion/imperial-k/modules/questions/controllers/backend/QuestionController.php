<?php
/**
 * Created by PhpStorm.
 * User: Мухтар
 * Date: 13.04.15
 * Time: 13:50
 */

namespace app\modules\questions\controllers\backend;


use app\components\AdminController;

class QuestionController extends AdminController
{
    public function actionIndex()
    {
        return $this->render('index',[]);
    }

} 