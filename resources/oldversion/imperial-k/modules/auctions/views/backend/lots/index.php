<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\auctions\models\search\LotsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Все лоты';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="lots-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Добавить лот', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'number',
            [
                'attribute' => 'nominal',
                'format' => 'raw',
                'value' => function ($model) {
                        return $model->nominal;
                },
                'contentOptions'=>['style'=>'max-width: 200px;']

            ],
            [
                'attribute'=>'auction_id',
                'format'=>'raw',
                'value'=>function($model){
                        return $model->auction->name;

                }
            ],

            // 'metal',
            // 'saves',
            // 'price',
            // 'image',
            // 'created_date',
            // 'closing_date',
            // 'publisher_draft',
            // 'auction_id',
            // 'category_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
