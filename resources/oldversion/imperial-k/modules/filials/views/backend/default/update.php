<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\news\models\News */

$this->title = 'Редактирование' . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'News', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
$this->params['h1Title'] = $this->title;
?>
<div class="box">
    <div class="box_body">

        <?=
        $this->render('_form', [
            'model' => $model,
        ]) ?>

    </div>
</div>
