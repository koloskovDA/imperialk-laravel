<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\news\models\search\NewsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Новости';
$this->params['breadcrumbs'][] = $this->title;
$this->params['h1Title'] = $this->title;
?>

<div class="col-xs-12">
    <div class="box">
        <div class="box-header">
            <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
            <p>
                <?= Html::a('Добавить новость', ['create'], ['class' => 'btn btn-success']) ?>
            </p>
        </div>
        <div class="box-body">
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    [
                      'attribute'=>'img',
                      'format'=>'raw',
                      'value'=>function($data){
                              return Html::img($data->show(50,50),['width'=>50,'height'=>50]);
                          }
                    ],
                    'name',
                    'content:ntext',


                    // 'created_at',
                    // 'seo_title',
                    // 'seo_keywords:ntext',
                    // 'seo_description:ntext',

                    ['class' => 'yii\grid\ActionColumn'],
                ],
            ]); ?>
        </div>

    </div>
</div>