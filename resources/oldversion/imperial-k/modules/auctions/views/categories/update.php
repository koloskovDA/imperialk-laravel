<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\auctions\models\Categories */

$this->title = 'Редактирование';
$this->params['breadcrumbs'][] = ['label' => 'Categories', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Редактирование';
$this->params['h1Title'] = $this->title;
?>
<div class="box">
    <div class="box_body">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
    </div>
