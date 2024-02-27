<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\auctions\models\search\HistoryLotsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'History Lots';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="history-lots-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create History Lots', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'sum',
            'create_date',
            'user_id',
            'lot_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
