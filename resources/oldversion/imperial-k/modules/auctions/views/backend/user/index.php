<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\grid\DataColumn;
use app\modules\auctions\models\PaymentHistory;

$this->title = 'Пользователи';
$this->params['breadcrumbs'][] = $this->title;
$this->params['h1Title'] = $this->title;
?>
<div class="col-xs-12">
    <div class="box">
        <div class="box-header">
        </div>


        <div class="box-body">
            <?=
            GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'tableOptions'=>['class'=>'user-table-admin table table-striped table-bordered'],
                'columns' => [

                    [
                        'label' => 'Логин',
                        'attribute'=>'username',
                        'format' => 'raw',
                        'value' => function ($data) {
                                return Html::a($data->username, ['view', 'id' => $data->id]);
                            }
                    ],
                    [
                        'label' => 'Ф.И',
                        'format' => 'raw',
                        'value' => function ($data) {
                                return Html::a($data->profile->firstname . ' ' . $data->profile->lastname, ['view', 'id' => $data->id]);
                            }
                    ],
                    'nickname',
                    'created_at',

                    [
                        'label' => 'Статус на аукционе',
                        'format' => 'raw',
                        'value' => function ($data) {
                                return ($data->status == 10) ? 'Активен' : 'Забанен';
                            }
                    ],
                    [
                        'label' => 'Забл./Разбл.',
                        'format' => 'raw',
                        'value' => function ($data) {
                                $link = '';
                                if ($data->role == 10) {
                                    if ($data->status == 10) {
                                        $link = Html::a('Забл.', ['block', 'id' => $data->id]);
                                    } else {
                                        $link = Html::a('Разбл.', ['activate', 'id' => $data->id]);
                                    }
                                }
                                return $link;
                            }
                    ],
                    //'email',
                    [
                       'format'=>'raw',
                       'value'=>function($data){
                           $class = 'label ';
                           if($data->role == 20){
                               $out = 'Администратор';
                               $class .='label-danger';
                           }else if($data->role == 15) {
                               $out = 'Модератор';
                               $class .='label-success';
                           }else {
                               $out = 'Пользователь';
                               $class .='label-info';
                           }
                           return '<span class="'.$class.'">'.$out.'</span>';
                       }
                    ],
                    'email',
//                    [
//                        'label' => 'Дата последнего захода',
//                        'format' => 'raw',
//                        'value' => function ($data) {
//                                return $data->updated_at;
//                            }
//                    ],
                    [
                        'label' => 'Сумма всех покупок',
                        'format' => 'raw',
                        'value' => function ($data) {

                                return Yii::$app->formatter->asDecimal($data->allcost, 0);
                            }
                    ],
                    [
                        'label' => 'Сумма оплаченных покупок',
                        'format' => 'raw',
                        'value' => function ($data) {
                                $sum = PaymentHistory::find()->where(['type'=>PaymentHistory::OPERATION_PLUS,'user_id'=>$data->id])->sum('sum');
                                if($sum === null){
                                    $sum = 0;
                                }
                                return $sum;
                            }
                    ],
                    [
                        'label' => 'Остаток на счете',
                        'format' => 'raw',
                        'contentOptions' => ['style' => 'width:20px;'],
                        'value' => function ($data) {
                                return $data->payment->inv;
                            }
                    ],
                    [
                        'label' => 'Кол-во покупок',
                        'format' => 'raw',
                        'value' => function ($data) {
                                return $data->winlotsCount;
                            }
                    ],


                    [
                        'class' => 'yii\grid\ActionColumn',
                        'template' => '{update}{delete}',
                    ],
                ],
            ]); ?>
        </div>
    </div>

</div>