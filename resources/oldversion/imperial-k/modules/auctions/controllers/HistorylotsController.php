<?php
/**
 * Created by PhpStorm.
 * User: Мухтар
 * Date: 31.01.15
 * Time: 4:11
 */

namespace app\modules\auctions\controllers;

use app\modules\auctions\models\HistoryLots;
use app\modules\auctions\models\Lots;
use app\modules\auctions\models\ProfileLots;
use Yii;
use yii\db\Expression;
use yii\debug\models\search\Profile;
use yii\web\Controller;
use yii\web\Response;
use yii\widgets\ActiveForm;
use app\models\User;

class HistorylotsController extends Controller
{

//   public function actionTest()
//   {
//       $historyLots = HistoryLots::find()->all();
//       print count($historyLots);
//       foreach($historyLots as $hl){
//           $user = User::findOne($hl->user_id);
//           Yii::$app->db->createCommand()->update('im_history_lots', ['nickname' => $user->nickname], 'id='.$hl->id)->execute();
//           unset($user);
//
//       }
//       $emptyHistoryLots = HistoryLots::find()->where(['nickname'=>''])->all();
//       echo "<br />".count($emptyHistoryLots);
//
//   }


    public function changeRate($historyLotId)
    {
        $modelLot = Lots::findOne($historyLotId);
        $currentPrice = $modelLot->price;
        $minimuRate = $currentPrice + ($currentPrice / 100 * Yii::$app->params['ratePercent']);
        $offset = $minimuRate - $currentPrice;
        if (($offset) < 1) {
            $minimuRate = $currentPrice + 1;
            $offset = 1;
        }

        $profileLots = ProfileLots::find()->where("lot_id=" . $historyLotId . " AND sum>=" . $minimuRate)->orderBy('sum ASC')->asArray()->all();


        $prLotsYes = false;
        if (count($profileLots) > 0) {
            $prLotsYes = true;
        }

        while (!empty($profileLots)) {
            foreach ($profileLots as $key => $lot) {
                $userInfo = User::findOne($lot['user_id']);
                $model = new HistoryLots();
                $model->lot_id = $lot['lot_id'];
                $model->user_id = $lot['user_id'];
                $model->sum = $minimuRate;
                $model->nickname = $userInfo->nickname;
                $model->save();
                $lastSum = $minimuRate;
                $minimuRate = $minimuRate + ($minimuRate / 100 * Yii::$app->params['ratePercent']);
                if (($minimuRate - $lastSum) < 1) {
                    $minimuRate = $lastSum + 1;
                }

                if ($minimuRate > $lot['sum']) {
                    if ($lastSum != $lot['sum']) {
                        $model = new HistoryLots();
                        $model->lot_id = $lot['lot_id'];
                        $model->user_id = $lot['user_id'];
                        $model->sum = $lot['sum'];
                        $model->nickname = $userInfo->nickname;
                        $model->save();
                    }


                    unset($profileLots[$key]);
                }
            }
            if (count($profileLots) == 1) {
                break;
            }
        }


        if (count($profileLots) == 0) {
            $lastProfileLots = ProfileLots::find()->where("lot_id=" . $historyLotId . " AND sum>=" . $currentPrice)->orderBy('sum ASC')->one();

            if ($lastProfileLots) {
                $userInfoLast = User::findOne($lastProfileLots->user_id);
                Yii::$app->db->createCommand()->insert('im_history_lots', [
                    'lot_id' => $lastProfileLots->lot_id,
                    'user_id' => $lastProfileLots->user_id,
                    'sum' => $lastProfileLots->sum,
                    'excess' => 1,
                    'create_date' => new Expression('NOW()'),
                    'nickname'=>$userInfoLast->nickname,

                ])->execute();


                $modelLot->price = $lastProfileLots->sum;
                $modelLot->save();
            }
        }
        if ($prLotsYes) {
            $modelLot->price = $lastSum;
            $modelLot->save();
        }

    }

    public function actionAddrate()
    {
        $model = new HistoryLots();
        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            Yii::$app->response->charset = 'UTF-8';
            $errors = ActiveForm::validate($model);
            $lastHistoryLot = HistoryLots::find()->where(['lot_id' => $model->lot_id])->orderBy('sum DESC,id DESC')->one();

            if (!empty($errors)) {
                return ['error' => $errors];
            }

            $lotModel = Lots::findOne($model->lot_id);

            if(time() > strtotime($lotModel->closing_date)){
                return ['error'=>['timeout'=>"Время истекло для лота"]];
            }

//            if($lastHistoryLot->user_id == Yii::$app->user->id){
//                return ['error'=>[
//                    'access'=>'Вы не можете перебить вашу ставку']
//                ];
//            }





            if ($lastHistoryLot !== null) {
                if ($lastHistoryLot->excess == 2) {
                    $lastHistoryLot->excess = 1;
                    $lastHistoryLot->save();
                }

                $profileLots = ProfileLots::find()->where("lot_id=" . $model->lot_id . " AND sum>" . $lastHistoryLot->sum . " AND sum< " . $model->sum)->orderBy('sum ASC')->all();

                foreach ($profileLots as $pl) {
                    $userInfo = User::findOne($pl->user_id);
                    Yii::$app->db->createCommand()->insert('im_history_lots', [
                        'lot_id' => $model->lot_id,
                        'user_id' => $pl->user_id,
                        'sum' => $pl->sum,
                        'excess' => 1,
                        'create_date' => new Expression('NOW()'),
                        'nickname'=>$userInfo->nickname,
                    ])->execute();
                }
            }

            $model->nickname = Yii::$app->user->identity->nickname;
            $model->save();
            $lotModel = Lots::findOne(['id' => $model->lot_id]);
            $lotModel->price = $model->sum;
            $lotModel->save();
            $this->changeRate($model->lot_id);
            $modelProfileLot = ProfileLots::find()->where(['lot_id' => $model->lot_id, 'user_id' => $model->user_id])->one();

            if ($modelProfileLot === null) {
                $newProfileLot = new ProfileLots();
                $newProfileLot->lot_id = $model->lot_id;
                $newProfileLot->user_id = $model->user_id;
                $newProfileLot->sum = 0;
                $newProfileLot->save();
            }


            $queryHistoryLots = HistoryLots::find();
            $queryHistoryLots->andWhere(['{{%history_lots}}.lot_id' => $model->lot_id]);
            $queryHistoryLots->addOrderBy('{{%history_lots}}.sum DESC,{{%history_lots}}.id DESC');
            $queryHistoryLots->leftJoin('{{%user}}', '{{%user}}.id={{%history_lots}}.user_id');
            $queryHistoryLots->select(['{{%history_lots}}.nickname AS nickname','{{%history_lots}}.sum','DATE_FORMAT({{%history_lots}}.create_date,"%T %d.%m.%Y") as create_date','{{%history_lots}}.excess']);

            $currentLotInfo = Lots::findOne($model->lot_id);
            $maxRate = $currentLotInfo->getMinimumRate();
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
                'error'=>'',
            ];

        }


    }

}



