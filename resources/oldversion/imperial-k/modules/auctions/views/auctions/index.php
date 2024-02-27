<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\grid\DataColumn;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\auctions\models\search\AuctionsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Аукционы';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="auctions-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute'=>'name',
                'format'=>'raw',
                'value'=>function($data){
                        return Html::a($data->name,['auctions/view','id'=>$data->id]);
                }
            ],
            'slug',
            'type',
            'closing_date',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
