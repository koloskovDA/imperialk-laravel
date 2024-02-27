<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Messages */

$this->title = 'Отправка сообщения';
$this->params['breadcrumbs'][] = ['label' => 'Messages', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
$this->params['h1Title'] = $this->title;
?>
<div class="box">
    <div class="box_body">

        <?= $this->render('_formcreate', [
            'model' => $model,
        ]) ?>

    </div>
</div>
