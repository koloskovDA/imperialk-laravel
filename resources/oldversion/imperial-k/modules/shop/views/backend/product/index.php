<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use yii\grid\SerialColumn;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\shop\models\search\ProductSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Продукты';
$this->params['breadcrumbs'][] = $this->title;
$this->params['h1Title'] = $this->title;
?>
<div class="col-xs-12">
    <div class="box">
        <div class="box-header">
            <p>
                <?= Html::a('Добавить продукт', ['create'], ['class' => 'btn btn-success']) ?>
            </p>
        </div>


        <div class="box-body">
            <?=
            GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    ['class' => SerialColumn::class],
                    [
                      'format'=>'raw',
                      'value'=>function($data){
                              return Html::img($data->show(100,100));
                      }

                    ],
                    'sku',
                    'name',
                    'price',
                    [
                        'format'=>'raw',
                        'value'=>function($data){
                                return Html::a('Добавить на главную',Url::to(['/auctions/backend/lookup/add','id'=>$data->id,'type'=>'product']));
                            }

                    ],

                    // 'weight',
                    // 'metal',
                    // 'diameter',
                    // 'packing',
                    // 'trial',
                    // 'quality_coin',
                    // 'degree_safe',
                    // 'circulation',
                    // 'specificity',
                    // 'image',
                    // 'description:ntext',
                    // 'category_id',
                    // 'seo_title',
                    // 'seo_description:ntext',
                    // 'h1_title',

                    ['class' => 'yii\grid\ActionColumn'],
                ],
            ]); ?>
        </div>
    </div>
</div>
