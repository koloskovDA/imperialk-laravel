<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\pages\models\Page */

$this->title = 'Редактирование ' . ' ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Pages', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
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
