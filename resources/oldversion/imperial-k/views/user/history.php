<?php
use yii\helpers\Html;
use yii\helpers\Url;
?>
<h2 style="font-size: 16px;">Профайл: <?= Yii::$app->user->identity->profile->firstname.' '. Yii::$app->user->identity->profile->lastname?></h2>

<p class="main">Остаток на счете: <b><?= Yii::$app->user->identity->payment->inv ?> руб.</b></p>
<p class="main">Выигранно лотов на сумму: <b><?= (Yii::$app->user->identity->allcost === null) ? 0 : Yii::$app->formatter->asDecimal(Yii::$app->user->identity->allcost,0) ?> руб.</b></p>
<p class="main">Ваш комиссионный процент: <b><?= Yii::$app->user->identity->payment->commission ?> %</b></p>
<p class="main">Сумма по текущим аукционам: <b> <?= $currentSum ?> руб.</b></p>
<h1>История изменения счета</h1>


<?=
\yii\grid\GridView::widget([
    'dataProvider' => $dataProvider,
    'layout'=>'{items}{pager}',
    'columns'=>[
        'created_at',
        [
            'label'=>'Обоснование',
            'attribute'=>'text',
            'value'=>$data->text,

        ],
        [
            'label'=>'Сумма операции',
            'attribute'=>'sum',
            'value'=>$data->sum,
        ],

        [
            'label'=>'Остаток',
            'value'=>function ($data){
                    return $data->balance;
                }
        ]
    ]
])
?>
