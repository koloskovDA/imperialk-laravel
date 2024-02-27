<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\modules\auctions\models\Auctions */

$this->title = 'Сообщения';
$this->params['breadcrumbs'][] = $this->title;
$this->params['h1Title'] = $this->title;
?>
<div class="col-xs-12">
    <div class="box">
        <div class="box-header">
                <p>
                    <?= Html::a('Написать сообщение', ['create'], ['class' => 'btn btn-success']) ?>
                </p>

        </div>
        <div class="box-body">
            <?=
            GridView::widget([
                'dataProvider' => $dataProvider,
                'layout' => "{pager}\n{summary}\n{items}\n{pager}",
                'rowOptions' => function ($model, $index, $widget, $grid){
                        $style = '';
                        if($model->status == \app\models\Messages::STATUS_NEW){
                            $style = 'font-weight:bold;';
                        }
                        return ['style'=>$style];
                    },
                'columns' => [
//                    [
//                        'attribute'=>'user_to',
//                        'value'=>function($data){
//                             return $data->sender->username;
//                        }
//                    ],
                    [
                        'attribute'=>'user_id',
                        'value'=>function($data){
                                return $data->author->username;
                            }
                    ],
                   'text',
                   'status',
                   'date',
                    [
                        'class' => 'yii\grid\ActionColumn',
                        'controller'=>'backend/messages',
                        'template'=>'{view}{update}{delete}',
                    ],
                ],
            ]); ?>


        </div>

    </div>
</div>


