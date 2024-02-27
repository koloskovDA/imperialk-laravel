<?php
/**
 * Created by PhpStorm.
 * User: Мухтар
 * Date: 20.03.15
 * Time: 10:33
 */

namespace app\modules\shop\controllers\backend;

use app\modules\shop\models\Order;
use app\modules\shop\models\Usershop;
use Yii;
use app\components\AdminController;
use app\modules\shop\models\search\OrderSearch;


class OrderController extends AdminController
{

    public function actionIndex()
    {
        $searchModel = new OrderSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    public function actionView($id)
    {
        $model = $this->findModel($id);
        $user = Usershop::findOne(['email'=>$model->email]);

        return $this->render('view',[
            'model'=>$model,
            'user'=>$user,

        ]);

    }


    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        return $this->render('update', [
            'model' => $model,
        ]);
    }

    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $model->delete();
        return $this->redirect(['index']);

    }

    protected function findModel($id)
    {
        if (($model = Order::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }


} 