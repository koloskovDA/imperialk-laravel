<?php

namespace app\modules\auctions\controllers\backend;


use app\components\AdminController;
use app\models\Messages;
use app\modules\auctions\models\AuctionsResult;
use app\modules\auctions\models\Payment;
use app\modules\auctions\models\PaymentHistory;
use app\modules\auctions\models\WinLots;
use Yii;
use app\modules\auctions\models\Auctions;
use app\modules\auctions\models\search\AuctionsSearch;
use yii\data\ActiveDataProvider;
use yii\db\Expression;
use yii\db\Query;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\modules\auctions\models\Categories;
use app\modules\auctions\models\Lots;
use app\modules\auctions\models\User;
use yii\filters\AccessControl;

/**
 * AuctionsController implements the CRUD actions for Auctions model.
 */
class AuctionsController extends AdminController
{

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['index', 'create', 'update', 'delete', 'view', 'result'],
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['index', 'create', 'update', 'delete', 'view',],
                        'roles' => ['admin','moder'],
                    ],
                    [
                        'allow'=>true,
                        'actions'=>['result'],
                        'roles'=>['admin'],
                    ]
                ]
            ],

            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    //'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Auctions models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AuctionsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    public function actionResult()
    {
        $auctionId = Yii::$app->request->get('auction_id');
        $auction = Auctions::findOne($auctionId);
        $auctionsResults = AuctionsResult::find()->all();
        $result = AuctionsResult::find()->where(['auction_id' => $auctionId])->exists();

        if (strtotime($auction->closing_date) < time() && !($result = AuctionsResult::find()->where(['auction_id' => $auctionId])->exists())) {

            $users = [];
            foreach ($auction->lots as $lot) {

                if ($lot->getLeaderId() !== null) {
                    $leaderId = $lot->getLeaderId();
                    $users[$leaderId]['sum'] = $users[$leaderId]['sum'] + $lot->price;
                    $paymentUser = Payment::findOne(['user_id' => $leaderId]);
                    $users[$lot->getLeaderId()]['comission'] = $paymentUser->commission;
                }


                $winlotsModel = new WinLots();
                $winlotsModel->lot_id = $lot->id;
                $winlotsModel->user_id = $lot->getLeaderId();
                $winlotsModel->save();
            }

            foreach ($users as $key => $user) {

                $paymentHistory = new PaymentHistory();
                $paymentHistory->user_id = $key;
                $paymentHistory->text = "Списаны покупки на аукционе № " . $auction->getAuctionName();
                $paymentHistory->type = PaymentHistory::OPERATION_MINUS;
                $sumResult = $user['sum'] + ($user['sum'] / 100 * $user['comission']);
                $paymentHistory->sum = $sumResult;
                $paymentModel = Payment::findOne(['user_id' => $key]);
                $paymentHistory->balance = $paymentModel->inv - $sumResult;
                $paymentHistory->save();
                $paymentModel->inv = $paymentHistory->balance;
                $paymentModel->save();

                $messageModel = new Messages();

                $messageModel->text = "На аукционе № " . $auction->name . " Вы выиграли лоты на общую сумму " . $sumResult . " руб. (c учётом комиссии).";
                $messageModel->user_id = Yii::$app->user->id;
                $messageModel->user_to = $key;
                $messageModel->status = Messages::STATUS_NEW;
                $messageModel->date = new Expression("NOW()");
                $messageModel->save();
                
                $uzver = User::findOne(['id' => $key]);
                $summary = "";
                
                foreach ($auction->lots as $lot) {
                    if ($lot->getLeaderId() == $key) {
                        $summary = $summary."<tr><td>".$lot->nominal."</td><td>".$lot->year."</td><td>".$lot->letter."</td><td>".$lot->metal."</td><td>".$lot->saves."</td><td>".$lot->price."</td></tr>";
                    }
                }
                        
                \Yii::$app->mailer->compose(['html' => 'result-html', 'text' => 'result-text'], ['user' => $uzver,'value' => $sumResult, 'sum' => $summary, 'name'=> $auction->name])
                        ->setFrom([\Yii::$app->params['supportEmail'] => 'Администрация Империал-К'])
                        ->setTo($uzver->email)
                        ->setSubject('Подведение итогов прошедшего аукциона')
                        ->send();


            }

            $auctionResultModel = new AuctionsResult();
            $auctionResultModel->auction_id = $auctionId;
            $auctionResultModel->status = 1;
            $auctionResultModel->created_at = new Expression("NOW()");
            $auctionResultModel->save();

            Yii::$app->getSession()->setFlash('successAuctionResult', 'Отчет аукциона успешно сформирован.');

        }
        return $this->redirect(['view','id'=>$auctionId]);


    }

    public function actionSort()
    {

        if (isset($_POST['items']) && is_array($_POST['items'])) {

            $lotId = $_POST['items'][0];
            $lotInfo = Lots::findOne($lotId);
            $auctionInfo = Auctions::findOne($lotInfo->auction_id);
            $closing_date = $auctionInfo->opening_date;
            $close_time = date("H:i:s", strtotime($closing_date));
            $close_date = date("Y-m-d", strtotime($closing_date));
            $i = 0;

            foreach ($_POST['items'] as $item) {
                $i++;
                $model = Lots::findOne($item);
                if ($i == 1) {
                    $close_time = date("H:i:s", strtotime($close_time));
                } else {
                    $close_time = date("H:i:s", strtotime($close_time) + Lots::TIME_PERIOD);
                }


                $model->close_time = $close_time;
                $model->close_date = $close_date;
                $model->pos = $i;
                $model->save();
            }

        }

    }


    /**
     * Displays a single Auctions model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {

        $categories = Categories::find()->all();
        $model = $this->findModel($id);
        if ($category = Yii::$app->request->get('category')) {
            $categoryModel = Categories::findOne(['slug' => $category]);
            $query = Lots::find()->where(['auction_id' => $model->id, 'category_id' => $categoryModel->id]);
        } else {
            $query = Lots::find()->where(['auction_id' => $model->id])->orderBy('category_id ASC,pos ASC');
        }
        
        $provider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 500,
            ]

        ]);
        $btnResult = AuctionsResult::find()->where(['auction_id' => $model->id])->exists();
        return $this->render('view', [
            'model' => $model,
            'categories' => $categories,
            'lotsProvider' => $provider,
            'btnResult'=>$btnResult,
        ]);
    }


    /**
     * Creates a new Auctions model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Auctions();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Auctions model.
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
     * Deletes an existing Auctions model.
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
     * Finds the Auctions model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Auctions the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Auctions::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
