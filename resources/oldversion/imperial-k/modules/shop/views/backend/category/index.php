<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\MenusSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Категории';
$this->params['breadcrumbs'][] = $this->title;
$this->params['h1Title'] = $this->title;
?>
<div class="col-xs-12">
    <div class="box">
        <div class="box-header">
            <p>
                <?= Html::a('Создать категорию', ['create'], ['class' => 'btn btn-success']) ?>
            </p>
        </div>


        <div class="box-body">

            <?=
            GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    'id',
                    [
                      'attribute'=>'name',
                      'format'=>'raw',
                      'value' => function ($data) {
                                return '<div style="padding-left:'.$data->depth * 10 .'px">'.$data->name.'</div>';
                      },
                    ],
                    ['class' => 'yii\grid\ActionColumn'],
                ],
            ]); ?>
        </div>


    </div>
</div>