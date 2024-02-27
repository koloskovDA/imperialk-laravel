<?php
/**
 * Created by PhpStorm.
 * User: Мухтар
 * Date: 24.03.15
 * Time: 11:56
 */

namespace app\modules\auctions\controllers\backend;


use app\components\AdminController;
use app\modules\auctions\models\Lookup;
use app\modules\auctions\models\search\LookupSearch;
use yii\filters\AccessControl;

class LookupController extends AdminController
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['index', 'create', 'update', 'delete', 'view'],
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['index', 'create', 'update', 'delete', 'view'],
                        'roles' => ['admin'],
                    ]
                ]
            ],
        ];
    }

    public function actionIndex()
    {
        $searchModel = new LookupSearch();
        $dataProvider = $searchModel->search(\Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);

    }


    public function actionAdd($id, $type)
    {
        $model = new Lookup();
        $model->type = $type;
        $model->value = $id;
        if ($model->save()) {
            return $this->redirect(['index']);
        }
    }


    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    protected function findModel($id)
    {
        if (($model = Lookup::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

} 