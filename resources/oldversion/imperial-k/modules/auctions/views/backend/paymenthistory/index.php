<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\auctions\models\search\PaymentHistory */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Payment Histories';
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
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],

                    'id',
                    'user_id',
                    'text:ntext',
                    'sum',
                    'type',
                    // 'created_at',

                    ['class' => 'yii\grid\ActionColumn'],
                ],
            ]); ?>

        </div>
    </div>
</div>