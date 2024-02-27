<?php

namespace app\modules\filials\controllers;

use Yii;
use app\components\Controller;
use yii\filters\VerbFilter;
use yii\data\ActiveDataProvider;
use app\modules\filials\models\Filial;



class DefaultController extends Controller {
	
	public function actionIndex()
	{
		$query = Filial::find();

		$dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

	    return $this->render('index',[
	    	'dataProvider' => $dataProvider,
	    ]);

    }

    public function actionView($id)
    {
    	return $this->render('view', [
            'model' => $this->findModel($id),
        ]);

    }


    protected function findModel($id)
    {
        if (($model = Filial::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}