<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\auctions\models\search\ProfileLotsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Заочные биды';
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
                    'id',
                    [
                        'attribute' => 'lot_id',
                        'value' => function ($data) {
                                return $data->lot->nominal;
                            },
                    ],
                    [
                        'attribute' => 'user_id',
                        'value' => function ($data) {
                                return $data->user->username;
                            },
                    ],
                    'sum',

                    ['class' => 'yii\grid\ActionColumn'],
                ],
            ]); ?>

        </div>
    </div>
</div>