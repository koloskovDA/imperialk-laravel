<?php

namespace app\modules\auctions\controllers;


use app\models\User;
use Yii;
use yii\base\Exception;
use yii\data\ActiveDataProvider;
use yii\db\Expression;
use yii\helpers\ArrayHelper;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;
use app\components\Controller;
use app\modules\auctions\models\Lots;
use app\modules\auctions\models\HistoryLots;
use app\modules\auctions\models\ProfileLots;
use yii\filters\AccessControl;
use yii\web\Session;


/**
 * LotsController implements the CRUD actions for Lots model.
 */
class LotsController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['addprofilelot', 'addprofilesum', 'removeprofilelot', 'addprofilelotact', 'removelotfromcheckbox', 'addlotfromcheckbox'],
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['addprofilelot', 'addprofilesum', 'removeprofilelot', 'addprofilelotact', 'removelotfromcheckbox', 'addlotfromcheckbox'],
                        'roles' => ['user'],
                    ]
                ]
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }



//    public function actionCreate()
//    {
//        $model = new Lots();
//        return $this->render('create',[
//            'model'=>$model,
//        ]);
//    }


    /**
     * Displays a single Lots model.
     * @param integer $id
     * @return mixed
     */

    public function actionView($id)
    {
        $session = Yii::$app->session;
        if (Yii::$app->request->absoluteUrl !== Yii::$app->request->referrer)
            $session->set('backLotUrl', Yii::$app->request->referrer);

        $backUrl = $session->get('backLotUrl');

        $lotClose = false;

        $model = $this->findModel($id);
        if (time() > strtotime($model->closing_date)) {
            $lotClose = true;
        }

        $count = $model->getHistoryLots()->count();
        $hlModel = new HistoryLots();
        $historyLots = HistoryLots::find()->where(['lot_id' => $model->id])->orderBy('sum DESC,id DESC')->all();

        $queryHistoryLots = HistoryLots::find();
        $queryHistoryLots->andWhere(['lot_id' => $model->id]);
        $queryHistoryLots->addOrderBy('sum DESC,id DESC');
        $historyDataProvider = new ActiveDataProvider([
            'query' => $queryHistoryLots,
            'pagination' => [
                'pageSize' => 500,
            ]
        ]);

        $profileLots = ProfileLots::find()->select('sum')->where("lot_id=" . $id . " AND sum>0")->asArray()->all();
        $profileLotsSum = ArrayHelper::getColumn($profileLots, 'sum');


        return $this->render('view', [
            'model' => $this->findModel($id),
            'count' => $count,
            'hlModel' => $hlModel,
            'historyLots' => $historyLots,
            'lotClose' => $lotClose,
            'profileLotsSum' => $profileLotsSum,
            'backUrl' => $backUrl,
            'historyDataProvider' => $historyDataProvider,
        ]);
    }


    /*
     *  Добавляем в профайл
     */
    public function actionAddprofilelot($id)
    {
        $model = new ProfileLots();
        $model->lot_id = $id;
        $model->user_id = Yii::$app->user->id;
        $model->sum = 0;
        if ($model->save()) {
            return $this->redirect(['lots/view', 'id' => $id]);
        }
    }


    public function actionAddlotfromcheckbox()
    {
        if (Yii::$app->request->isAjax) {
            $model = new ProfileLots();
            $model->lot_id = Yii::$app->request->get('lotId');
            $model->user_id = Yii::$app->request->get('userId');
            $model->sum = 0;
            Yii::$app->response->format = Response::FORMAT_JSON;
            $outData = ['success' => false];
            if ($model->save()) {
                $outData = ['success' => true];
            }
            return $outData;
        }
    }

    public function actionRemovelotfromcheckbox()
    {
        if (Yii::$app->request->isAjax) {
            $model = ProfileLots::find()->where(['user_id' => Yii::$app->request->get('userId'), 'lot_id' => Yii::$app->request->get('lotId')])->one();
            Yii::$app->response->format = Response::FORMAT_JSON;
            $outData = ['success' => false];
            if ($model->delete()) {
                $outData = ['success' => true];
            }
            return $outData;
        }
    }

    public function actionAddprofilelotact()
    {
        if (Yii::$app->request->isAjax) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            $model = new ProfileLots();
            //$model->lot_id = ;
            $model->user_id = Yii::$app->user->id;
            $model->sum = 0;
            $model->save();

        }

    }

    public function actionRemoveprofilelot($id)
    {
        $model = ProfileLots::findOne(['lot_id' => $id, 'user_id' => Yii::$app->user->id]);
        if ($model === null) {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
        if ($model->delete()) {
            return $this->redirect(['lots/view', 'id' => $id]);
        }
    }





    public function actionAddprofilesum()
    {
        if (Yii::$app->request->isAjax) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            $post = Yii::$app->request->post();

            $lotId = $post['ProfileLots']['lot_id'];
            $userId = $post['ProfileLots']['user_id'];

            $lotModel = Lots::findOne($lotId);

            if(time() > strtotime($lotModel->closing_date)){
                return ['error'=>"Время истекло"];
            }

            $sum = $post['ProfileLots']['sum'];
            $minimumRate = Lots::findOne($lotId)->getMinimumRate();
            if($sum < $minimumRate){
                return ['error'=>"Сумма должна быть больше ".$minimumRate];
            }
            $queryHistoryLots = HistoryLots::find();
            $queryHistoryLots->andWhere(['{{%history_lots}}.lot_id' => $lotId]);
            $queryHistoryLots->addOrderBy('{{%history_lots}}.sum DESC,{{%history_lots}}.id DESC');
            $queryHistoryLots->leftJoin('{{%user}}', '{{%user}}.id={{%history_lots}}.user_id');
            $queryHistoryLots->select(['{{%history_lots}}.nickname AS nickname','{{%history_lots}}.sum','DATE_FORMAT({{%history_lots}}.create_date,"%T %d.%m.%Y") as create_date','{{%history_lots}}.excess']);

            $resultsInfo = '';
            $model = ProfileLots::findOne(['lot_id' => $lotId, 'user_id' => $userId]);
            if ($model === null) {
                $model = new ProfileLots();
                $model->lot_id = $lotId;
                $model->user_id = Yii::$app->user->id;
                $model->sum = $post['ProfileLots']['sum'];
                if ($model->save()) {
                    $changeProfileSum = 'Вы установили бид на сумму ' . $model->sum;
                    Yii::$app->getSession()->setFlash('changeProfileSum',$changeProfileSum );
                    $resultsInfo = $this->addRating($lotId,$model->id);
                }
            }else {
                $model->sum = $post['ProfileLots']['sum'];
                if ($model->save()) {
                    if($model->sum>0){
                        $changeProfileSum = 'Сумма бида изменена на ' . $model->sum;
                    }else {
                        $changeProfileSum = 'Вы установили бид на сумму ' . $model->sum;
                    }
                    Yii::$app->getSession()->setFlash('changeProfileSum', $changeProfileSum);
                    $resultsInfo = $this->addRating($lotId,$model->id);
                }

            }


            $currentLotInfo = Lots::findOne($lotId);
            $maxRate = Lots::findOne($lotId)->getMinimumRate();
            $historyDataProvider = $queryHistoryLots->asArray()->all();
            $lotInfo = [
                'currentPrice'=>Yii::$app->formatter->asDecimal($currentLotInfo->getCurrentPrice(),0),
                'currentLeader'=>$currentLotInfo->getLeader(),
                'count'=>$currentLotInfo->getHistoryLots()->count(),

            ];
            return [
                'lotInfo'=>$lotInfo,
                'historyDataProvider'=>$historyDataProvider,
                'maxRate'=>$maxRate,
                'changeProfileSum'=>$changeProfileSum,
                'error'=>'',
                'results'=>$resultsInfo,
            ];

        }
    }


    public function actionRefreshpage()
    {
        if (Yii::$app->request->isAjax) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            $post = Yii::$app->request->post();
            $lotId = $post['id'];
            $queryHistoryLots = HistoryLots::find();
            $queryHistoryLots->andWhere(['{{%history_lots}}.lot_id' => $lotId]);
            $queryHistoryLots->addOrderBy('{{%history_lots}}.sum DESC,{{%history_lots}}.id DESC');
            $queryHistoryLots->leftJoin('{{%user}}', '{{%user}}.id={{%history_lots}}.user_id');
            $queryHistoryLots->select(['{{%history_lots}}.nickname AS nickname','{{%history_lots}}.sum','DATE_FORMAT({{%history_lots}}.create_date,"%T %d.%m.%Y") as create_date','{{%history_lots}}.excess']);

            $currentLotInfo = Lots::findOne($lotId);
            $maxRate = Lots::findOne($lotId)->getMinimumRate();
            $historyDataProvider = $queryHistoryLots->asArray()->all();
            $isProfileStatus = $currentLotInfo->isProfileSumSet();
            $changeProfileSum = "";
            $lotInfo = [
                'currentPrice'=>Yii::$app->formatter->asDecimal($currentLotInfo->getCurrentPrice(),0),
                'currentLeader'=>$currentLotInfo->getLeader(),
                'count'=>$currentLotInfo->getHistoryLots()->count(),
                'isProfileStatus'=>$isProfileStatus,

            ];
            return [
                'lotInfo'=>$lotInfo,
                'historyDataProvider'=>$historyDataProvider,
                'maxRate'=>$maxRate,
                'changeProfileSum'=>$changeProfileSum,
            ];


        }
    }


    public function addRating($lotId, $profileLotId)
    {
        $resultsInfo = '';
        $modelLot = Lots::findOne($lotId);
        $summLast = $modelLot->getMinimumRate();

        $lastHistroyLot = HistoryLots::find()->where("lot_id=" . $lotId)->orderBy('sum DESC,id DESC')->one();

        if ($lastHistroyLot !== null) {
            if ($lastHistroyLot->excess == 2) {
                $lastHistroyLot->excess = 1;
                $lastHistroyLot->save();
            }
        }


        if ($lastHistroyLot->user_id != Yii::$app->user->id) {
            $minimumRate = $modelLot->getMinimumRate();
            $lastProfileLot = ProfileLots::find()->where("id<>" . $profileLotId . " AND lot_id=" . $lotId . " AND sum>=" . $minimumRate)->orderBy('sum DESC')->one();
            $currentProfileLot = ProfileLots::findOne($profileLotId);

            if ($lastProfileLot !== null && $lastProfileLot->sum < $currentProfileLot->sum) {
                $model = new HistoryLots();
                $model->lot_id = $lastProfileLot->lot_id;
                $model->user_id = $lastProfileLot->user_id;
                $model->sum = $lastProfileLot->sum;
                $model->excess = 1;
                $model->nickname = User::findOne($lastProfileLot->user_id)->nickname;
                $model->save();

                $modelTwo = new HistoryLots();
                $modelTwo->lot_id = $currentProfileLot->lot_id;
                $modelTwo->user_id = $currentProfileLot->user_id;
                $summ = $lastProfileLot->sum + ($lastProfileLot->sum / 100 * Yii::$app->params['ratePercent']);
                if (($summ - $lastProfileLot->sum) < 1) {
                    $summ = $lastProfileLot->sum + 1;
                }
                $modelTwo->sum = $summ;
                $modelTwo->nickname = User::findOne($currentProfileLot->user_id)->nickname;
                $modelTwo->save();
                $modelLot->price = $summ;
                $modelLot->save();

            } elseif ($lastProfileLot === null) {
                $model = new HistoryLots();
                $model->lot_id = $currentProfileLot->lot_id;
                $model->user_id = $currentProfileLot->user_id;
                $summ = $summLast;
                $model->sum = $summ;
                $model->nickname = User::findOne($currentProfileLot->user_id)->nickname;
                $model->save();
                $modelLot->price = $summ;
                $modelLot->save();
            } elseif ($lastProfileLot->sum >= $currentProfileLot->sum) {
                $model = new HistoryLots();
                $model->lot_id = $currentProfileLot->lot_id;
                $model->user_id = $currentProfileLot->user_id;
                $model->sum = $currentProfileLot->sum;
                $model->excess = 1;
                $model->nickname = User::findOne($currentProfileLot->user_id)->nickname;
                $model->save();
                $modelLot->price = $model->sum;
                $modelLot->save();
                $this->changeRating($lotId, $currentProfileLot->id);
            }


        }
        return $resultsInfo;

    }

    public function changeRating($id, $currentId)
    {
        $modelLot = Lots::findOne($id);
        $profileLotEqual = ProfileLots::find()->where("id<>" . $currentId . " AND lot_id=" . $id . " AND sum=" . $modelLot->price)->orderBy('id ASC')->all();
        if (!empty($profileLotEqual)) {
            $sum = $modelLot->price;
            foreach ($profileLotEqual as $prlot) {
                $userInfo = User::findOne($prlot->user_id);
                Yii::$app->db->createCommand()->insert('im_history_lots', [
                    'lot_id' => $id,
                    'user_id' => $prlot->user_id,
                    'sum' => $sum,
                    'excess' => 1,
                    'create_date'=>new Expression('NOW()'),
                    'nickname'=>$userInfo->nickname,
                ])->execute();
            }

            $modelLot->price = $sum;
            $modelLot->save();

            $minimumRate = $modelLot->getMinimumRate();
            $model = new HistoryLots();
            $model->lot_id = $id;
            $model->user_id = Yii::$app->user->id;
            $model->sum = $minimumRate;
            $model->nickname = User::findOne(Yii::$app->user->id)->nickname;
            $model->save();

            $modelLot->price = $model->sum;
            $modelLot->save();

            unset($model);
        }

        $minimumRate = $modelLot->getMinimumRate();

        $profileLots = ProfileLots::find()->where("lot_id=" . $id . " AND sum>=" . $minimumRate)->orderBy('sum DESC')->one();
        if ($profileLots !== null) {
            $model = new HistoryLots();
            $model->lot_id = $id;
            $model->user_id = $profileLots->user_id;
            $model->sum = $minimumRate;
            $model->nickname = User::findOne($profileLots->user_id)->nickname;
            $model->save();

            $modelLot->price = $model->sum;
            $modelLot->save();

        }




    }

    /**
     * Finds the Lots model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Lots the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Lots::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
