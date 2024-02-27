<?php
/**
 * Created by PhpStorm.
 * User: Мухтар
 * Date: 20.03.15
 * Time: 9:44
 */

namespace app\modules\auctions\controllers\backend;

use app\models\Messages;
use app\models\User;
use Yii;
use app\components\AdminController;
use app\models\search\MessagesSearch;
use yii\data\ActiveDataProvider;
use yii\db\Expression;
use yii\filters\AccessControl;

use app\components\ArrayHelper;
use app\modules\auctions\models\Lots;
use app\modules\auctions\models\Lookup;




class MessagesController extends AdminController
{
    public function behaviors()
    {
        return [
            'access'=>[
                'class'=>AccessControl::class,
                'only'=>['index','create','update','delete','view'],
                'rules'=>[
                    [
                        'allow'=>true,
                        'actions'=>['index','create','update','delete','view'],
                        'roles'=>['admin'],
                    ]
                ]
            ],
       ];

    }

    public function actionIndex()
    {
        $searchModel = new MessagesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
            
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);

    }


    /**
     * Displays a single Messages model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        if($model->user_to == Yii::$app->user->id){
            $model->status = Messages::STATUS_OLD;
            $model->save();
        }

        return $this->render('view', [
            'model' => $model,
        ]);
    }



    /**
     * Creates a new Messages model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Messages();

        if ($model->load(Yii::$app->request->post())) {
            $user_id = $_POST['Messages']['user_to'];

            if(empty($user_id)){
                $users = User::find()->where(['role'=>User::ROLE_USER])->all();
                foreach($users as $user)
                {
                    $messageModel = new Messages();
                    $messageModel->text = $model->text;
                    $messageModel->user_id = Yii::$app->user->id;
                    $messageModel->user_to = $user->id;
                    $messageModel->status = Messages::STATUS_NEW;
                    $messageModel->date = new Expression("NOW()");
                    $messageModel->save();
                    
                    $lotsMain = Lookup::find()->select('value')->where(['type' => 'lots'])->asArray()->all();
                    $lotsMainIds = ArrayHelper::getColumn($lotsMain, 'value');
                    $lastLots = Lots::find()->where(['id' => $lotsMainIds])->orderBy('id DESC')->limit(6)->all();

                    \Yii::$app->mailer->compose(['html' => 'message-html', 'text' => 'message-text'], ['user' => $user,'message'=>$model->text,'lastLots'=>$lastLots])
                        ->setFrom([\Yii::$app->params['supportEmail'] => 'Администрация Империал-К'])
                        ->setTo($user->email)
                        ->setSubject('Сообщение от сайта ' . \Yii::$app->name)
                        ->send();

                }

            }else {
                $model->save();

            }
            return $this->redirect(['index']);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }


    /**
     * Updates an existing Messages model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }


    /**
     * Deletes an existing Messages model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }


    /**
     * Finds the Messages model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Messages the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Messages::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }


    public function actionInbox($id)
    {
        $user = User::findOne($id);
        $query = Messages::find();
        $query->andWhere(['user_to'=>$id]);
        $query->orderBy('date DESC');

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        return $this->render('inbox',[
            'dataProvider'=>$dataProvider,
            'user'=>$user,
        ]);

    }

    public function actionOutbox($id)
    {
        $user = User::findOne($id);
        $query = Messages::find();
        $query->andWhere(['user_id'=>$id]);
        $query->orderBy('date DESC');

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        return $this->render('outbox',[
            'dataProvider'=>$dataProvider,
            'user'=>$user,
        ]);


    }



}