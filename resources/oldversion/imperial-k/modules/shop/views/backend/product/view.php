<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\shop\models\Product */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Продукты', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$this->params['h1Title'] = $this->title;
?>
<div class="box">
    <div class="box_body" style="padding: 10px;">

        <p>
            <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
            <?=
            Html::a('Delete', ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => 'Are you sure you want to delete this item?',
                    'method' => 'post',
                ],
            ]) ?>
        </p>

        <?=
        DetailView::widget([
            'model' => $model,
            'attributes' => [
                'id',
                'sku',
                'name',
                'slug',
                'price',
                'weight',
                'metal',
                'diameter',
                'packing',
                'trial',
                'quality_coin',
                'degree_safe',
                'circulation',
                'specificity',
                'image',
                'description:ntext',
                'category_id',
                'seo_title',
                'seo_description:ntext',
                'h1_title',
            ],
        ]) ?>
    </div>
</div>
