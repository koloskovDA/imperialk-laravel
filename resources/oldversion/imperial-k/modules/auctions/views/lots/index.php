<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\auctions\models\search\LotsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Lots';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="lots-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Lots', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'number',
            'nominal',
            'year',
            'letter',
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
