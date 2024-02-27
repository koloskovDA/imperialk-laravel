<?php
use yii\helpers\Html;
use yii\grid\GridView;
use yii\grid\DataColumn;
use yii\widgets\DetailView;



$this->title = 'Пользователь '.$model->profile->firstname.' '.$model->profile->lastname;
$this->params['breadcrumbs'][] = ['label' => 'Пользователи', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$this->params['h1Title'] = $this->title;
?>
<div class="col-xs-12">
    <div class="box">
        <div class="box-header">
        </div>

        <div class="box-body">
            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'username',
                    'email',
                    'profile.firstname',
                    'profile.lastname',
                    'profile.patronym',
                    'nickname',
                    [
                        'label'=>'Выигранные  лоты',
                        'format'=>'raw',
                        'value'=>Html::a("Посмотреть",["winlots","id"=>$model->id]),

                    ],

                    [
                        'label'=>'Биды',
                        'format'=>'raw',
                        'value'=>Html::a("Посмотреть",["showbids","id"=>$model->id]),
                    ],
                    [
                        'label'=>'Количество выигранных лотов',
                        'value'=>$model->winlotsCount,
                    ],
                    [
                        'label'=>'Остаток на счете',
                        'value'=>$model->payment->inv,
                    ],
                    [
                        'label'=>'Выиграно лотов на сумму ',
                        'value'=>($model->allcost === null) ? 0 : Yii::$app->formatter->asDecimal($model->allcost,0),
                    ],
                    [
                        'label'=>'Комиссионный процент',
                        'format'=>'raw',
                        'value'=>$model->payment->commission.'  '.Html::a('Изменить',['paymentupdate','user_id'=>$model->id]),

                    ],
                    [
                        'label'=>'Сумма по текущим аукционам',
                        'value'=>$currentSum,
                    ],
                    [
                        'label'=>'История изменения счета',
                        'format'=>'raw',
                        'value'=>Html::a("Посмотреть",["paymenthistory","id"=>$model->id]),
                    ],
                    [
                        'label'=>'Сообщения',
                        'format'=>'raw',
                        'value'=>Html::a("Сообщения",["/auctions/backend/messages/inbox","id"=>$model->id]),
                    ]

                ],
            ]) ?>

        </div>
    </div>
</div>